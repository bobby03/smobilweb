<?php
/* @var $this EstacionController */
/* @var $dataProvider CActiveDataProvider */
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/css/estacion/estacion.css');
$cs->registerScriptFile($baseUrl.'/js/search.js');
$this->breadcrumbs=array(
	'Estacions',
);

$this->menu=array(
	array('label'=>'Create Estacion', 'url'=>array('create'))
);
?>

<h1>Estaciones</h1>
<div class="principal">

    <div class="search-form" >
    <?php $this->renderPartial('_search',array(
            'model'=>$model,
    )); ?>
    </div><!-- search-form -->

    <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'estacion',
            'summaryText'=>'',
            'dataProvider'=>$model->search(),
            'columns'=>$model->adminSearch()
        )); 
    ?>
</div>