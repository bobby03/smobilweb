<?php
/* @var $this RolesPermisosController */
/* @var $model RolesPermisos */

$this->breadcrumbs=array(
	'Roles Permisoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RolesPermisos', 'url'=>array('index')),
	array('label'=>'Manage RolesPermisos', 'url'=>array('admin')),
);
?>

<h1>Create RolesPermisos</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>