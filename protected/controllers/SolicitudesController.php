<?php

class SolicitudesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		//	'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
        {
            $return = array();
            if(Yii::app()->user->checkAccess('createSolicitudes') || Yii::app()->user->id == 'smobiladmin')
                $return[] = array
                (
                    'allow',
                    'actions'   => array('create'),
                    'users'     => array('*')
                );
            else
                $return[] = array
                (
                    'deny',
                    'actions'   => array('create'),
                    'users'     => array('*')
                );
            if(Yii::app()->user->checkAccess('readSolicitudes') || Yii::app()->user->id == 'smobiladmin')
                $return[] = array
                (
                    'allow',
                    'actions'   => array('index','view'),
                    'users'     => array('*')
                );
            else
                $return[] = array
                (
                    'deny',
                    'actions'   => array('index','view'),
                    'users'     => array('*')
                );
            if(Yii::app()->user->checkAccess('editSolicitudes') || Yii::app()->user->id == 'smobiladmin')
                $return[] = array
                (
                    'allow',
                    'actions'   => array('update'),
                    'users'     => array('*')
                );
            else
                $return[] = array
                (
                    'deny',
                    'actions'   => array('update'),
                    'users'     => array('*')
                );
            if(Yii::app()->user->checkAccess('deleteSolicitudes') || Yii::app()->user->id == 'smobiladmin')
                $return[] = array
                (
                    'allow',
                    'actions'   => array('delete'),
                    'users'     => array('*')
                );
            else
                $return[] = array
                (
                    'deny',
                    'actions'   => array('delete'),
                    'users'     => array('*')
                );
            return $return;
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		  $model = new Solicitudes();
          $estacion = new Estacion();
          $especies = new Especie();
          $cepa = new Cepa();
          $direccion = new ClientesDomicilio();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST) && $_POST != '' && $_POST != null)
		{
                    $model->attributes=$_POST['Solicitudes'];
                    $model->fecha_alta = date('Y-m-d');
                    $model->hora_alta = date('H:i');
                    $model->fecha_entrega = null;
                    $model->fecha_estimada = null;
                    $model->codigo = 'En proceso';
                    if($model->id != '')
                    {
                        $model2 = Solicitudes::model()->findByPk($model->id);
                        $model2->update();
                        $delete = Yii::app()->db->createCommand("DELETE FROM pedidos WHERE id_solicitud = $model->id")->execute();
                        foreach($_POST['pedido'] as $data)
                        {
                            $pedido = new Pedidos();
                            $pedido->id_cepa = $data['cepa'];
                            $pedido->id_especie = $data['especie'];
                            $pedido->id_solicitud = $model->id;
                            $pedido->id_direccion = $data['destino'];
                            $pedido->tanques = $data['tanques'];
                            $pedido->cantidad = $data['cantidad'];
                            $pedido->save();
                        }
                        $this->redirect(array('index'));
                    }
                    elseif($model->save())
                    {
                        $model->id = Yii::app()->db->getLastInsertId();
                        foreach($_POST['pedido'] as $data)
                        {
                            $pedido = new Pedidos();
                            $pedido->id_cepa = $data['cepa'];
                            $pedido->id_especie = $data['especie'];
                            $pedido->id_solicitud = $model->id;
                            $pedido->id_direccion = $data['destino'];
                            $pedido->tanques = $data['tanques'];
                            $pedido->cantidad = $data['cantidad'];
                            $pedido->save();
                        }
                        $this->redirect(array('index'));
                    }
		}
		$this->render('create',array(
                    'model'=>$model,
                    'estaciones'=>$estacion,
                    'especies'=>$especies,
                    'cepa'=>$cepa,
                    'direccion'=>$direccion,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
        public function getViajes()
        {
            $estaciones = Estacion::model()->findAll('tipo = 1');
            $viajes = Viajes::model()->findAll('status = 1');
            $todosViajes = array();
            foreach($estaciones as $data)
            {
                $tanques = Tanque::model()->findAll("id_estacion = $data->id and status = 1");
                $i = 0;
                $i = count($tanques);
                if($i > 0)
                {
                    $todosViajes[$data->id] = array
                    (
                        'cantidad' => $i,
                        'camion' => $data->identificador
                    );
                }
            }
            $imprimir  = '  <div class="subtitulos">
                                <div>Camión</div>
                                <div>Tanques disponibles</div>
                            </div>
                            <div class="tablaViajes">';
            foreach($viajes as $data)
            {
                if(isset($todosViajes[$data->id_estacion]))
                {
                    $imprimir = $imprimir.<<<eof
                        <div class="renglon">
                            <div>
                                {$todosViajes[$data->id_estacion]['camion']}
                            </div>
                            <div data-tanque="{$todosViajes[$data->id_estacion]['cantidad']}">
                                {$todosViajes[$data->id_estacion]['cantidad']}
                            </div>
                            <div class="viajeLoc" data-viaje="{$data->id}"></div>
                            <div class="viajeSel" data-viaje="{$data->id}"></div>
                        </div>
eof;
                }
            }
            $imprimir = $imprimir.'</div>';
            echo $imprimir;
        }
//        public function actionViajesCreate()
//        {
//            $this->render('viajesCreate',array('pedidos'=>$_POST));
//        }
        public function actionUpdate($id)
	{
            $model=$this->loadModel($id);
            $model->fecha_alta = date('d-m-Y', strtotime($model->fecha_alta));
            $model->hora_alta = date('H:i', strtotime($model->hora_alta));
            $model->fecha_entrega = date('d-m-Y', strtotime($model->fecha_entrega));
            $model->hora_entrega = date('H:i', strtotime($model->hora_entrega));
            $model->fecha_estimada = date('d-m-Y', strtotime($model->fecha_estimada));
            $model->hora_estimada = date('H:i', strtotime($model->hora_estimada));
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
            $pedidos = Pedidos::model()->findAll("id_solicitud =".(int)$id); 
            $direccion = new ClientesDomicilio();
            $especies = new Especie();
            $cepa = new Cepa();
            $estacion = new Estacion();
            if(isset($_POST['Solicitudes']))
            {
                    $model->attributes=$_POST['Solicitudes'];
                    $model->fecha_alta = date('Y-m-d', strtotime($model->fecha_alta));
                    $model->fecha_entrega = date('Y-m-d', strtotime($model->fecha_entrega));
                    $model->fecha_estimada = date('Y-m-d', strtotime($model->fecha_estimada));
                    if($model->save())
                            $this->redirect(array('index'));
            }

            $this->render('update',array(
                    'model'=>$model,
                    'pedidos'=>$pedidos,
                    'estacion'=>$estacion,
                    'direccion'=>$direccion,
                    'especies'=>$especies,
                    'cepa'=>$cepa,
            ));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
                $delete = Yii::app()->db->createCommand("DELETE FROM pedidos WHERE id_solicitud = $id")->execute();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
	/*	if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));*/
		                echo json_encode('');	
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
        {
            $model = new Solicitudes('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Solicitudes']))
                $model->attributes=$_GET['Solicitudes'];
            $this->render('index',array(
                    'model'=>$model,
            ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Solicitudes('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Solicitudes']))
			$model->attributes=$_GET['Solicitudes'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Solicitudes the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Solicitudes::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Solicitudes $model the model to be validated
	 */
        public function actionGetCliente($id, $flag)
        {
            if($flag == 1)
            {
                $cliente = Clientes::model()->findByPk($id);
                $domicilios = ClientesDomicilio::model()->getDireccionClienteSolicitudes($id);
            }
            if($flag == 2)
            {
                $solicitud = Solicitudes::model()->findByPk($id);
                $cliente = Clientes::model()->findByPk($solicitud->id_clientes);
                $domicilios = ClientesDomicilio::model()->getDireccionClienteSolicitudes($solicitud->id_clientes);
            }
            $return = array();
            $cliente = <<<eof
                    <div class="datosContacto">$cliente->nombre_empresa</div>
                    <div class="datosContacto"><span>RFC: </span>$cliente->rfc</div>
                    <div class="datosContacto"><span>Contacto: </span>$cliente->nombre_contacto $cliente->apellido_contacto</div>
                    <div class="datosContacto"><span>E-mail: </span>$cliente->correo</div>
                    <div class="datosContacto"><span>Teléfono: </span>$cliente->tel</div>
eof;
            $return['cliente'] = $cliente;
            $return['domicilio'] = $domicilios;
            echo json_encode($return);
        }
        public function actionGetCepas($id)
        {
            $return = Cepa::model()->getCepasEspecie($id);
            echo json_encode($return);
        }
        public function actionAddDireccion($id, $dom, $coord, $desc)
        {
            $model = new ClientesDomicilio();
            $model->id_cliente = $id;
            $model->domicilio = $dom;
            $model->ubicacion_mapa = $coord;
            $model->descripcion = $desc;
            if($model->save())
            {
                $return = array('boolean' => true, 'id'=>$model->id);
            }
            else
                $return = array('boolean' => false);
            echo json_encode ($return);
        }
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='solicitudes-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
