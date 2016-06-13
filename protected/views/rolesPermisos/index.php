<?php
/* @var $this RolesPermisosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Roles Permisoses',
);

$this->menu=array(
	array('label'=>'Create RolesPermisos', 'url'=>array('create')),
	array('label'=>'Manage RolesPermisos', 'url'=>array('admin')),
);
?>

<h1>Roles Permisoses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
