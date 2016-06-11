<?php
/* @var $this EstacionController */
/* @var $model Estacion */

$this->breadcrumbs=array(
	'Estacions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Estacion', 'url'=>array('index')),
	array('label'=>'Create Estacion', 'url'=>array('create')),
	array('label'=>'View Estacion', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Estacion', 'url'=>array('admin')),
);
?>

<h1>Update Estacion <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>