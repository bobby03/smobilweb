<?php
/* @var $this CepaController */
/* @var $model Cepa */

$this->breadcrumbs=array(
	'Cepas'=>array('index'),
	'Create',
);

//$nombres=CepaController::getNombres($this->id_estacion);
//print_r($nombres);
?>

<h1>Crear  Cepa</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>