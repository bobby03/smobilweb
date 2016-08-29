<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/personal/index.css');
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $cs->registerScriptFile($baseUrl.'/js/personal/search.js');
    $cs->registerScriptFile($baseUrl.'/js/changeTab.js');
    $this->breadcrumbs=array(
        'Personals',
    );
?>


<h1>Empleados</h1>

<div class="principal">
    <div class="tabs">
        <div class="tab select" data-id="1"><span>Activos</span></div>
        <div class="tab" data-id="2"><span>Inactivos</span></div>
    </div>
    <div class="tabContent" data-tan="1"> <!--Activos-->
    <div class="search-form" >
    <?php $this->renderPartial('_search',array(
            'model'=>$model,
    )); ?>
    <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/personal/create">
        <div class="agregar personal"></div>
    </a>
    </div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array
(
    'id'=>'personal-grid',
    'htmlOptions'=>array('class'=>'si-busqueda grid-view'),
    'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
    'emptyText'=>"No hay registros",
    'template' => "{items}{summary}{pager}",
    'pager' => array
    (
        'class' => 'PagerSA',
        'header'=>'',
    ),
    'dataProvider'=>$model->search(1),
    'columns'=>$model->adminSearch(),
    'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
    'afterAjaxUpdate' => "function(id,data)
    {
        $.fn.yiiGridView.update('personal-grid2');
    }"
)); 
?>
    </div>
    <div class="tabContent hide" data-tan="2"> <!--Inactivos-->
        <div class="search-form2" >
            <?php $this->renderPartial('_search2',array(
                    'model'=>$model,
            )); ?>
        </div><!-- search-form -->
        <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'personal-grid2',
            'htmlOptions'=>array('class'=>'si-busqueda grid-view'),
            'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
            'emptyText'=>"No hay registros",
            'ajaxUpdate'=>true,
            'template' => "{items}{summary}{pager}",
            'dataProvider'=> $model->search(0),
            'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
            'columns'=>$model->adminSearchVacios()
        )); 
?>
    </div>
</div>