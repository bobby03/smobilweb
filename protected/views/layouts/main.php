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

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<!--<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>-->
	</div><!-- header -->

	<div id="mainmenu">
		<div class= "menuTop"></div>
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Inicio', 'url'=>array('/')),
				array('label'=>'Cepa', 'url'=>array('/cepa')),
				array('label'=>'Clientes', 'url'=>array('/clientes')),
				array('label'=>'Especie', 'url'=>array('/especie')),
				array('label'=>'Estación', 'url'=>array('/estacion')),
				array('label'=>'Personal', 'url'=>array('/personal')),
				array('label'=>'Solicitudes', 'url'=>array('/solicitudes')),
				array('label'=>'Usuarios', 'url'=>array('/usuarios')),
				array('label'=>'Viajes', 'url'=>array('/viajes')),
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
