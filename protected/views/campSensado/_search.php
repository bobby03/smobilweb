<?php
/* @var $this CampSensadoController */
/* @var $model CampSensado */
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
		<?php echo $form->label($model,'id_viaje'); ?>
		<?php echo $form->textField($model,'id_viaje'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_responsable'); ?>
		<?php echo $form->textField($model,'id_responsable'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_estacion'); ?>
		<?php echo $form->textField($model,'id_estacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_camp'); ?>
		<?php echo $form->textField($model,'nombre_camp',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_inicio'); ?>
		<?php echo $form->textField($model,'fecha_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora_inicio'); ?>
		<?php echo $form->textField($model,'hora_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_fin'); ?>
		<?php echo $form->textField($model,'fecha_fin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora_fin'); ?>
		<?php echo $form->textField($model,'hora_fin'); ?>
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