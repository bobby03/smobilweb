<?php
/* @var $this SolicitudTanquesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Solicitud Tanques',
);

$this->menu=array(
	array('label'=>'Create SolicitudTanques', 'url'=>array('create')),
	array('label'=>'Manage SolicitudTanques', 'url'=>array('admin')),
);
?>

<h1>Solicitud Tanques</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
