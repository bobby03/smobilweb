<?php
/* @var $this CepaController */
/* @var $model Cepa */

$this->breadcrumbs=array(
	'Cepas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Cepa', 'url'=>array('index')),
	array('label'=>'Create Cepa', 'url'=>array('create')),
	array('label'=>'Update Cepa', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Cepa', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cepa', 'url'=>array('admin')),
);
?>

<h1>View Cepa #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_especie',
		'nombre_cepa',
		'temp_min',
		'temp_max',
		'ph_min',
		'ph_max',
		'ox_min',
		'ox_max',
		'cantidad',
		'cond_min',
		'cond_max',
		'orp_min',
		'orp_max',
	),
)); ?>
