<?php
/* @var $this TanqueController */
/* @var $model Tanque */

$this->breadcrumbs=array(
	'Tanques'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tanque', 'url'=>array('index')),
	array('label'=>'Create Tanque', 'url'=>array('create')),
	array('label'=>'View Tanque', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Tanque', 'url'=>array('admin')),
);
?>

<h1>Update Tanque <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>