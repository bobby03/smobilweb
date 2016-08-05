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

    <a href="<?php echo $baseUrl;?>/estacion/create?tipo=2">
        <div class="agregar estacion"></div>
    </a>
    </div><!-- search-form -->

    <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'estacion-grid',
            'summaryText'=>'',
            'enableSorting'=>true,
            'dataProvider'=>Estacion::model()->search1(2),
            'columns'=>Estacion::model()->adminSearch1(),
            'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
        )); 
    ?>
</div>