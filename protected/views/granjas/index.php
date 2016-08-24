<?php
/* @var $this GranjasController */
/* @var $dataProvider CActiveDataProvider */
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $cs->registerScriptFile($baseUrl.'/js/granjas/search.js');
    $cs->registerCssFile($baseUrl.'/css/granjas/index.css');
    $this->breadcrumbs=array(
            'Granjas',
    );
?>
<script>
    $(document).ready(function()
    {
        $('.tab').click(function()
        {
            var id = $(this).attr('data-id');
            $('.tab').removeClass('select');
            $(this).addClass('select');
            $('.tabContent').addClass('hide');
            $('[data-tan="'+id+'"]').removeClass('hide');
        }); 
    });
</script>
<h1>Granjas</h1>
<div class="principal">
    <div class="tabs">
        <div class="tab select" data-id="1"><span>Activos</span></div>
        <div class="tab" data-id="2"><span>Inactivos</span></div>
    </div>
    <div class="tabContent" data-tan="1">
        <div class="search-form" >
            <?php $this->renderPartial('_search',array(
                    'model'=>$model,
            )); ?>
            <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/granjas/create">
                <div class="agregar granjas"></div>
            </a>
        </div><!-- search-form -->
        <?php $this->widget('zii.widgets.grid.CGridView', array
            (
                'id'=>'granjas-grid',
                'htmlOptions'=>array('class'=>'si-busqueda grid-view'),
                'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
                'emptyText'=>"No hay resistros",
                'template' => "{items}{summary}{pager}",
                'dataProvider'=>$model->search(1),
                'columns'=>$model->adminSearch(),
                'pager' => array
                (
                    'class' => 'PagerSA',
                    'header'=>'',
                ),
                'afterAjaxUpdate' => "function(id,data)
                {
                    $.fn.yiiGridView.update('granjas-grid2');
                }"
            )); ?>
    </div>
    <div class="tabContent hide" data-tan="2">
        <div class="search-form2" >
            <?php $this->renderPartial('_search2',array(
                    'model'=>$model,
            )); ?>
        </div><!-- search-form -->
        <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'granjas-grid2',
                'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
                'emptyText'=>"No hay resistros",
                'template' => "{items}{summary}{pager}",
                'ajaxUpdate'=>true,
                'dataProvider'=>$model->search(0),
                'columns'=>$model->adminSearchBorrados(),
                'pager' => array
                (
                    'class' => 'PagerSA',
                    'header'=>'',
                ),
        )); ?>
    </div>
</div>