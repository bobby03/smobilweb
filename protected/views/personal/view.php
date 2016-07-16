<?php
/* @var $this PersonalController */
/* @var $model Personal */

 $baseUrl = Yii::app()->baseUrl;
 $cs = Yii::app()->getClientScript();
 $cs->registerScriptFile($baseUrl.'/js/viewTable.js');

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
