<?php
/* @var $this GranjasController */
/* @var $dataProvider CActiveDataProvider */
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $this->breadcrumbs=array(
            'Granjas',
    );
?>

<h1>Granjas</h1>
<div class="principal">
    <div class="search-form" >
    <?php $this->renderPartial('_search',array(
            'model'=>$model,
    )); ?>
        <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/granjas/create">
            <div class="agregar clientes"></div>
        </a>
    </div><!-- search-form -->
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'granjas-grid',
	'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
        'template' => "{items}{summary}{pager}",
        'enableSorting'=>true,
        'dataProvider'=>$model->search(),
        'columns'=>$model->adminSearch(),
        'pager' => array
        (
            'class' => 'PagerSA',
            'header'=>'',
        ),
)); ?>
</div>