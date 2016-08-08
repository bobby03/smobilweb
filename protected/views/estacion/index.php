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

<h1>Estaciones</h1>
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
        <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/estacion/create/tipo/1">
            <div class="agregar estacion"></div>
        </a>
        </div><!-- search-form -->

    <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'estacion-grid',
            'summaryText'=>'',
            'dataProvider'=>$model->search1(1,1),
            'columns'=>$model->adminSearch(),
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
            'dataProvider'=>$model->search1(1,0),
            'columns'=>$model->adminSearch(),
            'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
        )); 
    ?>
    </div>
</div>