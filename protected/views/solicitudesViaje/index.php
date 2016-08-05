<?php
/* @var $this SolicitudesViajeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Solicitudes Viajes',
);

$this->menu=array(
	array('label'=>'Create SolicitudesViaje', 'url'=>array('create')),
	array('label'=>'Manage SolicitudesViaje', 'url'=>array('admin')),
);
?>

<h1>Solicitudes Viajes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
