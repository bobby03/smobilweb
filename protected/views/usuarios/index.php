<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/usuarios/usuarios.css');
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $this->breadcrumbs=array(
	'Usuarioses',
    );

    $this->menu=array(
	array('label'=>'Create Usuarios', 'url'=>array('create'))
    );
?>

<h1>Usuarios</h1>

<div class="principal">
<div class="search-form" >
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array
(
    'id'=>'usuario',
    'dataProvider'=>$model->search(),
    'summaryText'=> '',
   
    'columns'=>$model->adminSearch()
)); ?>
</div>