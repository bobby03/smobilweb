<?php
/* @var $this SolicitudesViajeController */
/* @var $model SolicitudesViaje */
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
		<?php echo $form->label($model,'id_personal'); ?>
		<?php echo $form->textField($model,'id_personal'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_viaje'); ?>
		<?php echo $form->textField($model,'id_viaje'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_solicitud'); ?>
		<?php echo $form->textField($model,'id_solicitud'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->