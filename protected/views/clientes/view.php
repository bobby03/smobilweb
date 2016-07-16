<?php
/* @var $this ClientesController */
/* @var $model Clientes */

 $baseUrl = Yii::app()->baseUrl;
 $cs = Yii::app()->getClientScript();
 $cs->registerScriptFile($baseUrl.'/js/viewTable.js');

$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	$model->id,
);
?>

<h1>View Clientes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre_empresa',
		'nombre_contacto',
		'apellido_contacto',
		'correo',
		'rfc',
		'tel',
	),
)); ?>
