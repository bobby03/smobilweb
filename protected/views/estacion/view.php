<?php
/* @var $this EstacionController */
/* @var $model Estacion */

$this->breadcrumbs=array(
	'Estacions'=>array('index'),
	$model->id,
);

 $baseUrl = Yii::app()->baseUrl;
 $cs = Yii::app()->getClientScript();
 $cs->registerScriptFile($baseUrl.'/js/viewTable.js');
 
?>

<h1>View Estacion #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'tipo',
		'identificador',
		'no_personal',
		'marca',
		'color',
		'ubicacion',
		'disponible',
		'activo',
	),
)); ?>

