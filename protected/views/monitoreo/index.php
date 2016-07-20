<?php
/* @var $this EstacionController */
/* @var $dataProvider CActiveDataProvider */
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/css/monitoreo/monitoreo.css');
$cs->registerScriptFile($baseUrl.'/js/search.js');
$this->breadcrumbs=array(
    'Monitoreo Fijo',
);
?>

<h1>Monitoreo Fijo</h1>

<div class="principal">

    <div class="search-form" >
    <a href="estacion/create">
        <div class="agregar estacion"></div>
    </a>
    </div><!-- search-form -->

    <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'estacion',
            'summaryText'=>'',
            'dataProvider'=>Estacion::model()->search1(),
            'columns'=>Estacion::model()->adminSearch()
        )); 
    ?>
</div>