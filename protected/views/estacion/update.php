<?php
/* @var $this EstacionController */
/* @var $model Estacion */

$this->breadcrumbs=array(
	'Estacions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Editar estaci&oacute;n <?php echo $model->identificador; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>