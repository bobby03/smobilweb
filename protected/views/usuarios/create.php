<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */

$this->breadcrumbs=array(
	'Usuarioses'=>array('index'),
	'Create',
);
?>

<h1>Crear usuario</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>