<?php
/* @var $this EscalonViajeUbicacionController */
/* @var $model EscalonViajeUbicacion */

$this->breadcrumbs=array(
	'Escalon Viaje Ubicacions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EscalonViajeUbicacion', 'url'=>array('index')),
	array('label'=>'Create EscalonViajeUbicacion', 'url'=>array('create')),
	array('label'=>'View EscalonViajeUbicacion', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EscalonViajeUbicacion', 'url'=>array('admin')),
);
?>

<h1>Update EscalonViajeUbicacion <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>