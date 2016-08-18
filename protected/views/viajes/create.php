<?php
/* @var $this ViajesController */
/* @var $model Viajes */

$this->breadcrumbs=array(
	'Viajes'=>array('index'),
	'Create',
);

?>

<h1>Datos del viajes</h1>

<?php $this->renderPartial('_form', array(
    'model'=>$model,
    'pedidos'=>$pedidos,
    'solicitudes'=>$solicitudes,
    'personal'=>$personal,
    'nuevo' => $nuevo
)); ?>