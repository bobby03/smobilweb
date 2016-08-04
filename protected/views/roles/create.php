<?php
/* @var $this RolesController */
/* @var $model Roles */

$this->breadcrumbs=array(
	'Roles'=>array('index'),
	'Create',
);


?>
<?php if($model->isNewRecord):?>
<h1>Crear rol</h1>
<?php else:?>
<h1>Editar rol <?php echo $model->nombre_rol;?></h1>
<?php endif;?>

<?php 
    $this->renderPartial('_form', array
    (
        'model'     => $model, 
        'acciones'  => $acciones
    )); 
?>