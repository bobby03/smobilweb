<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->

<!--	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">-->
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

<body>

<div class="container" id="page">
        <?php
            $baseUrl = Yii::app()->baseUrl;
            $cs = Yii::app()->getClientScript();
            $cs->registerScriptFile($baseUrl.'/js/inputs.js');
        ?>
	<div id="header">
		<!--<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>-->
	</div><!-- header -->

	<div id="mainmenu">
		<div class= "menuTop"></div>
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Inicio', 'url'=>array('/'),'itemOptions'=>array('id' => 'inicio')),
				array('label'=>'Personal', 'url'=>array('/personal'),'itemOptions'=>array('id' => 'personal')),
				array('label'=>'Roles', 'url'=>array('/roles'),'itemOptions'=>array('id' => 'roles')),
				array('label'=>'Clientes', 'url'=>array('/clientes'),'itemOptions'=>array('id' => 'clientes')),
				array('label'=>'Estación', 'url'=>array('/estacion'),'itemOptions'=>array('id' => 'estacion')),
				array('label'=>'Especie', 'url'=>array('/especie'),'itemOptions'=>array('id' => 'especie')),
				array('label'=>'Solicitudes', 'url'=>array('/solicitudes'),'itemOptions'=>array('id' => 'solicitudes')),
				array('label'=>'Viajes', 'url'=>array('/viajes'),'itemOptions'=>array('id' => 'viajes')),
				array('label'=>'Usuarios', 'url'=>array('/usuarios'),'itemOptions'=>array('id' => 'usuarios')),
				array('label'=>'Cepa', 'url'=>array('/cepa')),
				
				
				
				
				
				
				
				
			),
		)); ?>
	</div><!-- mainmenu 
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
<div id="contentWrapper">
	<?php echo $content; ?>
</div>
	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
