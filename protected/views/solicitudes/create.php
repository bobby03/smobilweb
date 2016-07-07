<?php
/* @var $this SolicitudesController */
/* @var $model Solicitudes */

$this->breadcrumbs=array(
	'Solicitudes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Solicitudes', 'url'=>array('index')),
);
?>

<h1>Nueva solicitud</h1>

<?php $this->renderPartial('_form', array
    (
        'model'=>$model,
        'estaciones'=>$estaciones,
        'especies'=>$especies,
        'cepa'=>$cepa,
        'direccion'=>$direccion,
        'pedidos'=>''
    )); ?>