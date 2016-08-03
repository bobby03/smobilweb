<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/usuarios/usuarios.css');
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $cs->registerScriptFile($baseUrl.'/js/usuarios/index.js');
    $this->breadcrumbs=array(
	'Usuarioses',
    );
?>

<h1>Usuarios</h1>

<div class="principal">
    <div class="search-form" >
    <?php $this->renderPartial('_search',array(
            'model'=>$model,
    )); ?>
    <a href="usuarios/create">
        <div class="agregar usuarios"></div>
    </a>
    </div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array
(
    'id'=>'usuario',
    'dataProvider'=>$model->search(),
    'summaryText'=> '',
    'columns'=>$model->adminSearch(),
    'afterAjaxUpdate' => "function(id,data)
    {
        $('.items tbody tr').each(function()
        {
            $(this).find('a.view').remove();
        });
    }"
)); ?>
</div>