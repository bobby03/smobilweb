<?php
/* @var $this SolicitudesViajeController */
/* @var $data SolicitudesViaje */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_personal')); ?>:</b>
	<?php echo CHtml::encode($data->id_personal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_viaje')); ?>:</b>
	<?php echo CHtml::encode($data->id_viaje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_solicitud')); ?>:</b>
	<?php echo CHtml::encode($data->id_solicitud); ?>
	<br />


</div>