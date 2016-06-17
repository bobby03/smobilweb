<?php
/* @var $this TanqueController */
/* @var $model Tanque */

$this->breadcrumbs=array(
	'Tanques'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tanque', 'url'=>array('index')),
	array('label'=>'Manage Tanque', 'url'=>array('admin')),
);
?>

<h1>Create Tanque</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>