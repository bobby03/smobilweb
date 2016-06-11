<?php
/* @var $this CepaController */
/* @var $model Cepa */

$this->breadcrumbs=array(
	'Cepas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Cepa', 'url'=>array('index')),
	array('label'=>'Create Cepa', 'url'=>array('create')),
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
?>

<h1>Manage Cepas</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

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
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
