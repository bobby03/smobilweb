<?php
/* @var $this CepaController */
/* @var $dataProvider CActiveDataProvider */
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/search.js');


$this->breadcrumbs=array(
	'Cepas',
);

$this->menu=array(
	array('label'=>'Create Cepa', 'url'=>array('create')),
	array('label'=>'Manage Cepa', 'url'=>array('admin')),
);
?>

<h1>Cepas</h1>


<div class="search-form" >
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cepa',
	'filter'=>$model,
	'dataProvider'=>$model->search(),
	'summaryText'=> '',
	'columns'=>$model->adminSearch()
)); ?>

