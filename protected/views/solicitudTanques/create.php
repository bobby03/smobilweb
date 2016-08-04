<?php
/* @var $this SolicitudTanquesController */
/* @var $model SolicitudTanques */

$this->breadcrumbs=array(
	'Solicitud Tanques'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SolicitudTanques', 'url'=>array('index')),
	array('label'=>'Manage SolicitudTanques', 'url'=>array('admin')),
);
?>

<h1>Create SolicitudTanques</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>