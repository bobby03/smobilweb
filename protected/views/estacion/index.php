<?php
/* @var $this EstacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Estacions',
);

$this->menu=array(
	array('label'=>'Create Estacion', 'url'=>array('create')),
	array('label'=>'Manage Estacion', 'url'=>array('admin')),
);
?>

<h1>Estacions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
