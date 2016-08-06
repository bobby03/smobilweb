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

<h1>Cepas de la especie <?php echo $especie->nombre;?></h1>
<div class="principal">
    <div class="search-form" >
    <?php $this->renderPartial('_search',array(
            'model'=>$model,
    )); ?>
        <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/cepa/create/especie/<?php echo $id;?>">
            <div class="agregar cepa"></div>
        </a>
    </div><!-- search-form -->

    <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'cepa',
            'dataProvider'=>$model->search($id),
            'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
            'template' => "{items}{summary}{pager}",
            'columns'=>$model->adminSearch(),
            'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
        ));
    ?>
    
</div>
