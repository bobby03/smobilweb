<?php
/* @var $this ClientesDomicilioController */
/* @var $model ClientesDomicilio */

$this->breadcrumbs=array(
	'Clientes Domicilios'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClientesDomicilio', 'url'=>array('index')),
	array('label'=>'Create ClientesDomicilio', 'url'=>array('create')),
	array('label'=>'View ClientesDomicilio', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ClientesDomicilio', 'url'=>array('admin')),
);
?>

<h1>Update ClientesDomicilio <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>