<?php
/* @var $this SolicitudesController */
/* @var $model Solicitudes */

$this->breadcrumbs=array(
	'Solicitudes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Continuar solicitud #<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array
    (
        'model'=>$model,
        'pedidos'=>$pedidos,
        'direccion'=>$direccion,
        'especies'=>$especies,
        'cepa'=>$cepa,
        'estacion'=>$estacion,
    )); ?>