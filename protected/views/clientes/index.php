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

$this->menu=array(
	array('label'=>'Create Clientes', 'url'=>array('create'))
);
?>

<h1>Clientes</h1>

<div class="principal">
    <div class="search-form" >
    <?php $this->renderPartial('_search',array(
            'model'=>$model,
    )); ?>
    </div><!-- search-form -->

    <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'cliente',
            'dataProvider'=>$model->search(),

            'summaryText'=> '',
            'columns'=>$model->adminSearch()
    )); ?>
</div>
