<?php
/* @var $this CepaController */
/* @var $model Cepa */

$this->breadcrumbs=array(
	'Cepas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Cepa', 'url'=>array('index')),
	array('label'=>'Create Cepa', 'url'=>array('create')),
	array('label'=>'View Cepa', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Cepa', 'url'=>array('admin')),
);
?>

<h1>Update Cepa <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>