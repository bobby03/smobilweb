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
            'dataProvider'=>$model->searchTanqueGranja($id,1),
            'columns'=>$model->adminSearchPlanta(),
            'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
        )); 
    ?>
    </div>
    <div class="tabContent hide" data-tan="2"> <!--Inactivos-->

    <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'estacion-grid2',
            'summaryText'=>'',
            'dataProvider'=>$model->searchTanqueGranja($id,0),
            'columns'=>$model->adminSearchPlanta(),
            'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
        )); 
    ?>
    </div>
</div>