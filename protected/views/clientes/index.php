<?php
/* @var $this ClientesController */
/* @var $dataProvider CActiveDataProvider */
 $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/clientes/cliente.css');
    $cs->registerScriptFile($baseUrl.'/js/search.js');


$this->breadcrumbs=array(
	'Clientes',
);
?>
<h1>Clientes</h1>

<div class="principal">
    <div class="search-form" >
    <?php $this->renderPartial('_search',array(
            'model'=>$model,
    )); ?>
        <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/clientes/create">
            <div class="agregar clientes"></div>
        </a>
    </div><!-- search-form -->

    <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'clientes-grid',
            'htmlOptions'=>array('class'=>'si-busqueda grid-view'),
            'dataProvider'=>$model->search(),
            'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
            'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
            'template' => "{items}{summary}{pager}",
            'columns'=>$model->adminSearch()
    )); ?>
</div>
