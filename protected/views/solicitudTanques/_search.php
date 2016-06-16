<?php
/* @var $this SolicitudTanquesController */
/* @var $model SolicitudTanques */
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
		<?php echo $form->label($model,'id_solicitud'); ?>
		<?php echo $form->textField($model,'id_solicitud'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_tanque'); ?>
		<?php echo $form->textField($model,'id_tanque'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_domicilio'); ?>
		<?php echo $form->textField($model,'id_domicilio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_cepas'); ?>
		<?php echo $form->textField($model,'id_cepas'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cantidad_cepas'); ?>
		<?php echo $form->textField($model,'cantidad_cepas'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->