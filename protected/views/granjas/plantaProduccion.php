<?php
/* @var $this EstacionController */
/* @var $dataProvider CActiveDataProvider */
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/css/estacion/estacion.css');
$cs->registerScriptFile($baseUrl.'/js/estacion/create.js');
$cs->registerScriptFile($baseUrl.'/js/search.js');
$this->breadcrumbs=array(
	'Estaciones',
);
?>
<style>
div.tabContent 
{
    margin-top: 50px;
}
</style>
<h1>Plantas de producci&oacute;n</h1>
<div class="principal">
    <div class="tabs">
        <div class="tab select" data-id="1"><span>Activos</span></div>
        <div class="tab" data-id="2"><span>Inactivos</span></div>
    </div>
    <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/granjas/nuevaPlanta/<?php echo $id;?>">
        <div class="agregar planta"></div>
    </a>



    <div class="tabContent" data-tan="1"> <!--Activos-->

    <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'estacion-grid',
            'summaryText'=>'',
            'htmlOptions'=>array('class'=>'si-busqueda grid-view'),
            'dataProvider'=>$model->searchTanqueGranja($id,1),
            'emptyText'=>"No hay resistros",
            'columns'=>$model->adminSearchPlanta(),
            'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
            'afterAjaxUpdate' => "function(id,data)
            {
                $.fn.yiiGridView.update('estacion-grid2');
            }"
        )); 
    ?>
    </div>
    <div class="tabContent hide" data-tan="2"> <!--Inactivos-->

    <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'estacion-grid2',
            'summaryText'=>'',
            'ajaxUpdate'=>true,
            'dataProvider'=>$model->searchTanqueGranja($id,0),
            'columns'=>$model->adminSearchPlantaVacio(),
            'emptyText'=>"No hay resistros",
            'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
        )); 
    ?>

    </div><a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/granjas">Regresar</a> 
</div>