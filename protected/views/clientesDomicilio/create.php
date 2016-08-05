<?php
/* @var $this ClientesDomicilioController */
/* @var $model ClientesDomicilio */

$this->breadcrumbs=array(
	'Clientes Domicilios'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ClientesDomicilio', 'url'=>array('index')),
	array('label'=>'Manage ClientesDomicilio', 'url'=>array('admin')),
);
?>

<h1>Create ClientesDomicilio</h1>
<?php 
    $direccion = ClientesDomicilio::model();
    $this->renderPartial('_form', array
        (
            'model' => $model,
            'direccion' => $direccion
        )); 
?>