<?php
/* @var $this EscalonViajeUbicacionController */
/* @var $model EscalonViajeUbicacion */

 $baseUrl = Yii::app()->baseUrl;
 $cs = Yii::app()->getClientScript();
 $cs->registerScriptFile($baseUrl.'/js/viewTable.js');

$this->breadcrumbs=array(
	'Escalon Viaje Ubicacions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EscalonViajeUbicacion', 'url'=>array('index')),
	array('label'=>'Create EscalonViajeUbicacion', 'url'=>array('create')),
	array('label'=>'Update EscalonViajeUbicacion', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EscalonViajeUbicacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EscalonViajeUbicacion', 'url'=>array('admin')),
);
?>

<h1>View EscalonViajeUbicacion #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_estacion',
		'id_viaje',
		'id_tanque',
		'ubicacion',
		'fecha',
		'hora',
	),
)); ?>
