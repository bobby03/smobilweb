<?php
/* @var $this ClientesController */
/* @var $model Clientes */

 $baseUrl = Yii::app()->baseUrl;
 $cs = Yii::app()->getClientScript();
 $cs->registerScriptFile($baseUrl.'/js/viewTable.js');

$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	$model->id,
);
?>

<h1>Ver clientes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'nullDisplay'=>'No hay datos disponibles',
	'attributes'=>array
        (
            'nombre_empresa',
            'nombre_contacto',
            'apellido_contacto',
            'correo',
            'rfc',
            'tel',
	),
)); ?>
