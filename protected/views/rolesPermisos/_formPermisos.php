<?php
/* @var $this RolesPermisosController */
/* @var $model RolesPermisos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'roles-permisos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_rol'); ?>
		<?php echo $form->textField($model,'id_rol'); ?>
		<?php echo $form->error($model,'id_rol'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seccion'); ?>
		<?php echo $form->textField($model,'seccion'); ?>
		<?php echo $form->error($model,'seccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alta'); ?>
		<?php echo $form->textField($model,'alta'); ?>
		<?php echo $form->error($model,'alta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'baja'); ?>
		<?php echo $form->textField($model,'baja'); ?>
		<?php echo $form->error($model,'baja'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'consulta'); ?>
		<?php echo $form->textField($model,'consulta'); ?>
		<?php echo $form->error($model,'consulta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'edicion'); ?>
		<?php echo $form->textField($model,'edicion'); ?>
		<?php echo $form->error($model,'edicion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->textField($model,'activo'); ?>
		<?php echo $form->error($model,'activo'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->