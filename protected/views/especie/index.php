<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/especie/especie.css');
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $cs->registerScriptFile($baseUrl.'/js/especie/especie.js?C='.rand());
    $cs->registerScriptFile($baseUrl.'/js/changeTab.js');


    $this->breadcrumbs=array(
	'Especies',
    )
?>

<h1>Especies</h1>
<div class="principal">

    <div class="tabs">
        <div class="tab select" data-id="1"><span>Activos</span></div>
        <div class="tab" data-id="2"><span>Inactivos</span></div>
    </div>

<!--Activos-->
<div class="tabContent" data-tan="1"> 
    <div class="search-form" >
        <?php $this->renderPartial('_search',array(
                'model'=>$model,
        )); ?>
        <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/especie/create">
            <div class="agregar especie"></div>
        </a>
    </div><!-- search-form -->
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'especies-grid',
        'htmlOptions'=>array('class'=>'si-busqueda grid-view'),
        'dataProvider'=>$model->search(1),
        'pager' => array
        (
            'class' => 'PagerSA',
            'header'=>'',
        ),
        'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
        'template' => "{items}{summary}{pager}",
        'columns'=>$model->adminSearch(),
        'afterAjaxUpdate' => "function(id,data)
        {
            $('.items tbody tr').each(function()
            {
                $(this).find('a.view').remove();
            });
        }"
    )); ?>
</div>



<!--Inactivos-->
<div class="tabContent hide" data-tan="2"> 
    <?php $this->widget('zii.widgets.grid.CGridView', array
    (
        'id'=>'especies-grid2',
        'dataProvider'=>$model->search(0),
        'pager' => array
        (
            'class' => 'PagerSA',
            'header'=>'',
        ),
        'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
        'template' => "{items}{summary}{pager}",
        'columns'=>$model->adminSearchBorrados(),
    )); ?>
</div>



</div>