<?php

class ViajesController extends Controller
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
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}
    public function actionGetTanquesConSolicitud($solicitud, $camion) {

            $pedidos = Pedidos::model()->findAll("id_solicitud = {$solicitud}");
            // $tanquesOcupados = Tanque::model()->findAll("id_estacion = {$camion} AND status != 1 AND activo = 1");
            // $tanquesDesocupados = Tanque::model()->findAll("id_estacion = {$camion} AND status = 1 AND activo = 1");
            // $return = array();
            // $return['Tanques_ocupados'] = $tanquesOcupados;
            // $return['Tanques_desocupados'] = $tanquesDesocupados;
            // $return['pedidos'] = $pedidos;    
    /*

                    <?php// $tot = 1;?>
                    <?php //foreach($pedidos['pedido'] as $data):?>
                        <?php //for($i = 1; $i <= $data['tanques']; $i++):?>
                            <div class="pedido">
                                <div class="tituloEspecie">Pedido <?php// echo $tot;?></div>
                                <?php // if(isset($data['id_tanque'])):?>
                                <div class="pedidoWraper gris">an><
                                    <div>Especie: <span><?php //echo Especie::model()->getEspecie($data['especie']);?></sp/div>
                                    <div>Cepa: <span><?php //echo Cepa::model()->getCepa($data['cepa']);?></span></div>
                                    <div>Cantidad: <span><?php ///echo $data['cantidad'];?></span></div>
                                    <div>Destino: <span style="display: block"><?php //echo ClientesDomicilio::model()->getDomicilio($data['destino']);?></span></div>
                                    <div class="selectTanque">
                                        <label>Tanque</label>
                                        <div style="color: #000000">
                                            <?php //echo Tanque::model()->getTanque($data['id_tanque']);?>
                                        </div>
                                    </div>
                                </div>
                                 <div class="pedidosWraper">
                <?php echo $form->hiddenField($sol,'id_clientes',array('value'=>""));?>
                <?php echo $form->hiddenField($sol,'notas',array('value'=>""));?>
                <?php echo $form->hiddenField($sol,'id',array('value'=>""));?>
                            <?php //else:?>
                            <div class="pedidoWraper">
                                <div>Especie: <span><?php// echo Especie::model()->getEspecie($data['especie']);?></span></div>
                                <?php// echo $form->hiddenField($solicitudes,"codigo[$tot][especie]",array('value'=>$data['especie']))?>
                                <div>Cepa: <span><?php// echo Cepa::model()->getCepa($data['cepa']);?></span></div>
                                <?php// echo $form->hiddenField($solicitudes,"codigo[$tot][cepa]",array('value'=>$data['cepa']))?>
                                <div>Cantidad: <span><?php// echo $data['cantidad']/$data['tanques'];?></span></div>
                                <?php// echo $form->hiddenField($solicitudes,"codigo[$tot][cantidad]",array('value'=>($data['cantidad']/$data['tanques'])))?>
                                <div>Destino: <span style="display: block"><?php //echo ClientesDomicilio::model()->getDomicilio($data['destino']);?></span></div>
                                <?php// echo $form->hiddenField($solicitudes,"codigo[$tot][destino]",array('value'=>$data['destino']))?>
                                <div class="selectTanque hide">
                                    <label>Seleccionar Tanque</label>
                                    <?php //echo $form->dropDownList($solicitudes, "codigo[$tot][tanque]",array(''=>''),array('empty'=>'Seleccionar', 'class'=>'css-select ttan ttan'.$i, 'data-tan'=>$tot));?>
                                    <?php 
                                    //$t = "codigo[".$tot."][tanque]";

                                    //echo $form->error($model,$t); ?>
                                </div>
                            </div>
                            <?php// endif;?>
                        </div>
                        <?php// $tot++; ?>
                    <?php //endfor;?>
                <?php //endforeach; ?> -->
            </div>
        <!--    <div class="row">
                <?php 
                 //   echo $form->labelEx($model,'status');
                  //  if($model->isNewRecord)
                  //      echo $form->textField($model,'status',array('size'=>50,'maxlength'=>50));
                  //  else
                    //    echo $form->textField($model,'status',array('readonly'=>'readonly','size'=>50,'maxlength'=>50, 'value'=>  Viajes::model()->getStatus($model->status)));
                ?>
            </div>-->
    */
            echo json_encode( $pedidos );
        }
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
        {
            $return = array();
            if(Yii::app()->user->checkAccess('createViajes') || Yii::app()->user->id == 'smobiladmin')
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
            if(Yii::app()->user->checkAccess('readViajes') || Yii::app()->user->id == 'smobiladmin')
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
            if(Yii::app()->user->checkAccess('editViajes') || Yii::app()->user->id == 'smobiladmin')
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
            if(Yii::app()->user->checkAccess('deleteViajes') || Yii::app()->user->id == 'smobiladmin')
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
            $model = Viajes::model()->findByPk((int)$id);
            $prueba = SolicitudesViaje::model()->findAll("id_viaje = $model->id AND id_personal = 0");
            $guardar = array();
            $solicitudTanque = SolicitudTanques::model()->findAll("id_solicitud = $model->id_solicitudes");
            $i = 0;
            foreach($solicitudTanque as $data)
            {
                $cepa = Cepa::model()->findByPk($data->id_cepas);
                $pedido = array
                (
                    'especie'=> $cepa->id_especie,
                    'cepa'=>$data->id_cepas,
                    'cantidad'=>$data->cantidad_cepas,
                    'destino'=>$data->id_domicilio,
                    'tanques'=>1,
                    'id_tanque'=>$data->id_tanque
                );
                $pedidos['pedido'][$i] = $pedido;
                $i++;
            }
            foreach($guardar as $data)
            {
                $pedidos['pedido'][$i] = $data;
                $i++;
            }
            foreach($prueba as $data2)
            {
                $guardar = array();
                $solicitudTanque = SolicitudTanques::model()->findAll("id_solicitud = $data2->id_solicitud");
                foreach($solicitudTanque as $data)
                {
                    $cepa = Cepa::model()->findByPk($data->id_cepas);
                    $pedido = array
                    (
                        'especie'=> $cepa->id_especie,
                        'cepa'=>$data->id_cepas,
                        'cantidad'=>$data->cantidad_cepas,
                        'destino'=>$data->id_domicilio,
                        'tanques'=>1,
                        'id_tanque'=>$data->id_tanque
                    );
                    $pedidos['pedido'][$i] = $pedido;
                    $i++;
                }
                foreach($guardar as $data)
                {
                    $pedidos['pedido'][$i] = $data;
                    $i++;
                }
            }
//            if($model->status != 1)
//            {
                $tanques = Yii::app()->db->createCommand()
                        ->selectDistinct('SolTa.id_domicilio, SolTa.id_tanque, SolTa.id_cepas, SolTa.cantidad_cepas, cli.nombre_empresa, sol.codigo, tan.nombre, tan.id')
                        ->from('solicitudes_viaje as solVi')
                        ->join('solicitud_tanques as SolTa','SolTa.id_solicitud = solVi.id_solicitud')
                        ->join('solicitudes as sol','sol.id = SolTa.id_solicitud')
                        ->join('clientes as cli','cli.id = sol.id_clientes')
                        ->join('tanque as tan','tan.id = SolTa.id_tanque')
                        ->where("solVi.id_viaje = :id",array(':id'=>(int)$id))
                        ->queryAll();
//            }
            // print_r($tanques);
            $this->render('view',array(
                'model'=>$model,
                'tanques'=>$tanques,
                'pedidos' => $pedidos
            ));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

        $isNewRecord = false;
        $haypost = false;
        $model=new Viajes;
        $solicitudes = new Solicitudes();
        $personal = new SolicitudesViaje();
//		// Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
//
        if(isset($_POST['Viajes']))
        {   $isNewRecord = false;
            $haypost = true;
//                print_r($_POST);
            $model->attributes = $_POST['Viajes'];
            $model->fecha_salida = date('Y-m-d', strtotime($model->fecha_salida));
            if($_POST['Solicitudes']['id_clientes'] != '' && $_POST['Solicitudes']['id_clientes'] != null)
                $solicitudes->id = $_POST['Solicitudes']['id'];
            $solicitudes->id_clientes = $_POST['Solicitudes']['id_clientes'];
            $solicitudes->notas = $_POST['Solicitudes']['notas'];
            $solicitudes->fecha_alta = date('Y-m-d');
            $solicitudes->hora_alta = date('h:i');
            $solicitudes->fecha_estimada = $model->fecha_salida;
            $solicitudes->hora_estimada = $model->hora_salida;
            $codigo = substr(Clientes::model()->getCliente($solicitudes->id_clientes),0,2);
            $codigo = $codigo.date('Ymdhi');
            $solicitudes->codigo = $codigo;
            $solicitudes->status = 1;
            if($solicitudes->id != '' && $solicitudes->id != null)
            {
                $delete = Yii::app()->db->createCommand("DELETE FROM pedidos WHERE id_solicitud = $solicitudes->id")->execute();
                $update = Yii::app()->db->createCommand()->update('solicitudes',$solicitudes->attributes,"id = $solicitudes->id");
            }
            else
            {
                $solicitudes->save();
                $solicitudes->id = Yii::app()->db->getLastInsertID();
            }
            if(isset($_POST['NuevoRecord']))
            {
                $isNewRecord = false;
                $haypost =true;
                if($_POST['NuevoRecord'] == 0)
                {
                    $isNewRecord = false;
                    $haypost =true;
                    $model->id_solicitudes = $solicitudes->id;
                    $model->status = 1;
                    if($model->save())
                    {
                        foreach($_POST['SolicitudesViaje']['id_personal']['1']['tecnico'] as $data)
                        {
                            $nuevo = new SolicitudesViaje();
                            $nuevo->id_personal = $data;
                            $nuevo->id_viaje = $model->id;
                            $nuevo->id_solicitud = $solicitudes->id;
                            $nuevo->save();
                        }
                        foreach($_POST['SolicitudesViaje']['id_personal']['1']['chofer'] as $data)
                        {
                            $nuevo = new SolicitudesViaje();
                            $nuevo->id_personal = $data;
                            $nuevo->id_viaje = $model->id;
                            $nuevo->id_solicitud = $solicitudes->id;
                            $nuevo->save();
                        }
                        foreach($_POST['Solicitudes']['codigo'] as $data)
                        {
                            $nuevo = new SolicitudTanques();
                            $nuevo->id_solicitud = $solicitudes->id;
                            $nuevo->id_tanque = $data['tanque'];
                            $nuevo->id_domicilio = $data['destino'];
                            $nuevo->id_cepas = $data['cepa'];
                            $nuevo->cantidad_cepas = $data['cantidad'];
                            if($nuevo->save())
                            {
                                $tanque = Tanque::model()->findByPk($nuevo->id_tanque);
                                $tanque->status = 2;
                                $tanque->save();
                            }
                        }
                        $estacion = Estacion::model()->findByPk($model->id_estacion);
                        $estacion->disponible = 2;
                        $estacion->save();
                    }
                }
                else
                {
                    $solicitudViaje = new SolicitudesViaje();
                    $solicitudViaje->id_personal = 0;
                    $solicitudViaje->id_solicitud = $solicitudes->id;
                    $solicitudViaje->id_viaje = $_POST['viajeId'];
                    $solicitudViaje->save();
                    foreach($_POST['Solicitudes']['codigo'] as $data)
                    {
                        $nuevo = new SolicitudTanques();
                        $nuevo->id_solicitud = $solicitudes->id;
                        $nuevo->id_tanque = $data['tanque'];
                        $nuevo->id_domicilio = $data['destino'];
                        $nuevo->id_cepas = $data['cepa'];
                        $nuevo->cantidad_cepas = $data['cantidad'];
                        if($nuevo->save())
                        {
                            $tanque = Tanque::model()->findByPk($nuevo->id_tanque);
                            $tanque->status = 2;
                            $tanque->save();
                        }
                    }
                }
                $this->redirect(array('index'));
            }
            
        }
        if(isset($_POST['ClientesDomicilio']))
        {   
            $haypost = true;
            $pedidos = $_POST;
//            print_r($_POST);
            if($pedidos['ClientesDomicilio']['id_cliente'] > 0)
            {
                $model = $this->loadModel($pedidos['ClientesDomicilio']['id_cliente']);
                $prueba = SolicitudesViaje::model()->findAll("id_viaje = $model->id AND id_personal = 0");
//                print_r($prueba);
                $guardar = array();
                foreach ($pedidos['pedido'] as $data)
                    $guardar[] = $data;
                $solicitudTanque = SolicitudTanques::model()->findAll("id_solicitud = $model->id_solicitudes");
                $i = 0;
                foreach($solicitudTanque as $data)
                {
                    $cepa = Cepa::model()->findByPk($data->id_cepas);
                    $pedido = array
                    (
                        'especie'=> $cepa->id_especie,
                        'cepa'=>$data->id_cepas,
                        'cantidad'=>$data->cantidad_cepas,
                        'destino'=>$data->id_domicilio,
                        'tanques'=>1,
                        'id_tanque'=>$data->id_tanque
                    );
                    $pedidos['pedido'][$i] = $pedido;
                    $i++;
                }
                foreach($guardar as $data)
                {
                    $pedidos['pedido'][$i] = $data;
                    $i++;
                }
                foreach($prueba as $data2)
                {
                    $guardar = array();
                    $solicitudTanque = SolicitudTanques::model()->findAll("id_solicitud = $data2->id_solicitud");
                    foreach($solicitudTanque as $data)
                    {
                        $cepa = Cepa::model()->findByPk($data->id_cepas);
                        $pedido = array
                        (
                            'especie'=> $cepa->id_especie,
                            'cepa'=>$data->id_cepas,
                            'cantidad'=>$data->cantidad_cepas,
                            'destino'=>$data->id_domicilio,
                            'tanques'=>1,
                            'id_tanque'=>$data->id_tanque
                        );
                        $pedidos['pedido'][$i] = $pedido;
                        $i++;
                    }
                    foreach($guardar as $data)
                    {
                        $pedidos['pedido'][$i] = $data;
                        $i++;
                    }
                }
            }
        }
        if($haypost == false) {
            $isNewRecord = true;
            $solicitudes = Solicitudes::model()->findAll("status = 0");
            $pedidos = array();
            foreach($solicitudes as $data) {
                $pedidos[] = Pedidos::model()->findByAttributes(array('id_solicitud'=>$data->id));
            }

        }
        $this->render('create',array(
            'nuevo' =>$isNewRecord,
            'model' =>$model,
            'pedidos'=>$pedidos,
            'solicitudes'=>$solicitudes,
            'personal'=>$personal,
        ));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel((int)$id);
                $personal = SolicitudesViaje::model()->findAll("id_viaje =".(int)$id);
                $personalModel = new SolicitudesViaje();
                $model->fecha_salida = date('d-m-Y', strtotime($model->fecha_salida));
                $model->hora_salida = date('H:i', strtotime($model->hora_salida));
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		if(isset($_POST['Viajes']))
		{
			$model->attributes=$_POST['Viajes'];
                        $model->fecha_salida = date('Y-m-d', strtotime($model->fecha_salida));
                        $personal = SolicitudesViaje::model()->findAll("id_viaje = ".(int)$id." AND id_solicitud = $model->id_solicitudes");
			if($model->save())
                        {
                            foreach($personal as $data)
                                $data->delete();
                            foreach($_POST['SolicitudesViaje']['id_personal']['1']['tecnico'] as $data)
                            {
                                $nuevo = new SolicitudesViaje();
                                $nuevo->id_personal = $data;
                                $nuevo->id_solicitud = $model->id_solicitudes;
                                $nuevo->id_viaje = (int)$id;
                                $nuevo->save();
                            }
                            foreach($_POST['SolicitudesViaje']['id_personal']['1']['chofer'] as $data)
                            {
                                $nuevo = new SolicitudesViaje();
                                $nuevo->id_personal = $data;
                                $nuevo->id_solicitud = $model->id_solicitudes;
                                $nuevo->id_viaje = (int)$id;
                                $nuevo->save();
                            }
                            $this->redirect(array('index'));
                        }
		}
                $roles = array('chofer'=>array(),'tecnico'=>array());
                foreach($personal as $data)
                {
                    $rol = Personal::model()->getRolPersonal($data->id_personal);
                    if($rol == 1)
                        $roles['chofer'][$data->id_personal] = array('selected' => 'selected');
                    if($rol == 2)
                        $roles['tecnico'][$data->id_personal] = array('selected' => 'selected');
                }
		$this->render('update',array(
			    'model'     => $model,
                'personal'  => $personalModel,
                'roles'     => $roles
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
            $todoDatos = Yii::app()->db->createCommand()
                ->selectDistinct('solT.*')
                ->from('solicitud_tanques as solT')
                ->join('solicitudes_viaje as solV','solV.id_solicitud = solT.id_solicitud')
                ->where("solV.id_viaje = $id")
                ->queryAll();
            foreach($todoDatos as $data)
            {
                $solicitud = Solicitudes::model()->findByPk($data['id_solicitud']);
                $solicitud->codigo = 'En proceso';
                $solicitud->fecha_estimada = null;
                $solicitud->hora_estimada = null;
                $solicitud->save();
                $pedido = new Pedidos();
                $pedido->id_cepa = $data['id_cepas'];
                $cepa = Cepa::model()->findByPk($data['id_cepas']);
                $pedido->id_direccion = $data['id_domicilio'];
                $pedido->id_especie = $cepa->id_especie;
                $pedido->id_solicitud = $solicitud->id;
                $pedido->tanques = 1;
                $pedido->cantidad = $data['cantidad_cepas'];
                $pedido->save();
                $solT = SolicitudTanques::model()->findByPk($data['id']);
                $solT->delete();
                $delete = Yii::app()->db->createCommand("DELETE FROM solicitudes_viaje WHERE id_solicitud = {$solicitud->id}")->execute();
            }
            $viaje = Viajes::model()->findByPk($id);
            $estacion = Estacion::model()->findByPk($viaje->id_estacion);
            $estacion->disponible = 1;
            $tanques = Tanque::model()->findAll("id_estacion = $estacion->id");
            foreach($tanques as $data)
            {
                $save = Tanque::model()->findByPk($data['id']);
                $save->status = 1;
                $save->save();
            }
            $estacion->save();
            
            

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
	//	if(!isset($_GET['ajax']))
	//		$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	                echo json_encode('');

	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Viajes('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Viajes']))
			$model->attributes=$_GET['Viajes'];
		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Viajes('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Viajes']))
			$model->attributes=$_GET['Viajes'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Viajes the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Viajes::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Viajes $model the model to be validated
	 */
        
        public function actionGetTanques($id)
        {
            $tanques = Tanque::model()->findAll("id_estacion = $id AND status = 1 AND activo = 1");
            $return = '';
            foreach($tanques as $data)
                $return = $return.<<<eof
                    <option value="$data->id">$data->nombre - $data->capacidad L</option>
eof;
            echo json_encode($return);
        }
//        public function getClientes($pedidos)
//        {
//            $cliente = Clientes::model()->findByPk($pedidos['ClientesDomicilio']['id_cliente']);
//            echo <<<eof
//                <div class="contenedorCliente">
//                    <div class="titulo">Cliente</div>
//                    <div class="contenedorDatos">
//                        <div>
//                            <div class="nombreCliente">{$cliente->nombre_empresa}</div>
//                            <div class="clienteDatos">RFC: <span>{$cliente->rfc}</span></div>
//                            <div class="clienteDatos">RFC: <span>{$cliente->rfc}</span></div>
//                            <div class="clienteDatos">RFC:</div>
//                            <span>{$cliente->rfc}</span>
//                        </div>
//                        <div>
//                        </div>
//                    </div>
//                </div>
//eof;
//        }
        public function actionGetMapa($viaje)
        {
            $direcciones = Yii::app()->db->createCommand()
                ->selectDistinct('cliD.domicilio, cli.nombre_empresa')
                ->from('solicitudes_viaje as solV')
                ->join('solicitud_tanques as solT','solT.id_solicitud = solV.id_solicitud')
                ->join('clientes_domicilio as cliD','cliD.id = solT.id_domicilio')
                ->join('clientes as cli', 'cli.id = cliD.id_cliente')
                ->where("solV.id_viaje = $viaje")
                ->queryAll();
            $return =<<<EOF
                <div class="mapaPopup">
                    <div class="titulo">Mapa</div>
                    <div id="mapa2"></div>
                    <div class="abajoPopup">
                        <div class="subtituloPopup">Entregas:</div>
                        <div class="entregasWraper">
EOF;
            foreach($direcciones as $data)
            {
                $return =$return.<<<EOF
                            <div class="entregaPopup">
                                {$data['nombre_empresa']}
                                    <br>
                                {$data['domicilio']}
                            </div>
EOF;
            }
            $return =$return.<<<EOF
                        </div>
                    </div>
               </div>
EOF;
            echo json_encode($return);
        }
        public function rad($x)
        {
            return $x * pi() / 180;
        }
        public function actionGetTanqueGrafica($viaje, $id, $flag, $flag2)
        {
            $datos = Yii::app()->db->createCommand()
                ->select('esc.id, esc.fecha, esc.hora, esc.ubicacion, upT.ox, upT.id_tanque, upT.ph, upT.temp, upT.cond, upT.orp, upT.id')
                ->order('upT.id DESC')
                ->from('escalon_viaje_ubicacion as esc')
                ->join('uploadTemp as upT','upT.id_escalon_viaje_ubicacion = esc.id')
                ->where("esc.id_viaje = $viaje")
                ->andWhere("upT.id_tanque = $id")
                ->limit(1)
                ->queryRow();
            $return = array();
            if($flag2)
            {
                $d = 0;
                $recorrido = EscalonViajeUbicacion::model()->findAll("id_viaje = $viaje");
                $p1 = $p2 = array();
                foreach($recorrido as $data)
                {
                    if($d == 0)
                    {
                        $p1[0] = Yii::app()->params['locationLat'];
                        $p1[1] = Yii::app()->params['locationLon'];
                    }
                    $hay = strlen($data->ubicacion);
                    $coord = substr($data->ubicacion, 1, $hay-1);
                    $p2 = explode(",", $coord);
//                  $p2[0] = ();
                    $R = 6378137; // Earth’s mean radius in meter
                    $dLat = $this->rad($p2[0] - $p1[0]);
                    $dLong = $this->rad($p2[1] - $p1[1]);
                    $a = sin($dLat / 2) * sin($dLat / 2) +
                      cos($this->rad($p1[0])) * cos($this->rad($p2[0])) *
                      sin($dLong / 2) * sin($dLong / 2);
                    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
                    $d = $d + ($R * $c);
                    $p1[0] = $p2[0];
                    $p1[1] = $p2[1];
                }
                $d = $d/1000;
                $return['distancia'] = round($d, 2).' Km';
                $viajes = Viajes::model()->findByPk($viaje);
                $empieza = new DateTime($viajes->fecha_salida.' '.$viajes->hora_salida);
                $termina = new DateTime($datos['fecha'].' '.$datos['hora']);
                $diferencia = $termina->diff($empieza);
                $return['tiempo'] = $diferencia->format('%d dias %h horas, %I minutos y %S segundos');
                $return['ultimo'] = $this->GetDistancia($viaje);
            }
            $return['viaje'] = $datos;
            switch ($flag)
            {
                case 1: 
                    $return['grafica'] =
                    array
                    (
                        'type' => 'bar',
                        'data'=>array
                        (
                            'labels'    => ['T'],
                            'datasets'  => 
                            [
                                (object)
                                [
                                    'data'              => [$datos['temp']],
                                    'backgroundColor'   => ['#9EE7DD'],
                                    'fontSize'          => 2
                                ]
                            ]
                        ),
                        'options' => array
                        (
                            'animation' => false,
                            'legend'    => array('display' => false),
                            'scales'    => array
                            (
                                'yAxes' => 
                                [array(
                                    'ticks' => array
                                    (
                                        'min'       => 0,
//                                        'max'       => 30,
//                                        'stepSize'  => 5
                                    )
                                )]
                            )
                        )
                    );
                break;
                case 2: 
                    $return['grafica'] =
                    array
                    (
                        'type' => 'bar',
                        'data'=>array
                        (
                            'labels'    => ['Oz'],
                            'datasets'  => 
                            [
                                (object)
                                [
                                    'data'              => [$datos['ox']],
                                    'backgroundColor'   => ['#FE713D']
                                ]
                            ]
                        ),
                        'options' => array
                        (
                            'animation' => false,
                            'legend'    => array
                            (
                                'display' => false
                                
                            ),
                            'scales'    => array
                            (
                                'yAxes' => 
                                [array(
                                    'ticks' => array
                                    (
                                        'min'       => 0,
//                                        'max'       => 30,
//                                        'stepSize'  => 5
                                    )
                                )]
                            )
                        )
                    );
                break;
                case 3: 
                    $return['grafica'] =
                    array
                    (
                        'type' => 'bar',
                        'data'=>array
                        (
                            'labels'    => ['PH'],
                            'datasets'  => 
                            [
                                (object)
                                [
                                    'data'              => [$datos['ph']],
                                    'backgroundColor'   => ['#0079AB']
                                ]
                            ]
                        ),
                        'options' => array
                        (
                            'animation' => false,
                            'legend'    => array('display' => false),
                            'scales'    => array
                            (
                                'yAxes' => 
                                [array(
                                    'ticks' => array
                                    (
                                        'min'       => 0,
//                                        'max'       => 30,
//                                        'stepSize'  => 5
                                    )
                                )]
                            )
                        )
                    );
                break;
                case 4: 
                    $return['grafica'] =
                    array
                    (
                        'type' => 'bar',
                        'data'=>array
                        (
                            'labels'    => ['Cd'],
                            'datasets'  => 
                            [
                                (object)
                                [
                                    'data'              => [$datos['cond']],
                                    'backgroundColor'   => ['#5F7D8A'],
                                    'borderWidth'       => 1
                                ]
                            ]
                        ),
                        'options' => array
                        (
                            'animation' => false,
                            'legend'    => array('display' => false),
                            'scales'    => array
                            (
                                'yAxes' => 
                                [array(
                                    'ticks' => array
                                    (
                                        'min'       => 0,
//                                        'max'       => 30,
//                                        'stepSize'  => 5
                                    )
                                )]
                            )
                        )
                    );
                break;
                case 5: 
                    $return['grafica'] =
                    array
                    (
                        'type' => 'bar',
                        'data'=>array
                        (
                            'labels'    => ['OP'],
                            'datasets'  => 
                            [
                                (object)
                                [
                                    'data'              => [$datos['orp']],
                                    'backgroundColor'   => ['#9EE7DD']
                                ]
                            ]
                        ),
                        'options' => array
                        (
                            'animation' => false,
                            'legend'    => array('display' => false),
                            'scales'    => array
                            (
                                'yAxes' => 
                                [array(
                                    'ticks' => array
                                    (
                                        'min'       => 0,
//                                        'max'       => 30,
//                                        'stepSize'  => 5
                                    )
                                )]
                            )
                        )
                    );
                break;
            }
            echo json_encode($return);
        }
        public function GetDistancia($viaje)
        { 
            $recorrido = Yii::app()->db->createCommand()
                ->selectDistinct('sv.id_solicitud,cd.ubicacion_mapa,cd.domicilio')
                ->from('clientes_domicilio as cd')
                ->join('solicitud_tanques as st','st.id_domicilio = cd.id')
                ->join('solicitudes_viaje as sv','sv.id_solicitud = st.id_solicitud')
                ->join('solicitudes as s','s.id = sv.id_solicitud')
                ->join('viajes as v','v.id = sv.id_viaje')
                ->where("sv.id_viaje = $viaje")
                ->queryAll();
            $arreglo = array();
            $d = 0;
            $p1 = $p2 = array();
            foreach($recorrido as $data)
            {
                $p1[0] = Yii::app()->params['locationLat'];
                $p1[1] = Yii::app()->params['locationLon'];
                $hay = strlen($data['ubicacion_mapa']);
                $coord = substr($data['ubicacion_mapa'], 1, $hay-1);
                $p2 = explode(",", $coord);
                $R = 6378137; // Earth’s mean radius in meter
                $dLat = $this->rad($p2[0] - $p1[0]);
                $dLong = $this->rad($p2[1] - $p1[1]);
                $a = sin($dLat / 2) * sin($dLat / 2) +
                    cos($this->rad($p1[0])) * cos($this->rad($p2[0])) *
                    sin($dLong / 2) * sin($dLong / 2);
                       $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
                $fecha = isset($data['fecha_entrega'])?strtotime($data['fecha_entrega']): 'error';
                $arreglo[] = array('distancia' => $R * $c,'idLocacion' =>  $data['domicilio']);
            }
            $total = count($arreglo);
            for($i=0;$i<$total; $i++)
            {
                for($j=$i+1;$j<$total;$j++)
                {
                    if( $arreglo[$i]['distancia']>$arreglo[$j]['distancia'])
                    {
                        $aux =$arreglo[$i];
                        $arreglo[$i]=$arreglo[$j];
                        $arreglo[$j] =$aux;
                    }
                }
            }
            return $arreglo[$total-1]['idLocacion'];
        } 
        public function actionGetParametroGrafica($viaje, $flag)
        {
            $tanques = Yii::app()->db->createCommand()
                ->selectDistinct('SolTa.id_domicilio, SolTa.id_tanque, SolTa.id_cepas, SolTa.cantidad_cepas, cli.nombre_empresa, sol.codigo, tan.nombre, tan.id')
                ->from('solicitudes_viaje as solVi')
                ->join('solicitud_tanques as SolTa','SolTa.id_solicitud = solVi.id_solicitud')
                ->join('solicitudes as sol','sol.id = SolTa.id_solicitud')
                ->join('clientes as cli','cli.id = sol.id_clientes')
                ->join('tanque as tan','tan.id = SolTa.id_tanque')
                ->where("solVi.id_viaje = :id",array(':id'=>(int)$viaje))
                ->queryAll();
            foreach($tanques as $data)
                $nombre[] = $data['nombre'];
            $escalon = Yii::app()->db->createCommand()
                ->select('id')
                ->from('escalon_viaje_ubicacion')
                ->where("id_viaje = $viaje")
                ->order("id DESC")
                ->limit(1)
                ->queryRow();
            $datos = Yii::app()->db->createCommand()
                ->selectDistinct('esc.id, upT.ox, upT.id_tanque, upT.ph, upT.temp, upT.cond, upT.orp, upT.id')
                ->from('escalon_viaje_ubicacion as esc')
                ->join('uploadTemp as upT','upT.id_escalon_viaje_ubicacion = esc.id')
                ->where("esc.id_viaje = $viaje")
                ->andWhere("upT.id_escalon_viaje_ubicacion = {$escalon['id']}")
                ->queryAll();
            $colors = ['#9EE7DD', '#FE713D', '#0079AB', '#5F7D8A', '#9EE7DD', '#FE713D', '#0079AB', '#5F7D8A'];
            switch ($flag)
            {
                case 1: 
                $valores = array();
                    foreach($datos as $data)
                    {
                        $valores[] = $data['ox'];
                    }
                    $return =
                    array
                    (
                        'type' => 'bar',
                        'data'=>array
                        (
                            'labels'    => $nombre,
                            'datasets'  => 
                            [
                                (object)
                                [
                                    'data'              => $valores,
                                    'backgroundColor'   => $colors,
                                    'fontSize'          => 2,
                                    'borderWidth'       => 1
                                ]
                            ]
                        ),
                        'options' => array
                        (
                            'animation' => false,
                            'legend'    => array('display' => false),
                            'scales'    => array
                            (
                                'yAxes' => 
                                [array(
                                    'ticks' => array
                                    (
                                        'min'       => 0,
//                                        'max'       => 30,
//                                        'stepSize'  => 5
                                    )
                                )]
                            )
                        )
                    );
                break;
                case 2: 
                $valores = array();
                    foreach($datos as $data)
                    {
                        $valores[] = $data['temp'];
                    }
                    $return =
                    array
                    (
                        'type' => 'bar',
                        'data'=>array
                        (
                            'labels'    => $nombre,
                            'datasets'  => 
                            [
                                (object)
                                [
                                    'data'              => $valores,
                                    'backgroundColor'   => $colors,
                                    'fontSize'          => 2
                                ]
                            ]
                        ),
                        'options' => array
                        (
                            'animation' => false,
                            'legend'    => array
                            (
                                'display' => false
                                
                            ),
                            'scales'    => array
                            (
                                'yAxes' => 
                                [array(
                                    'ticks' => array
                                    (
                                        'min'       => 0,
//                                        'max'       => 30,
//                                        'stepSize'  => 5
                                    )
                                )]
                            )
                        )
                    );
                break;
                case 3: 
                $valores = array();
                    foreach($datos as $data)
                    {
                        $valores[] = isset($data['ph'])?$data['ph']:0;
                    }
                    $return =
                    array
                    (
                        'type' => 'bar',
                        'data'=>array
                        (
                            'labels'    => $nombre,
                            'datasets'  => 
                            [
                                (object)
                                [
                                    'data'              => $valores,
                                    'backgroundColor'   => $colors,
                                    'fontSize'          => 2
                                ]
                            ]
                        ),
                        'options' => array
                        (
                            'animation' => false,
                            'legend'    => array('display' => false),
                            'scales'    => array
                            (
                                'yAxes' => 
                                [array(
                                    'ticks' => array
                                    (
                                        'min'       => 0,
//                                        'max'       => 30,
//                                        'stepSize'  => 5
                                    )
                                )]
                            )
                        )
                    );
                break;
                case 4: 
                $valores = array();
                    foreach($datos as $data)
                    {
                        $valores[] = $data['cond'];
                    }
                    $return =
                    array
                    (
                        'type' => 'bar',
                        'data'=>array
                        (
                            'labels'    => $nombre,
                            'datasets'  => 
                            [
                                (object)
                                [
                                    'data'              => $valores,
                                    'backgroundColor'   => $colors,
                                    'fontSize'          => 2
                                ]
                            ]
                        ),
                        'options' => array
                        (
                            'animation' => false,
                            'legend'    => array('display' => false),
                            'scales'    => array
                            (
                                'yAxes' => 
                                [array(
                                    'ticks' => array
                                    (
                                        'min'       => 0,
//                                        'max'       => 30,
//                                        'stepSize'  => 5
                                    )
                                )]
                            )
                        )
                    );
                break;
                case 5:
                $valores = array();
                    foreach($datos as $data)
                    {
                        $valores[] = $data['orp'];
                    }
                    $return =
                    array
                    (
                        'type' => 'bar',
                        'data'=>array
                        (
                            'labels'    => $nombre,
                            'datasets'  => 
                            [
                                (object)
                                [
                                    'data'              => $valores,
                                    'backgroundColor'   => $colors,
                                    'fontSize'          => 2
                                ]
                            ]
                        ),
                        'options' => array
                        (
                            'animation' => false,
                            'legend'    => array('display' => false),
                            'scales'    => array
                            (
                                'yAxes' => 
                                [array(
                                    'ticks' => array
                                    (
                                        'min'       => 0,
//                                        'max'       => 30,
//                                        'stepSize'  => 5
                                    )
                                )]
                            )
                        )
                    );
                break;
            }
            echo json_encode($return);
        }
        public function actionGetAlertasTanque($viaje, $id)
        {
            $uploads = Yii::app()->db->createCommand()
                    ->selectDistinct('cep.*, tan.id as idTanque, upt.temp, upt.ox, upt.ph, upt.cond, upt.orp, evu.hora, evu.fecha, evu.ubicacion')
                    ->from('solicitudes_viaje as solV')
                    ->join('solicitud_tanques as solT','solT.id_solicitud = solV.id_solicitud')
                    ->leftJoin('tanque as tan', 'tan.id = solT.id_tanque')
                    ->rightJoin('cepa as cep', 'cep.id = solT.id_cepas')
                    ->join('uploadTemp as upt','upt.id_tanque = tan.id')
                    ->join('escalon_viaje_ubicacion as evu',"evu.id_viaje = $viaje")
                    ->where("solV.id_viaje = $viaje")
                    ->andWhere("tan.id = $id")
                    ->andWhere("upt.alerta > 1")
                    ->andWhere('upt.id_escalon_viaje_ubicacion = evu.id')
                    ->queryAll();
            if(count($uploads) > 0)
            {
                $return = '
                    <div class="alertas">
                        <div class="tituloAlerta">Alertas: </div>
                        <div class="tablaAlertas">
                            <div class="tablaTitulos">
                                <span>Origen</span><span>Acción</span><span>Hora</span><span>Fecha</span><span>Ubicación</span>
                            </div>
                            <div class="tablaWraper">';
                            
                foreach($uploads as $data)
                {
                    if($data['temp'] > $data['temp_max'] || $data['temp'] < $data['temp_min'])
                    {
                        $return = $return.'<div class="tableRow">';
                        if($data['temp'] > $data['temp_max'])
                            $imagen = 'flechaUp';
                        else
                            $imagen = 'flechaDown';
                        $return = $return.<<<eof
                                <div>Temperatura</div><div>{$data['temp']}º<span class="$imagen">X</span></div><div>{$data['hora']}</div><div>{$data['fecha']}</div><div>{$data['ubicacion']}</div></div>
eof;
                    }
                    if($data['ox'] > $data['ox_max'] || $data['ox'] < $data['ox_min'])
                    {
                        $return = $return.'<div class="tableRow">';
                        if($data['ox'] > $data['ox_max'])
                            $imagen = 'flechaUp';
                        else
                            $imagen = 'flechaDown';
                        $return = $return.<<<eof
                                <div>Oxígeno</div><div>{$data['ox']}<span class="$imagen">X</span></div><div>{$data['hora']}</div><div>{$data['fecha']}</div><div>{$data['ubicacion']}</div></div>
eof;
                    }
                    if($data['ph'] > $data['ph_max'] || $data['ph'] < $data['ph_min'])
                    {
                        $return = $return.'<div class="tableRow">';
                        if($data['ph'] > $data['ph_max'])
                            $imagen = 'flechaUp';
                        else
                            $imagen = 'flechaDown';
                        $return = $return.<<<eof
                                <div>PH</div><div>{$data['ph']}<span class="$imagen">X</span></div><div>{$data['hora']}</div><div>{$data['fecha']}</div><div>{$data['ubicacion']}</div></div>
eof;
                    }
                    if($data['cond'] > $data['cond_max'] || $data['cond'] < $data['cond_min'])
                    {
                        $return = $return.'<div class="tableRow">';
                        if($data['cond'] > $data['cond_max'])
                            $imagen = 'flechaUp';
                        else
                            $imagen = 'flechaDown';
                        $return = $return.<<<eof
                                <div>Conductividad</div><div>{$data['cond']}<span class="$imagen">X</span></div><div>{$data['hora']}</div><div>{$data['fecha']}</div><div>{$data['ubicacion']}</div></div>
eof;
                    }
                    if($data['orp'] > $data['orp_max'] || $data['orp'] < $data['orp_min'])
                    {
                        $return = $return.'<div class="tableRow">';
                        if($data['orp'] > $data['orp_max'])
                            $imagen = 'flechaUp';
                        else
                            $imagen = 'flechaDown';
                        $return = $return.<<<eof
                                <div>Potencial óxido reducción</div><div>{$data['orp']}<span class="$imagen">X</span></div><div>{$data['hora']}</div><div>{$data['fecha']}</div><div>{$data['ubicacion']}</div></div>
eof;
                    }
                }
                $return = $return.'</div>
                        </div>
                        </div>';
            }
            else
            {
                $return = '
                    <div class="alertas" style="width: 500px; height: 300px;">
                        <div class="tituloAlerta" style="background-color:#0077B0">Sin alertas en </div>
                        <div class="tablaTitulos" style="font-size: 28px;">
                            <div class="tablaAlertas">
                                <span style="padding:15px;text-indent:0; width: 100%; border-bottom:0;">Este tanque no presenta alertas hasta el momento.</span>
                            </div>
                        </div>
                    </div>';
            }
            echo json_encode($return);
        }
        public function actionGetAlertasParametro($viaje, $id)
        {
            $uploads = Yii::app()->db->createCommand()
                    ->selectDistinct("cep.*, tan.id as idTanque, tan.nombre, upt.$id, evu.hora, evu.fecha, evu.ubicacion")
                    ->from('solicitudes_viaje as solV')
                    ->join('solicitud_tanques as solT','solT.id_solicitud = solV.id_solicitud')
                    ->leftJoin('tanque as tan', 'tan.id = solT.id_tanque')
                    ->rightJoin('cepa as cep', 'cep.id = solT.id_cepas')
                    ->join('uploadTemp as upt','upt.id_tanque = tan.id')
                    ->join('escalon_viaje_ubicacion as evu',"evu.id_viaje = $viaje")
                    ->where("solV.id_viaje = $viaje")
                    ->andWhere("upt.alerta > 1")
                    ->andWhere('upt.id_escalon_viaje_ubicacion = evu.id')
                    ->queryAll();
            if(count($uploads) > 0)
            {
                if($id == 'ox')
                    $nombre = 'Oxígeno';
                elseif($id == 'temp')
                    $nombre = 'Temperatura';
                elseif($id == 'cond')
                    $nombre = 'Conductividad';
                elseif($id == 'orp')
                    $nombre = 'Potencial óxido reducción';
                elseif($id == 'ph')
                    $nombre = 'PH';
                $return = '
                    <div class="alertas">
                        <div class="tituloAlerta">Alertas: '.$nombre.'</div>
                        <div class="tablaAlertas">
                            <div class="tablaTitulos">
                                <span>Origen</span><span>Acción</span><span>Hora</span><span>Fecha</span><span>Ubicación</span>
                            </div>
                            <div class="tablaWraper">';
                            
                foreach($uploads as $data)
                {
                    if($data[$id] > $data[$id.'_max'] || $data[$id] < $data[$id.'_max'])
                    {
                        $return = $return.'<div class="tableRow">';
                        if($data[$id] > $data[$id.'_max'])
                            $imagen = 'flechaUp';
                        else
                            $imagen = 'flechaDown';
                        $return = $return.<<<eof
                                <div>{$data['nombre']}</div><div>{$data[$id]}º<span class="$imagen">X</span></div><div>{$data['hora']}</div><div>{$data['fecha']}</div><div>{$data['ubicacion']}</div></div>
eof;
                    }
                }
                $return = $return.'</div>
                        </div>
                        </div>';
            }
            else
            {
                $return = '
                    <div class="alertas" style="width: 500px; height: 300px;">
                        <div class="tituloAlerta" style="background-color:#0077B0">Sin alertas en </div>
                        <div class="tablaTitulos" style="font-size: 28px;">
                            <div class="tablaAlertas">
                                <span style="padding:15px;text-indent:0; width: 100%; border-bottom:0;">No existen alertas de este parametro hasta el momento.</span>
                            </div>
                        </div>
                    </div>';
            }
            echo json_encode($return);
        }
        public function actionGetHistorialTanque($viaje, $id)
        {
            $total = Yii::app()->db->createCommand()
                ->select('esc.hora, upT.ox, upT.id_tanque, upT.ph, upT.temp, upT.cond, upT.orp, upT.id')
                ->order('upT.id DESC')
                ->from('escalon_viaje_ubicacion as esc')
                ->join('uploadTemp as upT','upT.id_escalon_viaje_ubicacion = esc.id')
                ->where("esc.id_viaje = $viaje")
                ->andWhere("upT.id_tanque = $id")
//                ->where("upT.id_tanque = 28")
                ->queryAll();
            $count = count($total);
            if($count > 333)
                $limit = $count - 333;
            else
                $limit = 0;
            $datos = Yii::app()->db->createCommand()
                ->select('esc.hora, upT.ox, upT.id_tanque, upT.ph, upT.temp, upT.cond, upT.orp, upT.id')
                ->from('escalon_viaje_ubicacion as esc')
                ->join('uploadTemp as upT','upT.id_escalon_viaje_ubicacion = esc.id')
                ->where("esc.id_viaje = $viaje")
                ->andWhere("upT.id_tanque = $id")
//                ->where("upT.id_tanque = 28")
                ->limit(333,$limit)
                ->order("esc.id ASC")
                ->queryAll();
            $return['codigo'] = <<<eof
                <div class="historial">
                    <div class="titulo"></div>
                    <div class="historialGraficasWraper">
                        <div class="menuHistorial">
                            <div class="selected" data-para="1">Oxígeno disuelto</div>
                            <div data-para="2">Temperatura</div>
                            <div data-para="3">PH</div>
                            <div data-para="4">Conductividad</div>
                            <div data-para="5">ORP</div>
                        </div>
                        <div class="graficasWraper">
eof;
            $cont = 0;
            foreach($datos as $data)
            {
                $labels[] = $data['hora'];
                $datasets[] = $data['ox'];
                $cont++;
            }
            $width = ($cont * 98)+40;
            if($width < 1032)
                $width = 1032;
            $return['codigo'] =$return['codigo'].<<<eof
                            <div class="grafScroll" data-rece="1">
                                <canvas id="historialTanque1" width="$width" height="405"></canvas>
                            </div>
eof;
                $return['ox'] =
                array
                (
                    'type' => 'line',
                    'data'=>array
                    (
                        'labels'    => $labels,
                        'datasets'  => 
                        [
                            (object)
                            [
                                'label'                 => "Od",
                                'fill'                  => false,
                                'lineTension '          => 0,
                                'borderColor'           => '#3E66AA',
                                'pointBorderColor'      => "#3E66AA",
                                'pointBackgroundColor'  => "#3E66AA",
                                'pointBorderWidth'      => 5,
                                'pointHoverRadius'      => 10,
                                'data'                  => $datasets,
                            ]
                        ]
                    ),
                    'options' => array
                    (
                        'animation'             => false,
                        'responsive'            => false,
//                        'maintainAspectRatio'   => true,
                        'legend'                => array('display' => false),
                        'scales'                => array
                        (
                            'yAxes' => 
                            [array(
                                'ticks' => array
                                (
                                    'min'       => 0,
//                                        'max'       => 30,
//                                        'stepSize'  => 5
                                )
                            )]
                        )
                    )
                );
            foreach($datos as $data)
            {
                $labels2[] = $data['hora'];
                $datasets2[] = $data['temp'];
                $cont++;
            }
            $return['codigo'] =$return['codigo'].<<<eof
                            <div class="grafScroll hide" data-rece="2">
                                <canvas id="historialTanque2" width="$width" height="405"></canvas>
                            </div>
eof;
            $return['temp'] =
            array
            (
                'type' => 'line',
                'data'=>array
                (
                    'labels'    => $labels2,
                    'datasets'  => 
                    [
                        (object)
                        [
                            'label'                 => "Temp",
                            'fill'                  => false,
                            'lineTension '          => 0,
                            'borderColor'           => '#3E66AA',
                            'pointBorderColor'      => "#3E66AA",
                            'pointBackgroundColor'  => "#3E66AA",
                            'pointBorderWidth'      => 5,
                            'pointHoverRadius'      => 10,
                            'data'                  => $datasets2,
                        ]
                    ]
                ),
                'options' => array
                (
                    'animation'             => false,
                    'fontSize'              => 20,
                    'responsive'            => false,
//                    'maintainAspectRatio'   => false,
                    'legend'                => array('display' => false),
                    'scales'                => array
                    (
                        'yAxes' => 
                        [array(
                            'ticks' => array
                            (
                                'min'       => 0,
//                                        'max'       => 30,
//                                        'stepSize'  => 5
                            )
                        )]
                    )
                )
            );
            foreach($datos as $data)
            {
                $labels3[] = $data['hora'];
                $datasets3[] = $data['ph'];
                $cont++;
            }
            $return['codigo'] =$return['codigo'].<<<eof
                            <div class="grafScroll hide" data-rece="3">
                                <canvas id="historialTanque3" width="$width" height="405"></canvas>
                            </div>
eof;
            $return['ph'] =
            array
            (
                'type' => 'line',
                'data'=>array
                (
                    'labels'    => $labels3,
                    'datasets'  => 
                    [
                        (object)
                        [
                            'label'                 => "PH",
                            'fill'                  => false,
                            'lineTension '          => 0,
                            'borderColor'           => '#3E66AA',
                            'pointBorderColor'      => "#3E66AA",
                            'pointBackgroundColor'  => "#3E66AA",
                            'pointBorderWidth'      => 5,
                            'pointHoverRadius'      => 10,
                            'data'                  => $datasets3,
                        ]
                    ]
                ),
                'options' => array
                (
                    'animation'             => false,
                    'fontSize'              => 20,
                    'responsive'            => false,
//                    'maintainAspectRatio'   => false,
                    'legend'                => array('display' => false),
                    'scales'                => array
                    (
                        'yAxes' => 
                        [array(
                            'ticks' => array
                            (
                                'min'       => 0,
//                                        'max'       => 30,
//                                        'stepSize'  => 5
                            )
                        )]
                    )
                )
            );
            foreach($datos as $data)
            {
                $labels4[] = $data['hora'];
                $datasets4[] = $data['cond'];
                $cont++;
            }
            $return['codigo'] =$return['codigo'].<<<eof
                            <div class="grafScroll hide" data-rece="4">
                                <canvas id="historialTanque4" width="$width"height="405"></canvas>
                            </div>
eof;
            $return['cond'] =
            array
            (
                'type' => 'line',
                'data'=>array
                (
                    'labels'    => $labels4,
                    'datasets'  => 
                    [
                        (object)
                        [
                            'label'                 => "Cond",
                            'fill'                  => false,
                            'lineTension '          => 0,
                            'borderColor'           => '#3E66AA',
                            'pointBorderColor'      => "#3E66AA",
                            'pointBackgroundColor'  => "#3E66AA",
                            'pointBorderWidth'      => 5,
                            'pointHoverRadius'      => 10,
                            'data'                  => $datasets4,
                        ]
                    ]
                ),
                'options' => array
                (
                    'animation'             => false,
                    'fontSize'              => 20,
                    'responsive'            => false,
//                    'maintainAspectRatio'   => false,
                    'legend'                => array('display' => false),
                    'scales'                => array
                    (
                        'yAxes' => 
                        [array(
                            'ticks' => array
                            (
                                'min'       => 0,
//                                        'max'       => 30,
//                                        'stepSize'  => 5
                            )
                        )]
                    )
                )
            );
            foreach($datos as $data)
            {
                $labels5[] = $data['hora'];
                $datasets5[] = $data['orp'];
                $cont++;
            }
            $return['codigo'] =$return['codigo'].<<<eof
                            <div class="grafScroll hide" data-rece="5">
                                <canvas id="historialTanque5" width="$width" height="405"></canvas>
                            </div>
eof;
            $return['orp'] =
            array
            (
                'type' => 'line',
                'data'=>array
                (
                    'labels'    => $labels5,
                    'datasets'  => 
                    [
                        (object)
                        [
                            'label'                 => "ORP",
                            'fill'                  => false,
                            'lineTension '          => 0,
                            'borderColor'           => '#3E66AA',
                            'pointBorderColor'      => "#3E66AA",
                            'pointBackgroundColor'  => "#3E66AA",
                            'pointBorderWidth'      => 5,
                            'pointHoverRadius'      => 10,
                            'data'                  => $datasets5,
                        ]
                    ]
                ),
                'options' => array
                (
                    'animation'             => false,
                    'fontSize'              => 20,
                    'responsive'            => false,
//                    'maintainAspectRatio'   => false,
                    'legend'                => array('display' => false),
                    'scales'                => array
                    (
                        'yAxes' => 
                        [array(
                            'ticks' => array
                            (
                                'min'       => 0,
//                                        'max'       => 30,
//                                        'stepSize'  => 5
                            )
                        )]
                    )
                )
            );
            $return['codigo'] =$return['codigo'].
                    '   </div>
                    </div>
                </div>';
            echo json_encode($return);
        }
        public function actionGetHistorialParametro($viaje, $id)
        {
            $total = Yii::app()->db->createCommand()
                ->select("esc.hora, upT.$id, upT.id_tanque, upT.id")
                ->order('upT.id DESC')
                ->from('escalon_viaje_ubicacion as esc')
                ->join('uploadTemp as upT','upT.id_escalon_viaje_ubicacion = esc.id')
                ->where("esc.id_viaje = $viaje")
                ->queryAll();
            $count = count($total);
            if($count > 333)
                $limit = $count - 333;
            else
                $limit = 0;
            $tanques = Yii::app()->db->createCommand()
                ->selectDistinct('solT.id_tanque, tan.nombre')
                ->from('solicitudes_viaje as solV')
                ->join('solicitud_tanques as solT','solT.id_solicitud = solV.id_solicitud')
                ->join('tanque as tan','tan.id = solT.id_tanque')
                ->where("solV.id_viaje = $viaje")
                ->queryAll();
            $datos = Yii::app()->db->createCommand()
                ->select("esc.hora, upT.$id, upT.id_tanque, upT.id")
                ->from('escalon_viaje_ubicacion as esc')
                ->join('uploadTemp as upT','upT.id_escalon_viaje_ubicacion = esc.id')
                ->where("esc.id_viaje = $viaje")
                ->limit(333,$limit)
                ->order("upT.id ASC")
                ->queryAll();
            switch($id)
            {
                case 'ox':      $nombre='Oxígeno disuelto'; break;
                case 'temp':    $nombre='Temperatura'; break;
                case 'ph':      $nombre='PH'; break;
                case 'cond':    $nombre='Conductividad'; break;
                case 'orp':     $nombre='Potencial óxido reducción'; break;
            }
            $cont = 0;
            $colors = ['#4363AE','#8DC63F','#7F3F98','#FF5BB2','#27AAE1','#ED1C24','#8B5E3C','#FF7236'];
            $datasets = [];
            $flag = true;
            $menu = <<<eof
                <div class="menuSeccion" data-tanque="-1">Todos</div>
eof;
            $i = 0;
            foreach($tanques as $info)
            {
                $datas = [];
                $labels = [];
                foreach($datos as $data)
                {
                    if($data['id_tanque'] == $info['id_tanque'])
                    {
                        if($flag)
                        {
                            $cont++;
                        }
                        $labels[] = $data['hora'];
                        $datas[] = $data[$id];
                    }
                }
                $datasets[] = 
                [
                    'label'                 => $id,
                    'fill'                  => false,
                    'lineTension '          => 0,
                    'borderColor'           => $colors[$i],
                    'pointBorderColor'      => $colors[$i],
                    'pointBackgroundColor'  => $colors[$i],
                    'pointBorderWidth'      => 5,
                    'pointHoverRadius'      => 10,
                    'data'                  => $datas,
                ];
                $return['graf'.$i]=
                array
                (
                    'type' => 'line',
                    'data'=>array
                    (
                        'labels'    => $labels,
                        'datasets'  => [$datasets[$i]]
                    ),
                    'options' => array
                    (
                        'animation'             => false,
                        'fontSize'              => 20,
                        'responsive'            => false,
                        'legend'                => array('display' => false),
                        'scales'                => array
                        (
                            'yAxes' => 
                            [array(
                                'ticks' => array
                                (
                                    'min'       => 0,
                                )
                            )]
                        )
                    )
                );
                $flag = false;
                $menu = $menu.<<<eof
                    <div class="menuSeccion" data-tanque="$i">{$info['nombre']}</div>
eof;
                $i++;
            }
            $return['total'] = $i;
            $return['codigo'] = <<<eof
                <div class="historial parametro">
                    <div class="titulo">Historial de parámetro</div>
                    <div class="subtitulo">$nombre</div>
                    <div class="historialGraficasWraper">
                    <div class="menuTanques">
                        <div class="menuParametros">$menu</div>
                    </div>
                        <div class="graficasWraper">
eof;
            $width = ($cont * 98)+40;
            if($width < 1032)
                $width = 1032;
            $return['codigo'] =$return['codigo'].<<<eof
                <div class="grafScroll" data-parame="-1">
                    <canvas id="parametrosGrafica" width="$width" height="405"></canvas>
                </div>
eof;
            for($j = 0; $j < $i; $j++)
            {
                $return['codigo'] =$return['codigo'].<<<eof
                    <div class="grafScroll hide" data-parame="$j">
                        <canvas id="parametrosGrafica$j" width="$width" height="405"></canvas>
                    </div>
eof;
            }
            $return['graficaTodos'] =
            array
            (
                'type' => 'line',
                'data'=>array
                (
                    'labels'    => $labels,
                    'datasets'  => $datasets
                ),
                'options' => array
                (
                    'animation'             => false,
                    'fontSize'              => 20,
                    'responsive'            => false,
                    'legend'                => array('display' => false),
                    'scales'                => array
                    (
                        'yAxes' => 
                        [array(
                            'ticks' => array
                            (
                                'min'       => 0,
                            )
                        )]
                    )
                )
            );
//                            <div class="menuArriba">
//                                <div class="menuTitulo">Seleccionar tanques:</div>
//                                <div class="menuTodos"><div></div>Ver todos</div>
//                            </div>
            $return['codigo'] = $return['codigo'].'
                    </div>
                </div>';
            echo json_encode($return);
        }
    
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='viajes-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
