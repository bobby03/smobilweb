<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $cs->registerScriptFile($baseUrl.'/js/solicitudes/index.js');
    $cs->registerScriptFile($baseUrl.'/js/solicitudes/search.js');
    $cs->registerCssFile($baseUrl.'/css/solicitudes/index.css');
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $this->breadcrumbs=array('Solicitudes',);
    
?>

<h1>Solicitudes</h1>
<?php
//$a=SolicitudesViaje::model()->findByAttributes(array(74));
?>
<div class="principal">
    <input type='hidden' id='idviaje'>
    <div class="tabs">
        <div class="tab select" data-id="1"><span>Sin asignar</span></div>
        <div id="asignadas" class="tab" data-id="2"><span>Asignadas</span></div>
        <div class="tab" data-id="3"><span>En ruta</span></div>
        <div class="tab" data-id="4"><span>Finalizado</span></div>
    </div>
    <div class="tabContent" data-tan="1">
        <div class="search-form" ><!-- search-form -->
            <?php $this->renderPartial('_search',array(
                    'model'=>$model,
            )); ?>
            <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/solicitudes/create">
                <div class="agregar solicitudes"></div>
            </a>
        </div><!-- search-form -->    
    <?php $this->widget('zii.widgets.grid.CGridView', array
    (
        'id'=>'solicitudes-grid',
        'dataProvider'=>$model->searchStatus(0),
        'htmlOptions'=>array('class'=>'si-busqueda grid-view'),
        'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
        'emptyText'=>"No hay resistros",
        'template' => "{items}{summary}{pager}",
        'columns'=>$model->adminSearch1(),
        'pager' => array
        (
            'class' => 'PagerSA',
            'header'=>'',
        ),
        'afterAjaxUpdate' => "function(id,data)
        {
            $.fn.yiiGridView.update('solicitudes-grid2');
            $.fn.yiiGridView.update('solicitudes-grid3');
            $.fn.yiiGridView.update('solicitudes-grid4');
        }"
    //    'filter'=>$model,
    )); 
    ?>
    </div>
    
    <div class="tabContent hide" data-tan="2">
        <div class="search-form2" ><!-- search-form -->
            <?php $this->renderPartial('_search2',array(
                    'model'=>$model,
            )); ?>
            
        </div><!-- search-form --> 
    <?php $this->widget('zii.widgets.grid.CGridView', array
    (
        'id'=>'solicitudes-grid2',
        'dataProvider'=>$model->searchStatus(1),
        'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
        'emptyText'=>"No hay resistros",
        'template' => "{items}{summary}{pager}",
        'ajaxUpdate'=>true,
    //    'filter'=>$model,
        'columns'=>$model->adminSearch2(),
        'pager' => array
        (
            'class' => 'PagerSA',
            'header'=>'',
        )
    )); 
    ?>
    </div>

    <div class="tabContent hide" data-tan="3">
        <div class="search-form3" ><!-- search-form -->
            <?php $this->renderPartial('_search3',array(
                    'model'=>$model,
            )); ?>
        </div><!-- search-form --> 
    <?php $this->widget('zii.widgets.grid.CGridView', array
    (
        'id'=>'solicitudes-grid3',
        'dataProvider'=>$model->searchStatus(2),
        'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
        'emptyText'=>"No hay resistros",
        'template' => "{items}{summary}{pager}",
        'ajaxUpdate'=>true,
    //    'filter'=>$model,
        'columns'=>$model->adminSearch3(),
        'pager' => array
        (
            'class' => 'PagerSA',
            'header'=>'',
        )
    )); 
    ?>
    </div>
    <div class="tabContent hide" data-tan="4">
        <div class="search-form4" ><!-- search-form -->
            <?php $this->renderPartial('_search4',array(
                    'model'=>$model,
            )); ?>
        </div><!-- search-form --> 
    <?php $this->widget('zii.widgets.grid.CGridView', array
    (
        'id'=>'solicitudes-grid4',
        'dataProvider'=>$model->searchStatus(3),
        'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
        'emptyText'=>"No hay resistros",
        'template' => "{items}{summary}{pager}",
        'ajaxUpdate'=>true,
    //    'filter'=>$model,
        'columns'=>$model->adminSearch4(),
        'pager' => array
        (
            'class' => 'PagerSA',
            'header'=>'',
        )
    )); 
    ?>
    </div>
</div>

