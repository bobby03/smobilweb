<?php
/* @var $this CepaController */
/* @var $dataProvider CActiveDataProvider */
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $cs->registerScriptFile($baseUrl.'/js/cepa/search.js');
    $cs->registerScriptFile($baseUrl.'/js/changeTab.js');


$this->breadcrumbs=array(
	'Cepas',
);
?>

<h1>Cepas de la especie <?php echo $especie->nombre;?></h1>
<div class="principal">

    <div class="tabs">
        <div class="tab select" data-id="1"><span>Activos</span></div>
        <div class="tab" data-id="2"><span>Inactivos</span></div>
    </div>

    <!--Activos-->
<div class="tabContent" data-tan="1"> 
    <div class="search-form" >
    <?php $this->renderPartial('_search',array(
            'model'=>$model,
    )); ?>
        <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/cepa/create/especie/<?php echo $id;?>">
            <div class="agregar cepa"></div>
        </a>
    </div><!-- search-form -->

    <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'cepa-grid',
            'dataProvider'=>$model->search($id,1),
            'htmlOptions'=>array('class'=>'si-busqueda grid-view'),
            'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
            'emptyText'=>"No hay registros",
            'template' => "{items}{summary}{pager}",
            'columns'=>$model->adminSearch(),
            'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
            'afterAjaxUpdate' => "function(id,data)
            {
                $.fn.yiiGridView.update('cepa-grid2');
            }"
        ));
    ?>
</div>
<!--Inactivos-->
<div class="tabContent hide" data-tan="2"> 
    <div class="search-form2" >
    <?php $this->renderPartial('_search2',array(
            'model'=>$model,
    )); ?>
    </div><!-- search-form -->
    <?php $this->widget('zii.widgets.grid.CGridView', array
    (
        'id'=>'cepa-grid2',
        'dataProvider'=>$model->search($id,0),
        'pager' => array
        (
            'class' => 'PagerSA',
            'header'=>'',
        ),
        'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
        'emptyText'=>"No hay registros",
        'template' => "{items}{summary}{pager}",
        'columns'=>$model->adminSearchBorrados(),
    )); ?>
</div>
    <a href="<?php echo $baseUrl.'/especie'; ?>" ><div class="gBoton" " >Regresar</div></a>


</div>

