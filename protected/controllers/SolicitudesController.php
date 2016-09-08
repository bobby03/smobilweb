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
//		 $this->performAjaxValidation($model);

		if(isset($_POST) && $_POST != '' && $_POST != null)
		{
                    $model->attributes=$_POST['Solicitudes'];
                    $model->fecha_alta = date('Y-m-d');
                    $model->hora_alta = date('H:i');
                    $model->fecha_entrega = null;
                    $model->fecha_estimada = null;
                    $codigo = substr(Clientes::model()->getCliente($model->id_clientes),0,2);
                    $codigo = $codigo.date('Ymdhi');
                    $model->codigo = $codigo;
                    if($model->save())
                    {
                        $model->id = Yii::app()->db->getLastInsertId();
                        if(isset($_POST['pedido']))
                        {
                            if(count($_POST['pedido']) > 0)
                            {
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
                            }
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
            $viajes = Viajes::model()->findAll('status = 1');
            $imprimir  = '  <div class="siViaje"><h2>Viajes disponibles</h2>
                            <div class="subtitulos">
                                <div>Camión</div>
                                <div>Tanques disponibles</div>
                            </div>
                            <div class="tablaViajes">';
            foreach($viajes as $data)
            {
                $estacion = Estacion::model()->findByPk($data['id_estacion']);
                $tanques = Tanque::model()->findAll("id_estacion = $estacion->id and activo = 1");
                $solicitudes = Yii::app()->db->createCommand()
                    ->selectDistinct('solT.id_tanque, solV.id_solicitud')
                    ->from('solicitudes_viaje as solV')
                    ->join('solicitud_tanques as solT','solT.id_solicitud = solV.id_solicitud')
                    ->where('solV.id_viaje = '.$data['id'])
                    ->queryAll();
                $i = count($tanques);
                $i = $i - count($solicitudes);
                if($i > 0)
                {
                    $imprimir = $imprimir.<<<eof
                        <div class="renglon">
                            <div>{$estacion->identificador}</div>
                            <div data-tanque="$i">$i</div>
                            <div class="viajeLoc" data-viaje="{$data->id}"></div>
                            <div class="viajeSel" data-viaje="{$data->id}"></div>
                        </div>
eof;
                }

            }
            $imprimir = $imprimir.'</div><h2></h2></div>
                    <div class="noViaje hide"><h2>No hay viajes disponibles</h2></div>';
            echo $imprimir;
        }
//        public function actionViajesCreate()
//        {
//            $this->render('viajesCreate',array('pedidos'=>$_POST));
//        }
        public function actionUpdate($id)
	{
            $model=$this->loadModel($id);
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
                    if($model->save())
                    {
                        $delete = Yii::app()->db->createCommand("DELETE FROM pedidos WHERE id_solicitud = $model->id")->execute();
                        if(isset($_POST['pedido']))
                        {
                            if(count($_POST['pedido']) > 0)
                            {
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
                            }
                        }
                        else
                            $model->delete();
                        if($model->status == 1)
                        {
                            $viajes = Viajes::model()->findAll("id_solicitudes = $model->id");
                            if(count($viajes)>0)
                            {
                                $solVia = SolicitudesViaje::model()->findAll("id_viaje = {$viajes[0]->id} AND id_personal = 0");
                                if(count($solVia)>0)
                                {
                                    $solVia2 = SolicitudesViaje::model()->findAll("id_viaje = {$viajes[0]->id} AND id_solicitud = $model->id");
                                    $id = $solVia[0]->id_solicitud;
                                    foreach($solVia2 as $data)
                                    {
                                        $data['id_solicitud'] = $id;
                                        $update = Yii::app()->db->createCommand()->update("solicitudes_viaje",$data,"id = {$data['id']}");
                                    }
                                    $delete2 = Yii::app()->db->createCommand("DELETE FROM solicitudes_viaje WHERE id_solicitud = $id AND id_personal = 0")->execute();
                                    $viajes[0]->id_solicitudes = $id;
                                    $update = Yii::app()->db->createCommand()->update("viajes",$viajes[0],"id = {$viajes[0]->id}");
                                }
                                else
                                {
                                    $delete2 = Yii::app()->db->createCommand("DELETE FROM solicitudes_viaje WHERE id_solicitud = $model->id")->execute();
                                    $delete4 = Yii::app()->db->createCommand("DELETE FROM viajes WHERE id = {$viajes[0]->id}")->execute();
                                    $camion = Estacion::model()->findByPk($viajes[0]->id_estacion);
                                    $camion->disponible = 1;
                                    $camion->save();                                    
                                }
                            }
                            else
                            {
                                $delete2 = Yii::app()->db->createCommand("DELETE FROM solicitudes_viaje WHERE id_solicitud = $model->id")->execute();
                            }
                            $delete3 = Yii::app()->db->createCommand("DELETE FROM solicitud_tanques WHERE id_solicitud = $model->id")->execute();
                            $model->status = 0;
                            $model->fecha_estimada = null;
                            $model->hora_estimada = null;
                            $model->fecha_entrega = null;
                            $model->hora_entrega = null;
                            $model->save();
                        }
                        $this->redirect(array('index'));
                    }
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
            $model = Solicitudes::model()->findByPk($id);
            $idEstaciones=null;
            if($model->status == 0)
            {
                $delete = Yii::app()->db->createCommand("DELETE FROM pedidos WHERE id_solicitud = $model->id")->execute();
                $model->delete();
            }
            elseif($model->status == 1)
            {
                $tanques = SolicitudTanques::model()->findAll("id_solicitud = $model->id");
                foreach ($tanques as $data)
                {
                    $tanque = Tanque::model()->findByPk($data['id_tanque']);
                    $idEstaciones = $tanque['id_estacion'];
                    if($tanque->save())
                        $delete2 = Yii::app()->db->createCommand("DELETE FROM solicitud_tanques WHERE id_solicitud = $model->id AND id_tanque = {$data['id_tanque']}")->execute();
                }
                $viaje = Viajes::model()->findAll("id_solicitudes = $id");
                if($viaje != null && $viaje != '')
                {
                    $solicitudes = SolicitudesViaje::model()->findAll("id_viaje = {$viaje[0]->id} AND id_personal = 0");
                    if($solicitudes != null && $solicitudes != '')
                    {
                        $viaje[0]->id_solicitudes = $solicitudes[0]->id_solicitud;
                        $update = Yii::app()->db->createCommand()
                            ->update('viajes',$viaje[0]->attributes,"id = {$viaje[0]->id}");
                        $solicitudes2 = SolicitudesViaje::model()->findAll("id_solicitud = $id");
                        foreach ($solicitudes2 as $data)
                        {
                            $data->id_solicitud = $viaje[0]->id_solicitudes;
                            $data->save();
                        }
                        $delete = Yii::app()->db->createCommand("DELETE FROM solicitudes_viaje WHERE id = {$solicitudes[0]->id}")->execute();
                    }
                    else
                    {
                        $solicitudes2 = SolicitudesViaje::model()->findAll("id_viaje = {$viaje[0]->id}");
                        foreach ($solicitudes2 as $data)
                        {
                            $data->id_solicitud = $viaje[0]->id_solicitudes;
                            $data->delete();
                        }
                        $update = Yii::app()->db->createCommand("UPDATE estacion SET disponible= 1 WHERE id = {$viaje[0]->id_estacion}")->execute();
                        $viaje[0]->delete();
                    }
                }
                else
                    $delete = Yii::app()->db->createCommand("DELETE FROM solicitudes_viaje WHERE id_solicitud = $model->id")->execute();
                $model->delete();
            }
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
        public function actionGetDirecciones($id)
        {
            $direcciones = Yii::app()->db->createCommand()
                ->selectDistinct('cliD.domicilio, cli.nombre_empresa')
                ->from('solicitudes_viaje as solV')
                ->join('solicitud_tanques as solT','solT.id_solicitud = solV.id_solicitud')
                ->join('clientes_domicilio as cliD','cliD.id = solT.id_domicilio')
                ->join('clientes as cli', 'cli.id = cliD.id_cliente')
                ->where("solV.id_viaje = $id")
                ->queryAll();
            $return =<<<eof
                    <div class="direccionesContainer">
                        <div class="titulo">Direcciones</div>
                        <div class="direccionesTabla">
eof;
            foreach($direcciones as $data)
            {
                $return =$return.<<<eof
                            <div class="direccion-wraper">
                                <div class="direccionIcono"></div>
                                <div class="direccion">{$data['domicilio']}</div>
                            </div>
eof;
            }
            $return =$return.<<<eof
                            
                        </div>
                    </div>
eof;
            echo json_encode($return);
        }
         public function actionGetViajeId()
        {
            $solicitud = Solicitudes::model()->findByPk($_POST['id']);
            $return = array();
            $return['sol'] = (int)$solicitud->status;
            echo json_encode($return);
            
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
