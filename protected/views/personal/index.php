<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/personal/index.css');
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $this->breadcrumbs=array(
        'Personals',
    );
?>


<h1>Empleados</h1>

<div class="principal">
    <div class="search-form" >
    <?php $this->renderPartial('_search',array(
            'model'=>$model,
    )); ?>
    <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/personal/create">
        <div class="agregar personal"></div>
    </a>
    </div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array
(
    'id'=>'personal-grid',
    'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
    'template' => "{items}{summary}{pager}",
    'pager' => array
    (
        'class' => 'PagerSA',
        'header'=>'',
    ),
    'dataProvider'=>$model->search(),
    'columns'=>$model->adminSearch()
)); 
?>
</div>