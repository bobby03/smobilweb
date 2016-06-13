<?php
/* @var $this CepaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cepas',
);

$this->menu=array(
	array('label'=>'Create Cepa', 'url'=>array('create')),
	array('label'=>'Manage Cepa', 'url'=>array('admin')),
);
?>

<h1>Cepas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
