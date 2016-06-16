<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
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
    'id'=>'solicitud',
    'dataProvider'=>$model->search(),
    'summaryText'=> '',
    'filter'=>$model,
    'columns'=>$model->adminSearch()
)); ?>
