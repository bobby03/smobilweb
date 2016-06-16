<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/search.js');

    $this->breadcrumbs=array(
	'Especies',
    );

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
	'id'=>'especie',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'summaryText'=>'',
	'columns'=>$model->adminSearch()
)); ?>
<?php // $this->widget('zii.widgets.CListView', array(
//    'dataProvider'=>$dataProvider,
//    'itemView'=>'_view',
//)); ?>
