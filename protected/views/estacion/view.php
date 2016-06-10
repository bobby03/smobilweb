<?php
/* @var $this EstacionController */
/* @var $model Estacion */

$this->breadcrumbs=array(
	'Estacions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Estacion', 'url'=>array('index')),
	array('label'=>'Create Estacion', 'url'=>array('create')),
	array('label'=>'Update Estacion', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Estacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Estacion', 'url'=>array('admin')),
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
