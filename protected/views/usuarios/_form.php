<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/usuarios/form.js');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuarios-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'usuario'); ?>
		<?php echo $form->textField($model,'usuario',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pwd'); ?>
		<?php echo $form->textField($model,'pwd',array('size'=>35,'maxlength'=>35)); ?>
		<?php echo $form->error($model,'pwd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_usr'); ?>
		<?php echo $form->dropDownList($model,'tipo_usr', $model->getAllTipoUsuario(), array('empty'=>'Seleecionar', 'class'=>'css-select')); ?>
		<?php echo $form->error($model,'tipo_usr'); ?>
	</div>

	<div class="row hide" data-tipo="1">
		<?php echo $form->labelEx($model,'id_usr'); ?>
		<?php echo $form->dropDownList($model,'id_usr', Clientes::model()->getAllClientes(), array('empty'=>'Seleccionar','class'=>'css-select', 'id'=>'clienteList')); ?>
		<?php echo $form->error($model,'id_usr'); ?>
	</div>
	<div class="row hide" data-tipo="2">
		<?php echo $form->labelEx($model,'id_usr'); ?>
		<?php echo $form->dropDownList($model,'id_usr', Personal::model()->getAllPersonal(), array('empty'=>'Seleccionar','class'=>'css-select', 'id'=>'personalList')); ?>
		<?php echo $form->error($model,'id_usr'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->