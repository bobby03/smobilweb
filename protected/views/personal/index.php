<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/personal/index.css');
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
    'id'=>'personal',
    'dataProvider'=>$model->search(),
    'summaryText'=> '',
    'columns'=>$model->adminSearch()
)); 
?>
