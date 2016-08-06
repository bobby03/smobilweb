<?php
/* @var $this EstacionController */
/* @var $dataProvider CActiveDataProvider */
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/css/estacion/estacion.css');
$cs->registerScriptFile($baseUrl.'/js/search.js');
$this->breadcrumbs=array(
	'Estaciones',
);
?>

<h1>Estaciones</h1>
<div class="principal">

    <div class="search-form" >
    <?php $this->renderPartial('_search',array(
            'model'=>$model,
    )); ?>
    <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/estacion/create/tipo/1">
        <div class="agregar estacion"></div>
    </a>
    </div><!-- search-form -->

    <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'estacion-grid',
            'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
            'template' => "{items}{summary}{pager}",
            'dataProvider'=>$model->search1(1),
            'columns'=>$model->adminSearch(),
            'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
        )); 
    ?>
</div>