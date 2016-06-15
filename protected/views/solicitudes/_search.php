<?php
/* @var $this SolicitudesController */
/* @var $model Solicitudes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_clientes'); ?>
		<?php echo $form->textField($model,'id_clientes'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_alta'); ?>
		<?php echo $form->textField($model,'fecha_alta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora_alta'); ?>
		<?php echo $form->textField($model,'hora_alta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_estimada'); ?>
		<?php echo $form->textField($model,'fecha_estimada'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora_estimada'); ?>
		<?php echo $form->textField($model,'hora_estimada'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_entrega'); ?>
		<?php echo $form->textField($model,'fecha_entrega'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora_entrega'); ?>
		<?php echo $form->textField($model,'hora_entrega'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notas'); ?>
		<?php echo $form->textField($model,'notas',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->