<?php
/* @var $this SolicitudTanquesController */
/* @var $model SolicitudTanques */

$this->breadcrumbs=array(
	'Solicitud Tanques'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SolicitudTanques', 'url'=>array('index')),
	array('label'=>'Create SolicitudTanques', 'url'=>array('create')),
	array('label'=>'View SolicitudTanques', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SolicitudTanques', 'url'=>array('admin')),
);
?>

<h1>Update SolicitudTanques <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>