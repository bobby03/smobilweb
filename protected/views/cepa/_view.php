<?php
/* @var $this CepaController */
/* @var $data Cepa */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_especie')); ?>:</b>
	<?php echo CHtml::encode($data->id_especie); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_cepa')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_cepa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('temp_min')); ?>:</b>
	<?php echo CHtml::encode($data->temp_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('temp_max')); ?>:</b>
	<?php echo CHtml::encode($data->temp_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ph_min')); ?>:</b>
	<?php echo CHtml::encode($data->ph_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ph_max')); ?>:</b>
	<?php echo CHtml::encode($data->ph_max); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ox_min')); ?>:</b>
	<?php echo CHtml::encode($data->ox_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ox_max')); ?>:</b>
	<?php echo CHtml::encode($data->ox_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidad')); ?>:</b>
	<?php echo CHtml::encode($data->cantidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cond_min')); ?>:</b>
	<?php echo CHtml::encode($data->cond_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cond_max')); ?>:</b>
	<?php echo CHtml::encode($data->cond_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orp_min')); ?>:</b>
	<?php echo CHtml::encode($data->orp_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orp_max')); ?>:</b>
	<?php echo CHtml::encode($data->orp_max); ?>
	<br />

	*/ ?>

</div>