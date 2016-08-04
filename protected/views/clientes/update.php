<?php
/* @var $this ClientesController */
/* @var $model Clientes */

$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>


<h1>Actualizar Cliente <?php echo $model->nombre_empresa; ?></h1>

<?php $this->renderPartial('_form', array(
        'model'=>$model,
        'direccion' =>$direccion
    )); ?>