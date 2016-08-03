<?php
/* @var $this CepaController */
/* @var $dataProvider CActiveDataProvider */
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    
    $cs->registerScriptFile($baseUrl.'/js/search.js');


$this->breadcrumbs=array(
	'Cepas',
);
?>

<h1>Cepas</h1>
<div class="principal">
    <div class="search-form" >
    <?php $this->renderPartial('_search',array(
            'model'=>$model,
    )); ?>
        <a href="cepa/create?especie=<?php echo $id;?>">
            <div class="agregar cepa"></div>
        </a>
    </div><!-- search-form -->

    <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'cepa',
            'dataProvider'=>$model->search($id),
            'summaryText'=> '',
            'columns'=>$model->adminSearch()
        ));
    ?>
    
</div>
