<?php
/* @var $this ViajesController */
/* @var $model Viajes */

$this->breadcrumbs=array(
	'Viajes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Viajes', 'url'=>array('index')),
	array('label'=>'Create Viajes', 'url'=>array('create')),
	array('label'=>'View Viajes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Viajes', 'url'=>array('admin')),
);
?>

<h1>Update Viajes <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>