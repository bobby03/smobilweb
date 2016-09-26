<?php

class MonitoreoController extends Controller
{
    public function actionDelete($id)
    {
        Estacion::model()->findByPk($id)->delete();
        echo json_encode('');
    }
    public $layout='//layouts/column2';
    public function filters()
    {
            return array(
                    'accessControl', // perform access control for CRUD operations
                    //'postOnly + delete', // we only allow deletion via POST request
            );
    }
    public function accessRules()
    {
        $return = array();
        if(Yii::app()->user->checkAccess('createEstacion') || Yii::app()->user->id == 'smobiladmin')
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
        if(Yii::app()->user->checkAccess('readEstacion') || Yii::app()->user->id == 'smobiladmin')
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
        if(Yii::app()->user->checkAccess('updateEstacion') || Yii::app()->user->id == 'smobiladmin')
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
        if(Yii::app()->user->checkAccess('deleteEstacion') || Yii::app()->user->id == 'smobiladmin')
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
    public function actionIndex()
    {

            $model = new Monitoreo('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Monitoreo']))
            $model->attributes=$_GET['Solicitudes'];


        $this->render('index',array(
                'model'=>$model
        ));
    }
    public function actionView($id)
    {
        // $campsensado = CampSensado::model()->findByAttributes(array('id_estacion'=>$id) );
        $campsensado = CampSensado::model()->findByPk((int)$id);
        
        // fb($campsensado);

        $nombre = $campsensado->nombre_camp;
        $responsable = Granjas::model()->getGranjaResponsable($campsensado->id_responsable);
        
        $id_estacion = $campsensado->id_estacion;
        // fb($id_estacion);
        $cantTanques =count( Yii::app()->db->createCommand()
            ->select('t.id')
            ->from('tanque t')
            ->join('estacion e','e.id = t.id_estacion')
            ->where('t.activo = 1')
            ->andWhere('t.id_estacion = :tID',array(':tID'=>$id_estacion))
            ->queryRow() );

        // $cantTanques= Yii::app()->db->createCommand('SELECT count(t.id) as cTan FROM tanque t
        // JOIN estacion e ON t.id_estacion=e.id
        // WHERE t.activo=1
        // AND t.id_estacion='.$id_estacion)
        // ->queryRow();
        // fb($cantTanques);
        // $sql = "SELECT * FROM (SELECT rc.id AS idUpl,tanque.id AS idTan,estacion.id AS idEst,identificador,no_personal,marca,color,ubicacion,capacidad,nombre,ct,ox,ph,temp,cond,orp,alerta
       // FROM estacion
       // JOIN tanque ON estacion.id=tanque.id_estacion
       // JOIN registro_camp rc ON tanque.id=rc.id_tanque AND rc.id_camp_sensado='.(int)$id.'
       // WHERE estacion.id='.$id_estacion.'
       // ORDER BY tanque.id,rc.id DESC LIMIT 2000) consulta
       // GROUP BY idtan";

        // echo $sql;

        $tanques = Yii::app()->db->createCommand('SELECT * FROM (SELECT rc.id AS idUpl,tanque.id AS idTan,estacion.id AS idEst,identificador,no_personal,marca,color,ubicacion,capacidad,nombre,ct,ox,ph,temp,cond,orp,alerta
        FROM estacion
        JOIN tanque ON estacion.id=tanque.id_estacion
        JOIN registro_camp rc ON tanque.id=rc.id_tanque AND rc.id_camp_sensado='.(int)$id.'
        WHERE estacion.id='.$id_estacion.'
        ORDER BY tanque.id,rc.id DESC LIMIT 2000) consulta
        GROUP BY idtan')
                ->queryAll();
        // print_r($tanques);
        // fb($tanques);
        $estaciones = Yii::app()->db->createCommand()
                ->select('*')
                ->from('estacion')
                ->where("estacion.id=$id_estacion")
                ->andWhere("tipo=2")
                ->limit(1)
                ->queryRow();
        // print_r($estaciones);
        
        fb($estaciones);
            $this->render('monitoreo',array(
                'fijas'=>$this->loadModel($estaciones),
                'tanques'=>$tanques,
                'cantTanques'=>$cantTanques,
                'nombre' => $nombre,
                'responsable' => $responsable,
                'siembra'=>$campsensado
            ));
            // */
    }
    public function loadModel($estacion)
    {
        if(empty($estacion))
            throw new CHttpException(404,'The requested page does not exist.');
        return $estacion;
        if(empty($tanques))
            throw new CHttpException(404,'The requested page does not exist.');
        return $estacion;
    }
    public function actionGetTanqueGrafica($estacion,$id, $flag)
    {
        $datos = Yii::app()->db->createCommand('SELECT estacion.id AS idEst,tanque.id AS idTan,r.id AS idr,identificador,no_personal,marca,color,ubicacion,capacidad,nombre,ox,ph,temp,cond,orp
          FROM estacion                
          JOIN tanque ON estacion.id=tanque.id_estacion
          JOIN registro_camp r ON tanque.id=r.id_tanque
          WHERE estacion.id='.$estacion.'
          AND tanque.id='.$id.' ORDER BY idr DESC')
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
    public function actionGetAlertasParametro($estacion, $id)
    {
        $uploads = Yii::app()->db->createCommand('SELECT rc.id,cs.id as idcs,t.id as idt, c.id as idcepa, c.nombre_cepa,c.'.$id.'_min,c.'.$id.'_max, t.nombre as nombre, rc.fecha,rc.hora,rc.'.$id.',rc.ct
        FROM registro_camp rc
        JOIN camp_sensado cs ON rc.id_camp_sensado=cs.id
        JOIN camp_tanque ct ON ct.id_camp_sensado=cs.id 
        JOIN cepa c ON ct.id_cepa=c.id 
        JOIN tanque t ON rc.id_tanque=t.id
        WHERE rc.alerta>0
        AND rc.id_estacion='.$estacion.'
        AND ( rc.'.$id.'<c.'.$id.'_min OR rc.'.$id.'>c.'.$id.'_max)')
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
    public function actionGetAlertasTanque($camp_sen, $id)
    {
        $cepa = Yii::app()->db->createCommand()
                ->select('cep.*')
                ->from('camp_tanque as CT')
                ->join('cepa as cep', 'cep.id = CT.id_cepa')
                ->where("CT.id_camp_sensado = $camp_sen")
                ->andWhere("CT.id_tanque = $id")
                ->queryRow();
        $uploads = RegistroCamp::model()->findAll("id_camp_sensado = $camp_sen AND id_tanque = $id AND alerta > 1");
//        $uploads = Yii::app()->db->createCommand('SELECT rc.id,cs.id as idcs,t.id as idt, cepa.*, t.nombre as nombre, rc.fecha,rc.hora,rc.temp,rc.ph,rc.ox,rc.cond,rc.orp,rc.alerta,rc.ct
//        FROM registrso_camp rc
//        JOIN camp_sensado cs ON rc.id_camp_sensado=cs.id
//        JOIN camp_tanque ct ON ct.id_camp_sensado=cs.id 
//        JOIN cepa ON ct.id_cepa=cepa.id 
//        JOIN tanque t ON rc.id_tanque=t.id
//        WHERE rc.id_tanque='.$id.'
//        AND rc.alerta>0')
//                ->queryAll();
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
    public function actionGetHistorialTanque($estacion, $id)
    {
        $total = Yii::app()->db->createCommand('SELECT r.id as idreg, r.fecha, r.hora, temp,ph,ox,cond,orp,t.id AS idtan, t.capacidad,t.nombre,t.activo,est.id as idest,est.tipo,est.identificador,est.no_personal,est.marca,est.color,est.ubicacion,est.disponible,est.activo FROM registro_camp r
        JOIN tanque t ON r.id_tanque = t.id
        JOIN estacion est ON est.id=t.id_estacion
        WHERE t.id='.$id.'
        AND est.id='.$estacion.' ORDER BY r.id ASC')
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
            ->select('r.id as idreg, r.fecha, r.hora, temp,ph,ox,cond,orp,t.id AS idtan, t.capacidad,t.nombre,t.activo,est.id as idest,est.tipo,est.identificador,est.no_personal,est.marca,est.color,est.ubicacion,est.disponible,est.activo')
            ->from('registro_camp r')
            ->join('tanque t','r.id_tanque = t.id')
            ->join('estacion est','est.id=t.id_estacion')
            ->where("t.id = $id")
            ->andWhere("est.id = $estacion")
            ->limit(300,$rangos[0][0])
            ->order('r.id ASC')
            ->queryAll();
//        $datos = Yii::app()->db->createCommand('SELECT r.id as idreg, r.fecha, r.hora, temp,ph,ox,cond,orp,t.id AS idtan, t.capacidad,t.nombre,t.activo,est.id as idest,est.tipo,est.identificador,est.no_personal,est.marca,est.color,est.ubicacion,est.disponible,est.activo FROM registro_camp r
//        JOIN tanque t ON r.id_tanque = t.id
//        JOIN estacion est ON est.id=t.id_estacion
//        WHERE t.id='.$id.'
//        AND est.id='.$estacion)
//            ->queryAll();
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
                        <div class="enlaceC selected" data-para="1">Oxígeno disuelto</div>
                        <div class="enlaceC" data-para="2">Temperatura</div>
                        <div class="enlaceC" data-para="3">PH</div>
                        <div class="enlaceC" data-para="4">Conductividad</div>
                        <div class="enlaceC" data-para="5">ORP</div>
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
    public function actionGetGraficaTanqueRango($estacion, $id, $rango)
    {
        $datos = Yii::app()->db->createCommand()
            ->select('r.id as idreg, r.fecha, r.hora, temp,ph,ox,cond,orp,t.id AS idtan, t.capacidad,t.nombre,t.activo,est.id as idest,est.tipo,est.identificador,est.no_personal,est.marca,est.color,est.ubicacion,est.disponible,est.activo')
            ->from('registro_camp r')
            ->join('tanque t','r.id_tanque = t.id')
            ->join('estacion est','est.id=t.id_estacion')
            ->where("t.id = $id")
            ->andWhere("est.id = $estacion")
            ->limit(300,$rango)
            ->order('r.id ASC')
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
    public function actionGetHistorialParametro($estacion, $id)
    {// Total de tanques
        $total = Yii::app()->db->createCommand('SELECT r.hora, r.'.$id.', r.id_tanque, r.id               
            FROM registro_camp r
            WHERE r.id_estacion='.$estacion.'
            ORDER BY r.id ASC')
            ->queryAll();
        //Tanques
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
        $tanques = Yii::app()->db->createCommand('SELECT * FROM tanque t
        JOIN registro_camp r ON t.id=r.id_tanque
        WHERE t.id_estacion='.$estacion.'
        GROUP BY t.id')
            ->queryAll();
        $datos = Yii::app()->db->createCommand()
            ->select('r.hora, r.'.$id.', r.id_tanque, r.id')
            ->from('registro_camp r')
            ->where("r.id_estacion = $estacion")
            ->limit(300,$rangos[0][0])
            ->order('r.id ASC')
            ->queryAll();
//        $datos = Yii::app()->db->createCommand('SELECT r.hora, r.'.$id.', r.id_tanque, r.id               
//            FROM registro_camp r
//            WHERE r.id_estacion='.$estacion.'
//            ORDER BY r.id ASC')
//            ->queryAll();
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
        $i = 0;
        $menuTanques = '';
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
    public function actionGetGraficaParametroRango($estacion, $id, $rango)
    {
        $tanques = Yii::app()->db->createCommand('SELECT * FROM tanque t
        JOIN registro_camp r ON t.id=r.id_tanque
        WHERE t.id_estacion='.$estacion.'
        GROUP BY t.id')
            ->queryAll();
        $datos = Yii::app()->db->createCommand()
            ->select('r.hora, r.'.$id.', r.id_tanque, r.id')
            ->from('registro_camp r')
            ->where("r.id_estacion = $estacion")
            ->limit(300,$rango)
            ->order('r.id ASC')
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
    public function actionGetParametroGrafica($estacion, $flag)
    {
        $tanques = Yii::app()->db->createCommand('  SELECT * FROM '.chr(40).'SELECT estacion.id AS idEst,tanque.id AS idTan,r.id AS idr,identificador,no_personal,marca,color,ubicacion,capacidad,nombre,ox,ph,temp,cond,orp
            FROM estacion
            JOIN tanque ON estacion.id=tanque.id_estacion
            JOIN registro_camp r ON tanque.id=r.id_tanque
            WHERE estacion.id='.$estacion.'
            ORDER BY idTan,idr DESC
              LIMIT 1000'.chr(41).' consulta
            GROUP BY idTan')
            ->queryAll();

        foreach($tanques as $data)
            $nombre[] = $data['nombre'];
        $colors = ['#9EE7DD', '#FE713D', '#0079AB', '#5F7D8A', '#9EE7DD', '#FE713D', '#0079AB', '#5F7D8A'];
        switch ($flag)
        {
            case 1: 
                foreach($tanques as $data)
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
                foreach($tanques as $data)
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
                foreach($tanques as $data)
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
                foreach($tanques as $data)
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
                foreach($tanques as $data)
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
    
}