<?php
/* @var $this EspecieController */
/* @var $model Especie */

$this->breadcrumbs=array(
	'Especies'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Especie', 'url'=>array('index')),
	array('label'=>'Create Especie', 'url'=>array('create')),
	array('label'=>'View Especie', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Especie', 'url'=>array('admin')),
);
?>

<h1>Update Especie <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>