<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $cs->registerCssFile($baseUrl.'/css/roles/roles.css');
    $cs->registerScriptFile($baseUrl.'/js/roles/roles.js');
    $this->breadcrumbs=array(
	'Roles',
    );

?>

<h1>Roles</h1>

<div class="principal">
     <div class="tabs">
        <div class="tab select" data-id="1"><span>Activos</span></div>
        <div class="tab" data-id="2"><span>Inactivos</span></div>
    </div>

<div class="tabContent" data-tan="1"> <!--Activos-->
    <div class="search-form">
    <?php $this->renderPartial('_search',array(
            'model'=>$model,
    )); ?>
    <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/roles/create">
        <div class="agregar roles"></div>
    </a>
    </div><!-- search-form -->

    <?php $this->widget('zii.widgets.grid.CGridView', array
    (
        'id'=>'rol',
        'dataProvider'=>$model->search(1),
        'pager' => array
        (
            'class' => 'PagerSA',
            'header'=>'',
        ),
        'summaryText'=> '',
        'columns'=>$model->adminSearch(),
    )); ?>
</div>

<div class="tabContent hide" data-tan="2"> <!--Inactivos-->

    <?php $this->widget('zii.widgets.grid.CGridView', array
    (
        'id'=>'rol2',
        'dataProvider'=>$model->search(0),
        'pager' => array
        (
            'class' => 'PagerSA',
            'header'=>'',
        ),
        'summaryText'=> '',
        'columns'=>$model->adminSearch(),
        
    )); ?>
</div>


</div>