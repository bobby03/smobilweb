<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $this->breadcrumbs=array(
        'Personals',
    );

    $this->menu=array(
        array('label'=>'Create Personal', 'url'=>array('create')),
        array('label'=>'Manage Personal', 'url'=>array('admin')),
    );
?>

<h1>Personal</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array
(
    'id'=>'personal-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array
    (
        'nombre',
        'apellido',
        'tel',
        'rfc',
        'domicilio',
        /*
        'id_rol',
        'correo',
        'puesto',
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
