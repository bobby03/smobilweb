<?php
/* @var $this EstacionController */
/* @var $model Estacion */

$this->breadcrumbs=array(
	'Estacions'=>array('index'),
	$model->id,
);

 $baseUrl = Yii::app()->baseUrl;
 $cs = Yii::app()->getClientScript();
 $cs->registerScriptFile($baseUrl.'/js/viewTable.js');
 $cs->registerScriptFile($baseUrl.'/js/estacion/create.js');
 $model->disponible = Estacion::model()->getDisponible($model->disponible);
 $model->tipo = Estacion::model()->getTipo($model->tipo);
?>

<h1>Ver estaci&oacute;n #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'nullDisplay'=>'No hay datos disponibles',
	'attributes'=>array(
		'tipo',
		'identificador',
		'no_personal',
		'marca',
		'color',
		'ubicacion',
		'disponible'
	),
)); ?>

