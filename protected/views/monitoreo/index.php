<?php
/* @var $this EstacionController */
/* @var $dataProvider CActiveDataProvider */
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/css/estacion/estacion.css');
$cs->registerScriptFile($baseUrl.'/js/search.js');
$this->breadcrumbs=array(
    'Monitoreo Fijo',
);
?>

<h1>Monitoreo Fijo</h1>

<div class="principal">

    <div class="search-form" >
    <a href="estacion/create/2">
        <div class="agregar estacion"></div>
    </a>
    </div><!-- search-form -->

    <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'estacion',
            'summaryText'=>'',
            'enableSorting'=>false,
            'dataProvider'=>Estacion::model()->search1(),
            'columns'=>Estacion::model()->adminSearch2()
        )); 
    ?>
</div>