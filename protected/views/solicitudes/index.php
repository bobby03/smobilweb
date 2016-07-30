<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $cs->registerScriptFile($baseUrl.'/js/solicitudes/index.js');
    $this->breadcrumbs=array('Solicitudes');
    
?>

<h1>Solicitudes</h1>
<div class="principal">
   <div class="search-form" >
    <?php 
            $this->renderPartial('_search',array(
	       'model'=>$model,)); 


    ?>

    <a href="solicitudes/create">
        <div class="agregar solicitudes"></div>
    </a>

    </div>

    <?php $this->widget('zii.widgets.grid.CGridView', array
    (
        'id'=>'solicitud',
        'dataProvider'=>$model->search(),
        'summaryText'=> '',
        'columns'=>$model->adminSearch(),
        'afterAjaxUpdate' => "function(id,data)
        {
            $('tr td:nth-child(2)').each(function()
            {
                var texto = $(this).text();
                var columna = $(this).siblings('.button-column');
                var index = texto.indexOf('proceso');
                if(index == -1)
                {
                    columna.find('a.update').remove();
                    columna.find('a.delete').remove();
                }
            });
        }"
    )); ?>
</div>
