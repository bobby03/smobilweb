<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/calendario.js');
    $cs->registerScriptFile($baseUrl.'/js/solicitudes/create.js');
    $this->widget('zii.widgets.jui.CJuiDatePicker',array
    (
        'name' => 'SolicitudesForm',
        // additional javascript options for the date picker plugin
        'options'=>array(
            'showAnim'=>'fold',
        ),
        'htmlOptions'=>array(
            'style'=>'display:none;'
        ),
));
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'solicitudes-form',
//        'htmlOptions'=>array('name'=>'SolicitudesForm'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_clientes'); ?>
		<span class='css-select-moz'>
                    <?php echo $form->dropDownList($model,'id_clientes', Clientes::model()->getAllClientes(), array('empty'=>'Seleccionar', 'class'=>'css-select')); ?>
                </span>
		<?php echo $form->error($model,'id_clientes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_alta'); ?>
		<?php echo $form->textField($model,'fecha_alta', array('class'=>'calendario', 'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'fecha_alta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hora_alta'); ?>
		<?php echo $form->textField($model,'hora_alta', array('placeholder'=>'hh:mm')); ?>
		<?php echo $form->error($model,'hora_alta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_estimada'); ?>
		<?php echo $form->textField($model,'fecha_estimada', array('class'=>'calendario', 'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'fecha_estimada'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hora_estimada'); ?>
		<?php echo $form->textField($model,'hora_estimada', array('placeholder'=>'hh:mm')); ?>
		<?php echo $form->error($model,'hora_estimada'); ?>
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

	<div class="row">
		<?php echo $form->labelEx($model,'notas'); ?>
		<?php echo $form->textField($model,'notas',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'notas'); ?>
	</div>
        
	<div class="row">
            <label>Estación</label>
            <?php echo $form->dropDownList($estaciones,'identificador', $estaciones->getEstacionSolicitud(), array('class'=>'css-select','empty'=>'Selecionar')); ?>
            <?php echo $form->error($estaciones,'identifiacdor'); ?>
	</div>
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->