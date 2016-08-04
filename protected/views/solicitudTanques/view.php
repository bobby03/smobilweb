<?php
/* @var $this SolicitudTanquesController */
/* @var $model SolicitudTanques */

 $baseUrl = Yii::app()->baseUrl;
 $cs = Yii::app()->getClientScript();
 $cs->registerScriptFile($baseUrl.'/js/viewTable.js');

$this->breadcrumbs=array(
	'Solicitud Tanques'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SolicitudTanques', 'url'=>array('index')),
	array('label'=>'Create SolicitudTanques', 'url'=>array('create')),
	array('label'=>'Update SolicitudTanques', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SolicitudTanques', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SolicitudTanques', 'url'=>array('admin')),
);
?>

<h1>View SolicitudTanques #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_solicitud',
		'id_tanque',
		'id_domicilio',
		'id_cepas',
		'cantidad_cepas',
	),
)); ?>
