<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/roles/roles.css');
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $cs->registerScriptFile($baseUrl.'/js/roles/roles.js');
    $this->breadcrumbs=array(
	'Roles',
    );

    $this->menu=array(
	array('label'=>'Create Roles', 'url'=>array('create'))
    );
?>

<h1>Roles</h1>
<div class="principal">
    <div class="search-form">
    <?php $this->renderPartial('_search',array(
            'model'=>$model,
    )); ?>
    </div><!-- search-form -->

    <?php $this->widget('zii.widgets.grid.CGridView', array
    (
        'id'=>'rol',
        'dataProvider'=>$model->search(),

        'summaryText'=> '',
        'columns'=>$model->adminSearch()
    )); ?>
</div>