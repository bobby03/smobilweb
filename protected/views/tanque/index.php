<?php
/* @var $this TanqueController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tanques',
);

$this->menu=array(
	array('label'=>'Create Tanque', 'url'=>array('create'))
);
?>

<h1>Tanques</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
