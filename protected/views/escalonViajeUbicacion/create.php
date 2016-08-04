<?php
/* @var $this EscalonViajeUbicacionController */
/* @var $model EscalonViajeUbicacion */

$this->breadcrumbs=array(
	'Escalon Viaje Ubicacions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EscalonViajeUbicacion', 'url'=>array('index')),
	array('label'=>'Manage EscalonViajeUbicacion', 'url'=>array('admin')),
);
?>

<h1>Create EscalonViajeUbicacion</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>