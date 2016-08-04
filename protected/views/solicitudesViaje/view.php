<?php
/* @var $this SolicitudesViajeController */
/* @var $model SolicitudesViaje */

 $baseUrl = Yii::app()->baseUrl;
 $cs = Yii::app()->getClientScript();
 $cs->registerScriptFile($baseUrl.'/js/viewTable.js');

$this->breadcrumbs=array(
	'Solicitudes Viajes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SolicitudesViaje', 'url'=>array('index')),
	array('label'=>'Create SolicitudesViaje', 'url'=>array('create')),
	array('label'=>'Update SolicitudesViaje', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SolicitudesViaje', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SolicitudesViaje', 'url'=>array('admin')),
);
?>

<h1>View SolicitudesViaje #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_personal',
		'id_viaje',
		'id_solicitud',
	),
)); ?>
