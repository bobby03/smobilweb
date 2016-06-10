<?php
/* @var $this EstacionController */
/* @var $model Estacion */

$this->breadcrumbs=array(
	'Estacions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Estacion', 'url'=>array('index')),
	array('label'=>'Manage Estacion', 'url'=>array('admin')),
);
?>

<h1>Create Estacion</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>