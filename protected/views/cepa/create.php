<?php
/* @var $this CepaController */
/* @var $model Cepa */

$this->breadcrumbs=array(
	'Cepas'=>array('index'),
	'Create',
);

?>

<h1>Create Cepa</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>