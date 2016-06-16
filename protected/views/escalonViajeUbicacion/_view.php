<?php
/* @var $this EscalonViajeUbicacionController */
/* @var $data EscalonViajeUbicacion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estacion')); ?>:</b>
	<?php echo CHtml::encode($data->id_estacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_viaje')); ?>:</b>
	<?php echo CHtml::encode($data->id_viaje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tanque')); ?>:</b>
	<?php echo CHtml::encode($data->id_tanque); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ubicacion')); ?>:</b>
	<?php echo CHtml::encode($data->ubicacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora')); ?>:</b>
	<?php echo CHtml::encode($data->hora); ?>
	<br />


</div>