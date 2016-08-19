<?php
/* @var $this CampSensadoController */
/* @var $model CampSensado */

$this->breadcrumbs=array(
	'Camp Sensados'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

// $this->menu=array(
// 	array('label'=>'List CampSensado', 'url'=>array('index')),
// 	array('label'=>'Create CampSensado', 'url'=>array('create')),
// 	array('label'=>'View CampSensado', 'url'=>array('view', 'id'=>$model->id)),
// 	array('label'=>'Manage CampSensado', 'url'=>array('admin')),
// );
?>

<h1>Update CampSensado <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'personal'=>$personal)); ?>