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
//            if($model->status != 1)
//            {
                $tanques = Yii::app()->db->createCommand()
                        ->selectDistinct('solTa.id_domicilio, solTa.id_tanque, solTa.id_cepas, SolTa.cantidad_cepas, cli.nombre_empresa, sol.codigo, tan.nombre, tan.id')
                        ->from('solicitudes_viaje as solVi')
                        ->join('solicitud_tanques as solTa','solTa.id_solicitud = solVi.id_solicitud')
                        ->join('solicitudes as sol','sol.id = solTa.id_solicitud')
                        ->join('clientes as cli','cli.id = sol.id_clientes')
                        ->join('tanque as tan','tan.id = solTa.id_tanque')
                        ->where("solVi.id_viaje = :id",array(':id'=>(int)$id))
                        ->queryAll();
//            }
            $this->render('view',array(
                'model'=>$model,
                'tanques'=>$tanques
            ));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
            $model=new Viajes;
            $solicitudes = new Solicitudes();
            $personal = new SolicitudesViaje();
//		// Uncomment the following line if AJAX validation is needed
            $this->performAjaxValidation($model);
//
            if(isset($_POST['Viajes']))
            {
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
                if($solicitudes->id != '' && $solicitudes->id != null)
                {
                    $delete = Yii::app()->db->createCommand("DELETE FROM pedidos WHERE id_solicitud = $solicitudes->id")->execute();
                    $update = Yii::app()->db->createCommand()->update('solicitudes',$solicitudes->attributes,"id = $solicitudes->id");
                }
                else
                    $solicitudes->save();
                if($_POST['NuevoRecord'] == 0)
                {
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
            $pedidos = $_POST;
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
//            print_r($pedidos);
            $this->render('create',array
            (
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
		$model=$this->loadModel($id);
                $model->fecha_salida = date('d-m-Y', strtotime($model->fecha_salida));
                $model->hora_salida = date('H:i', strtotime($model->hora_salida));
                $model->fecha_entrega = date('d-m-Y', strtotime($model->fecha_entrega));
                $model->hora_entrega = date('H:i', strtotime($model->hora_entrega));
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Viajes']))
		{
			$model->attributes=$_POST['Viajes'];
                        $model->fecha_salida = date('Y-m-d', strtotime($model->fecha_salida));
                        $model->fecha_entrega = date('Y-m-d', strtotime($model->fecha_entrega));
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
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
//                    $p2[0] = ();
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
                $viaje = Viajes::model()->findByPk($viaje);
                $empieza = new DateTime($viaje->fecha_salida.' '.$viaje->hora_salida);
                $termina = new DateTime($datos['fecha'].' '.$datos['hora']);
                $diferencia = $termina->diff($empieza);
                $return['tiempo'] = $diferencia->format('%d dias %h horas, %I minutos y %S segundos');
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
        public function actionGetParametroGrafica($viaje, $flag)
        {
            $tanques = Yii::app()->db->createCommand()
                ->selectDistinct('solTa.id_domicilio, solTa.id_tanque, solTa.id_cepas, SolTa.cantidad_cepas, cli.nombre_empresa, sol.codigo, tan.nombre, tan.id')
                ->from('solicitudes_viaje as solVi')
                ->join('solicitud_tanques as solTa','solTa.id_solicitud = solVi.id_solicitud')
                ->join('solicitudes as sol','sol.id = solTa.id_solicitud')
                ->join('clientes as cli','cli.id = sol.id_clientes')
                ->join('tanque as tan','tan.id = solTa.id_tanque')
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
                    foreach($datos as $data)
                    {
                        $valores[] = $data['ph'];
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
                    ->selectDistinct('cep.*, tan.id as idTanque, upt.temp, upt.ox, upt.ph, upt.od, upt.orp, evu.hora, evu.fecha, evu.ubicacion')
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
                    <div class="alertas">
                        <div class="tituloAlerta2">Sin alertas en </div>
                        <div class="tablaAlertas">
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
                    <div class="alertas">
                        <div class="tituloAlerta2">Sin alertas en </div>
                        <div class="tablaAlertas">
                        </div>
                    </div>';
            }
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
