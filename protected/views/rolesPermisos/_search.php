<?php
/* @var $this RolesPermisosController */
/* @var $model RolesPermisos */
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
		<?php echo $form->label($model,'id_rol'); ?>
		<?php echo $form->textField($model,'id_rol'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'seccion'); ?>
		<?php echo $form->textField($model,'seccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'alta'); ?>
		<?php echo $form->textField($model,'alta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'baja'); ?>
		<?php echo $form->textField($model,'baja'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'consulta'); ?>
		<?php echo $form->textField($model,'consulta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'edicion'); ?>
		<?php echo $form->textField($model,'edicion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'activo'); ?>
		<?php echo $form->textField($model,'activo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->