<?php
/* @var $this GranjasController */
/* @var $model Granjas */

    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/viewTable.js');
    $cs->registerScriptFile($baseUrl.'/js/clientes/view.js');
    $cs->registerCssFile($baseUrl.'/css/clientes/create.css');
$this->breadcrumbs=array(
	'Granjases'=>array('index'),
	$model->id,
);
?>

<h1>View Granjas <?php echo $model->nombre; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'direccion',
		'responsable',
	),
)); ?>
