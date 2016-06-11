<?php
/* @var $this CepaController */
/* @var $model Cepa */
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
		<?php echo $form->label($model,'id_especie'); ?>
		<?php echo $form->textField($model,'id_especie'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_cepa'); ?>
		<?php echo $form->textField($model,'nombre_cepa',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'temp_min'); ?>
		<?php echo $form->textField($model,'temp_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'temp_max'); ?>
		<?php echo $form->textField($model,'temp_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ph_min'); ?>
		<?php echo $form->textField($model,'ph_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ph_max'); ?>
		<?php echo $form->textField($model,'ph_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ox_min'); ?>
		<?php echo $form->textField($model,'ox_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ox_max'); ?>
		<?php echo $form->textField($model,'ox_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cantidad'); ?>
		<?php echo $form->textField($model,'cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cond_min'); ?>
		<?php echo $form->textField($model,'cond_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cond_max'); ?>
		<?php echo $form->textField($model,'cond_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'orp_min'); ?>
		<?php echo $form->textField($model,'orp_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'orp_max'); ?>
		<?php echo $form->textField($model,'orp_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_1'); ?>
		<?php echo $form->textField($model,'id_1'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->