<?php
/* @var $this CampSensadoController */
/* @var $model CampSensado */

$this->breadcrumbs=array(
	'Siembra'=>array('index'),
	$model->id,
);


?>

<h1>View CampSensado #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_viaje',
		'id_responsable',
		'id_estacion',
		'nombre_camp',
		'fecha_inicio',
		'hora_inicio',
		'hora_inicio',
		'fecha_fin',
		'hora_fin',
		'activo',
	),
)); ?>
