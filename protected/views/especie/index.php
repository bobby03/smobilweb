<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/especie/especie.css');
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
<div class="search-form" >
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'especie',
	'dataProvider'=>$model->search(),
	
        'summaryText'=>'',
	'columns'=>$model->adminSearch()
)); ?>
<?php // $this->widget('zii.widgets.CListView', array(
//    'dataProvider'=>$dataProvider,
//    'itemView'=>'_view',
//)); ?>
