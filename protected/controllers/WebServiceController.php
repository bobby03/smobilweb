<?php

class WebServiceController extends CController
{
	/*	Actions(WebServices)
	 *	driver ( get driver user name and return status)
	 *	getDataDriver ( get the Travel data to device )
	 *	receiveData ( receive data from device to update tables on server )
	 * 	
	*/
	public function actionIndex()
	{
		/*
		*	definie variables for webService android app.
		*	Post variables
		*	Control variables:	Accion (ax), ApiKey (apiKey), 
		*	Sensor variables:	Oxigen (Ox), PH (Ph), Temp (T2),
		*	Position:			Lat (lt), Long (ln), Time (tm),
		*	
		*/

		$ax = isset($_GET['ax'] )?$_GET['ax']:'0';
		$apiKey = isset($_GET['apiKey'] )?$_GET['apiKey']:'0';
		
		$data = array(
				'ax'=>$ax,
				'apiKey'=>$apiKey,
			);

		$this->render('index', array('data'=>$data) );
	}

    public function actionDriver(){
    	$driver = isset($_GET['driver'])?$_GET['driver']:"0";
    	//query
        $ax = null;
        $ac = Yii::app()->db->createCommand()
            ->select('id_usr, tipo_usr, usuario, pwd')
            ->from('usuarios')
            ->where('usuario = :usr',array(':usr'=>$driver) )
            ->queryRow();
        if(!isset($ac)){
            $ax = array('Name'=>'NOVALID','Status'=>'X','SCode'=>'4BD','code'=>400);
        }else{
            $fName = "Empresa";
            if($ac['tipo_usr']==2){

                $tmp = Yii::app()->db->createCommand()
                    ->select('nombre, apellido')
                    ->from('personal')
                    ->where('id = :id',array(':id'=>$ac['id_usr']))
                    ->queryRow();
                    // var_dump($tmp);
                    $fName = $tmp['nombre']." ".$tmp['apellido'];
                }
            

            $ax = array('Name'=>$ac['usuario'],
                'fullName'=>$fName,
                'tUser'=>$ac['tipo_usr'],
                'iUser'=>$ac['id_usr'],
                /* 'apiKey'=>sha1('md5',$ac['usuario'].$ac['tipo_usr'].$ac['id_usr']) */
                'Status'=>'OK',
                'sCode'=>'ACP',
                'code'=>200);
        }

    		// $ax = array('Name'=>'Rodolfo','Status'=>'OK','SCode'=>'200','code'=>200);
    		
    	echo json_encode($ax);

    }
    public function actionGetViaje(){
        $idResp = isset($_GET['idResp'])?$_GET['idResp']:0;
        $idViaje = isset($_GET['Viaje'])?$_GET['Viaje']:0;
        $ac = array(); $result = null;
        $temp = null;
        $sol = null;
        //----------- Query for Solicitudes.
        $sol = Yii::app()->db->createCommand()
            ->select('sv.id_personal,sv.id_solicitud,s.id, s.id_clientes, s.codigo, s.fecha_alta, s.fecha_estimada, s.fecha_entrega, s.notas')
            ->from('solicitudes s')
            ->join('solicitudes_viaje sv','sv.id_solicitud = s.id')
            ->where('sv.id_viaje = :id',array(':id' =>$idViaje ))
            ->queryAll();
        // echo json_encode($sol);
        $tIDSol = 0;
        $Codigo = 0;
        $fAlta = null;
        $fEntrega = null;
        $notas = null;
        $idEstanque = null;
        $marca = null;
        $lenght =  count($sol);
        if($sol != null){
            // echo $lenght;
        foreach($sol as $key => $value){
            $idSol = $value['id_solicitud'];
            // $Codigo =$value['codigo'];
            // echo $Codigo."<br>";
            $resp = Yii::app()->db->createCommand()
                ->select ("p.id, p.nombre, p.apellido, p.rfc, p.correo, v.id_responsable")
                ->from ("personal p")
                ->join('viajes v','v.id = '.$idViaje )
                ->where("p.id = v.id_responsable")
                ->queryRow();

            $per = Yii::app()->db->createCommand()
                ->select ("p.id, p.nombre, p.apellido, p.rfc, p.correo, p.puesto")
                ->from ("personal p")
                ->where("p.id = :id",array(":id"=>$value['id_personal']) )
                ->queryRow();

            $travel = Yii::app()->db->createCommand()
                ->select('v.status, v.fecha_salida, v.id_estacion, e.identificador, e.marca')
                ->from('viajes v')
                ->join('estacion e','v.id_estacion = e.id')
                ->where('v.id = :id',array(':id'=>$idViaje))
                ->queryRow();
                

            if( $idSol > $tIDSol){  
                if($tIDSol>0){
                    $ac[] = array(
                        'idViaje'=>$idViaje,
                        'codigo'=>$Codigo,
                        'Resp'=>$resp['nombre']." ".$resp['apellido'],
                        'fecha_alta'=>$fAlta,
                        'fecha_entrega'=>$fEntrega,
                        'notas'=>$notas,
                        'Estanque'=>$idEstanque,
                        'Marca'=>$marca,
                        'personal'=>$temp,
                    );
                }
                $tIDSol = $idSol; 
                 $temp = null;
            }
            if($tIDSol == $idSol){ //registro
                $Codigo =$value['codigo'];
                $fAlta =$value['fecha_alta'];
                $fEntrega =$value['fecha_entrega'];
                $notas =$value['notas'];
                $idEstanque = $travel['identificador'];
                $marca = $travel['marca'];
                $temp[] = array('name'=>$per['nombre'],
                        'apellido'=>$per['apellido'],
                        'rfc'=>$per['rfc'],
                        'correo'=>$per['correo'],
                        'puesto'=>$per['puesto'],
                    );

            }//first time
            if($key == $lenght-1){
                $ac[] = array(
                    'idViaje'=>$idViaje,
                    'codigo'=>$Codigo,
                    'Resp'=>$resp['nombre']." ".$resp['apellido'],
                    'fecha_alta'=>$value['fecha_alta'],
                    'fecha_alta'=>$fAlta,
                    'fecha_entrega'=>$fEntrega,
                    'notas'=>$notas,
                    'Estanque'=>$idEstanque,
                    'Marca'=>$marca,
                    'personal'=>$temp);
            }
            
            
        }//end foreach
        $result=array('solicitud'=>$ac);
    }else{
        $result=array('Solicitud'=>'No válida','estado'=>'No Válida','code'=>400);
    }
        echo json_encode($result);
    }

