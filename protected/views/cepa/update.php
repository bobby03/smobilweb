<?php
/* @var $this CepaController */
/* @var $model Cepa */

$this->breadcrumbs=array(
	'Cepas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);


?>

<h1>Editar cepa</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>