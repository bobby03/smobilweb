<?php
/* @var $this EstacionController */
/* @var $model Estacion */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'estacion-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo'); ?>
		<?php echo $form->textField($model,'tipo'); ?>
		<?php echo $form->error($model,'tipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'identificador'); ?>
		<?php echo $form->textField($model,'identificador',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'identificador'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'no_personal'); ?>
		<?php echo $form->textField($model,'no_personal'); ?>
		<?php echo $form->error($model,'no_personal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'marca'); ?>
		<?php echo $form->textField($model,'marca',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'marca'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'color'); ?>
		<?php echo $form->textField($model,'color',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'color'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ubicacion'); ?>
		<?php echo $form->textField($model,'ubicacion',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'ubicacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'disponible'); ?>
		<?php echo $form->textField($model,'disponible'); ?>
		<?php echo $form->error($model,'disponible'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->textField($model,'activo'); ?>
		<?php echo $form->error($model,'activo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->