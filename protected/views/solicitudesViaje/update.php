<?php
/* @var $this SolicitudesViajeController */
/* @var $model SolicitudesViaje */

$this->breadcrumbs=array(
	'Solicitudes Viajes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SolicitudesViaje', 'url'=>array('index')),
	array('label'=>'Create SolicitudesViaje', 'url'=>array('create')),
	array('label'=>'View SolicitudesViaje', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SolicitudesViaje', 'url'=>array('admin')),
);
?>

<h1>Update SolicitudesViaje <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>