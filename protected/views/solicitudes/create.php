<?php
/* @var $this SolicitudesController */
/* @var $model Solicitudes */

$this->breadcrumbs=array(
	'Solicitudes'=>array('index'),
	'Create',
);
 $update = false;
?>

<h1>Nueva solicitud</h1>

<?php $this->renderPartial('_form', array
    (
        'model'=>$model,
        'estaciones'=>$estaciones,
        'especies'=>$especies,
        'cepa'=>$cepa,
        'direccion'=>$direccion,
        'pedidos'=>'',
        'update'=> $update
    )); ?>

