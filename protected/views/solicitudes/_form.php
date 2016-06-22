<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/calendario.js');
    $cs->registerScriptFile($baseUrl.'/js/solicitudes/create.js');
    $cs->registerScriptFile($baseUrl.'/js/plugins/chosen/assets/js/chosen.jquery.min.js');
    $cs->registerCssFile($baseUrl.'/js/plugins/chosen/assets/css/chosen.min.css');
    $cs->registerCssFile($baseUrl.'/css/solicitudes/create.css');
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

    <div class="formContainer1">
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'solicitudes-form',
    //        'htmlOptions'=>array('name'=>'SolicitudesForm'),
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation'=>false,
    )); ?>
	<!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->

	<?php echo $form->errorSummary($model); ?>
        <h2>Clientes</h2>
	<div class="row">
		<span class='css-select-moz'>
                    <?php echo $form->dropDownList($model,'id_clientes', Clientes::model()->getAllClientes(), array('empty'=>'Seleccionar', 'class'=>'css-select')); ?>
                </span>
		<?php echo $form->error($model,'id_clientes'); ?>
	</div>

        <h2>Pedido</h2>
	<div class="row">
            <label>Especie</label>
            <?php echo $form->dropDownList($especies,'id', $especies->getAllEspeciesSolicitud(), array('class'=>'css-select','empty'=>'Selecionar')); ?>
            <?php echo $form->error($especies,'id'); ?>
	</div>
        
	<div class="row cepa hide">
            <label>Cepa</label>
            <?php echo $form->dropDownList($cepa,'id', array('1'=>'1'),array('empty'=>'Selecionar','class'=>'css-select')); ?>
            <?php echo $form->error($cepa,'id'); ?>
	</div>
	
	<div class="row">
            <label>Estación</label>
            <?php echo $form->dropDownList($estaciones,'identificador', $estaciones->getEstacionSolicitud(), array('class'=>'css-select','empty'=>'Selecionar')); ?>
            <?php echo $form->error($estaciones,'identifiacdor'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('maxlength'=>50)); ?>
		<?php echo $form->error($model,'codigo'); ?>
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
		<?php echo $form->textField($model,'notas',array('maxlength'=>100)); ?>
		<?php echo $form->error($model,'notas'); ?>
	</div>
        
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
    </div>
    <div class="formContainer2">
        <h2>Detalles</h2>
        <div class="wraper">
            <div class="fechaYora">
                <div class="dateHoy"><?php echo date('d/m/Y');?></div>
                <div class="timeHoy">
                    <?php 
                        date_default_timezone_set("Pacific/Easter");
                        echo date('h:i');
                    ?>
                </div>
            </div>
            <div class="datosCliente">

            </div>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->