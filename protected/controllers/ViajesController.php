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
    public function actionGetIdCliente($s) 
    {
        $solicitud = Solicitudes::model()->findByPk((int) $s);
        $pedidos = Pedidos::model()->findAll("id_solicitud = $solicitud->id");
        $return = array();
        foreach($pedidos as $data)
            $return[] = $data->attributes;
//        $html = $solicitud->id_clientes;
//        if($solicitud->notas !='' && $solicitud->notas != NULL) {
//            $nota = $solicitud->notas;
//        }
//        else {
//            $nota = "no hay notas";
//        }
//
//        $this->layout=false;
//        header('Content-type: application/json');
//        $data = array();
//
//        $data['html'] = $html;
//        $data['nota'] = $nota;
        echo json_encode($return);
//        Yii::app()->end(); 
    }
    public function actionGetCamionesDisponibles($total, $fecha, $idCamion)
    {
        $opciones = '';
        if($fecha != '')
        {
            $fecha = date('Y-m-d', strtotime($fecha.' + 3 days'));
            $Viajes = Yii::app()->db->createCommand()
                ->selectDistinct('id_estacion')
                ->from('viajes')
                ->where('status = 1')
                ->andWhere("fecha_salida > '$fecha'")
                ->queryAll();
            $Viajes2 = Yii::app()->db->createCommand()
                ->selectDistinct('id_estacion')
                ->from('viajes')
                ->where('status = 1')
                ->andWhere("fecha_salida <= '$fecha'")
                ->queryAll();
            $index = 0;
            foreach($Viajes as $data)
            {
                foreach($Viajes2 as $data2)
                {
                    if($data2['id_estacion'] == $data['id_estacion'])
                        unset($Viajes[$index]);
                }
                $index++;
            }
        }
        if($idCamion != null)
            $Viajes[] = array('id_estacion' => $idCamion);
        if(isset($Viajes))
        {
            foreach($Viajes as $data)
            {
                $estacion = Estacion::model()->findByPk($data['id_estacion']);
                $tanques = Tanque::model()->findAll("id_estacion = $estacion->id and activo = 1");
                $i = count($tanques);
                if($i >= $total)
                    $opciones = $opciones.<<<eof
                        <option value="$estacion->id">$estacion->identificador ($i Tanque(s))</option>
eof;
            }
        }
        $estacion = Estacion::model()->findAll('disponible = 1 and activo = 1 and tipo = 1');
        foreach ($estacion  as $data)
        {
            $tanques = Tanque::model()->findAll("id_estacion = $data->id and activo = 1");
            $i = count($tanques);
            if($i >= $total)
                $opciones = $opciones.<<<eof
                    <option value="$data->id">$data->identificador ($i Tanque(s))</option>
eof;
        }
//        echo json_encode($opciones, JSON_UNESCAPED_SLASHES);
        if($opciones == '')
            $opciones = "<option value>Sin camiones disponibles</option>";
        echo json_encode($opciones);
    }
    public function actionGetTanquesConSolicitud($solicitud, $camion/*, $i*/)
    {
        $pedidos = json_decode($solicitud);
        $select = '';
        $cliente = Clientes::model();
        $cepa = Cepa::model();
        $return = array();
        foreach($pedidos->k as $data)
        {
            $pedido = Pedidos::model()->findAll("id_solicitud = $data");
            $solicitud = Solicitudes::model()->findByPk($data);
            $select = $select.<<<EOF
                    <optgroup label="{$cliente->getCliente($solicitud->id_clientes)}($solicitud->codigo)">
EOF;
            $tempTtl = 0;
            foreach($pedido as $data2)
            {
                for($i = 1; $i <= $data2['tanques']; $i++)
                {
                    if ( $i == $data2['tanques'] ) {
                        $tempTtl = ceil($data2['cantidad'] / $data2['tanques']) - floor($data2['cantidad'] / $data2['tanques']) ;
                    }

                    $total = ceil($data2['cantidad']/$data2['tanques']) - $tempTtl;  //$data2['cantidad']/$data2['tanques'];
                    $select = $select.<<<EOF
                        <option value="{$data2['id']}:$i">{$cepa->getCepa($data2['id_cepa'])}($total)</option>
EOF;
                }
            }
            $select = $select.'</optgoup>';
        }
        $select = $select.'</select>';
        $tanques = Tanque::model()->findAll("id_estacion = $camion AND activo = 1");
        $tot = 1;
        $html = "";
        foreach($tanques as $data) 
        {
            $html = $html.<<<EOF
                <div class="pedido">
                    <input type="hidden" name="Solicitudes[codigo][{$tot}][id_tanque]" value="$data->id">
                    <div class="tituloEspecie">$data->nombre</div>
                    <div class="pedidoWraper">
                        <select class="css-select ttan ttan{$tot}" data-tan="{$tot}" name="Solicitudes[codigo][{$tot}][tanque]" id="Solicitudes_codigo_{$tot}_tanque">
                            <option value="">Seleccionar</option>
                            $select
                        </select>                            
                        <div class="errorMessage" id="Viajes_codigo_{$tot}_tanque_em_" style="display:none"></div>                        
                    </div>                     
                </div>
                </div>
EOF;
            $tot++;
        }
            $return['html'] = $html;
            echo json_encode($return);
        }
    public function actionGetResumenViaje($pedido, $tanque, $pos) 
    {
        $Tanque = Tanque::model();
        $Domicilio = ClientesDomicilio::model();
        $Especie = Especie::model();
        $pedido = Pedidos::model()->findByPk($pedido);
        $solicitud = Solicitudes::model()->findByPk($pedido->id_solicitud);
        $cepa = Cepa::model()->findByPk($pedido->id_cepa);
        $cliente = Clientes::model()->findByPk($solicitud->id_clientes);
        $data['id_cliente'] = $cliente->id;
        if($pos == $pedido->tanques) {
            $cant = ceil($pedido->cantidad/$pedido->tanques);
        }
        else {
            $cant = floor($pedido->cantidad/$pedido->tanques);
        }
        $html = <<<EOF
        <div class='boxCont'>
            <div id='contV3'>
                <div id='vt1'>
                    <div class='headerT'>Tanque: {$Tanque->getTanque($tanque)}</div>
                </div>
                <div id='vc1' class='vbox'>
                    <div class=''>
                        <p id='vtitulo'><span style="color: #000000">$cliente->nombre_empresa</span></br>
                       <span>$cliente->rfc</span></br>
                        <span>$cliente->nombre_contacto $cliente->apellido_contacto</span></br>
                        <span>{$Domicilio->getDomicilio($pedido->id_direccion)}</span></p>
                    </div>
                    <div class=''>
                        <p><span class='vresalta'>Fecha de salida: </span> <span class='fsalida'></span></p>
                    </div>
                </div>
                <div id='vt2'>
                    <div class='headerT'>Datos de la especie</div>
                </div>
                <div id='vc2'>
                    <p><span class='vresalta'>Especie: </span>{$Especie->getEspecie($pedido->id_especie)}</p>
                    <p><span class='vresalta'>Cepa: </span>{$cepa->getcepa($pedido->id_cepa)}</p>
                    <p><span class='vresalta'>No. Organismos: </span>{$cant}</p>
                <table id='vcont'>
                    <tr class='pf'>
                        <th class='pc'></th><th>Mínima</th><th>Máxima</th>
                    </tr>
                    <tr>
                        <th class='pc'>Temperatura</th><th> {$cepa->temp_min}</th><th>{$cepa->temp_max}</th>
                    </tr>
                    <tr>
                        <th class='pc'>PH</th><th>{$cepa->ph_min}</th><th>{$cepa->ph_max}</th>
                    </tr>
                    <tr>
                        <th class='pc'>Oxígeno</th><th> {$cepa->ox_min}</th><th>{$cepa->ox_min}</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
EOF;
        $data = array();
        $data['cliente'] = $cliente;
        $data['html'] = $html;
        $data['pos'] = $pos;
        echo json_encode($data);
    }
    public function accessRules()
    {
        $return = array();
        if(Yii::app()->user->checkAccess('createViajes') || Yii::app()->user->id == 'smobiladmin'||Yii::app()->user->getTipoUsuario()==1)
            $return[] = array
            (
                'allow',
                'actions'   => array('crear, create'),
                'users'     => array('*')
            );
        else
            $return[] = array
            (
                'deny',
                'actions'   => array('create'),
                'users'     => array('*')
            );

        if(Yii::app()->user->checkAccess('readViajes') || Yii::app()->user->id == 'smobiladmin'||Yii::app()->user->getTipoUsuario()==1)
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
        if(Yii::app()->user->checkAccess('editViajes') || Yii::app()->user->id == 'smobiladmin'||Yii::app()->user->getTipoUsuario()==1)
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
        if(Yii::app()->user->checkAccess('deleteViajes') || Yii::app()->user->id == 'smobiladmin'||Yii::app()->user->getTipoUsuario()==1)
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
    public function actionView($id)
    {
        $model = Viajes::model()->findByPk((int)$id);
        $prueba = SolicitudesViaje::model()->findAll("id_viaje = $model->id AND id_personal = 0");
        $guardar = array();
        $pedidos = array();
        $solicitudTanque = SolicitudTanques::model()->findAll("id_solicitud = $model->id_solicitudes");
        if(Yii::app()->user->getTipoUsuario()==1)
        {
            $prueba=Yii::app()->db->createCommand('SELECT sv.*, c.id as idc FROM solicitudes_viaje sv
            JOIN solicitudes s ON s.id=sv.id_solicitud
            JOIN clientes c ON c.id=s.id_clientes
            WHERE id_viaje='.$model->id.'
            AND id_personal=0
            AND c.id='.Yii::app()->user->getIDc())
            ->queryAll();
            $solicitudTanque = Yii::app()->db->createCommand('SELECT st.*,c.id as idc FROM solicitud_tanques st
            JOIN solicitudes s ON st.id_solicitud=s.id
            JOIN clientes c ON s.id_clientes=c.id
            WHERE id_solicitud='.$model->id_solicitudes.'
            AND c.id='.Yii::app()->user->getIDc())
            ->queryAll();
        }
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
                'id_solicitud'=>$data->id_solicitud,
                'id_tanque'=>$data->id_tanque
            );
            $pedidos['pedido'][] = $pedido;
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
                    'id_solicitud'=>$data->id_solicitud,
                    'id_tanque'=>$data->id_tanque
                );
                $pedidos['pedido'][] = $pedido;
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

            $this->render('view',array(
                'model'=>$model,
                'tanques'=>$tanques,
                'pedidos' => $pedidos
            ));

    }
    public function actionCreate()
    {

        $isNewRecord = false;
        $haypost = false;
        $model = new Viajes;
        $solicitudes = new Solicitudes();
        $personal = new SolicitudesViaje();
    //		Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
        if(isset($_POST['Viajes']))
        {   
            $isNewRecord = false;
            $haypost = true;
            $model->attributes = $_POST['Viajes'];
            $model->fecha_salida = date('Y-m-d', strtotime($model->fecha_salida));
            if(isset($_POST['Solicitudes']['id_clientes']))
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
//                    $model->id_solicitudes = $solicitudes->id;
                    if($model->id_solicitudes == '' || $model->id_solicitudes ==  null || $model->id_solicitudes == 0)
                    {
                        $model->id_solicitudes = $_POST['Viajes']['id_solicitudes'][0];
                        $solicitudes->id = $_POST['Viajes']['id_solicitudes'][0];
                    }
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
                            if(isset($data['id_solicitud']))
                                $nuevo->id_solicitud = $data['id_solicitud'];
                            else
                                $nuevo->id_solicitud = $solicitudes->id;
                            $nuevo->id_tanque = $data['tanque'];
                            $nuevo->id_domicilio = $data['destino'];
                            $nuevo->id_cepas = $data['cepa'];
                            $nuevo->cantidad_cepas = $data['cantidad'];
                            $nuevo->save();
                        }
                        if(isset($_POST['Viajes']['id_solicitudes']))
                        {
                            $i = 0;
                            foreach($_POST['Viajes']['id_solicitudes'] as $data)
                            {
                                if($i > 0)
                                {
                                    $nuevo = new SolicitudesViaje();
                                    $nuevo->id_personal = 0;
                                    $nuevo->id_viaje = $model->id;
                                    $nuevo->id_solicitud = $data;
                                    $nuevo->save();
                                }
                                $solicitud = Solicitudes::model()->findByPk($data);
                                $solicitud->status = 1;
                                $solicitud->fecha_estimada = $model->fecha_salida;
                                $solicitud->hora_estimada = $model->hora_salida;
                                if($solicitud->save())
                                {
                                    $pedido = Pedidos::model()->findAll("id_solicitud = $solicitud->id");
                                    foreach ($pedido as $data2)
                                    {
                                        $delete = Yii::app()->db->createCommand("DELETE from pedidos WHERE id = {$data2['id']}")->execute();
                                    }
                                }
                                $i++;
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
                        $nuevo->save();
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
    public function actionCrear()
    {
        $model = new Viajes();
        $pedidos = new Pedidos();
        $solicitudes = new Solicitudes();
        $personal = new SolicitudesViaje();
        if(isset($_POST['Viajes']))
        {
            $model->attributes = $_POST['Viajes'];
            $model->fecha_salida = date('Y-m-d', strtotime($model->fecha_salida));
            $model->id_solicitudes = $_POST['Viajes']['id_solicitudes'][0];
            $model->status = 1;
            if($model->save())
            {
                foreach($_POST['SolicitudesViaje']['id_personal']['1']['tecnico'] as $data)
                {
                    $nuevo = new SolicitudesViaje();
                    $nuevo->id_personal = $data;
                    $nuevo->id_viaje = $model->id;
                    $nuevo->id_solicitud = $model->id_solicitudes;
                    $nuevo->save();
                }
                foreach($_POST['SolicitudesViaje']['id_personal']['1']['chofer'] as $data)
                {
                    $nuevo = new SolicitudesViaje();
                    $nuevo->id_personal = $data;
                    $nuevo->id_viaje = $model->id;
                    $nuevo->id_solicitud = $model->id_solicitudes;
                    $nuevo->save();
                }
                foreach($_POST['Solicitudes']['codigo'] as $data)
                {
                    if(isset($data['tanque']) && $data['tanque'] != '')
                    {
                        $nuevo = new SolicitudTanques();
                        $id = explode(':',$data['tanque']);
                        $pedido = Pedidos:: model()->findByPk($id[0]);
                        $nuevo->id_solicitud = $pedido->id_solicitud;
                        $nuevo->id_tanque = $data['id_tanque'];
                        $nuevo->id_domicilio = $pedido->id_direccion;
                        $nuevo->id_cepas = $pedido->id_cepa;
                        if($pedido->tanques > 0)
                            $nuevo->cantidad_cepas = $pedido->cantidad / $pedido->tanques;
                        else
                            $nuevo->cantidad_cepas = $pedido->cantidad;
                        $nuevo->save();
//                        $insert = Yii::app()->db->createCommand()->insert('solicitud_tanques',$nuevo->attributes);
                    }
                }
                if(isset($_POST['Viajes']['id_solicitudes']))
                {
                    $i = 0;
                    foreach($_POST['Viajes']['id_solicitudes'] as $data)
                    {
                        if($i > 0)
                        {
                            $nuevo = new SolicitudesViaje();
                            $nuevo->id_personal = 0;
                            $nuevo->id_viaje = $model->id;
                            $nuevo->id_solicitud = $data;
                            $nuevo->save();
                        }
                        $solicitud = Solicitudes::model()->findByPk($data);
                        $solicitud->status = 1;
                        $solicitud->fecha_estimada = $model->fecha_salida;
                        $solicitud->hora_estimada = $model->hora_salida;
                        if($solicitud->save())
                        {
//                            $pedido = Pedidos::model()->findAll("id_solicitud = $solicitud->id");
//                            foreach ($pedido as $data2)
//                            {
//                                $delete = Yii::app()->db->createCommand("DELETE from pedidos WHERE id = {$data2['id']}")->execute();
//                            }
                        }
                        $i++;
                    }
                }
                $estacion = Estacion::model()->findByPk($model->id_estacion);
                $estacion->disponible = 2;
                if($estacion->save())
                    $this->redirect(array('index'));
            }
        }
//            print_r($_POST);
        $this->render('crear',array
        (
            'model' =>$model,
            'pedidos'=>$pedidos,
            'solicitudes'=>$solicitudes,
            'personal'=>$personal,
        ));
    }
    public function actionUpdate($id)
    {
            $model=$this->loadModel((int)$id);
            $personal = SolicitudesViaje::model()->findAll("id_viaje =".(int)$id);
            $solVia = SolicitudesViaje::model()->findAll("id_viaje =".(int)$id);
            $personalModel = new SolicitudesViaje();
            $model->fecha_salida = date('d-m-Y', strtotime($model->fecha_salida));
            $model->hora_salida = date('H:i', strtotime($model->hora_salida));
            // Uncomment the following line if AJAX validation is needed
            $this->performAjaxValidation($model);
            if(isset($_POST['Viajes']))
            {
                $estacion = Estacion::model()->findByPk($model->id_estacion);
                $estacion->disponible = 1;
                $estacion->save();
                $tanques = Tanque::model()->findAll("id_estacion = $model->id_estacion");
                $solTan = SolicitudTanques::model()->findAll();
                foreach($tanques as $data)
                    foreach($solTan as $data2)
                        if($data2->id_tanque == $data->id)
                                $data2->delete();
                $delete2 = Yii::app()->db->createCommand("DELETE FROM solicitudes_viaje WHERE id_viaje = $model->id")->execute();
                $solicitudes = SolicitudesViaje::model()->findAll("id_viaje = $model->id");
                foreach($solicitudes as $data)
                {
                    $columnas = array
                    (
                        'status' => 0,
                        'fecha_estimada' =>  null,
                        'hora_estimada' =>  null
                    );
                    $update = Yii::app()->db->createCommand()->update('solicitudes',$columnas,"id = $data->id_solicitud");
                }
                $model->attributes=$_POST['Viajes'];
                $model->fecha_salida = date('Y-m-d', strtotime($model->fecha_salida));
                $model->id_solicitudes = $_POST['Viajes']['id_solicitudes'][0];
                if($model->save())
                {
                    foreach($_POST['SolicitudesViaje']['id_personal']['1']['tecnico'] as $data)
                    {
                        $nuevo = new SolicitudesViaje();
                        $nuevo->id_personal = $data;
                        $nuevo->id_viaje = $model->id;
                        $nuevo->id_solicitud = $model->id_solicitudes;
                        $nuevo->save();
                    }
                    foreach($_POST['SolicitudesViaje']['id_personal']['1']['chofer'] as $data)
                    {
                        $nuevo = new SolicitudesViaje();
                        $nuevo->id_personal = $data;
                        $nuevo->id_viaje = $model->id;
                        $nuevo->id_solicitud = $model->id_solicitudes;
                        $nuevo->save();
                    }
                    foreach($_POST['Solicitudes']['codigo'] as $data)
                    {
                        if(isset($data['tanque']) && $data['tanque'] != '')
                        {
                            $nuevo = new SolicitudTanques();
                            $id = explode(':',$data['tanque']);
                            $pedido = Pedidos:: model()->findByPk($id[0]);
                            $nuevo->id_solicitud = $pedido->id_solicitud;
                            $nuevo->id_tanque = $data['id_tanque'];
                            $nuevo->id_domicilio = $pedido->id_direccion;
                            $nuevo->id_cepas = $pedido->id_cepa;
                            if($pedido->tanques > 0)
                                $nuevo->cantidad_cepas = $pedido->cantidad / $pedido->tanques;
                            else
                                $nuevo->cantidad_cepas = $pedido->cantidad;
                            $nuevo->save();
                        }
                    }
                    if(isset($_POST['Viajes']['id_solicitudes']))
                    {
                        $i = 0;
                        foreach($_POST['Viajes']['id_solicitudes'] as $data)
                        {
                            if($i > 0)
                            {
                                $nuevo = new SolicitudesViaje();
                                $nuevo->id_personal = 0;
                                $nuevo->id_viaje = $model->id;
                                $nuevo->id_solicitud = $data;
                                $nuevo->save();
                            }
                            $solicitud = Solicitudes::model()->findByPk($data);
                            $solicitud->status = 1;
                            $solicitud->fecha_estimada = $model->fecha_salida;
                            $solicitud->hora_estimada = $model->hora_salida;
                            $solicitud->save();
                            $i++;
                        }
                    }
                    $estacion = Estacion::model()->findByPk($model->id_estacion);
                    $estacion->disponible = 2;
                    if($estacion->save())
                        $this->redirect(array('index'));
                }
            }
            $roles = array('chofer'=>array(),'tecnico'=>array(), 'solicitudes'=>array());
            foreach($personal as $data)
            {
                $rol = Personal::model()->getRolPersonal($data->id_personal);
                if($rol == 1)
                    $roles['chofer'][$data->id_personal] = array('selected' => 'selected');
                if($rol == 2)
                    $roles['tecnico'][$data->id_personal] = array('selected' => 'selected');
            }
            foreach($solVia as $data)
            {
                $roles['solicitudes'][$data->id_solicitud] = array('selected' => 'selected');
            }
            $this->render('update',array
            (
                'model'     => $model,
                'personal'  => $personalModel,
                'roles'     => $roles
            ));
    }
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
            $solicitud->fecha_estimada = null;
            $solicitud->hora_estimada = null;
            $solicitud->status = 0;
            $solicitud->save();
//            $pedido = new Pedidos();
//            $pedido->id_cepa = $data['id_cepas'];
//            $cepa = Cepa::model()->findByPk($data['id_cepas']);
//            $pedido->id_direccion = $data['id_domicilio'];
//            $pedido->id_especie = $cepa->id_especie;
//            $pedido->id_solicitud = $solicitud->id;
//            $pedido->tanques = 1;
//            $pedido->cantidad = $data['cantidad_cepas'];
//            $pedido->save();
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
            // $save->status = 1;
            $save->save();
        }
        $estacion->save();
        $viaje->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
    //	if(!isset($_GET['ajax']))
    //		$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                    echo json_encode('');

    }
    public function actionIndex()
    {
        // echo date('H:i');
            $model=new Viajes();
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Viajes']))
                    $model->attributes=$_GET['Viajes'];
            $this->render('index',array(
                    'model'=>$model,
            ));
    }
    public function loadModel($id)
    {
            $model=Viajes::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
    }
    public function actionGetTanques($id)
    {
        $tanques = Tanque::model()->findAll("id_estacion = $id AND activo = 1");
        $return = '';
        foreach($tanques as $data)
            $return = $return.<<<eof
                <option value="$data->id">$data->nombre - $data->capacidad L</option>
eof;
        echo json_encode($return);
    }
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
        $return = array();
        $recorrido = EscalonViajeUbicacion::model()->findAll("id_viaje = $viaje");
//        print_r($recorrido);
        $arregloPosicion = new ArrayObject();
        $i = 0;
        $hay = strlen($recorrido[0]->ubicacion);
        $coord = substr($recorrido[0]->ubicacion, 1, $hay-2);
        $p2 = explode(",", $coord);
        $arregloPosicion->append(array('lat'=>(float)$p2[0], 'lng'=>(float)$p2[1]));
        foreach($recorrido as $data)
        {
            if($i % 15 == 0)
            {
                $hay = strlen($data->ubicacion);
                $coord = substr($data->ubicacion, 1, $hay-2);
                $p2 = explode(",", $coord);
                $arregloPosicion->append((array)['lat'=>(float)$p2[0], 'lng'=>(float)$p2[1]]);
            }
            $i++;
        }
        $return['puntosMapa'] = $arregloPosicion;
        $return['html'] = <<<EOF
            <div class="mapaPopup">
                <div class="titulo">Mapa</div>
                <div id="mapa2"></div>
                <div class="abajoPopup">
                    <div class="subtituloPopup">Entregas:</div>
                    <div class="entregasWraper">
EOF;
        foreach($direcciones as $data)
        {
            $return['html'] = $return['html'].<<<EOF
                        <div class="entregaPopup">
                            {$data['nombre_empresa']}
                                <br>
                            {$data['domicilio']}
                        </div>
EOF;
        }
        $return['html'] = $return['html'].<<<EOF
                    </div>
                </div>
           </div>
EOF;
        echo json_encode($return);
    }
    public function actionGetMapaPuntos($viaje)
    {
        $return = array();
        $recorrido = EscalonViajeUbicacion::model()->findAll("id_viaje = $viaje");
        $arregloPosicion = new ArrayObject();
        $i = 1;
        $hay = strlen($recorrido[0]->ubicacion);
        $coord = substr($recorrido[0]->ubicacion, 1, $hay-2);
        $p2 = explode(",", $coord);
        $arregloPosicion->append(array('lat'=>(float)$p2[0], 'lng'=>(float)$p2[1]));
        foreach($recorrido as $data)
        {
            if($i % 15 == 0)
            {
                $hay = strlen($data->ubicacion);
                $coord = substr($data->ubicacion, 1, $hay-2);
                $p2 = explode(",", $coord);
                $arregloPosicion->append((array)['lat'=>(float)$p2[0], 'lng'=>(float)$p2[1]]);
            }
            $i++;
        }
        $return['puntosMapa'] = $arregloPosicion;
        $return['html'] ='
            <div class="mapaPopup" style="height: auto !important;">
                <div class="titulo">Ruta completa (escalones de 30 minutos)</div>
                <div id="mapa2"></div>
           </div>';
        echo json_encode($return);
    }
    public function rad($x)
    {
        return $x * pi() / 180;
    }
    public function actionGetTanqueGrafica($viaje, $id, $flag)
    {
        $datos = Yii::app()->db->createCommand()
            ->select('esc.id, esc.fecha, esc.hora, esc.ubicacion, upT.ox, upT.id_tanque, upT.ph, upT.temp, upT.cond, upT.orp, upT.id')
            ->order('upT.id DESC')
            ->from('escalon_viaje_ubicacion as esc')
            ->join('uploadtemp as upT','upT.id_escalon_viaje_ubicacion = esc.id')
            ->where("esc.id_viaje = $viaje")
            ->andWhere("upT.id_tanque = $id")
            ->limit(1)
            ->queryRow();
        $return = array();
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
//                                    'min'       => 0,
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
//                                    'min'       => 0,
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
//                                    'min'       => 0,
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
//                                    'min'       => 0,
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
//                                    'min'       => 0,
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
    public function actionGetDatosViajeRuta($viaje, $flag)
    {
        $datos = Yii::app()->db->createCommand()
            ->from('escalon_viaje_ubicacion')
            ->where("id_viaje = $viaje")
            ->limit(1)
            ->order('id DESC')
            ->queryRow();
        $return = array();
        $recorrido = EscalonViajeUbicacion::model()->findAll("id_viaje = $viaje");
        if($flag)
        {
            $arregloPosicion = new ArrayObject();
            $i = 1;
            $hay = strlen($recorrido[0]->ubicacion);
            $coord = substr($recorrido[0]->ubicacion, 1, $hay-2);
            $p2 = explode(",", $coord);
            $arregloPosicion->append(array('lat'=>(float)$p2[0], 'lng'=>(float)$p2[1]));
            foreach($recorrido as $data)
            {
                if($i % 30 == 0)
                {
                    $hay = strlen($data->ubicacion);
                    $coord = substr($data->ubicacion, 1, $hay-2);
                    $p2 = explode(",", $coord);
                    $arregloPosicion->append((array)['lat'=>(float)$p2[0], 'lng'=>(float)$p2[1]]);
                }
                $i++;
            }
            $return['puntosMapa'] = $arregloPosicion;
        }
        $p1 = $p2 = array();
        $d = 0;
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
        $interval = $termina->diff($empieza);
        if($interval->y > 0)                        
            $return['tiempo'] = $interval->format('%y Años %m Meses %d D&iacute;as %h Horas %i Minutos %s Segundos');
        elseif($interval->m > 0)
            $return['tiempo'] = $interval->format('%m Meses %d D&iacute;as %h Horas %i Minutos %s Segundos');
        elseif($interval->d > 0)
            $return['tiempo'] = $interval->format('%d D&iacute;as %h Horas %i Minutos %s Segundos');
        elseif($interval->h >= 2 )
            $return['tiempo'] = $interval->format('%h Horas %i Minutos %s Segundos');
        elseif($interval->h == 1 )
            $return['tiempo'] = $interval->format('%h Hora %i Minutos %s Segundos');
        elseif ($interval->m > 0) 
            $return['tiempo'] = $interval->format('%i Minutos %s Segundos');
        // $return['tiempo'] = $diferencia->format('%d dias %h horas, %I minutos y %S segundos');
        $return['ultimo'] = $this->GetDistancia($viaje);
        $return['viaje'] = $datos;
        echo json_encode($return);
    }
    public function getDistanciaKm($viaje)
    {
        $recorrido = EscalonViajeUbicacion::model()->findAll("id_viaje = $viaje");
        $d = 0;
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
        return round($d, 2).' Km';
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
            ->join('uploadtemp as upT','upT.id_escalon_viaje_ubicacion = esc.id')
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
                        'labels'    => isset($nombre)?$nombre:"Not define",
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
//                                    'min'       => 0,
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
                        'labels'    => isset($nombre)?$nombre:"nombre",
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
//                                    'min'       => 0,
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
                        'labels'    => isset($nombre)?$nombre:"nombre",
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
//                                    'min'       => 0,
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
                        'labels'    => isset($nombre)?$nombre:"nombre",
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
//                                    'min'       => 0,
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
                        'labels'    => isset($nombre)?$nombre:"nombre",
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
//                                    'min'       => 0,
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
        $cepa = Yii::app()->db->createCommand()
                ->select('cep.*')
                ->from('solicitudes_viaje as SV')
                ->join('solicitud_tanques as ST','ST.id_solicitud = SV.id_solicitud')
                ->join('cepa as cep', 'cep.id = ST.id_cepas')
                ->where("SV.id_viaje = $viaje")
                ->andWhere("ST.id_tanque = $id")
                ->queryRow();
        $uploads = Yii::app()->db->createCommand()
                ->selectDistinct('evu.id as idTabla, upt.temp, upt.ox, upt.ph, upt.cond, upt.orp, upt.id as idUploads, evu.hora, evu.fecha, evu.ubicacion')
                ->from('escalon_viaje_ubicacion as evu')
                ->join('uploadtemp as upt','upt.id_escalon_viaje_ubicacion = evu.id')
                ->where("evu.id_viaje = $viaje")
                ->andWhere("upt.id_tanque = $id")
                ->andWhere("upt.alerta > 1")
                ->queryAll();
        if(count($uploads) > 0)
        {
            $return = '
                <div class="alertas">
                    <div class="tituloAlerta">Alertas: </div>
                    <div class="tablaAlertas">
                        <div class="tablaTitulos">
                            <span>Origen</span><span>Acción</span><span>Hora</span><span>Fecha</span>
                        </div>
                        <div class="tablaWraper">';
            foreach($uploads as $data)
            {
                if(isset($data['temp']))
                {
                    $dif = ($cepa['temp_max'] - $cepa['temp_min']) * 0.2;
                    $max = $cepa['temp_max'] - $dif;
                    $min = $cepa['temp_min'] + $dif;
                    if($data['temp'] >= $max || $data['temp'] <= $min)
                    {
                        $return = $return.'<div class="tableRow">';
                        if($data['temp'] >= $max)
                            $imagen = 'flechaUp';
                        else
                            $imagen = 'flechaDown';
                        $return = $return.<<<eof
                            <div>Temperatura<br>Min:{$cepa['temp_min']}º/Max:{$cepa['temp_max']}º</div><div>{$data['temp']}º<span class="$imagen">X</span></div><div>{$data['hora']}</div><div>{$data['fecha']}</div></div>
eof;
                    }
                }
                if(isset($data['ox']))
                {
                    $dif = ($cepa['ox_max'] - $cepa['ox_min']) * 0.2;
                    $max = $cepa['ox_max'] - $dif;
                    $min = $cepa['ox_min'] + $dif;
                    if($data['ox'] >= $max || $data['ox'] <= $min)
                    {
                        $return = $return.'<div class="tableRow">';
                        if($data['ox'] >= $max)
                            $imagen = 'flechaUp';
                        else
                            $imagen = 'flechaDown';
                        $return = $return.<<<eof
                            <div>Oxígeno<br>Min:{$cepa['ox_min']}/Max:{$cepa['ox_max']}</div><div>{$data['ox']}<span class="$imagen">X</span></div><div>{$data['hora']}</div><div>{$data['fecha']}</div></div>
eof;
                    }
                }
                if(isset($data['ph']))
                {
                    $dif = ($cepa['ph_max'] - $cepa['ph_min']) * 0.2;
                    $max = $cepa['ph_max'] - $dif;
                    $min = $cepa['ph_min'] + $dif;
                    if($data['ph'] >= $max || $data['ph'] <= $min)
                    {
                        $return = $return.'<div class="tableRow">';
                        if($data['ph'] >= $max)
                            $imagen = 'flechaUp';
                        else
                            $imagen = 'flechaDown';
                        $return = $return.<<<eof
                            <div>PH<br>Min:{$cepa['ph_min']}/Max:{$cepa['ph_max']}</div><div>{$data['ph']}<span class="$imagen">X</span></div><div>{$data['hora']}</div><div>{$data['fecha']}</div></div>
eof;
                    }
                }
                if(isset($data['cond']))
                {
                    $dif = ($cepa['cond_max'] - $cepa['cond_min']) * 0.2;
                    $max = $cepa['cond_max'] - $dif;
                    $min = $cepa['cond_min'] + $dif;
                    if($data['cond'] >= $max || $data['cond'] <= $min)
                    {
                        $return = $return.'<div class="tableRow">';
                        if($data['cond'] >= $max)
                            $imagen = 'flechaUp';
                        else
                            $imagen = 'flechaDown';
                        $return = $return.<<<eof
                            <div>Conductividad<br>Min:{$cepa['cond_min']}/Max:{$cepa['cond_max']}</div><div>{$data['cond']}<span class="$imagen">X</span></div><div>{$data['hora']}</div><div>{$data['fecha']}</div></div>
eof;
                    }
                }
                if(isset($data['orp']))
                {
                    $dif = ($cepa['orp_max'] - $cepa['orp_min']) * 0.2;
                    $max = $cepa['orp_max'] - $dif;
                    $min = $cepa['orp_min'] + $dif;
                    if($data['orp'] >= $max || $data['orp'] <= $min )
                    {
                        $return = $return.'<div class="tableRow">';
                        if($data['orp'] > $max)
                            $imagen = 'flechaUp';
                        else
                            $imagen = 'flechaDown';
                        $return = $return.<<<eof
                            <div>Potencial óxido reducción<br>Min:{$cepa['orp_min']}/Max:{$cepa['orp_max']}</div><div>{$data['orp']}<span class="$imagen">X</span></div><div>{$data['hora']}</div><div>{$data['fecha']}</div></div>
eof;
                    }
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
        $nombre = " Name "  ;
        $uploads = Yii::app()->db->createCommand()
                ->selectDistinct("cep.*, tan.id as idTanque, tan.nombre, upt.$id, evu.hora, evu.fecha, evu.ubicacion")
                ->from('solicitudes_viaje as solV')
                ->join('solicitud_tanques as solT','solT.id_solicitud = solV.id_solicitud')
                ->leftJoin('tanque as tan', 'tan.id = solT.id_tanque')
                ->rightJoin('cepa as cep', 'cep.id = solT.id_cepas')
                ->join('uploadtemp as upt','upt.id_tanque = tan.id')
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
                            <span>Origen</span><span>Acción</span><span>Hora</span><span>Fecha</span>
                        </div>
                        <div class="tablaWraper">';

            foreach($uploads as $data)
            {
                $dif = ($data[$id.'_max'] - $data[$id.'_min']) * 0.2;
                $max = $data[$id.'_max'] - $dif;
                $min = $data[$id.'_min'] + $dif;
                if($data[$id] >= $max || $data[$id] < $min)
                {
                    $return = $return.'<div class="tableRow">';
                    if($data[$id] >= $max)
                        $imagen = 'flechaUp';
                    else
                        $imagen = 'flechaDown';
                    $return = $return.<<<eof
                            <div>{$data['nombre']}<br>Min:{$data[$id.'_min']}/Max:{$data[$id.'_max']}</div><div>{$data[$id]}º<span class="$imagen">X</span></div><div>{$data['hora']}</div><div>{$data['fecha']}</div></div>
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
            ->join('uploadtemp as upT','upT.id_escalon_viaje_ubicacion = esc.id')
            ->where("esc.id_viaje = $viaje")
            ->andWhere("upT.id_tanque = $id")
            ->order("esc.id ASC")
            ->queryAll();
        $count = count($total);
        $rangos = array();
        $rangosTitulo = array();
        $index = 0;
        $x = 0;
        if($count > 300)
        {
            do
            {
                $x = $x + 300;
                if( $x < $count )
                {
                    $rangos[$index] = array((300*$index)+1,(300*($index+1)));
                    $rangosTitulo[$index] = array($total[(300*$index)+1]['hora'], $total[300*($index+1)]['hora']);
                    $index = $index + 1;
                }
                else
                {
                    $x = $x - 300;
                    $rangos[$index] = array((300*$index)+1,((300*$index)+($count-$x)));
                    $rangosTitulo[$index] = array($total[(300*$index)+1]['hora'], $total[(300*$index)+($count-$x)-1]['hora']);
                    $x = null;
                }
            }while($x != null);
        }
        else
        {
            $rangos[$index] = array(0, $count);
            $rangosTitulo[$index] = array($total[0]['hora'], $total[$count-1]['hora']);
        }
            $datos = Yii::app()->db->createCommand()
            ->select('esc.hora, upT.ox, upT.id_tanque, upT.ph, upT.temp, upT.cond, upT.orp, upT.id')
            ->from('escalon_viaje_ubicacion as esc')
            ->join('uploadtemp as upT','upT.id_escalon_viaje_ubicacion = esc.id')
            ->where("esc.id_viaje = $viaje")
            ->andWhere("upT.id_tanque = $id")
            ->limit(300,$rangos[0][0])
            ->order("esc.id ASC")
            ->queryAll();
        $x = count($rangos) * 206.39;
        $return['codigo'] = <<<eof
            <div class="historial">
                <div class="titulo"></div>
                <div class="historialGraficasWraper">
                    <div>rango de datos</div>
                    <div class="rangos-wraper">
                        <div class="rangosHistorial" style="width: {$x}px">
eof;
        $x = true;
        $conta = 1;
        foreach ($rangosTitulo as $data)
        {
            if($x)
            {
                $return['codigo'] = $return['codigo'].<<<eof
                    <div class="selected" data-range="{$rangos[0][0]}">$data[0] - $data[1]</div>
eof;
                $x = false;
            }
            else
            {
                $return['codigo'] = $return['codigo'].<<<eof
                    <div data-range="{$rangos[$conta][0]}">$data[0] - $data[1]</div>
eof;
                $conta++;
            }
        }
        $return['codigo'] = $return['codigo'].<<<eof
                        </div>
                    </div>
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
        $return['codigo'] = $return['codigo'].<<<eof
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
                    'labels'    => isset($labels)?$labels:"empty",
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
                            'data'                  => isset($datasets)?$datasets:"empty",
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
//                                'min'       => 0,
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
                'labels'    => isset($labels2)?$labels2:"empty",
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
                        'data'                  => isset($datasets2)?$datasets2:"empty",
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
//                            'min'       => 0,
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
                'labels'    =>isset($labels3)?$labels3:"empty",
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
                        'data'                  => isset($datasets3)?$datasets3:"empty",
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
//                            'min'       => 0,
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
                'labels'    => isset($labels4)?$labels4:"empty",
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
                        'data'                  => isset($datasets4)?$datasets4:"empty",
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
//                            'min'       => 0,
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
                'labels'    => isset($labels5)?$labels5:"empty",
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
                        'data'                  => isset($datasets5)?$datasets5:"empty",
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
//                            'min'       => 0,
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
    public function actionGetGraficaTanqueRango($viaje, $id, $rango)
    {
        $datos = Yii::app()->db->createCommand()
            ->select('esc.hora, upT.ox, upT.id_tanque, upT.ph, upT.temp, upT.cond, upT.orp, upT.id')
            ->from('escalon_viaje_ubicacion as esc')
            ->join('uploadtemp as upT','upT.id_escalon_viaje_ubicacion = esc.id')
            ->where("esc.id_viaje = $viaje")
            ->andWhere("upT.id_tanque = $id")
            ->limit(300,$rango)
            ->order("esc.id ASC")
            ->queryAll();
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
        $return['ox'] =
            array
            (
                'type' => 'line',
                'data'=>array
                (
                    'labels'    => isset($labels)?$labels:"empty",
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
                            'data'                  => isset($datasets)?$datasets:"empty",
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
        $return['temp'] =
        array
        (
            'type' => 'line',
            'data'=>array
            (
                'labels'    => isset($labels2)?$labels2:"empty",
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
                        'data'                  => isset($datasets2)?$datasets2:"empty",
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
        $return['ph'] =
        array
        (
            'type' => 'line',
            'data'=>array
            (
                'labels'    =>isset($labels3)?$labels3:"empty",
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
                        'data'                  => isset($datasets3)?$datasets3:"empty",
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
        $return['cond'] =
        array
        (
            'type' => 'line',
            'data'=>array
            (
                'labels'    => isset($labels4)?$labels4:"empty",
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
                        'data'                  => isset($datasets4)?$datasets4:"empty",
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
        $return['orp'] =
        array
        (
            'type' => 'line',
            'data'=>array
            (
                'labels'    => isset($labels5)?$labels5:"empty",
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
                        'data'                  => isset($datasets5)?$datasets5:"empty",
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
        echo json_encode($return);
    }
    public function actionGetHistorialParametro($viaje, $id)
    {
        $total = Yii::app()->db->createCommand()
            ->select("esc.hora, upT.$id, upT.id_tanque, upT.id")
            ->order('upT.id DESC')
            ->from('escalon_viaje_ubicacion as esc')
            ->join('uploadtemp as upT','upT.id_escalon_viaje_ubicacion = esc.id')
            ->where("esc.id_viaje = $viaje")
            ->order("upT.id ASC")
            ->queryAll();
        $count = count($total);
        $rangos = array();
        $rangosTitulo = array();
        $index = 0;
        $x = 0;
        if($count > 300)
        {
            do
            {
                $x = $x + 300;
                if( $x < $count )
                {
                    $rangos[$index] = array((300*$index)+1,(300*($index+1)));
                    $rangosTitulo[$index] = array($total[(300*$index)+1]['hora'], $total[300*($index+1)]['hora']);
                    $index = $index + 1;
                }
                else
                {
                    $x = $x - 300;
                    $rangos[$index] = array((300*$index)+1,((300*$index)+($count-$x)));
                    $rangosTitulo[$index] = array($total[(300*$index)+1]['hora'], $total[(300*$index)+($count-$x)-1]['hora']);
                    $x = null;
                }
            }while($x != null);
        }
        else
        {
            $rangos[$index] = array(0, $count);
            $rangosTitulo[$index] = array($total[0]['hora'], $total[$count-1]['hora']);
        }
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
            ->join('uploadtemp as upT','upT.id_escalon_viaje_ubicacion = esc.id')
            ->where("esc.id_viaje = $viaje")
            ->limit(300,$rangos[0][0])
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
            <div class="menuSeccion selected" data-tanque="-1">Todos</div>
eof;
        $menuTanques = '';
        $i = 0;
        foreach($tanques as $info)
        {
            $menuTanques = $menuTanques.<<<eof
                    <div class="tanqueItem" style="color:$colors[$i]">{$info['nombre']}</div>
eof;
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
                    'responsive'            => false,
                    'legend'                => array
                    (
                        'display' => false
                    ),
                    'scales'                => array
                    (
                        'yAxes' => 
                        [array(
                            'ticks' => array
                            (
//                                'min'       => 0,
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
        $x = count($rangos) * 206.39;
        $return['codigo'] = <<<eof
            <div class="historial parametro">
                <div class="titulo">Historial de parámetro ($nombre)</div>
                <div class="historialGraficasWraper">
                    <div>rango de datos</div>
                    <div class="rangos-wraper">
                        <div class="rangosHistorial" style="width: {$x}px">
eof;
        $x = true;
        $conta = 1;
        foreach ($rangosTitulo as $data)
        {
            if($x)
            {
                $return['codigo'] = $return['codigo'].<<<eof
                    <div class="selected" data-range="{$rangos[0][0]}">$data[0] - $data[1]</div>
eof;
                $x = false;
            }
            else
            {
                $return['codigo'] = $return['codigo'].<<<eof
                    <div data-range="{$rangos[$conta][0]}">$data[0] - $data[1]</div>
eof;
                $conta++;
            }
        }
        $return['codigo'] = $return['codigo'].<<<eof
                        </div>
                    </div>
                    <div class="menuHistorial">
                        $menu
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
        $return['codigo'] =$return['codigo'].<<<eof
            <div class="tanquesColores">
                $menuTanques
            </div>
eof;
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
//                            'min'       => 0,
                        )
                    )]
                )
            )
        );
        $return['codigo'] = $return['codigo'].'
                </div>
            </div>';
            
        echo json_encode($return);
    }
    public function actionGetGraficaParametroRango($viaje, $id, $rango)
    {
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
            ->join('uploadtemp as upT','upT.id_escalon_viaje_ubicacion = esc.id')
            ->where("esc.id_viaje = $viaje")
            ->limit(300,$rango)
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
            $i++;
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