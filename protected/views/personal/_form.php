<?php
/* @var $this PersonalController */
/* @var $model Personal */
/* @var $form CActiveForm */
$baseUrl = Yii::app()->baseUrl;
?>

<div class="form">
<?php 
    $cs = Yii::app()->getClientScript();  
    $cs->registerCssFile($baseUrl.'/css/personal/create.css');
    $cs->registerScriptFile($baseUrl.'/js/clientes/googleMap.js');
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'personal-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>
<div class="form-containerWraper">
<div class="form-container1">
	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellido'); ?>
		<?php echo $form->textField($model,'apellido',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'apellido'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tel'); ?>
		<?php echo $form->textField($model,'tel',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'tel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rfc'); ?>
		<?php echo $form->textField($model,'rfc',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'rfc'); ?>
	</div>
</div>
<div class="form-container2">
	<div class="row">
		<?php echo $form->labelEx($model,'domicilio'); ?>
		<?php echo $form->textField($model,'domicilio',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'domicilio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_rol'); ?>
		<span class='css-select-moz'>
                    <?php echo $form->dropDownList($model,'id_rol', Roles::model()->getAllRoles(), array('empty'=>'Seleccionar', 'class'=>'css-select')); ?>
                </span>
		<?php echo $form->error($model,'id_rol'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'correo'); ?>
		<?php echo $form->emailField($model,'correo',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'correo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'puesto'); ?>
		<?php echo $form->textField($model,'puesto',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'puesto'); ?>
	</div>
</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->