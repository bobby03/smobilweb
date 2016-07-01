<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $cs->registerCssFile($baseUrl.'/css/viajes/index.css');
    $cs->registerScriptFile($baseUrl.'/js/viajes/index.js');
    $this->breadcrumbs=array(
	'Viajes',
    );

    $this->menu=array(
	array('label'=>'Create Viajes', 'url'=>array('create')),
	array('label'=>'Manage Viajes', 'url'=>array('admin')),
    );
?>
<h1>Viajes</h1>

<div class="principal">
    <div class="tabs">
        <div class="tab select" data-id="1"><span>En espera</span></div>
        <div class="tab" data-id="2"><span>En ruta</span></div>
        <div class="tab" data-id="3"><span>Finalizado</span></div>
    </div>
    <?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
    <div class="search-form" style="display:none">
    <?php $this->renderPartial('_search',array(
            'model'=>$model,
    )); ?>
    </div><!-- search-form -->
    <div class="tabContent" data-tan="1">
    <?php $this->widget('zii.widgets.grid.CGridView', array
    (
        'id'=>'viaje1',
        'dataProvider'=>$model->searchStatus1(1),
        'summaryText'=> '',
    //    'filter'=>$model,
        'columns'=>$model->adminSearch()
    )); 
    ?>
    </div>
    <div class="tabContent hide" data-tan="2">
    <?php $this->widget('zii.widgets.grid.CGridView', array
    (
        'id'=>'viaje2',
        'dataProvider'=>$model->searchStatus1(2),
        'summaryText'=> '',
    //    'filter'=>$model,
        'columns'=>$model->adminSearch()
    )); 
    ?>
    </div>
    <div class="tabContent hide" data-tan="3">
    <?php $this->widget('zii.widgets.grid.CGridView', array
    (
        'id'=>'viaje3',
        'dataProvider'=>$model->searchStatus1(3),
        'summaryText'=> '',
    //    'filter'=>$model,
        'columns'=>$model->adminSearch()
    )); 
    ?>
    </div>
</div>
