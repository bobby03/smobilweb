<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="es-MX">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="es-mx" />
    <meta name="language" content="es">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script> 
    <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.1.0.min.js"></script>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <?php 
		$baseUrl = Yii::app()->baseUrl;
		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile($baseUrl.'/css/main.css');
		$cs->registerCssFile($baseUrl.'/css/form.css');
	?>
  </head>


  <body class="<?php echo isset($this->classes) ? $this->classes : '' ?>">
    <div class="container" id="page">
      <?php
		$baseUrl = Yii::app()->baseUrl;
		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile($baseUrl.'/js/inputs.js');
	?>
    
    <!--
		<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
		</div>
	-->

      <div id="mainmenu">
        <div class= "menuTop">
        </div>
        <?php 

		if(!Yii::app()->user->isGuest){

			switch (Yii::app()->user->getTipoUsuario()) {

				case 1: //Menu para Tipo de Usuario Cliente

						$this->widget('zii.widgets.CMenu',array(
							'items'=>array(
									 array('label'=>'Inicio', 'url'=>array('/'),'itemOptions'=>array('id' => 'inicio')),
									 array('label'=>'Viajes', 'url'=>array('/viajes'),'itemOptions'=>array('id' => 'viajes')),
									 array('label'=>''.Yii::app()->user->name.'','url'=>array('site/logout'),'itemOptions'=>array('id' => 'login')),				    
									),));

						break;

				case 2: //Menu para Tipo de Usuario Personal
						$this->widget('zii.widgets.CMenu',array(
							'items'=>array(
									 array('label'=>'Inicio', 'url'=>array('/'),'itemOptions'=>array('id' => 'inicio')),
									 array('label'=>'Personal', 'url'=>array('/personal'),'itemOptions'=>array('id' => 'personal')),
									 array('label'=>'Roles', 'url'=>array('/roles'),'itemOptions'=>array('id' => 'roles')),
									 array('label'=>'Clientes', 'url'=>array('/clientes'),'itemOptions'=>array('id' => 'clientes')),
									 array('label'=>'Estaciones', 'url'=>array('/estacion'),'itemOptions'=>array('id' => 'estacion')),
									 array('label'=>'Especies', 'url'=>array('/especie'),'itemOptions'=>array('id' => 'especie')),
									 array('label'=>'Solicitudes', 'url'=>array('/solicitudes'),'itemOptions'=>array('id' => 'solicitudes')),
									 array('label'=>'Viajes', 'url'=>array('/viajes'),'itemOptions'=>array('id' => 'viajes')),
									 array('label'=>'Usuarios', 'url'=>array('/usuarios'),'itemOptions'=>array('id' => 'usuarios')),
									 array('label'=>'Monitoreo', 'url'=>array('/monitoreo'),'itemOptions'=>array('id' => 'monitoreo')),
									 array('label'=>''.Yii::app()->user->name.'','url'=>array('site/logout'),'itemOptions'=>array('id' => 'login')),
									 ),	));
						break;	

				default:
						$this->widget('zii.widgets.CMenu',array(
							'items'=>array(
									 array('label'=>'Inicio', 'url'=>array('/'),'itemOptions'=>array('id' => 'inicio')),
									 array('label'=>'Personal', 'url'=>array('/personal'),'itemOptions'=>array('id' => 'personal')),
									 array('label'=>'Roles', 'url'=>array('/roles'),'itemOptions'=>array('id' => 'roles')),
									 array('label'=>'Clientes', 'url'=>array('/clientes'),'itemOptions'=>array('id' => 'clientes')),
									 array('label'=>'Estaciones', 'url'=>array('/estacion'),'itemOptions'=>array('id' => 'estacion')),
									 array('label'=>'Especies', 'url'=>array('/especie'),'itemOptions'=>array('id' => 'especie')),
									 array('label'=>'Solicitudes', 'url'=>array('/solicitudes'),'itemOptions'=>array('id' => 'solicitudes')),
									 array('label'=>'Viajes', 'url'=>array('/viajes'),'itemOptions'=>array('id' => 'viajes')),
									 array('label'=>'Usuarios', 'url'=>array('/usuarios'),'itemOptions'=>array('id' => 'usuarios')),
									 array('label'=>'Monitoreo', 'url'=>array('/monitoreo'),'itemOptions'=>array('id' => 'monitoreo')),
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
