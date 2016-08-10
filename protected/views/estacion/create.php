<?php
/* @var $this EstacionController */
/* @var $model Estacion */

$this->breadcrumbs=array(
	'Estacions'=>array('index'),
	'Create',
);
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/estacion/create.js');
?>

<h1>Crear cami&oacute;n</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>