    public function actionSolicitudes(){
        //get idViaje, datos responsable, solicitudes.
        $idResp = isset($_GET['id'])?$_GET['id']:0; // id
        $typeResp = isset($_GET['type'])?$_GET['type']:0; // id
        $userData = null; $udArray = array();
        $viajeData = null; $vdArray = array(); $per=null;
        $rx = null;
        if($typeResp == "2"){
            //--------------------- USER DATA RESP------------------------
            $userData = Yii::app()->db->createCommand()
                ->select('nombre, apellido, rfc, correo, puesto')
                ->from('personal p')
                ->where('id = :id',array(':id'=>$idResp) )
                ->queryRow();

            if($userData != false){
                // UserData
                // var_dump($userData);
                $udArray = array(
                   'Name'=>$userData['nombre']." ".$userData['apellido'] ,
                   'RFC'=>$userData['rfc'],
                   'CORREO'=>$userData['correo'],
                   'PUESTO'=>$userData['puesto'],
                   'Status'=>'GRANTED',
                   'code'=>200,
                   'SCode'=>'OK',
                    );
                //----------------------- /USER DATA  RESP-----------------------
                //----------------------- VIAJE ----------------------------
                $viajeData = Yii::app()->db->createCommand()
                    ->select('v.id, id_solicitudes , status, fecha_salida, v.fecha_entrega, id_estacion , identificador, no_personal, codigo,')
                    ->from('viajes  v')
                    ->join('estacion e','id_estacion = e.id')
                    ->join('solicitudes s','s.id = v.id_solicitudes')
                    ->where('id_responsable = :id',array(':id'=>$idResp))
                    ->queryAll();

                    $vdTemp = array();
                foreach ($viajeData as $VDkey => $VDvalue) {
                    
                     //----------------------- /Personal Agregado----------------------------
                    $per = Yii::app()->db->createCommand()
                        ->select ("p.id, p.nombre, p.apellido, p.rfc, p.correo, p.puesto")
                        ->from ("personal p")
                        ->join('solicitudes_viaje sv','sv.id_personal = p.id')
                        ->where("sv.id_viaje = :id",array(":id"=>$VDvalue['id']) )
                        ->queryAll();
                        foreach($per as $perKey =>$perValue){
                            $perTemp[] = array(
                                'nombre'=>$perValue['nombre']." ".$perValue['apellido'],
                                'rfc'=>$perValue['rfc'],
                                'correo'=>$perValue['correo'],
                                'puesto'=>$perValue['puesto']
                                );
                        }
                        $vdTemp[] = array(
                        'VIAJE'=>$VDvalue['id'],
                        'ID'=>$VDvalue['id_solicitudes'],
                        'STATUS'=>$VDvalue['status'],
                        'F_SALIDA'=>$VDvalue['fecha_salida'],
                        'F_EST'=>$VDvalue['fecha_entrega'],
                        'TRANSPORTE'=>$VDvalue['identificador'],
                        'ID_TRANSP'=>$VDvalue['no_personal'],
                        'codigo'=>$VDvalue['codigo'],
                        'PERSONAL'=>$perTemp
                        );
                //----------------------- /Peronal Agregado----------------------------

                }
                //----------------------- /VIAJE----------------------------
               
                //----------------------- CONSTRUCCIÓN JSON----------------------------
                $rx = array(
                   'RESPONSABLE'=>$userData['nombre']." ".$userData['apellido'] ,
                   'RFC'=>$userData['rfc'],
                   'CORREO'=>$userData['correo'],
                   'PUESTO'=>$userData['puesto'],
                   'STATUS'=>'GRANTED',
                   'CODE'=>200,
                   'SCODE'=>'OK',
                   'SOLICITUDES'=>$vdTemp,
                );
                $udArray = array(
                   'RESPONSABLE'=>$userData['nombre']." ".$userData['apellido'] ,
                   'RFC'=>$userData['rfc'],
                   'CORREO'=>$userData['correo'],
                   'PUESTO'=>$userData['puesto'],
                   'Status'=>'GRANTED',
                   'code'=>200,
                   'SCode'=>'OK',
                   'Solicitudes'=>$vdTemp,
                    );
                $vdArray = array('Resp'=>$vdTemp);
                $rx = $udArray;
            }else{
                $rx = array('Name'=>'USER NO VALID','Status'=>'4BD','SCode'=>"-1",'ak'=>"-1");
            }
            
            
        }else{
            $rx = array('Name'=>'USER NO VALID','Status'=>'4BD','SCode'=>"-1",'ak'=>"-1");
        }
        
        // echo json_encode($rx);
        echo json_encode($rx);
    }

