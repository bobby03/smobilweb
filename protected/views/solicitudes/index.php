<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/plugins/ColorBox/jquery.colorbox.js');
    $cs->registerCssFile($baseUrl.'/js/plugins/ColorBox/colorbox.css');
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $this->breadcrumbs=array
    (
	'Solicitudes',
    );

    $this->menu=array
    (
	array('label'=>'Create Solicitudes', 'url'=>array('create')),
	array('label'=>'Manage Solicitudes', 'url'=>array('admin')),
    );
?>

<h1>Solicitudes</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array
(
    'id'=>'solicitudes-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array
    (
        array(
            'name'=>'id_clientes',
            'value' => 'Clientes::model()->getCliente($data->id_clientes)'
        ),
        'codigo',
        array(
            'name'=>'fecha_alta',
            'value' => 'date("d-m-Y", strtotime($data->fecha_alta))'
        ),
        array(
            'name'=>'hora_alta',
            'value' => 'date("H:i", strtotime($data->hora_alta))'
        ),
        array(
            'name'=>'fecha_estimada',
            'value' => 'date("d-m-Y", strtotime($data->fecha_estimada))'
        ),
        /*
        'hora_estimada',
        'fecha_entrega',
        'hora_entrega',
        'notas',
        */
        array
        (
            'class'=>'NCButtonColumn',
            'header'=>'Acciones',
            'template'=>'<div class="buttonsWraper">{view} {update} {delete}</div>'
        ),
    ),
)); ?>
