<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $this->breadcrumbs=array(
	'Roles',
    );

    $this->menu=array(
	array('label'=>'Create Roles', 'url'=>array('create')),
	array('label'=>'Manage Roles', 'url'=>array('admin')),
    );
?>

<h1>Roles</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array
(
    'id'=>'roles-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array
    (
        'nombre_rol',
        array
        (
            'class'=>'NCButtonColumn',
            'header'=>'Acciones',
            'template'=>'<div class="buttonsWraper">{view} {update} {delete}</div>'
        ),
    ),
)); ?>
