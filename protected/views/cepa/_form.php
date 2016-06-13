<?php
/* @var $this CepaController */
/* @var $model Cepa */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cepa-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_especie'); ?>
		<?php echo $form->textField($model,'id_especie'); ?>
		<?php echo $form->error($model,'id_especie'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_cepa'); ?>
		<?php echo $form->textField($model,'nombre_cepa',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nombre_cepa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'temp_min'); ?>
		<?php echo $form->textField($model,'temp_min'); ?>
		<?php echo $form->error($model,'temp_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'temp_max'); ?>
		<?php echo $form->textField($model,'temp_max'); ?>
		<?php echo $form->error($model,'temp_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ph_min'); ?>
		<?php echo $form->textField($model,'ph_min'); ?>
		<?php echo $form->error($model,'ph_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ph_max'); ?>
		<?php echo $form->textField($model,'ph_max'); ?>
		<?php echo $form->error($model,'ph_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ox_min'); ?>
		<?php echo $form->textField($model,'ox_min'); ?>
		<?php echo $form->error($model,'ox_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ox_max'); ?>
		<?php echo $form->textField($model,'ox_max'); ?>
		<?php echo $form->error($model,'ox_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidad'); ?>
		<?php echo $form->textField($model,'cantidad'); ?>
		<?php echo $form->error($model,'cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cond_min'); ?>
		<?php echo $form->textField($model,'cond_min'); ?>
		<?php echo $form->error($model,'cond_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cond_max'); ?>
		<?php echo $form->textField($model,'cond_max'); ?>
		<?php echo $form->error($model,'cond_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'orp_min'); ?>
		<?php echo $form->textField($model,'orp_min'); ?>
		<?php echo $form->error($model,'orp_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'orp_max'); ?>
		<?php echo $form->textField($model,'orp_max'); ?>
		<?php echo $form->error($model,'orp_max'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->