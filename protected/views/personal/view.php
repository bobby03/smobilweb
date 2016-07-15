<?php
/* @var $this PersonalController */
/* @var $model Personal */

$this->breadcrumbs=array(
	'Personals'=>array('index'),
	$model->id,
);
?>

<h1>View Personal #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'apellido',
		'tel',
		'rfc',
		'domicilio',
		'id_rol',
		'correo',
		'puesto',
	),
)); ?>
