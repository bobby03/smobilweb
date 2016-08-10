<?php
/* @var $this CampSensadoController */
/* @var $model CampSensado */

$this->breadcrumbs=array(
	'Camp Sensados'=>array('index'),
	'Create',
);

?>

<h1>Nueva siembra</h1>

<?php $this->renderPartial('_form', array(
		'model'=>$model, 
		'granjas' => $granjas,
		'personal' => $personal
		)); ?>