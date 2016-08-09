<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $cs->registerCssFile($baseUrl.'/css/roles/roles.css');
    $cs->registerScriptFile($baseUrl.'/js/roles/roles.js');
    $cs->registerScriptFile($baseUrl.'/js/changeTab.js');
    $this->breadcrumbs=array(
	'Roles',
    );

?>

<h1>Roles</h1>

<div class="principal">
     <div class="tabs">
        <div class="tab select" data-id="1"><span>Activos</span></div>
        <div class="tab" data-id="2"><span>Inactivos</span></div>
    </div>

<div class="tabContent" data-tan="1"> <!--Activos-->
    <div class="search-form">
    <?php $this->renderPartial('_search',array(
            'model'=>$model,
    )); ?>
    <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/roles/create">
        <div class="agregar roles"></div>
    </a>
    </div><!-- search-form -->

    <?php $this->widget('zii.widgets.grid.CGridView', array
    (
        'id'=>'rol',
        'dataProvider'=>$model->search(1),
        'htmlOptions'=>array('class'=>'si-busqueda grid-view'),
        'pager' => array
        (
            'class' => 'PagerSA',
            'header'=>'',
        ),
        'template' => "{items}{summary}{pager}",
        'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
        'columns'=>$model->adminSearch(),
        'afterAjaxUpdate' => "function(id,data)
        {
            $('.items tbody tr').each(function()
            {
                var check = $(this).find('a.view').attr('href');
                var index = check.lastIndexOf('/');
                var id = parseInt(check.substring(index+1));
                if(id == 1 || id == 2 || id == 3)
                {
                    $(this).find('a').remove();
                }
                else
                    $(this).find('a.view').remove();
            });
        }"
    )); ?>
</div>

<div class="tabContent hide" data-tan="2"> <!--Inactivos-->

    <?php $this->widget('zii.widgets.grid.CGridView', array
    (
        'id'=>'rol2',
        'dataProvider'=>$model->search(0),
        'pager' => array
        (
            'class' => 'PagerSA',
            'header'=>'',
        ),
        'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
        'template' => "{items}{summary}{pager}",
        'columns'=>$model->adminSearchBorrados(),
    )); ?>
</div>


</div>