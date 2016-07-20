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
        $tanques = Yii::app()->db->createCommand()
                ->select('estacion.id AS idEst,tanque.id AS idTan,uploadTemp.id AS idUpl,identificador,no_personal,marca,color,ubicacion,capacidad,nombre,ct,ox,ph,temp,cond,orp,alerta')
                ->from('estacion')
                ->join('tanque','estacion.id=tanque.id_estacion')
                ->join('uploadTemp','tanque.id=uploadTemp.id_tanque')
                ->where("estacion.id=$id")
                ->queryAll();
        $estaciones = Yii::app()->db->createCommand()
                ->select('id,identificador')
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
           /* if($flag2)
            {
                $d = 0;
               // $recorrido = EscalonViajeUbicacion::model()->findAll("id_viaje = $viaje");
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
            }*/
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