    public function actionGetDataDriver(){
    	// $ax = isset($_GET['ax'] )?$_GET['ax']:'0';
        $ac = null;
        $ax = array();
        $sl = array();
        $idResp = isset($_GET['id'])?$_GET['id']:0; // id
        // $idViaje = isset($_GET['Viaje'])?$_GET['Viaje']:0; // viaje
        $name_usr = isset($_GET['driver'])?$_GET['driver']:"0";
    	//$id_usr = isset($_GET['id'])?$_GET['id']:"0";
    	//$type_usr = isset($_GET['type'])?$_GET['type']:"0";
    	//query

    	$ac = Yii::app()->db->createCommand()
            ->select('s.id as id, s.codigo, s.fecha_alta, s.hora_alta, s.fecha_estimada, s.hora_estimada, s.notas, v.fecha_salida, v.hora_salida, v.status, v.hora_entrega, v.fecha_entrega, v.id as idViaje')
            ->from('viajes v')
            ->join('solicitudes s', 'v.id_solicitudes = s.id')
            ->where('v.id_responsable = :id',array(':id'=>$idResp)  )
            ->queryAll();


        if($ac != null ){
            foreach ($ac as $key => $value) {
                /* //---------

                $ac1 = array(); 
                        $result = null;
                        $temp = null;
                        $sol = null;
                        //----------- Query for Solicitudes.
                        $sol = Yii::app()->db->createCommand()
                            ->select('sv.id_personal,sv.id_solicitud,s.id, s.id_clientes, s.codigo, s.fecha_alta, s.fecha_estimada, s.fecha_entrega, s.notas')
                            ->from('solicitudes s')
                            ->join('solicitudes_viaje sv','sv.id_solicitud = s.id')
                            ->where('sv.id_viaje = :id',array(':id' =>$value['idViaje'] ))
                            ->queryAll();
                        // echo json_encode($sol);
                        $tIDSol = 0;
                        $Codigo = 0;
                        $fAlta = null;
                        $fEntrega = null;
                        $notas = null;
                        $idEstanque = null;
                        $marca = null;
                        $lenght =  count($sol);
                        if($sol != null){
                            // echo $lenght;
                        foreach($sol as $key1 => $value1){
                            $idSol = $value1['id_solicitud'];
                            // $Codigo =$value['codigo'];
                            // echo $Codigo."<br>";
                            $resp = Yii::app()->db->createCommand()
                                ->select ("p.id, p.nombre, p.apellido, p.rfc, p.correo, v.id_responsable")
                                ->from ("personal p")
                                ->join('viajes v','v.id = '.$value['idViaje'] )
                                ->where("p.id = v.id_responsable")
                                ->queryRow();

                            $per = Yii::app()->db->createCommand()
                                ->select ("p.id, p.nombre, p.apellido, p.rfc, p.correo, p.puesto")
                                ->from ("personal p")
                                ->where("p.id = :id",array(":id"=>$value1['id_personal']) )
                                ->queryRow();

                            $travel = Yii::app()->db->createCommand()
                                ->select('v.status, v.fecha_salida, v.id_estacion, e.identificador, e.marca')
                                ->from('viajes v')
                                ->join('estacion e','v.id_estacion = e.id')
                                ->where('v.id = :id',array(':id'=>$value['idViaje']))
                                ->queryRow();
                                

                            if( $idSol > $tIDSol){  
                                if($tIDSol>0){
                                    $ac1[] = array(
                                        'codigo'=>$Codigo,
                                        'Resp'=>$resp['nombre']." ".$resp['apellido'],
                                        'fecha_alta'=>$fAlta,
                                        'fecha_entrega'=>$fEntrega,
                                        'notas'=>$notas,
                                        'Estanque'=>$idEstanque,
                                        'Marca'=>$marca,
                                        'personal'=>$temp,
                                    );
                                }
                                $tIDSol = $idSol; 
                                 $temp = null;
                            }
                            if($tIDSol == $idSol){ //registro
                                $Codigo =$value1['codigo'];
                                $fAlta =$value1['fecha_alta'];
                                $fEntrega =$value1['fecha_entrega'];
                                $notas =$value1['notas'];
                                $idEstanque = $travel['identificador'];
                                $marca = $travel['marca'];
                                $temp[] = array('name'=>$per['nombre'],
                                        'apellido'=>$per['apellido'],
                                        'rfc'=>$per['rfc'],
                                        'correo'=>$per['correo'],
                                        'puesto'=>$per['puesto'],
                                    );

                            }//first time
                            if($key1 == $lenght-1){
                                $ac1[] = array(
                                    'codigo'=>$Codigo,
                                    'Resp'=>$resp['nombre']." ".$resp['apellido'],
                                    'fecha_alta'=>$value['fecha_alta'],
                                    'fecha_alta'=>$fAlta,
                                    'fecha_entrega'=>$fEntrega,
                                    'notas'=>$notas,
                                    'Estanque'=>$idEstanque,
                                    'Marca'=>$marca,
                                    'personal'=>$temp);
                            }
                            
                            
                        }//end foreach
                        $result=array('solicitud'=>$ac1);
                    }else{
                        $result=array('Solicitud'=>'No v&aacute;lida','estado'=>'No V&aacute;lida','code'=>400);
                    }
                //----------- */
                $ax[$key] = array('id'=>$value['id'],
                    'idViaje'=>$value['idViaje'],
                    'codigo'=>$value['codigo'],
                    /*
                    'fAlta'=>$value['fecha_alta'],
                    'hAlta'=>$value['hora_alta'],
                    'fEstimada'=>$value['fecha_estimada'],
                    'hEstimada'=>$value['hora_estimada'],
                    */
                    'Estado'=>$value['status'],
                    'Fecha_Salida'=>$value['fecha_salida'],
                    'Hora_Salida'=>$value['hora_salida'],
                    /*
                    'FViajeEntrega'=>$value['fecha_entrega'],
                    'HViajeEntrega'=>$value['hora_entrega'],
                    */
                    'resultado'=>$result,
                );
                
            }
    		$rx = array('Name'=>'TRIP',
                'Status'=>'GRANTED',
                'code'=>200,
                'SCode'=>'OK',
                // 'ak'=>$apiKey, 
                'campaigns'=>$ax,
            );
        }
    	else
    		$rx = array('Name'=>'NO TRIP','Status'=>'4BD','SCode'=>"-1",'ak'=>"-1");

    	echo json_encode($rx);

    }

    public function actionReceiveData(){
    	$dt=isset($_GET['dt'])?$_GET['dt']:"0";
    	//query
    	$sql = "insert into table (data) values (dt) ".$dt;
    	echo $sql;
    }
    
}