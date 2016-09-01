<?php
/* @var $this PersonalController */
/* @var $model Personal */
/* @var $form CActiveForm */
$baseUrl = Yii::app()->baseUrl;
?>

<div class="form">
<?php 
    $cs = Yii::app()->getClientScript();  
    $cs->registerCssFile($baseUrl.'/css/personal/create.css?I='.rand());
    $cs->registerScriptFile($baseUrl.'/js/jquery.mask.min.js');
    $cs->registerScriptFile($baseUrl.'/js/personal/validacion.js?i='.rand());
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'personal-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>TRUE,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
            'validateOnType' => true,
        ),
)); ?>


<div class="form-containerWraper">
<div class="form-cLeft">
	<div class="row">
		<label class="letreros">Nombre(s)  <span class="required">*</span></label>
		<div class="form-cLarge"><?php echo $form->textField($model,'nombre',array('size'=>50,'maxlength'=>50,'class'=>'ValidaAlpha')); ?></div>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<label class="letreros">Apellido(s)  <span class="required">*</span></label>
		<div class="form-cLarge"><?php echo $form->textField($model,'apellido',array('size'=>50,'maxlength'=>50,'class'=>'ValidaAlpha')); ?></div>
		<?php echo $form->error($model,'apellido'); ?>
	</div>

	<div class="row">
		<label class="letreros">Teléfono  <span class="required">*</span></label>
		<div class="form-cMedium"><?php echo $form->textField($model,'tel',array('size'=>14,'maxlength'=>14)); ?></div>
		<?php echo $form->error($model,'tel'); ?>
	</div>

	
	<div class="row">
		<label class="letreros">RFC  <span class="required">*</span></label>
		<div class="form-cMedium"><?php echo $form->textField($model,'rfc',array('size'=>13,'maxlength'=>13)); ?></div>
		<?php echo $form->error($model,'rfc'); ?>
	</div>
</div>

<div class="form-cRight">



	<div class="row">
	<label class="letreros">Rol <span class="required">*</span></label>
	<div class="form-cMedium"><span class='css-select-moz'>
                <?php echo $form->dropDownList($model,'id_rol', Roles::model()->getAllRoles(), array('empty'=>'Seleccionar', 'class'=>'css-select')); ?>
                </span></div>
		<?php echo $form->error($model,'id_rol'); ?>
	</div>

	<div class="row">
		<label class="letreros">E-mail <span class="required">*</span></label>
		<div class="form-cXLarge"><?php echo $form->emailField($model,'correo',array('size'=>60,'maxlength'=>100)); ?></div>
		<?php echo $form->error($model,'correo'); ?>
	</div>

	<div class="row">
		<label class="letreros">Puesto <span class="required">*</span></label>
		<div class="form-cMedium"><?php echo $form->textField($model,'puesto',array('size'=>60,'maxlength'=>100,'class'=>'ValidaAlpha')); ?></div>
		<?php echo $form->error($model,'puesto'); ?>
	</div>
	<div class="containerbutton">
	<div class="row buttons">
		<a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/personal">Cancelar</a> 
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>
</div>	
</div>



</div>
<?php $this->endWidget(); ?>

</div><!-- form -->