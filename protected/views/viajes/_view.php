<?php
/* @var $this ViajesController */
/* @var $data Viajes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_clientes')); ?>:</b>
	<?php echo CHtml::encode($data->id_clientes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_responsable')); ?>:</b>
	<?php echo CHtml::encode($data->id_responsable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_salida')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_salida); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_salida')); ?>:</b>
	<?php echo CHtml::encode($data->hora_salida); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_entrega')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_entrega); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_entrega')); ?>:</b>
	<?php echo CHtml::encode($data->hora_entrega); ?>
	<br />

	*/ ?>

</div>