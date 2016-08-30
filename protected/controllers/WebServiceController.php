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

    public function actionUpdateEstacionEscalon(){
        $lat        = isset($_GET['lat'])?$_GET['lat']:"0";
        $lng        = isset($_GET['lng'])?$_GET['lng']:"0";
        $type       = isset($_GET['type'])?$_GET['type']:null;
        $resp       = isset($_GET['resp'])?$_GET['resp']:null;
        $est       = isset($_GET['EST'])?$_GET['EST']:null;
        //Campaing data---------------------------------------------------------
        $LatLng = "(".$lat.",".$lng.")";  // ( Lat,-Lng )
        $codeViaje  = isset($_GET['id_viaje'])?$_GET['id_viaje']:"0"; // id Viaje
        $time = date('H:i');
        $date = date('Y-m-d');

        switch ($type) {
            case 1:
                $table = 'escalon_viaje_ubicacion';
                $columns = array('ubicacion'=>$LatLng, 'id_viaje'=>$codeViaje, 'fecha'=>$date, 'hora'=>$time);
                $conditions = "id_viaje = :idViaje";
                $params = array(":idViaje"=>$codeViaje);
                // var_dump($table);
                // var_dump($columns);
                if(Yii::app()->db->createCommand()->insert($table,$columns) )
                    $Campaing = array("lastID"=>Yii::app()->db->getLastInsertID(),"Code"=>200,'SCode'=>"OK");
                else
                    $Campaing = array('code'=>303);
            break;
                //***********************************************************************************************
            case 2:
            $table = 'camp_sensado';
                $columns = array('id_responsable'=>$resp, 'id_viaje'=>$codeViaje, 'id_estacion'=>$est, 'fecha_inicio'=>$date, 'hora_inicio'=>$time);
                $conditions = "id_viaje = :idViaje";
                $params = array(":idViaje"=>$codeViaje);
               
                if(Yii::app()->db->createCommand()->insert($table,$columns) )
                    $Campaing[] = array("lastID"=>Yii::app()->db->getLastInsertID(),"Code"=>200,'SCode'=>"OK");
                else
                    $Campaing[] = array('code'=>303);
            break;
        }
        echo json_encode($Campaing);

    }

    public function actionUpload(){
        //upload?lat=31.8710559&lng=-116.6669508&id_viaje=30&idTank=28&CT=1&OX=n%2Fa&PH=4.215&T2=22.50&EC=n%2Fa&OD=115.01
        $Campaing = array();
        $campaingTemp = array();
        //Sense campaing data
        $lat        = isset($_GET['lat'])?$_GET['lat']:"0";
        $lng        = isset($_GET['lng'])?$_GET['lng']:"0";
        $lastID       = isset($_GET['lastID'])?$_GET['lastID']:0;
        $resp       = isset($_GET['resp'])?$_GET['resp']:null;
        $est       = isset($_GET['EST'])?$_GET['EST']:null;
        //Campaing data---------------------------------------------------------
        $LatLng = "(".$lat.",".$lng.")";  // ( Lat,-Lng )
        $codeViaje  = isset($_GET['id_viaje'])?$_GET['id_viaje']:"0"; // id Viaje
        //Sense tank data---------------------------------------------------------
        $codeIdTank  = isset($_GET['idTank'])?$_GET['idTank']:"0"; // id Tanque
        $ct = isset($_GET['CT'])?$_GET['CT']:"0";
        $codeCT = isset($_GET['CodeCT'])?$_GET['CodeCT']:"0";
        $ox = isset($_GET['OX'])?$_GET['OX']:null;
        $ph = isset($_GET['PH'])?$_GET['PH']:null;
        $t2 = isset($_GET['T2'])?$_GET['T2']:null;
        $ec = isset($_GET['EC'])?$_GET['EC']:null;
        $orp = isset($_GET['ORP'])?$_GET['ORP']:null;
        $wl = isset($_GET['WL'])?$_GET['WL']:"0";
        $time = date('H:i');
        $date = date('Y-m-d');
        
        $campaingTemp[] = array('Viaje'=> "OK", 'code'=>200);

        $table = 'uploadtemp';
        $columns = array('ct'=>$ct,
                'id_tanque'=>$codeIdTank,
                'id_escalon_viaje_ubicacion'=>$lastID,
                'alerta'=>$wl,
                'ox'=>$ox,
                'ph'=>$ph,
                'temp'=>$t2,
                'cond'=>$ec,
                'orp'=>$orp);

        // var_dump($columns);
        
        $sql = Yii::app()->db->createCommand()
            ->insert('uploadtemp',array(
                'ct'=>$ct,
                'id_tanque'=>$codeIdTank,
                'id_escalon_viaje_ubicacion'=>$lastID,
                'alerta'=>$wl,
                'ox'=>$ox,
                'ph'=>$ph,
                'temp'=>$t2,
                'cond'=>$ec,
                'orp'=>$orp)
            );
        if($sql)
            $Campaing[] = array("Code"=>200,'SCode'=>"OK","Validation"=>$sql);
        else
            $Campaing[] = array('error'=>100);

       
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
                ->andWhere('pwd = :pd',array(':pd'=>$pass))
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

    public function actionViajes(){
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
            // print_r($userData);
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
            $today = date('Y-m-d');
            $PlataformasViaje = Yii::app()->db->createCommand()
                ->select('v.id, id_solicitudes , id_clientes, v.status, fecha_salida, v.fecha_entrega,   codigo, e.tipo, e.identificador, e.no_personal, e.marca, e.color, e.disponible, e.id AS ID_EST')
                ->from('viajes  v')
                ->join('estacion e','id_estacion = e.id')
                ->join('solicitudes s','s.id = v.id_solicitudes')
                ->where('id_responsable = :id',array(':id'=>$idResp))
                ->andWhere('fecha_salida <= :today',array(':today'=>$today) )
                ->andWhere('v.status = 1')
                ->order('id_solicitudes asc')
                ->queryAll();

            $vdTemp = array();
            // print_r($PlataformasViaje);
            foreach ($PlataformasViaje as $VDkey => $VDvalue) {
                //------------ SOLICITUDES--------------------------------------------
                $sols = Yii::app()->db->createCommand()
                    ->selectDistinct('s.id, id_clientes, codigo, fecha_alta, fecha_estimada, notas')
                    ->from('solicitudes s')
                    ->join('solicitudes_viaje sv','sv.id_solicitud = s.id')
                    ->where('sv.id_viaje = :id',array(':id'=>$VDvalue['id']))
                    ->andWhere('sv.id_solicitud = :idS',array(':idS'=>$VDvalue['id_solicitudes']))
                    ->queryAll();
                // print_r($sols);
                
                $solTemp = null;
                foreach ($sols as $Solskey => $Solsvalue) {
                    
                    // print_r($Solsvalue);
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
                        ->where('st.id_solicitud =:idS',array(':idS'=>$Solsvalue['id']))
                        ->andWhere('sv.id_viaje = :idV',array(':idV'=>$VDvalue['id']))
                        ->queryAll();

                    //-----End Solicitud_tanques
                    // to check
                  
                  $solTemp[] = array(
                        'IDSol'=>$VDvalue['id_solicitudes'],
                        'codigo'=>$Solsvalue['codigo'],
                        'fecha_alta'=>$Solsvalue['fecha_alta'],
                        'fecha_estimada'=>$Solsvalue['fecha_estimada'],
                        'notas'=>$Solsvalue['notas'],
                        'tanques'=>$tanks,
                    );

                }
    
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
        
        
        echo json_encode($rx);
    }

    public function actionSiembras(){
        //get idViaje, datos responsable, solicitudes.
        $idResp = isset($_GET['id'])?$_GET['id']:0; // id
        $typeResp = isset($_GET['type'])?$_GET['type']:0; // id
        //--- Variables
        $userData = null; $udArray = array();
        $Siembras = null; $siArray = array(); 
        $per=null; $tipoEstacion = array('1'=>"Camion",'2'=>"Igl&uacute;");
        $clienteTemp = null; $sols = null; $solTemp = null; $tanksTemp = null; $tanks= null;
        $rx = null;
        //--------------------- USER DATA RESP------------------------
        $userData = Yii::app()->db->createCommand()
            ->select('id, nombre, apellido, rfc, correo, puesto')
            ->from('personal p')
            ->where('id = :id',array(':id'=>$idResp) )
            ->queryRow();
    
        if($userData != false){
            
            $today = date('Y-m-d');
            //------------------------- Campañas Sensado -------------------------
            $Siembras = Yii::app()->db->createCommand()
                ->select('id,id_estacion est, id_responsable resp, nombre_camp, fecha_inicio, fecha_fin, status')
                ->from('camp_sensado cs')
                ->where('id_responsable = :idR',array(':idR'=>$idResp))
                ->andWhere('fecha_inicio <=:today',array(':today'=>$today))
                ->andWhere('cs.status = 1')
                ->queryAll();
            //--------------END CAMPAñAS SENSADO-----------------------
            if(count($Siembras)>0){
                //------------ Estaciones ---------------------

                foreach ($Siembras as $keySiembras => $valueSiembras) {
                    # code...
                    $est = Yii::app()->db->createCommand()
                        ->select('e.id_granja, e.identificador,  e.no_personal, e.marca, e.ubicacion, g.nombre, g.direccion, g.responsable')
                        ->from('estacion e')
                        ->join('granjas g','e.id_granja = g.id')
                        ->where('e.id = :idE',array(':idE'=>$valueSiembras['est']))
                        ->andWhere('e.disponible = 1')
                        ->andWhere('e.activo = 1')
                        ->queryAll();

                    //---------------- Cepa ---------------------
                    $cepa = Yii::app()->db->createCommand()
                        ->select('ct.id_tanque,t.nombre,c.*')
                        ->from('camp_tanque ct')
                        ->join('cepa c','ct.id_cepa = c.id')
                        ->join('tanque t','t.id = ct.id_tanque')
                        ->where('ct.id_camp_sensado = :idCS',array(':idCS'=>$valueSiembras['id']))
                        ->queryAll();
                    //-------------------- Granja --------------
                    $siTemp[] = array('ID'=>$valueSiembras['id'],
                                    'IDRESP'=>$valueSiembras['resp'],
                                    'EST'=>$valueSiembras['est'],
                                    'NOMBRE'=>$valueSiembras['nombre_camp'],
                                    'FECHA'=>$valueSiembras['fecha_inicio'],
                                    'TERMINO'=>$valueSiembras['fecha_fin'],
                                    'ESTATUS'=>$valueSiembras['status'],
                                    'GRANJA'=>$est,
                                    'CEPA'=>$cepa,);
                    //-------------------- Granja --------------

                    
                    $siArray =  $siTemp;
                }

            }else{
                $siArray = 0; //('Name'=>'USER NO VALID','Status'=>'4BD','SCode'=>"-1",'ak'=>"-1");
            }
            

            //----- Construccion JSON 
            $udArray = array(
               'ID'=>$userData['id'],
               'Name'=>$userData['nombre']." ".$userData['apellido'] ,
               'RFC'=>$userData['rfc'],
               'CORREO'=>$userData['correo'],
               'PUESTO'=>$userData['puesto'],
               'Status'=>'GRANTED',
               'code'=>200,
               'SCode'=>'OK',
               'SIEMBRAS'=>$siArray,
                );

            //----- Construccion JSON 
            


            
        }else{
            $udArray = array('Name'=>'USER NO VALID','Status'=>'4BD','SCode'=>"-1",'ak'=>"-1");
        }

          
        
        echo json_encode($udArray);
        // echo json_encode($rx);
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
    public function actionUpdatestatus(){
        $idViaje = isset($_GET['id'])?$_GET['id']:0;
        $status = isset($_GET['status'])?$_GET['status']:0;
        $table = 'viajes';
        $column = array('status'=>$status,'fecha_entrega'=>date('Y-m-d'), 'hora_entrega'=>date('H:i:s'));
        $conditions = "id = :idViaje";
        $params = array(":idViaje"=>$idViaje);

        $update = Yii::app()->db->createCommand()->update($table, $column,$conditions, $params );
        $aResult = null;
        if($update > 0){
            $updateSols = Yii::app()->db->createCommand()
                ->selectDistinct('id_solicitud')
                ->from('solicitudes_viaje')
                ->where('id_viaje = :idV',array(':idV'=>$idViaje))
                ->queryAll();
            foreach ($updateSols as $key => $value) {
                # code...
                $table = 'solicitudes';
                $column = array('status'=>$status);
                $conditions = "id = :idS";
                $params = array(":idS"=>$value['id_solicitud']);
                $update = Yii::app()->db->createCommand()->update($table, $column,$conditions, $params );
            }
            $aResult = array('sCode'=>"OK",'updated'=>$update,'code'=>200);

        }
        else
            $aResult = array('sCode'=>"NO",'updated'=>$update,'code'=>300);
        
        echo json_encode($aResult);
    }

    public function actionUpdatesolicitud(){
        $code = isset($_GET['code'])?$_GET['code']:0;
        $table = 'solicitudes';
        $column = array('status'=>"3",'fecha_entrega'=>date('Y-m-d'), 'hora_entrega'=>date('H:i:s'));
        $conditions = "codigo = :code";
        $params = array(":code"=>$code);
        $update = Yii::app()->db->createCommand()->update($table, $column,$conditions, $params );
        if($update > 0)
            $aResult = array('sCode'=>"OK",'updated'=>$update,'code'=>200);
        else
            $aResult = array('sCode'=>"NO",'updated'=>$update,'code'=>300);
        
        echo json_encode($aResult);

    }

    public function actionUpdateEstacion(){
        $code = isset($_GET['id'])?$_GET['id']:0;
        $table = 'viajes';
        $column = 'id_estacion';
        $conditions = "id = :id";
        $params = array(':id'=>$code);
        $idEstacion = Yii::app()->db->createCommand()
            ->select('id_estacion')
            ->from('viajes')
            ->where($conditions,$params)
            ->queryRow();

        $table = 'estacion';
        $column = array('disponible'=>"1");
        $conditions = "id = :code";
        $params = array(":code"=>$idEstacion['id_estacion']);
        $update = Yii::app()->db->createCommand()->update($table, $column,$conditions, $params );
        if($update > 0)
            $aResult = array('sCode'=>"OK",'updated'=>$update,'code'=>200);
        else
            $aResult = array('sCode'=>"NO",'updated'=>$update,'code'=>300);
        
        echo json_encode($aResult);

    }

}