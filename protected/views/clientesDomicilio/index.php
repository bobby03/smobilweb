<?php
/* @var $this ClientesDomicilioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Clientes Domicilios',
);

$this->menu=array(
	array('label'=>'Create ClientesDomicilio', 'url'=>array('create')),
	array('label'=>'Manage ClientesDomicilio', 'url'=>array('admin')),
);
?>

<h1>Clientes Domicilios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
