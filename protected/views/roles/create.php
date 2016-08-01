<?php
/* @var $this RolesController */
/* @var $model Roles */

$this->breadcrumbs=array(
	'Roles'=>array('index'),
	'Create',
);


?>

<h1>Create Roles</h1>

<?php 
    $this->renderPartial('_form', array
    (
        'model'     => $model, 
        'acciones'  => $acciones
    )); 
?>