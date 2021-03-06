<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
//    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $cs->registerCssFile($baseUrl.'/css/viajes/index.css');
    $cs->registerScriptFile($baseUrl.'/js/viajes/index.js');
    $this->breadcrumbs=array(
	'Viajes',
    );
?>
<h1>Viajes</h1>
<div class="principal">
    <div class="tabs">
        <div class="tab select" data-id="1"><span>En espera</span></div>
        <div class="tab" data-id="2"><span>En ruta</span></div>
        <div class="tab" data-id="3"><span>Finalizado</span></div>
    </div>
    <div class="tabContent" data-tan="1">
        <div class="search-form">
            <?php $this->renderPartial('_search',array(
                    'model'=>$model,
            )); ?>
            <?php if(Yii::app()->user->getTipoUsuario()!=1):?>
                <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/index.php/viajes/crear">
                    <div class="agregar viaje"></div>
                </a>
            <?php endif;?>
        </div><!-- search-form -->
        <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'viaje1',
            'dataProvider'=>$model->searchStatus1(1),
            'htmlOptions'=>array('class'=>'si-busqueda grid-view','data-id'=>1),
            'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
            'emptyText'=>"No hay registros",
            'template' => "{items}{summary}{pager}",
            'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
        //    'filter'=>$model,
            'columns'=>$model->adminSearch1()
        )); 
        ?>
    </div>
    <div class="tabContent hide" data-tan="2">
        <div class="search-form">
            <?php $this->renderPartial('_search2',array(
                    'model'=>$model,
            )); ?>
        </div><!-- search-form -->
        <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'viaje2',
            'dataProvider'=>$model->searchStatus1(2),
            'htmlOptions'=>array('data-id'=>2),
            'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
            'emptyText'=>"No hay registros",
            'template' => "{items}{summary}{pager}",
        //    'filter'=>$model,
            'columns'=>$model->adminSearch2(),
            'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
            'afterAjaxUpdate' => "function(id,data)
            {
                $('.items tbody tr').each(function()
                {
                    $(this).find('a.delete').remove();
                });
            }"
        )); 
        ?>
    </div>
    <div class="tabContent hide" data-tan="3">
        <div class="search-form">
            <?php $this->renderPartial('_search3',array(
                    'model'=>$model,
            )); ?>
        </div><!-- search-form -->
        <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'viaje3',
            'dataProvider'=>$model->searchStatus1(3),
            'htmlOptions'=>array('data-id'=>3),
            'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
            'emptyText'=>"No hay registros",
            'template' => "{items}{summary}{pager}",
        //    'filter'=>$model,
            'columns'=>$model->adminSearch3(),
            'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
            'afterAjaxUpdate' => "function(id,data)
            {
                $('.items tbody tr').each(function()
                {
                    $(this).find('a.delete').remove();
                });
            }"
        )); 
        ?>
    </div>
</div>
