<?php
/* @var $this EstacionController */
/* @var $model Estacion */

$this->breadcrumbs=array(
	'Estacions'=>array('index'),
	$model->id,
);
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
