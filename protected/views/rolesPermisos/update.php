<?php
/* @var $this RolesPermisosController */
/* @var $model RolesPermisos */

$this->breadcrumbs=array(
	'Roles Permisoses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RolesPermisos', 'url'=>array('index')),
	array('label'=>'Create RolesPermisos', 'url'=>array('create')),
	array('label'=>'View RolesPermisos', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RolesPermisos', 'url'=>array('admin')),
);
?>

<h1>Update RolesPermisos <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>