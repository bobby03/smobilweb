<?php
/* @var $this ClientesController */
/* @var $dataProvider CActiveDataProvider */
 $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/search.js');

$this->breadcrumbs=array(
	'Clientes',
);

$this->menu=array(
	array('label'=>'Create Clientes', 'url'=>array('create')),
	array('label'=>'Manage Clientes', 'url'=>array('admin')),
);
?>

<h1>Clientes</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'clientes-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombre_empresa',
		'nombre_contacto',
		'apellido_contacto',
		'correo',
		'rfc',
		/*
		'tel',
		*/
		array(
				'class'=>'NCButtonColumn',
              	'header'=>'Acciones',
                'template'=>'<div class="buttonsWraper">{view} {update} {delete}</div>'
		),
	),
)); ?>
