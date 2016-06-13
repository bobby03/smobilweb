<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $this->breadcrumbs=array(
	'Viajes',
    );

    $this->menu=array(
	array('label'=>'Create Viajes', 'url'=>array('create')),
	array('label'=>'Manage Viajes', 'url'=>array('admin')),
    );
?>

<h1>Viajes</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array
(
    'id'=>'viajes-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array
    (
        'id_clientes',
        'id_responsable',
        'status',
        'fecha_salida',
        'hora_salida',
        /*
        'fecha_entrega',
        'hora_entrega',
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
