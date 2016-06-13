<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $this->breadcrumbs=array(
	'Usuarioses',
    );

    $this->menu=array(
	array('label'=>'Create Usuarios', 'url'=>array('create')),
	array('label'=>'Manage Usuarios', 'url'=>array('admin')),
    );
?>

<h1>Usuarioses</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array
(
    'id'=>'usuarios-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array
    (
        'usuario',
//        'pwd',
        'tipo_usr',
        'id_usr',
        array
        (
            'class'=>'NCButtonColumn',
            'header'=>'Acciones',
            'template'=>'<div class="buttonsWraper">{view} {update} {delete}</div>'
        ),
    ),
)); ?>
