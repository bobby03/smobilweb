<?php
/* @var $this TanqueController */
/* @var $model Tanque */

$this->breadcrumbs=array(
	'Tanques'=>array('index'),
	'Create',
);
?>
<h1>Agregar tanques</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>