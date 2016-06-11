<?php
/* @var $this EspecieController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Especies',
);

$this->menu=array(
	array('label'=>'Create Especie', 'url'=>array('create')),
	array('label'=>'Manage Especie', 'url'=>array('admin')),
);
?>

<h1>Especies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
