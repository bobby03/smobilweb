<?php
/* @var $this ClientesController */
/* @var $model Clientes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
	<label>Buscar:</label>
		<?php echo $form->textField($model,'nombre_contacto',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->dropDownList($model,'id_especie', Especie::model()->getAllEspecies(),array('empty'=>'Seleccionar', 'class'=>'css-select')); ?> <!--modificar ma;ana -->
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_contacto'); ?>
		<?php echo $form->textField($model,'nombre_contacto',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'apellido_contacto'); ?>
		<?php echo $form->textField($model,'apellido_contacto',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'correo'); ?>
		<?php echo $form->textField($model,'correo',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rfc'); ?>
		<?php echo $form->textField($model,'rfc',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tel'); ?>
		<?php echo $form->textField($model,'tel',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->