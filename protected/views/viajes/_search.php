<?php
/* @var $this ViajesController */
/* @var $model Viajes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_clientes'); ?>
		<?php echo $form->textField($model,'id_clientes'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_responsable'); ?>
		<?php echo $form->textField($model,'id_responsable'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_salida'); ?>
		<?php echo $form->textField($model,'fecha_salida'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora_salida'); ?>
		<?php echo $form->textField($model,'hora_salida'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_entrega'); ?>
		<?php echo $form->textField($model,'fecha_entrega'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora_entrega'); ?>
		<?php echo $form->textField($model,'hora_entrega'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->