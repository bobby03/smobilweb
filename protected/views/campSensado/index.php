<?php
/* @var $this CampSensadoController */
/* @var $dataProvider CActiveDataProvider */
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $cs->registerScriptFile($baseUrl.'/js/changeTab.js');
    $this->breadcrumbs=array(
	'Roles',
    );

?>
<h1>Camp Sensados</h1>

<div class="principal">
    <div class="tabs">
        <div class="tab select" data-id="1"><span>Activos</span></div>
        <div class="tab" data-id="2"><span>Inactivos</span></div>
    </div>


 <div class="search-form">
    <?php $this->renderPartial('_search',array(
            'model'=>$model,
    )); ?>
    
    </div><!-- search-form -->

    <div class="tabContent" data-tan="1"> <!--Activos-->

    <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'campsensado-grid',
            'summaryText'=>'',
            'htmlOptions'=>array('class'=>'si-busqueda grid-view'),
            'dataProvider'=>$model->search(1),
            'columns'=>$model->adminSearch(),
            'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
            'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
            'template' => "{items}{summary}{pager}",
            'afterAjaxUpdate' => "function(id,data)
            {
                $.fn.yiiGridView.update('campsensado-grid2');
            }"
        )); 
    ?>
    </div>
    <div class="tabContent hide" data-tan="2"> <!--Inactivos-->
 

    <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'campsensado-grid2',
            'summaryText'=>'',
            'ajaxUpdate'=>true,
            'dataProvider'=>$model->search(0),
            'columns'=>$model->adminSearchBorrados(),
            'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
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