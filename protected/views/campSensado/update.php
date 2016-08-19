<?php
/* @var $this CampSensadoController */
/* @var $model CampSensado */

$this->breadcrumbs=array(
	'Camp Sensados'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);
?>

<h1>Actualizar siembra <?php echo $model->nombre_camp; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'personal'=>$personal, 'granjas'=>$granjas, 'update'=>$update)); ?>