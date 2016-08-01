<?php
/* @var $this PersonalController */
/* @var $model Personal */

$this->breadcrumbs=array(
	'Personals'=>array('index'),
	'Create',
);


?>

<h1>Agregar Personal</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>