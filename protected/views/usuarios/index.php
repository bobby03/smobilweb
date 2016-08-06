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
        <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/usuarios/create">
            <div class="agregar usuarios"></div>
        </a>
    </div>

<?php $this->widget('zii.widgets.grid.CGridView', array
(
    'id'=>'usuario',
    'dataProvider'=>$model->search(),
    'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
    'template' => "{items}{summary}{pager}",
    'columns'=>$model->adminSearch(),
    'pager' => array
    (
        'class' => 'PagerSA',
        'header'=>'',
    )
)); ?>
</div>