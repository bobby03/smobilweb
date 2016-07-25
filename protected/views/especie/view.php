<?php
/* @var $this EspecieController */
/* @var $model Especie */
 
 $baseUrl = Yii::app()->baseUrl;
 $cs = Yii::app()->getClientScript();
 $cs->registerScriptFile($baseUrl.'/js/viewTable.js');

$this->breadcrumbs=array(
	'Especies'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Especie', 'url'=>array('index')),
	array('label'=>'Create Especie', 'url'=>array('create')),
	array('label'=>'Update Especie', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Especie', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Especie', 'url'=>array('admin')),
);
?>

<h1>View Especie #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
	),
)); ?>
