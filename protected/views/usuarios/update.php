<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */

$this->breadcrumbs=array(
	'Usuarioses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Editar usuario <?php echo $model->usuario; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>