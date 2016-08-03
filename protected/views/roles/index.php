<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/roles/roles.css');
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $cs->registerScriptFile($baseUrl.'/js/roles/roles.js');
    $this->breadcrumbs=array(
	'Roles',
    );
?>

<h1>Roles</h1>
<div class="principal">
    <div class="search-form">
    <?php $this->renderPartial('_search',array(
            'model'=>$model,
    )); ?>
    <a href="roles/create">
        <div class="agregar roles"></div>
    </a>
    </div><!-- search-form -->

    <?php $this->widget('zii.widgets.grid.CGridView', array
    (
        'id'=>'rol',
        'dataProvider'=>$model->search(),

        'summaryText'=> '',
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