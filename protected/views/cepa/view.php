<?php
/* @var $this CepaController */
/* @var $model Cepa */

 $baseUrl = Yii::app()->baseUrl;
 $cs = Yii::app()->getClientScript();
 $cs->registerScriptFile($baseUrl.'/js/viewTable.js');

$this->breadcrumbs=array(
	'Cepas'=>array('index'),
	$model->id,
);
?>

<h1>View Cepa #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_especie',
		'nombre_cepa',
		'temp_min',
		'temp_max',
		'ph_min',
		'ph_max',
		'ox_min',
		'ox_max',
		'cantidad',
		'cond_min',
		'cond_max',
		'orp_min',
		'orp_max',
	),
)); ?>
