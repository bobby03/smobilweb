<?php
/* @var $this ClientesController */
/* @var $model Clientes */

$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Clientes', 'url'=>array('index')),
	array('label'=>'Manage Clientes', 'url'=>array('admin')),
);
?>

<h1>Nuevo Cliente</h1>

<?php 
    $this->renderPartial('_form', array
        (
            'model' => $model,
            'direccion' => $direccion
        )); 
?>