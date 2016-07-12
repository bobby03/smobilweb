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
			->where("t.status = '2'")
				->queryAll();




		$this->render('index', array('enruta'=>$model));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
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

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}