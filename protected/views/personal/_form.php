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


<div class="form-containerWraper">
<div class="form-cLeft">
	<div class="row">
		<label class="letreros">Nombre</label>
		<div class="form-cLarge"><?php echo $form->textField($model,'nombre',array('size'=>50,'maxlength'=>50)); ?></div>
		<!--<?php echo $form->error($model,'nombre'); ?>-->
	</div>

	<div class="row">
		<label class="letreros">Apellido</label>
		<div class="form-cLarge"><?php echo $form->textField($model,'apellido',array('size'=>50,'maxlength'=>50)); ?></div>
		<!--<?php echo $form->error($model,'apellido'); ?>-->
	</div>

	<div class="row">
		<label class="letreros">Teléfono</label>
		<div class="form-cMedium"><?php echo $form->textField($model,'tel',array('size'=>12,'maxlength'=>12)); ?></div>
		<!--<?php echo $form->error($model,'tel'); ?>-->
	</div>

	
	<div class="row">
		<label class="letreros">RFC</label>
		<div class="form-cMedium"><?php echo $form->textField($model,'rfc',array('size'=>15,'maxlength'=>15)); ?></div>
	<!--	<?php echo $form->error($model,'rfc'); ?>-->
	</div>
</div>
<div class="form-cRight">
	<div class="row">
		<label class="letreros">Domicilio</label>
		<div class="form-cXLarge"><?php echo $form->textField($model,'domicilio',array('size'=>60,'maxlength'=>150)); ?>
	<!--	<?php echo $form->error($model,'domicilio'); ?>-->
	</div>

	<div class="row">
	<label class="letreros">Rol</label>
	<div class="form-cMedium"><span class='css-select-moz'>
                    <?php echo $form->dropDownList($model,'id_rol', Roles::model()->getAllRoles(), array('empty'=>'Seleccionar', 'class'=>'css-select')); ?>
                </span></div>
	<!--	<?php echo $form->error($model,'id_rol'); ?>-->
	</div>

	<div class="row">
		<label class="letreros">E-mail</label>
		<div class="form-cXLarge"><?php echo $form->emailField($model,'correo',array('size'=>60,'maxlength'=>100)); ?></div>
	<!--	<?php echo $form->error($model,'correo'); ?>-->
	</div>

	<div class="row">
		<label class="letreros">Puesto</label>
		<div class="form-cMedium"><?php echo $form->textField($model,'puesto',array('size'=>60,'maxlength'=>100)); ?></div>
	<!--	<?php echo $form->error($model,'puesto'); ?>-->
	</div>
</div>
<div class="containerbutton">
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>
</div>	
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->