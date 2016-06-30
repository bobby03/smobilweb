<?php
/* @var $this ViajesController */
/* @var $model Viajes */

$this->breadcrumbs=array(
	'Viajes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Viajes', 'url'=>array('index')),
	array('label'=>'Create Viajes', 'url'=>array('create')),
	array('label'=>'Update Viajes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Viajes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Viajes', 'url'=>array('admin')),
);
?>

<h1>View Viajes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_solicitudes',
		'id_responsable',
		'status',
		'fecha_salida',
		'hora_salida',
		'fecha_entrega',
		'hora_entrega',
		'id_estacion',
	),
)); ?>
