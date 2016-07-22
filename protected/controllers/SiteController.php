<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'

		$criteria = new CDbCriteria();
		/*$criteria->select = "t.*, est.identificador, p.nombre, p.apellido";
		$criteria->from = 'viajes as t';
		$criteria->join = "JOIN estacion est ON est.id = t.id_estacion";
		$criteria->join .= " JOIN personal as p ON p.id = t.id_responsable";
		$criteria->join .= " JOIN solicitudes_viaje as sv ON sv.id_viaje = t.id";
		$criteria->condition = "t.status = '2'"; //statis = 2 --> viajes en ruta*/
		
		$model = Yii::app()->db->createCommand()
			->selectDistinct("t.*, est.identificador, p.nombre, p.apellido")
			->from('viajes as t')
			->join("estacion est","est.id = t.id_estacion")
			->join("personal as p","p.id = t.id_responsable")
			->join("solicitudes_viaje as sv","sv.id_viaje = t.id")
			->where("t.status = '2
				+.0'")
				->queryAll();

				/*lo voy a ocupar no borrar**/
		$viajes_disponibles =  Yii::app()->db->createCommand(
				'SELECT v.id as "id_viaje", est.identificador as "nombre", 
					(SELECT count(t.id) 
						FROM tanque as t 
						WHERE t.id_estacion = v.id_estacion 
						AND t.status = 1 
						AND t.activo = 1) as "disponibles", 
					(SELECT DISTINCT cd.domicilio 
						FROM solicitudes_viaje as sv 
						JOIN solicitud_tanques as st ON st.id_solicitud = sv.id_solicitud 
						JOIN clientes_domicilio as cd ON cd.id = st.id_domicilio 
						WHERE sv.id_viaje = v.id ORDER BY cd.id DESC LIMIT 1) as "ultimo"
				FROM viajes as v 
				JOIN estacion as est ON est.id=v.id_estacion 
				WHERE v.status = 1')
			->queryAll();

		$this->render('index', array('enruta'=>$model, 'enespera'=> $viajes_disponibles));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest){
				echo $error['message'];
			}else{

                switch($error['code'])
                {
                        case 403:

                                $this->render('error403', array('error' => $error));
                                break;
                        default:
                        		$this->render('error', $error);

                }
				
			}
		}
	}





	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
                        {
                            $usuario = Usuarios::model()->findBySql("SELECT id_usr, tipo_usr FROM usuarios WHERE usuario = '".Yii::app()->user->id."'");
                            if($usuario->tipo_usr == 1)
                            {
                                Yii::app()->user->id = 'Cliente';
                            }
                            elseif($usuario->tipo_usr == 2)
                            {
                                $personal = Personal::model()->findByPk($usuario->id_usr);
                                $rol = Roles::model()->findByPk($personal->id_rol);
                                Yii::app()->user->id = $rol->nombre_rol;
                            }
                            $this->redirect(Yii::app()->user->returnUrl);
                        }
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
	public function actionDashboardTanques($id) {
		$return['result'] = 0 ;
		$return['html'] = "";
		$last = Yii::app()->db->createCommand("SELECT ut.* FROM uploadTemp as ut INNER JOIN (SELECT MAX(id) as id, id_viaje FROM escalon_viaje_ubicacion where id_viaje = {$id}) evu ON evu.id = ut.id_escalon_viaje_ubicacion")
		->queryAll();

            if(count($last) > 0)
            {
                foreach($last as $data)
                {
                   $return["html"] .= "
                   	<div class='tanque'>
                   	<div class='tanque-container-titulo'>
                   		<span class='titulotanque'> Tanque {$data["ct"]}</span></div>
                   		<div class='variables-wrapper'> 
                   			<div class='var-oz'>
                   				<div class='icon-oz'></div>
                   				<div class='txt'>{$data["ox"]}</div>
                   			</div>
                   			<div class='var-ph'>
                   				<div class='icon-ph'></div>
                   				<div class='txt'>{$data["ph"]}</div>
                   			</div>
                   			<div class='var-tm'>
                   				<div class='icon-tm'></div>
                   				<div class='txt'>{$data["temp"]}</div>
                   			</div>
                   		</div>
                   	</div>";
                }
                $return['result'] = 1;
            }
            else
            {
                $return['result'] = 0;
                $return["html"] .="<div class='letreroError'>Este viaje no tiene registros de viaje en ruta, porfavor, p&oacute;ngase en contacto con el administrador.</div>"; 

            }
            echo json_encode($return);
	}


	public function actionPrueba($id) {
			$return['result'] = 0 ;
		    $return['html'] = "";
         	$last =  Yii::app()->db->createCommand("SELECT v.id,est.identificador FROM viajes as v JOIN estacion as est ON est.id = v.id_estacion where v.id = {$id}")
			->queryAll();

			if(count($last)>0){
                foreach($last as $data){
 				$return["html"] = "<label class='tituloV3'>3.Ubicación: {$data["identificador"]}</label>";
				}
        	$return['result'] = 1;
    	}
        echo json_encode($return);
	}




	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}