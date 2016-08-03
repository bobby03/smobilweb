<?php
/* @var $this SolicitudesController */
/* @var $model Solicitudes */

 $baseUrl = Yii::app()->baseUrl;
 $cs = Yii::app()->getClientScript();
 $cs->registerScriptFile($baseUrl.'/js/viewTable.js');

$this->breadcrumbs=array(
	'Solicitudes'=>array('index'),
	$model->id,
);
$model->id_clientes = Clientes::model()->getCliente($model->id_clientes);
?>

<h1>Ver solicitud #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'nullDisplay'=>'No hay datos disponibles',
	'attributes'=>array
        (
            'id_clientes',
            'codigo',
            'fecha_alta',
            'hora_alta',
            'fecha_estimada',
            'hora_estimada',
            'fecha_entrega',
            'hora_entrega',
            'notas',
	),
)); ?>
