<?php
/* @var $this TanqueController */
/* @var $model Tanque */

$this->breadcrumbs=array(
	'Tanques'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Tanque', 'url'=>array('index')),
	array('label'=>'Create Tanque', 'url'=>array('create')),
	array('label'=>'Update Tanque', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Tanque', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tanque', 'url'=>array('admin')),
);
?>

<h1>View Tanque #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_estacion',
		'capacidad',
		'nombre',
		'status',
		'activo',
	),
)); ?>
