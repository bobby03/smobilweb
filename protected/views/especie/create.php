<?php
/* @var $this EspecieController */
/* @var $model Especie */

$this->breadcrumbs=array(
	'Especies'=>array('index'),
	'Create',
);

?>

<h1>Crear nueva especie</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>