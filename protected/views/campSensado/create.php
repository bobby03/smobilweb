<?php
/* @var $this CampSensadoController */
/* @var $model CampSensado */

$this->breadcrumbs=array(
	'Camp Sensados'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CampSensado', 'url'=>array('index')),
	array('label'=>'Manage CampSensado', 'url'=>array('admin')),
);
?>

<h1>Create CampSensado</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>