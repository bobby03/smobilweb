<?php
/* @var $this EscalonViajeUbicacionController */
/* @var $model EscalonViajeUbicacion */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'escalon-viaje-ubicacion-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_estacion'); ?>
		<?php echo $form->textField($model,'id_estacion'); ?>
		<?php echo $form->error($model,'id_estacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_viaje'); ?>
		<?php echo $form->textField($model,'id_viaje'); ?>
		<?php echo $form->error($model,'id_viaje'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_tanque'); ?>
		<?php echo $form->textField($model,'id_tanque'); ?>
		<?php echo $form->error($model,'id_tanque'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ubicacion'); ?>
		<?php echo $form->textField($model,'ubicacion',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'ubicacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hora'); ?>
		<?php echo $form->textField($model,'hora'); ?>
		<?php echo $form->error($model,'hora'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->