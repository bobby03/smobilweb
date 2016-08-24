<?php
/* @var $this ClientesController */
/* @var $dataProvider CActiveDataProvider */
 $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/clientes/cliente.css');
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $cs->registerScriptFile($baseUrl.'/js/clientes/search.js');
    $cs->registerScriptFile($baseUrl.'/js/changeTab.js');


$this->breadcrumbs=array(
	'Clientes',
);
?>
<h1>Clientes</h1>

<div class="principal">
    <div class="tabs">
        <div class="tab select" data-id="1"><span>Activos</span></div>
        <div class="tab" data-id="2"><span>Inactivos</span></div>
    </div>
    <div class="tabContent" data-tan="1">
    <div class="search-form" >
    <?php $this->renderPartial('_search',array(
            'model'=>$model,
    )); ?>
        <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/clientes/create">
            <div class="agregar clientes"></div>
        </a>
    </div><!-- search-form -->

    <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'clientes-grid',
            'htmlOptions'=>array('class'=>'si-busqueda grid-view'),
            'dataProvider'=>$model->search(1),
            'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
            'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
            'emptyText'=>"No hay resistros",
            'template' => "{items}{summary}{pager}",
            'columns'=>$model->adminSearch(),
            'afterAjaxUpdate' => "function(id,data)
            {
                $.fn.yiiGridView.update('clientes-grid2');
            }"
    )); ?>
</div>
    <div class="tabContent hide" data-tan="2">
        <div class="search-form2" >
    <?php $this->renderPartial('_search2',array(
            'model'=>$model,
    )); ?>
    </div><!-- search-form -->
    <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'clientes-grid2',
            'dataProvider'=>$model->search(0),
            'ajaxUpdate'=>true,
            'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
            'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
            'emptyText'=>"No hay resistros",
            'template' => "{items}{summary}{pager}",
            'columns'=>$model->adminSearchVacios()
    )); ?>
</div>
</div>
