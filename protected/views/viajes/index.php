<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $cs->registerCssFile($baseUrl.'/css/viajes/index.css');
    $cs->registerScriptFile($baseUrl.'/js/viajes/index.js');
    $this->breadcrumbs=array(
	'Viajes',
    );
?>
<h1>Viajes</h1>

<div class="principal">
    <div class="add-wrapper">
         <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/viajes/create">
            <div class="agregar viaje"></div>
        </a>
    </div>
    <div class="tabs">
        <div class="tab select" data-id="1"><span>En espera</span></div>
        <div class="tab" data-id="2"><span>En ruta</span></div>
        <div class="tab" data-id="3"><span>Finalizado</span></div>
    </div>
      <div class="search-form" style="display:none;">
    <?php $this->renderPartial('_search',array(
            'model'=>$model,
    )); ?>

    </div><!-- search-form -->
    <div class="tabContent" data-tan="1">
    <?php $this->widget('zii.widgets.grid.CGridView', array
    (
        'id'=>'viaje1',
        'dataProvider'=>$model->searchStatus1(1),
        'summaryText'=> '',
    //    'filter'=>$model,
        'columns'=>$model->adminSearch1(),
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
    
    <div class="tabContent hide" data-tan="2">
    <?php $this->widget('zii.widgets.grid.CGridView', array
    (
        'id'=>'viaje2',
        'dataProvider'=>$model->searchStatus1(2),
        'summaryText'=> '',
    //    'filter'=>$model,
        'columns'=>$model->adminSearch2(),
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
    <?php $this->widget('zii.widgets.grid.CGridView', array
    (
        'id'=>'viaje3',
        'dataProvider'=>$model->searchStatus1(3),
        'summaryText'=> '',
    //    'filter'=>$model,
        'columns'=>$model->adminSearch3(),
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
