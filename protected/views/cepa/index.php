<?php
/* @var $this CepaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cepas',
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cepa-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

$this->menu=array(
	array('label'=>'Create Cepa', 'url'=>array('create')),
	array('label'=>'Manage Cepa', 'url'=>array('admin')),
);
?>

<h1>Cepas</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cepa-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'id_especie',
		'nombre_cepa',
		'temp_min',
		'temp_max',
		'ph_min',
		/*
		'ph_max',
		'ox_min',
		'ox_max',
		'cantidad',
		'cond_min',
		'cond_max',
		'orp_min',
		'orp_max',
		'id_1',
		*/
		/*array(
			'class'=>'CButtonColumn',
		),*/
	),
)); ?>