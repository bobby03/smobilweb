<?php
/* @var $this CepaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cepas',
);

$this->menu=array(
	array('label'=>'Create Cepa', 'url'=>array('create')),
	array('label'=>'Manage Cepa', 'url'=>array('admin')),
);
?>

<h1>Cepas</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cepa-grid',
	'dataProvider'=>$model->search(),
	'summaryText'=> '',
	'filter'=>$model,
	'columns'=>array(
		
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
		
		 array
            (
                'class'=>'NCButtonColumn',
                'template'=>'<div class="buttonsWraper">{view} {update} {delete}</div>'
            ),
	),
)); ?>