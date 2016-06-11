<?php
/* @var $this CepaController */
/* @var $model Cepa */

$this->breadcrumbs=array(
	'Cepas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cepa', 'url'=>array('index')),
	array('label'=>'Manage Cepa', 'url'=>array('admin')),
);
?>

<h1>Create Cepa</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>