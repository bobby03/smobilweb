<?php
/* @var $this ViajesController */
/* @var $model Viajes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<div class="row" data-id="1">
		<?php echo $form->textField($model,'id_solicitudes'); ?>
	</div>

	<div class="row" data-id="2">
		<?php echo $form->textField($model,'id_responsable'); ?>
	</div>

	<div class="row" data-id="3">
		<?php echo $form->textField($model,'status',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row" data-id="4">
		<?php echo $form->textField($model,'fecha_salida'); ?>
	</div>

	<div class="row" data-id="5">
		<?php echo $form->textField($model,'hora_salida'); ?>
	</div>

	<div class="row" data-id="6">
		<?php echo $form->textField($model,'fecha_entrega'); ?>
	</div>

	<div class="row" data-id="7">
		<?php echo $form->textField($model,'hora_entrega'); ?>
	</div>

	<div class="row buttons hide">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->