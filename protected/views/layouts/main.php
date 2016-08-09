<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="es-MX">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="es-mx" />
    <meta name="language" content="es">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.2.min.js"></script> 
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.1.0.min.js"></script>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <?php 
		$baseUrl = Yii::app()->baseUrl;
		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile($baseUrl.'/css/main.css');
		$cs->registerCssFile($baseUrl.'/css/form.css');
	?>
  </head>

	<?php 
		$LoginClass =  isset($this->classes) ? $this->classes : '' ;
		$patterns = array();
		$patterns[0] = 'index.php';
		$patterns[1] = 'index.php-';
		$replace = array();
		$replace[0] = '';
		$replace[1] = '';

	?>
  <body class="<?php echo str_replace($patterns,$replace,$LoginClass) ?>">
    <div class="container" id="page">
      <?php
		$baseUrl = Yii::app()->baseUrl;
		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile($baseUrl.'/js/inputs.js');
	?>
    
      <div id="mainmenu">
        <div class= "menuTop">
        </div>
        <?php 


		if(!Yii::app()->user->isGuest){


			// Construye el Menu en Base a los Roles Asignados en la sesion.
			$menu = array();
			array_push($menu,array('label'=>'Inicio','url'=>Yii::app()->getBaseUrl(true),'itemOptions'=>array('id' => 'inicio','active'=>$this->id=='/'?true:false)));
			//Movil
			if(Yii::app()->user->checkAccess('readViajes')){array_push($menu,array('label'=>'Viajes', 'url'=>array('/viajes'),'itemOptions'=>array('id' => 'viajes','active'=>$this->id=='viajes'?true:false)));}
			// - Camiones


			//Granjas
			if(Yii::app()->user->checkAccess('readGranjas')){array_push($menu,array('label'=>'Granjas', 'url'=>array('/granjas'),'itemOptions'=>array('id' => 'granjas','active'=>$this->id=='granjas'?true:false)));}
			// - Siembra


			//Administrativo
			if(Yii::app()->user->checkAccess('readSolicitudes')){array_push($menu,array('label'=>'Solicitudes', 'url'=>array('/solicitudes'),'itemOptions'=>array('id' => 'solicitudes','active'=>$this->id=='solicitudes'?true:false)));}
			if(Yii::app()->user->checkAccess('readClientes')){array_push($menu,array('label'=>'Clientes', 'url'=>array('/clientes'),'itemOptions'=>array('id' => 'clientes','active'=>$this->id=='clientes'?true:false)));}
			if(Yii::app()->user->checkAccess('readEspecie')){array_push($menu,array('label'=>'Especies', 'url'=>array('/especie'),'itemOptions'=>array('id' => 'especie','active'=>$this->id=='especie'?true:false)));}
			if(Yii::app()->user->checkAccess('readPersonal')){ array_push($menu,array('label'=>'Empleados', 'url'=>array('/personal'),'itemOptions'=>array('id' => 'personal','active'=>$this->id=='personal'?true:false))); }
			if(Yii::app()->user->checkAccess('readRoles')){array_push($menu,array('label'=>'Roles', 'url'=>array('/roles'),'itemOptions'=>array('id' => 'roles','active'=>$this->id=='roles'?true:false))); }
			if(Yii::app()->user->checkAccess('readUsuarios')){array_push($menu,array('label'=>'Usuarios', 'url'=>array('/usuarios'),'itemOptions'=>array('id' => 'usuarios','active'=>$this->id=='usuarios'?true:false)));}


			if(Yii::app()->user->checkAccess('readEstacion')){array_push($menu,array('label'=>'Estaciones', 'url'=>array('/estacion'),'itemOptions'=>array('id' => 'estacion','active'=>$this->id=='estacion'?true:false)));}		
			if(Yii::app()->user->checkAccess('readMonitoreo')){array_push($menu,array('label'=>'Monitoreo', 'url'=>array('/monitoreo'),'itemOptions'=>array('id' => 'monitoreo','active'=>$this->id=='monitoreo'?true:false)));}
			if(Yii::app()->user->checkAccess('readCampSensado')){array_push($menu,array('label'=>'CampSensado', 'url'=>array('/campSensado'),'itemOptions'=>array('id' => 'campsensado','active'=>$this->id=='campsensado'?true:false)));}
			
			array_push($menu,array('label'=>''.Yii::app()->user->name.'','url'=>array('site/logout'),'itemOptions'=>array('id' => 'login')));



			switch (Yii::app()->user->getTipoUsuario()) {

				case 1: //Menu para Tipo de Usuario Cliente


						$this->widget('zii.widgets.CMenu',array(
							'items'=>array(
									 array('label'=>'Inicio','url'=>Yii::app()->getBaseUrl(true),'itemOptions'=>array('id' => 'inicio','active'=>$this->id=='/'?true:false)),
									 array('label'=>'Viajes', 'url'=>array('/viajes'),'itemOptions'=>array('id' => 'viajes')),
									 array('label'=>''.Yii::app()->user->name.'','url'=>array('site/logout'),'itemOptions'=>array('id' => 'login')),				    
									),));

						break;

				case 2:     //Menu para Tipo de Usuario Personal
							if(Yii::app()->user->name =='smobiladmin'){ //Si el usuario es smobiladmin muestra todas las secciones
								$this->widget('zii.widgets.CMenu',array(
										'items'=>array(
												 array('label'=>'Inicio','url'=>Yii::app()->getBaseUrl(true),'itemOptions'=>array('id' => 'inicio','active'=>$this->id=='/'?true:false)),
												 array('label'=>'Viajes', 'url'=>array('/viajes'),'itemOptions'=>array('id' => 'viajes','active'=>$this->id=='viajes'?true:false)),
												 array('label'=>'Camiones', 'url'=>array('/clientes'),'itemOptions'=>array('id' => 'clientes','active'=>$this->id=='clientes'?true:false)),
												 array('label'=>'Granjas', 'url'=>array('/granjas'),'itemOptions'=>array('id' => 'granjas','active'=>$this->id=='granjas'?true:false)),
												 array('label'=>'Siembras', 'url'=>array('/campsensado'),'itemOptions'=>array('id' => 'campsensado','active'=>$this->id=='campsensado'?true:false)),
												 array('label'=>'Solicitudes', 'url'=>array('/solicitudes'),'itemOptions'=>array('id' => 'solicitudes','active'=>$this->id=='solicitudes'?true:false)),
												 array('label'=>'Clientes', 'url'=>array('/clientes'),'itemOptions'=>array('id' => 'clientes','active'=>$this->id=='clientes'?true:false)),
									 			 array('label'=>'Especies', 'url'=>array('/especie'),'itemOptions'=>array('id' => 'especie','active'=>$this->id=='especie'?true:false)),
												 array('label'=>'Empleados', 'url'=>array('/personal'),'itemOptions'=>array('id' => 'personal','active'=>$this->id=='personal'?true:false)),
												 array('label'=>'Roles', 'url'=>array('/roles'),'itemOptions'=>array('id' => 'roles','active'=>$this->id=='roles'?true:false)),
												 array('label'=>'Usuarios', 'url'=>array('/usuarios'),'itemOptions'=>array('id' => 'usuarios','active'=>$this->id=='usuarios'?true:false)),
												 array('label'=>''.Yii::app()->user->name.'','url'=>array('site/logout'),'itemOptions'=>array('id' => 'login')),
												 ),	));
							}else{	// Muestra secciones de acuerdo a los roles asignados
								$this->widget('zii.widgets.CMenu',array('items'=>$menu));			
							}
						break;	

				default:
						$this->widget('zii.widgets.CMenu',array(
							'items'=>array(
							 array('label'=>'Inicio','url'=>Yii::app()->getBaseUrl(true),'itemOptions'=>array('id' => 'inicio','active'=>$this->id=='/'?true:false)),
							 array('label'=>'Viajes', 'url'=>array('/viajes'),'itemOptions'=>array('id' => 'viajes','active'=>$this->id=='viajes'?true:false)),
							 array('label'=>'Camiones', 'url'=>array('/clientes'),'itemOptions'=>array('id' => 'clientes','active'=>$this->id=='clientes'?true:false)),
							 array('label'=>'Granjas', 'url'=>array('/granjas'),'itemOptions'=>array('id' => 'granjas','active'=>$this->id=='granjas'?true:false)),
							 array('label'=>'Siembras', 'url'=>array('/campsensado'),'itemOptions'=>array('id' => 'campsensado','active'=>$this->id=='campsensado'?true:false)),
							 array('label'=>'Solicitudes', 'url'=>array('/solicitudes'),'itemOptions'=>array('id' => 'solicitudes','active'=>$this->id=='solicitudes'?true:false)),
							 array('label'=>'Clientes', 'url'=>array('/clientes'),'itemOptions'=>array('id' => 'clientes','active'=>$this->id=='clientes'?true:false)),
				 			 array('label'=>'Especies', 'url'=>array('/especie'),'itemOptions'=>array('id' => 'especie','active'=>$this->id=='especie'?true:false)),
							 array('label'=>'Empleados', 'url'=>array('/personal'),'itemOptions'=>array('id' => 'personal','active'=>$this->id=='personal'?true:false)),
							 array('label'=>'Roles', 'url'=>array('/roles'),'itemOptions'=>array('id' => 'roles','active'=>$this->id=='roles'?true:false)),
							 array('label'=>'Usuarios', 'url'=>array('/usuarios'),'itemOptions'=>array('id' => 'usuarios','active'=>$this->id=='usuarios'?true:false)),
							 array('label'=>''.Yii::app()->user->name.'','url'=>array('site/logout'),'itemOptions'=>array('id' => 'login')),
							 ),	));
						break;
				}
		}
		?>
      </div>

      <div id="contentWrapper">
      <div id="headerSmobil"></div>
      		<?php echo $content; ?>
      </div>

      <div class="clear"></div>
      <div id="footer"></div>
      
    </div>
    
  </body>
</html>
