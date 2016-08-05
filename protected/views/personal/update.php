<?php
/* @var $this PersonalController */
/* @var $model Personal */

$this->breadcrumbs=array(
	'Personals'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Editar empleado <?php echo $model->nombre.' '.$model->apellido; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>