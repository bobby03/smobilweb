<?php
/* @var $this EscalonViajeUbicacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Escalon Viaje Ubicacions',
);

$this->menu=array(
	array('label'=>'Create EscalonViajeUbicacion', 'url'=>array('create')),
	array('label'=>'Manage EscalonViajeUbicacion', 'url'=>array('admin')),
);
?>

<h1>Escalon Viaje Ubicacions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
