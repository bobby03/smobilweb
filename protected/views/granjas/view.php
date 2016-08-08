<?php
/* @var $this GranjasController */
/* @var $model Granjas */

$this->breadcrumbs=array(
	'Granjases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Granjas', 'url'=>array('index')),
	array('label'=>'Create Granjas', 'url'=>array('create')),
	array('label'=>'Update Granjas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Granjas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Granjas', 'url'=>array('admin')),
);
?>

<h1>View Granjas #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'direccion',
		'responsable',
		'activo',
	),
)); ?>
