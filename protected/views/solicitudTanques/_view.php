<?php
/* @var $this SolicitudTanquesController */
/* @var $data SolicitudTanques */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_solicitud')); ?>:</b>
	<?php echo CHtml::encode($data->id_solicitud); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tanque')); ?>:</b>
	<?php echo CHtml::encode($data->id_tanque); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_domicilio')); ?>:</b>
	<?php echo CHtml::encode($data->id_domicilio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cepas')); ?>:</b>
	<?php echo CHtml::encode($data->id_cepas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidad_cepas')); ?>:</b>
	<?php echo CHtml::encode($data->cantidad_cepas); ?>
	<br />


</div>