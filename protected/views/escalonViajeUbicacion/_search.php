<?php
/* @var $this EscalonViajeUbicacionController */
/* @var $model EscalonViajeUbicacion */
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
		<?php echo $form->label($model,'id_estacion'); ?>
		<?php echo $form->textField($model,'id_estacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_viaje'); ?>
		<?php echo $form->textField($model,'id_viaje'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_tanque'); ?>
		<?php echo $form->textField($model,'id_tanque'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ubicacion'); ?>
		<?php echo $form->textField($model,'ubicacion',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora'); ?>
		<?php echo $form->textField($model,'hora'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->