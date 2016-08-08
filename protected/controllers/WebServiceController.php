<?php

class WebServiceController extends Controller
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
    public function actionUpload(){
        //upload?lat=31.8710559&lng=-116.6669508&id_viaje=30&idTank=28&CT=1&OX=n%2Fa&PH=4.215&T2=22.50&EC=n%2Fa&OD=115.01
        $Campaing = array();
        $campaingTemp = array();
        //Sense campaing data
        $lat        = isset($_GET['lat'])?$_GET['lat']:"0";
        $lng        = isset($_GET['lng'])?$_GET['lng']:"0";
        $type       = isset($_GET['type'])?$_GET['type']:null;
        $resp       = isset($_GET['resp'])?$_GET['resp']:null;
        $est       = isset($_GET['EST'])?$_GET['EST']:null;
        //Campaing data---------------------------------------------------------
        $LatLng = "(".$lat.",".$lng.")";  // ( Lat,-Lng )
        $codeViaje  = isset($_GET['id_viaje'])?$_GET['id_viaje']:"0"; // id Viaje
        //Sense tank data---------------------------------------------------------
        $codeIdTank  = isset($_GET['idTank'])?$_GET['idTank']:"0"; // id Tanque
        $ct = isset($_GET['CT'])?$_GET['CT']:"0";
        $codeCT = isset($_GET['CodeCT'])?$_GET['CodeCT']:"0";
        $ox = isset($_GET['OX'])?$_GET['OX']:"0";
        $ph = isset($_GET['PH'])?$_GET['PH']:"0";
        $t2 = isset($_GET['T2'])?$_GET['T2']:"0";
        $ec = isset($_GET['EC'])?$_GET['EC']:"0";
        $od = isset($_GET['OD'])?$_GET['OD']:"0";
        $od = isset($_GET['ORP'])?$_GET['ORP']:"0";
        $wl = isset($_GET['WL'])?$_GET['WL']:"0";
        $time = date('H:m:s');
        $date = date('Y-m-d');
        switch ($type) {
            case 1:
            $table = 'id_escalon_viaje_ubicacion';
                $columns = array('ubicacion'=>$LatLng, 'id_viaje'=>$codeViaje, 'fecha'=>$date, 'hora'=>$time);
                $conditions = "id_viaje = :idViaje";
                $params = array(":idViaje"=>$codeViaje);
                // var_dump($table);
                // var_dump($columns);
                $sqlViaje = Yii::app()->db->createCommand()->insert($table,$columns);
                if($sqlViaje){
                    $lastInsert = Yii::app()->db->getLastInsertID();
                    $campaingTemp[] = array('Viaje'=> "OK", 'code'=>200);
                    $sql = Yii::app()->db->createCommand()
                        ->insert('uploadTemp',array(
                            'ct'=>$ct,
                            'id_tanque'=>$codeIdTank,
                            'id_escalon_viaje_ubicacion'=>$lastInsert,
                            'alerta'=>$wl,
                            'ox'=>$ox,
                            'ph'=>$ph,
                            't2'=>$t2,
                            'ec'=>$ec,
                            'orp'=>$od)
                        );
                    if($sql){
                        $Campaing[] = array("Ubicacion"=>$campaingTemp,"Code"=>200,'SCode'=>"OK","Validation"=>$sql);
                    }else{
                        $Campaing[] = $campaingTemp;
                    }
                }else{
                    $campaingTemp[] = array('Viaje'=> "4BD", 'code'=>400, 'TTL'=>$sqlViaje);
                }
                break;
                //***********************************************************************************************
            case 2:
            $table = 'camp_sensado';
                $columns = array('id_responsable'=>$resp, 'id_viaje'=>$codeViaje, 'id_estacion'=>$est, 'fecha_inicio'=>$date, 'hora_inicio'=>$time);
                $conditions = "id_viaje = :idViaje";
                $params = array(":idViaje"=>$codeViaje);
               
                $sqlViaje = Yii::app()->db->createCommand()->insert($table,$columns);
            
                $lastInsert = Yii::app()->db->getLastInsertID();
                $campaingTemp[] = array('Viaje'=> "OK", 'code'=>200);
                $sql = Yii::app()->db->createCommand()
                    ->insert('registro_camp',array(
                        'ct'=>$ct,
                        'id_tanque'=>$codeIdTank,
                        'id_estacion'=>$est,
                        'id_camp_sensado'=>$lastInsert,
                        'alerta'=>$wl,
                        'hora'=>$time,
                        'ox'=>$ox,
                        'ph'=>$ph,
                        'temp'=>$t2,
                        'cond'=>$ec,
                        'orp'=>$od)
                    );
                if($sql){
                    $Campaing[] = array("Ubicacion"=>$campaingTemp,"Code"=>200,'SCode'=>"OK","Validation"=>$sql);
                }else{
                    $Campaing[] = $campaingTemp;
                }

                break;
        }
       
        echo json_encode($Campaing);
    }
    public function actionDriver(){
    	$driver = isset($_GET['driver'])?$_GET['driver']:null;
        $pass = isset($_GET['pass'])?$_GET['pass']:null;
    	//query
        $ax = null;
        // echo $driver;
        if(isset($driver) && isset($pass)){
            $ac = Yii::app()->db->createCommand()
                ->select('id_usr, tipo_usr, usuario, pwd')
                ->from('usuarios')
                ->where('usuario = :usr',array(':usr'=>$driver) )
                ->andWhere('tipo_usr = 2')
                ->queryRow();
                // var_dump($ac);
            if(!$ac){
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
        }else{
            $ax = array('Name'=>'NOVALID','Status'=>'X','SCode'=>'4BD','code'=>400);
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
        $PlataformasViaje = null; $vdArray = array(); $per=null; $tipoEstacion = array('1'=>"Camion",'2'=>"Igl&uacute;");
        $clienteTemp = null; $sols = null; $solTemp = null; $tanksTemp = null; $tanks= null;
        $rx = null;
        if($typeResp == "2"){
            //--------------------- USER DATA RESP------------------------
            $userData = Yii::app()->db->createCommand()
                ->select('nombre, apellido, rfc, correo, puesto')
                ->from('personal p')
                ->where('id = :id',array(':id'=>$idResp) )
                ->queryRow();
            if($userData != false){
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
                //----------------------- Plataforma Viaje ----------------------------
            $PlataformasViaje = Yii::app()->db->createCommand()
                ->select('v.id, id_solicitudes , id_clientes, status, fecha_salida, v.fecha_entrega,   codigo, e.tipo, e.identificador, e.no_personal, e.marca, e.color, e.disponible, E.ID AS ID_EST')
                ->from('viajes  v')
                ->join('estacion e','id_estacion = e.id')
                ->join('solicitudes s','s.id = v.id_solicitudes')
                ->where('id_responsable = :id',array(':id'=>$idResp))
                ->order('id desc')
                ->queryAll();
            $vdTemp = array();
            foreach ($PlataformasViaje as $VDkey => $VDvalue) {
                //------------ SOLICITUDES--------------------------------------------
                $sols = Yii::app()->db->createCommand()
                    ->selectDistinct('s.id, id_clientes, codigo, fecha_alta, fecha_estimada, notas')
                    ->from('solicitudes s')
                    ->join('solicitudes_viaje sv','sv.id_solicitud = s.id')
                    ->where('sv.id_viaje = :id',array(':id'=>$VDvalue['id']))
                    ->queryAll();
                $solTemp = null;
                // foreach ($sols as $solsKey => $solsValue) { //
                    // Solicitud_tanques
                    $tanks = Yii::app()->db->createCommand()
                    // tanque, Domicilio, cepa
                        ->selectDistinct('d.id_cliente, sv.id_viaje, t.id, st.id_tanque,t.nombre, t.capacidad, t.id_estacion, d.domicilio, d.ubicacion_mapa, d.descripcion, c.nombre_cepa, c.temp_min, c.temp_max, c.ph_min, c.ph_max, c.ox_min, c.ox_max, c.cond_min, c.cond_max, c.orp_min, c.orp_max, cantidad_cepas, e.nombre as nombre_producto')
                        ->from('solicitud_tanques st')
                        ->join('tanque t','st.id_tanque = t.id')
                        ->join('clientes_domicilio d', 'st.id_domicilio = d.id')
                        ->join('cepa c', 'st.id_cepas = c.id')
                        ->join('solicitudes_viaje sv','sv.id_solicitud = st.id_solicitud')
                        ->join('especie e','e.id = c.id_especie')
                        ->where('st.id_solicitud =:idS',array(':idS'=>$VDvalue['id_solicitudes']))
                        ->queryAll();
                    ;
                    //-----End Solicitud_tanques
                    $solTemp[] = array(
                        'codigo'=>$sols[$VDkey]['codigo'],
                        'fecha_alta'=>$sols[$VDkey]['fecha_alta'],
                        'fecha_estimada'=>$sols[$VDkey]['fecha_estimada'],
                        'notas'=>$sols[$VDkey]['notas'],
                        'tanques'=>$tanks,
                        );
                    # code...
                    // $solTemp[] = array(
                    //     'codigo'=>$solsValue['codigo'],
                    //     'fecha_alta'=>$solsValue['fecha_alta'],
                    //     'fecha_estimada'=>$solsValue['fecha_estimada'],
                    //     'notas'=>$solsValue['notas'],
                    //     'tanques'=>$tanks,
                    //     );
                // } //
                //------------------------------Clientes--------------------------------
                $clnt = Yii::app()->db->createCommand()
                    ->selectDistinct('id, nombre_empresa,  nombre_contacto, apellido_contacto, correo, rfc, tel')
                    ->from('clientes c')
                    ->where('c.id = :idC',array(':idC'=>$VDvalue['id_clientes']))
                    ->queryAll();
                $clienteTemp = null;
                foreach ($clnt as $clntKey => $clntValue) {
                    # code...
                    $clienteTemp[] = array(
                        'ID'=>$clntValue['id'],
                        'EMPRESA'=>$clntValue['nombre_empresa'],
                        'CONTACTO'=>$clntValue['nombre_contacto']."  ".$clntValue['apellido_contacto'],
                        'CORREO'=>$clntValue['correo'],
                        'RFC'=>$clntValue['rfc'],
                        'TEL'=>$clntValue['tel'],
                        );
                }
                //------------------------------/Clientes--------------------------------
                 //----------------------- /Personal Agregado----------------------------
                $per = Yii::app()->db->createCommand()
                    ->select ("p.id, p.nombre, p.apellido, p.rfc, p.correo, p.puesto")
                    ->from ("personal p")
                    ->join('solicitudes_viaje sv','sv.id_personal = p.id')
                    ->where("sv.id_viaje = :id",array(":id"=>$VDvalue['id']) )
                    ->queryAll();
                    $perTemp = null;
                if($per){
                foreach($per as $perKey =>$perValue){
                    $perTemp[] = array(
                        'nombre'=>$perValue['nombre']." ".$perValue['apellido'],
                        'rfc'=>$perValue['rfc'],
                        'correo'=>$perValue['correo'],
                        'puesto'=>$perValue['puesto']
                        );    
                }
                
                }//----------------------- /Peronal Agregado----------------------------
                    
    
                $vdTemp[] = array(
                'CAMPAIGN'=>$VDvalue['id'],
                'IDTypeContainer'=>$VDvalue['tipo'],
                'Container'=>$tipoEstacion[$VDvalue['tipo']],
                'ID'=>$VDvalue['id_solicitudes'],
                'ID_RESP'=>$idResp,
                'STATUS'=>$VDvalue['status'],
                'F_SALIDA'=>$VDvalue['fecha_salida'],
                'F_EST'=>$VDvalue['fecha_entrega'],
                'TRANSPORTE'=>$VDvalue['identificador'],
                'ID_TRANSP'=>$VDvalue['ID_EST'],
                'codigo'=>$VDvalue['codigo'],
                /* ------------- */
                'CLIENTE'=>$clienteTemp,
                'PERSONAL'=>$perTemp,
                'SOLICITUDES'=>$solTemp,
                );
            } //----------------------- /PlataformasViaje----------------------------
               
                //----------------------- CONSTRUCCIÓN JSON----------------------------
                $rx = array(
                   'RESPONSABLE'=>$userData['nombre']." ".$userData['apellido'] ,
                   'IDRESP'=>$idResp,
                   'RFC'=>$userData['rfc'],
                   'CORREO'=>$userData['correo'],
                   'PUESTO'=>$userData['puesto'],
                   'STATUS'=>'GRANTED',
                   'CODE'=>200,
                   'SCODE'=>'OK',
                   'VIAJES'=>$vdTemp,
                );
                $udArray = array(
                   'RESPONSABLE'=>$userData['nombre']." ".$userData['apellido'] ,
                   'IDRESP'=>$idResp,
                   'RFC'=>$userData['rfc'],
                   'CORREO'=>$userData['correo'],
                   'PUESTO'=>$userData['puesto'],
                   'Status'=>'GRANTED',
                   'code'=>200,
                   'SCode'=>'OK',
                   'Plataformas'=>$vdTemp,
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