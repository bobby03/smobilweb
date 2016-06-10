<?php
/* @var $this SolicitudesController */
/* @var $data Solicitudes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_clientes')); ?>:</b>
	<?php echo CHtml::encode($data->id_clientes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo')); ?>:</b>
	<?php echo CHtml::encode($data->codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_alta')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_alta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_alta')); ?>:</b>
	<?php echo CHtml::encode($data->hora_alta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_estimada')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_estimada); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_estimada')); ?>:</b>
	<?php echo CHtml::encode($data->hora_estimada); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_entrega')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_entrega); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_entrega')); ?>:</b>
	<?php echo CHtml::encode($data->hora_entrega); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notas')); ?>:</b>
	<?php echo CHtml::encode($data->notas); ?>
	<br />

	*/ ?>

</div>