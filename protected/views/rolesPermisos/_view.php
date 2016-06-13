<?php
/* @var $this RolesPermisosController */
/* @var $data RolesPermisos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_rol')); ?>:</b>
	<?php echo CHtml::encode($data->id_rol); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seccion')); ?>:</b>
	<?php echo CHtml::encode($data->seccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alta')); ?>:</b>
	<?php echo CHtml::encode($data->alta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('baja')); ?>:</b>
	<?php echo CHtml::encode($data->baja); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('consulta')); ?>:</b>
	<?php echo CHtml::encode($data->consulta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('edicion')); ?>:</b>
	<?php echo CHtml::encode($data->edicion); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />

	*/ ?>

</div>