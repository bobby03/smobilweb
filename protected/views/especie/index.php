<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/especie/especie.css');
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $cs->registerScriptFile($baseUrl.'/js/especie/especie.js');


    $this->breadcrumbs=array(
	'Especies',
    )
?>

<h1>Especies</h1>
<div class="principal">
    <div class="search-form" >
        <?php $this->renderPartial('_search',array(
                'model'=>$model,
        )); ?>
        <a href="especie/create">
            <div class="agregar especie"></div>
        </a>
    </div><!-- search-form -->
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'especies-grid',
        'dataProvider'=>$model->search(),

        'summaryText'=>'',
        'columns'=>$model->adminSearch(),
        'afterAjaxUpdate' => "function(id,data)
        {
            $('.items tbody tr').each(function()
            {
                $(this).find('a.view').remove();
            });
        }"
    )); ?>
    <?php // $this->widget('zii.widgets.CListView', array(
    //    'dataProvider'=>$dataProvider,
    //    'itemView'=>'_view',
    //)); ?>
</div>