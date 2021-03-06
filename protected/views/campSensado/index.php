<?php
/* @var $this CampSensadoController */
/* @var $dataProvider CActiveDataProvider */
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $cs->registerScriptFile($baseUrl.'/js/campsensado/search.js');
    $cs->registerScriptFile($baseUrl.'/js/changeTab.js');
//    $cs->registerScriptFile($baseUrl.'/js/siembras/search.js');
    $cs->registerScriptFile($baseUrl.'/js/siembras/index.js');
    $this->breadcrumbs=array(
	'Siembra',
    );

?>
<h1>Siembras</h1>

<div class="principal">
    <div class="tabs">
        <div class="tab select" data-id="1"><span>En espera</span></div>
        <div id="proceso" class="tab" data-id="2"><span>En proceso</span></div>
        <div id="historico" class="tab" data-id="3"><span>Histórico</span></div>
    </div>

    <div class="tabContent" data-tan="1"> <!--Activos-->
        <div class="search-form"><!-- search-form -->
            <?php $this->renderPartial('_search',array('model'=>$model,)); ?>
            <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/CampSensado/create">
                <div class="agregar campsensado"></div>
            </a>
        </div>
        <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'campsensado-grid',
            'htmlOptions'=>array('class'=>'si-busqueda grid-view'),
            'dataProvider'=>$model->search(0),
            'columns'=>$model->adminSearchEnEspera(),
            'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
            'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
            'emptyText'=>"No hay registros",
            'template' => "{items}{summary}{pager}",
            'afterAjaxUpdate' => "function(id,data)
            {
                $.fn.yiiGridView.update('campsensado-grid2');
            }"
        )); 
    ?>
    </div>
    <!-- - - - - - - - - - - -  - - - - - - -->
    <div class="tabContent hide" data-tan="2"> <!--Activos-->
        <div class="search-form2"><!-- search-form -->
            <?php $this->renderPartial('_search2',array('model'=>$model,)); ?>
            <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/CampSensado/create">
                <div class="agregar campsensado"></div>
            </a>
        </div>
        <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'campsensado-grid2',
            'ajaxUpdate'=>true,
            'htmlOptions'=>array('class'=>'si-busqueda grid-view'),
            'dataProvider'=>$model->search(1),
            'columns'=>$model->adminSearchBorrados(),
            'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
            'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
            'emptyText'=>"No hay registros",
            'template' => "{items}{summary}{pager}",
        )); 
    ?>
    </div>
    <!-- - - - - - - - - - - -  - - - - - - -->
    <div class="tabContent hide" id="asignadas" data-tan="3"> <!--Inactivos-->
        <div class="search-form3"><!-- search-form -->
            <?php $this->renderPartial('_search3',array('model'=>$model,)); ?>
        </div>
        <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'campsensado-grid3',
            'ajaxUpdate'=>true,
            'dataProvider'=>$model->search(2),
            'columns'=>$model->adminSearchBorrados(),
            'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
            'emptyText'=>"No hay registros",
            'template' => "{items}{summary}{pager}",
            'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
        )); 
    ?>
    </div>
</div>