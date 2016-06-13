<?php
/* @var $this RolesPermisosController */
/* @var $model RolesPermisos */

$this->breadcrumbs=array(
	'Roles Permisoses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RolesPermisos', 'url'=>array('index')),
	array('label'=>'Create RolesPermisos', 'url'=>array('create')),
	array('label'=>'Update RolesPermisos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RolesPermisos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RolesPermisos', 'url'=>array('admin')),
);
?>

<h1>View RolesPermisos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_rol',
		'seccion',
		'alta',
		'baja',
		'consulta',
		'edicion',
		'activo',
	),
)); ?>
