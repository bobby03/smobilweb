<?php
/* @var $this SolicitudTanquesController */
/* @var $model SolicitudTanques */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'solicitud-tanques-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_solicitud'); ?>
		<?php echo $form->textField($model,'id_solicitud'); ?>
		<?php echo $form->error($model,'id_solicitud'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_tanque'); ?>
		<?php echo $form->textField($model,'id_tanque'); ?>
		<?php echo $form->error($model,'id_tanque'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_domicilio'); ?>
		<?php echo $form->textField($model,'id_domicilio'); ?>
		<?php echo $form->error($model,'id_domicilio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cepas'); ?>
		<?php echo $form->textField($model,'id_cepas'); ?>
		<?php echo $form->error($model,'id_cepas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidad_cepas'); ?>
		<?php echo $form->textField($model,'cantidad_cepas'); ?>
		<?php echo $form->error($model,'cantidad_cepas'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->