<?php
/* @var $this EstacionController */
/* @var $dataProvider CActiveDataProvider */
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/search.js');
$this->breadcrumbs=array(
	'Estacions',
);

$this->menu=array(
	array('label'=>'Create Estacion', 'url'=>array('create')),
	array('label'=>'Manage Estacion', 'url'=>array('admin')),
);
?>

<h1>Estaciones</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array
    (
        'id'=>'estacion-grid',
        'summaryText'=>'',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array
        (
            'tipo',
            'identificador',
            'no_personal',
            'marca',
            'color',
            /*
            'ubicacion',
            'disponible',
            'activo',
            */
            array
            (
                'class'=>'NCButtonColumn',
                'header'=>'Acciones',
                'template'=>'<div class="buttonsWraper">{view} {update} {delete}</div>'
            ),
        ),
    )); 
?>
