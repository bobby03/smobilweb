<?php
/* @var $this ClientesDomicilioController */
/* @var $model ClientesDomicilio */

$this->breadcrumbs=array(
	'Clientes Domicilios'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ClientesDomicilio', 'url'=>array('index')),
	array('label'=>'Create ClientesDomicilio', 'url'=>array('create')),
	array('label'=>'Update ClientesDomicilio', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ClientesDomicilio', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClientesDomicilio', 'url'=>array('admin')),
);
?>

<h1>View ClientesDomicilio #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_cliente',
		'domicilio',
		'ubicacion_mapa',
		'descripcion',
	),
)); ?>