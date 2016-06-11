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
    	if($driver > 10)
    		$ax = array('Name'=>'Rodolfo','Status'=>'OK','SCode'=>'200');
    	else
    		$ax = array('Name'=>'NOVALID','Status'=>'X','SCode'=>'4BD');
    	echo json_encode($ax);

    }

    public function actionGetDataDriver(){
    	$ax = isset($_GET['ax'] )?$_GET['ax']:'0';
    	$apiKey = isset($_GET['apiKey'])?$_GET['apiKey']:"0";
    	//query
    	$rx = array('Name'=>'TRIP','Status'=>'OK','SCode'=>$ax,'ak'=>$apiKey);
    	echo json_encode($rx);

    }

    public function actionReceiveData(){
    	$dt=isset($_GET['dt'])?$_GET['dt']:"0";
    	//query
    	$sql = "insert into table (data) values (dt) ".$dt;
    	echo $sql;
    }
    
}