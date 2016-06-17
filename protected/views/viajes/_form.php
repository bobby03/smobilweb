<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/calendario.js');
    $this->widget('zii.widgets.jui.CJuiDatePicker',array
    (
        'name' => 'ViajesForm',
        // additional javascript options for the date picker plugin
        'options'=>array(
            'showAnim'=>'fold',
        ),
        'htmlOptions'=>array(
            'style'=>'display:none;'
        )
    ));
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'viajes-form',
//        'htmlOptions'=>array('name'=>'ViajesForm'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'id_solicitudes'); ?>
		<?php echo $form->dropDownList($model,'id_solicitudes', Clientes::model()->getAllClientesViajes(), array('empty'=>'Seleccionar','class'=>'css-select')); ?>
		<?php echo $form->error($model,'id_solicitudes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_responsable'); ?>
		<?php echo $form->dropDownList($model,'id_responsable', Personal::model()->getAllPersonal(), array('empty'=>'Seleccionar','class'=>'css-select')); ?>
		<?php echo $form->error($model,'id_responsable'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'id_estacion'); ?>
		<?php echo $form->dropDownList($model,'id_estacion', Estacion::model()->getAllEstacion(), array('empty'=>'Seleccionar','class'=>'css-select')); ?>
		<?php echo $form->error($model,'id_estacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_salida'); ?>
		<?php echo $form->textField($model,'fecha_salida', array('class'=>'calendario', 'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'fecha_salida'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hora_salida'); ?>
		<?php echo $form->textField($model,'hora_salida', array('placeholder'=>'hh:mm')); ?>
		<?php echo $form->error($model,'hora_salida'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_entrega'); ?>
		<?php echo $form->textField($model,'fecha_entrega', array('class'=>'calendario', 'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'fecha_entrega'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hora_entrega'); ?>
		<?php echo $form->textField($model,'hora_entrega', array('placeholder'=>'hh:mm')); ?>
		<?php echo $form->error($model,'hora_entrega'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->