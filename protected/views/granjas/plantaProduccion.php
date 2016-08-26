<?php
/* @var $this EstacionController */
/* @var $dataProvider CActiveDataProvider */
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/css/estacion/estacion.css');
$cs->registerScriptFile($baseUrl.'/js/estacion/create.js');
$cs->registerScriptFile($baseUrl.'/js/search.js');
$cs->registerScriptFile($baseUrl.'/js/granjas/searchPlanta.js');
$this->breadcrumbs=array(
	'Estaciones',
);
?>
<h1>Plantas de producci&oacute;n</h1>
<div class="principal">
    <div class="tabs">
        <div class="tab select" data-id="1"><span>Activos</span></div>
        <div class="tab" data-id="2"><span>Inactivos</span></div>
    </div>



    <div class="tabContent" data-tan="1"> <!--Activos-->
        <div class="search-form" >
            <?php $this->renderPartial('_searchPlanta',array(
                    'model'=>$model,
            )); ?>
            <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/granjas/nuevaPlanta/<?php echo $id;?>">
                <div class="agregar planta"></div>
            </a>
        </div><!-- search-form -->
    <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'estacion-grid',
            'htmlOptions'=>array('class'=>'si-busqueda grid-view'),
            'dataProvider'=>$model->searchTanqueGranja($id,1),
            'columns'=>$model->adminSearchPlanta(),
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
                $.fn.yiiGridView.update('estacion-grid2');
            }"
        )); 
    ?>
    </div>
    <div class="tabContent hide" data-tan="2"> <!--Inactivos-->
        <div class="search-form2" >
            <?php $this->renderPartial('_searchPlanta2',array(
                    'model'=>$model,
            )); ?>
        </div><!-- search-form -->
        <?php $this->widget('zii.widgets.grid.CGridView', array
            (
                'id'=>'estacion-grid2',
                'summaryText'=>'',
                'ajaxUpdate'=>true,
                'dataProvider'=>$model->searchTanqueGranja($id,0),
                'columns'=>$model->adminSearchPlantaVacio(),
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

    </div><a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/granjas">Regresar</a> 
</div>