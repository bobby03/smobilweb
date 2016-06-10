<?php
/* @var $this ViajesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Viajes',
);

$this->menu=array(
	array('label'=>'Create Viajes', 'url'=>array('create')),
	array('label'=>'Manage Viajes', 'url'=>array('admin')),
);
?>

<h1>Viajes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
