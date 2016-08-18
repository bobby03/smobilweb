<?php
/* @var $this GranjasController */
/* @var $model Granjas */

$this->breadcrumbs=array(
	'Granjases'=>array('index'),
	'Create',
);
?>

<h1>Crear granja</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>