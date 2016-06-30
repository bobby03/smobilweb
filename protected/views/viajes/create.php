<?php
/* @var $this ViajesController */
/* @var $model Viajes */

$this->breadcrumbs=array(
	'Viajes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Viajes', 'url'=>array('index')),
	array('label'=>'Manage Viajes', 'url'=>array('admin')),
);
?>

<h1>Datos del viajes</h1>

<?php $this->renderPartial('_form', array(
    'model'=>$model,
    'pedidos'=>$pedidos,
    'solicitudes'=>$solicitudes,
    'personal'=>$personal
)); ?>