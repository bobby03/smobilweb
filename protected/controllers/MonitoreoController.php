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
        ORDER BY tanque.id,uploadtemp.id DESC LIMIT 2000'.chr(41).' consulta
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
            $total = Yii::app()->db->createCommand('SELECT r.id as idreg, r.fecha, r.hora, temp,ph,ox,cond,orp,t.id AS idtan, t.capacidad,t.nombre,t.status,t.activo,est.id as idest,est.tipo,est.identificador,est.no_personal,est.marca,est.color,est.ubicacion,est.disponible,est.activo FROM registro r
            JOIN tanque t ON r.id_tanque = t.id
            JOIN estacion est ON est.id=t.id_estacion
            WHERE t.id=42
            AND est.id=8')
                ->queryAll();
            $count = count($total);
            if($count > 333)
                $limit = $count - 333;
            else
                $limit = 0;
            $datos = Yii::app()->db->createCommand('SELECT r.id as idreg, r.fecha, r.hora, temp,ph,ox,cond,orp,t.id AS idtan, t.capacidad,t.nombre,t.status,t.activo,est.id as idest,est.tipo,est.identificador,est.no_personal,est.marca,est.color,est.ubicacion,est.disponible,est.activo FROM registro r
            JOIN tanque t ON r.id_tanque = t.id
            JOIN estacion est ON est.id=t.id_estacion
            WHERE t.id=42
            AND est.id=8')
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
            $datos = Yii::app()->db->createCommand()
                ->select('estacion.id AS idEst,tanque.id AS idTan,uploadTemp.id AS idUpl,identificador,no_personal,marca,color,ubicacion,capacidad,nombre,ct,ox,ph,temp,cond,orp,alerta')
                ->from('estacion')
                ->join('tanque','estacion.id=tanque.id_estacion')
                ->join('uploadTemp','tanque.id=uploadTemp.id_tanque')
                ->where("estacion.id=$estacion")
                ->andWhere("tanque.id=$id")
                ->order('idUpl DESC')
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

        public function actionGetParametroGrafica($estacion, $flag)
        {
            $tanques = Yii::app()->db->createCommand()
                ->select('estacion.id AS idEst,tanque.id AS idTan,uploadTemp.id AS idUpl,identificador,no_personal,marca,color,ubicacion,capacidad,nombre,ct,ox,ph,temp,cond,orp,alerta')
                ->from('estacion')
                ->join('tanque','estacion.id=tanque.id_estacion')
                ->join('uploadTemp','tanque.id=uploadTemp.id_tanque')
                ->where("estacion.id=$estacion")
                ->order('idUpl DESC')
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