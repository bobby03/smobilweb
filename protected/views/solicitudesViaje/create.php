<?php
/* @var $this SolicitudesViajeController */
/* @var $model SolicitudesViaje */

$this->breadcrumbs=array(
	'Solicitudes Viajes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SolicitudesViaje', 'url'=>array('index')),
	array('label'=>'Manage SolicitudesViaje', 'url'=>array('admin')),
);
?>

<h1>Create SolicitudesViaje</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>