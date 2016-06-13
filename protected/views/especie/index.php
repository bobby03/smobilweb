<?php
/* @var $this EspecieController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Especies',
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $('#especie-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
");

$this->menu=array(
	array('label'=>'Create Especie', 'url'=>array('create')),
	array('label'=>'Manage Especie', 'url'=>array('admin')),
);
?>

<h1>Especies</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'especie-grid',
    'summaryText' => '',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'nombre',
        /*array(
            'class'=>'CButtonColumn',
        ),*/
    ),
)); ?>

