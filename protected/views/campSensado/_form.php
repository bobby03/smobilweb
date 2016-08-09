<?php
/* @var $this CampSensadoController */
/* @var $model CampSensado */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'camp-sensado-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_viaje'); ?>
		<?php echo $form->textField($model,'id_viaje'); ?>
		<?php echo $form->error($model,'id_viaje'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_responsable'); ?>
		<?php echo $form->textField($model,'id_responsable'); ?>
		<?php echo $form->error($model,'id_responsable'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_estacion'); ?>
		<?php echo $form->textField($model,'id_estacion'); ?>
		<?php echo $form->error($model,'id_estacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_camp'); ?>
		<?php echo $form->textField($model,'nombre_camp',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nombre_camp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_inicio'); ?>
		<?php echo $form->textField($model,'fecha_inicio'); ?>
		<?php echo $form->error($model,'fecha_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hora_inicio'); ?>
		<?php echo $form->textField($model,'hora_inicio'); ?>
		<?php echo $form->error($model,'hora_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_fin'); ?>
		<?php echo $form->textField($model,'fecha_fin'); ?>
		<?php echo $form->error($model,'fecha_fin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hora_fin'); ?>
		<?php echo $form->textField($model,'hora_fin'); ?>
		<?php echo $form->error($model,'hora_fin'); ?>
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