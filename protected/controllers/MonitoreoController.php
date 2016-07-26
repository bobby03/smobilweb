<?php

class MonitoreoController extends Controller
{
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
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}*/

	/*
		$datos = Yii::app()->db->createCommand('SELECT estacion.id AS idEst,tanque.id AS idTan,uploadTemp.id AS idUpl,identificador,no_personal,marca,color,ubicacion,capacidad,nombre,ct,ox,ph,temp,cond,orp,alerta FROM estacion 
													JOIN tanque ON estacion.id=tanque.id_estacion 
													JOIN uploadTemp ON tanque.id=uploadTemp.id_tanque 
													WHERE estacion.id='.$estacion)->queryAll();
	*/
    
	public function actionView($id)
    {
        $tanques = Yii::app()->db->createCommand('SELECT * FROM '.chr(40).'SELECT uploadTemp.id AS idUpl,tanque.id AS idTan,estacion.id AS idEst,identificador,no_personal,marca,color,ubicacion,capacidad,nombre,ct,ox,ph,temp,cond,orp,alerta
        FROM estacion
        JOIN tanque ON estacion.id=tanque.id_estacion
        JOIN uploadTemp ON tanque.id=uploadTemp.id_tanque
        WHERE estacion.id='.$id.'
        ORDER BY tanque.id,uploadTemp.id DESC LIMIT 2000'.chr(41).' consulta
        GROUP BY idtan')
                ->queryAll();
        $estaciones = Yii::app()->db->createCommand()
                ->select('*')
                ->from('estacion')
                ->where("estacion.id=$id")
                ->andWhere("tipo=2")
                ->limit(1)
                ->queryRow();

            $this->render('monitoreo',array(
                'fijas'=>$this->loadModel($estaciones),
                'tanques'=>$tanques
            ));
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
    public function actionGetHistorialTanque($estacion, $id)
        {
            $total = Yii::app()->db->createCommand('SELECT r.id as idreg, r.fecha, r.hora, temp,ph,ox,cond,orp,t.id AS idtan, t.capacidad,t.nombre,t.status,t.activo,est.id as idest,est.tipo,est.identificador,est.no_personal,est.marca,est.color,est.ubicacion,est.disponible,est.activo FROM registro_camp r
            JOIN tanque t ON r.id_tanque = t.id
            JOIN estacion est ON est.id=t.id_estacion
            WHERE t.id='.$id.'
            AND est.id='.$estacion)
                ->queryAll();
            $count = count($total);
            if($count > 333)
                $limit = $count - 333;
            else
                $limit = 0;
            $datos = Yii::app()->db->createCommand('SELECT r.id as idreg, r.fecha, r.hora, temp,ph,ox,cond,orp,t.id AS idtan, t.capacidad,t.nombre,t.status,t.activo,est.id as idest,est.tipo,est.identificador,est.no_personal,est.marca,est.color,est.ubicacion,est.disponible,est.activo FROM registro_camp r
            JOIN tanque t ON r.id_tanque = t.id
            JOIN estacion est ON est.id=t.id_estacion
            WHERE t.id='.$id.'
            AND est.id='.$estacion)
                ->queryAll();
            $return['codigo'] = <<<eof
                <div class="historial">
                    <div class="titulo"></div>
                    <div class="historialGraficasWraper">
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
    

	public function actionGetTanqueGrafica($estacion,$id, $flag, $flag2)
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
            $return['estacion'] = $datos;
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
                                        'max'       => 150,
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
                                        'max'       => 300,
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
                                        'max'       => 14,
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
                                        'max'       => 10,
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
                                       'max'       => 40,
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
                                <span>Origen</span><span>Mínimo</span><span>Máximo</span><span>Acción</span><span>Hora</span><span>Fecha</span>
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
                        $min=$id."_min";
                        $max=$id."_max";
                        $return = $return.<<<eof
                                <div>{$data['nombre']}</div><div>{$data[$min]}</div><div>{$data[$max]}</div><div>{$data[$id]}º<span class="$imagen">X</span></div><div>{$data['hora']}</div><div>{$data['fecha']}</div></div>
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
                        <div class="tituloAlerta2">Parámetro sin alertas</div>
                        <div class="tablaAlertas">
                        </div>
                    </div>';
            }
            echo json_encode($return);
        }

        public function actionGetAlertasTanque($estacion, $id)
        {
            $uploads = Yii::app()->db->createCommand('SELECT rc.id,cs.id as idcs,t.id as idt, cepa.*, t.nombre as nombre, rc.fecha,rc.hora,rc.temp,rc.ph,rc.ox,rc.cond,rc.orp,rc.alerta,rc.ct
            FROM registro_camp rc
            JOIN camp_sensado cs ON rc.id_camp_sensado=cs.id
            JOIN camp_tanque ct ON ct.id_camp_sensado=cs.id 
            JOIN cepa ON ct.id_cepa=cepa.id 
            JOIN tanque t ON rc.id_tanque=t.id
            WHERE rc.id_tanque='.$id.'
            AND rc.alerta>0')
                    ->queryAll();
            if(count($uploads) > 0)
            {
                $return = '
                    <div class="alertas">
                        <div class="tituloAlerta">Alertas: </div>
                        <div class="tablaAlertas">
                            <div class="tablaTitulos">
                                <span>Origen</span><span>Mínimo</span><span>Máximo</span><span>Acción</span><span>Hora</span><span>Fecha</span>
                            </div>
                            <div id="tablaScroll">
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
                                <div>Temperatura</div><div>{$data['temp_min']}º</div><div>{$data['temp_max']}º</div><div>{$data['temp']}º<span class="$imagen">X</span></div><div>{$data['hora']}</div><div>{$data['fecha']}</div></div>
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
                                <div>Oxígeno</div><div>{$data['ox_min']}</div><div>{$data['ox_max']}</div><div>{$data['ox']}<span class="$imagen">X</span></div><div>{$data['hora']}</div><div>{$data['fecha']}</div></div>
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
                                <div>PH</div><div>{$data['ph_min']}</div><div>{$data['ph_max']}</div><div>{$data['ph']}<span class="$imagen">X</span></div><div>{$data['hora']}</div><div>{$data['fecha']}</div></div>
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
                                <div>Conductividad</div><div>{$data['cond_min']}</div><div>{$data['cond_max']}</div><div>{$data['cond']}<span class="$imagen">X</span></div><div>{$data['hora']}</div><div>{$data['fecha']}</div></div>
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
                                <div>Óxido reducción</div><div>{$data['orp_min']}</div><div>{$data['orp_max']}</div><div>{$data['orp']}<span class="$imagen">X</span></div><div>{$data['hora']}</div><div>{$data['fecha']}</div></div>
eof;
                    }
                }
                $return = $return.'</div></div>
                        </div>
                        </div>';
            }
            else
            {
                $return = '
                    <div class="alertas">
                        <div class="tituloAlerta2">Tanque sin alertas</div>
                        </div>
                    </div>';
            }
            echo json_encode($return);
        }
        public function actionGetHistorialParametro($estacion, $id)
        {// Total de tanques
            $total = Yii::app()->db->createCommand('SELECT r.hora, r.'.$id.', r.id_tanque, r.id               
                FROM registro_camp r
                WHERE r.id_estacion='.$estacion.'
                ORDER BY r.id DESC')
                ->queryAll();
            $count = count($total);
            if($count > 333)
                $limit = $count - 333;
            else
                $limit = 0;
            //Tanques
            $tanques = Yii::app()->db->createCommand('SELECT * FROM tanque t
            JOIN registro_camp r ON t.id=r.id_tanque
            WHERE t.id_estacion='.$estacion.'
            GROUP BY t.id')
                ->queryAll();
            $datos = Yii::app()->db->createCommand('SELECT r.hora, r.'.$id.', r.id_tanque, r.id               
                FROM registro_camp r
                WHERE r.id_estacion='.$estacion.'
                ORDER BY r.id ASC')
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
                <div class="menuSeccion enlaceP" data-tanque="-1">Todos</div>
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
                    <div class="menuSeccion enlaceP" data-tanque="$i">{$info['nombre']}</div>
eof;
                $i++;
            }
            $return['total'] = $i;
            $return['codigo'] = <<<eof
                <div class="historial parametro">
                    <div class="titulo">Historial de parámetro</div>
                    <div class="subtitulo tit">$nombre</div>
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