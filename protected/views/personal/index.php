<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/personal/index.css');
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $this->breadcrumbs=array(
        'Personals',
    );

    $this->menu=array(
        array('label'=>'Create Personal', 'url'=>array('create'))
    );
?>


<h1>Personal</h1>

<div class="principal">
<div class="search-form" >
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array
(
    'id'=>'personal',
    'dataProvider'=>$model->search(),
    'summaryText'=> '',
    'columns'=>$model->adminSearch()
)); 
?>
</div>