<?php
/* @var $this GranjasController */
/* @var $model Granjas */

$this->breadcrumbs=array(
	'Granjases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Editar Granja <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>