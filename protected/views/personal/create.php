<?php
/* @var $this PersonalController */
/* @var $model Personal */

$this->breadcrumbs=array(
	'Personals'=>array('index'),
	'Create',
);


?>

<h1>Agregar empleado</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>