<?php
/* @var $this CampSensadoController */
/* @var $model CampSensado */
/* @var $form CActiveForm */
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/calendario.js');
    $cs->registerScriptFile($baseUrl.'/js/plugins/chosen/assets2/js/chosen.jquery.min.js');
    $cs->registerCssFile($baseUrl.'/js/plugins/chosen/assets2/css/chosen.min.css');
    $cs->registerScriptFile($baseUrl.'/js/viajes/create.js');
    $cs->registerScriptFile($baseUrl.'/js/monitoreo/crear.js');
    $cs->registerScriptFile($baseUrl.'/js/jquery.mask.min.js');
    $cs->registerScriptFile($baseUrl.'/js/viajes/validacion.js');
    $cs->registerCssFile($baseUrl.'/css/viajes/create.css');

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
	'id'=>'camp-sensado-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <div class="menuTabs">
        <div class="bolaChica selected"></div>
        <div class="lineaChica selected"></div>
        <div class="bolaGrande selected">1</div>
        <div class="lineaGandre <?php if(!$model->isNewRecord) echo 'selected';?>"></div>
        <div class="bolaGrande <?php if(!$model->isNewRecord) echo 'selected';?>">2</div>
        <div class="lineaGandre"></div>
        <div class="bolaGrande">3</div>
        <div class="lineaChica"></div>
        <div class="bolaChica"></div>
    </div>
    <div class="tab " data-tab="1">
	     <div class="formContainer1">
			<?php echo $form->errorSummary($model); ?>	
				<?php echo $form->hiddenField($model,'status', array('value' => '1')); ?>	

			<div class="row">
				<?php 
					$grn = new Granjas;
				?>
				<label for="Granjas_nombre" class="required">Granja: <span class="required">*</span></label>
		        <span class="css-select-moz">
		            <?php echo $form->dropDownList($grn,'id', $grn->getnombregranja(), array('empty'=>'Seleccionar','class'=>'css-select','value'=>$grn->id));?>
		            <?php echo $form->error($model,'id_responsable'); ?>
		        </span>
			</div>
			<div class="row">
				<?php
					$est = new Estacion;
				?>
	             <span class="css-select-moz">
					<?php echo $form->labelEx($model,'id_estacion'); ?>
		            <?php echo $form->dropDownList($model,'id_estacion', array(), array('empty'=>'Seleccionar', 'disabled'=>'disabled'));?>
		            <?php echo $form->error($model,'id_responsable'); ?>
		        </span>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model,'id_responsable'); ?>
		        <span class="css-select-moz">
		            <?php echo $form->dropDownList($model,'id_responsable', $personal->getpersonal(3), array('empty'=>'Seleccionar','class'=>'css-select','value'=>$model->id_responsable));?>
		            <?php echo $form->error($model,'id_responsable'); ?>
		        </span>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model,'nombre_camp'); ?>
				<?php echo $form->textField($model,'nombre_camp',array('size'=>45,'maxlength'=>45)); ?>
				<?php echo $form->error($model,'nombre_camp'); ?>
			</div>
		</div>
		 <div class="formContainer1">

			<div class="row">
				<?php echo $form->labelEx($model,'fecha_inicio'); ?>
				<?php echo $form->textField($model,'fecha_inicio', array('class'=>'calendario', 'readonly'=>'readonly')); ?>
				<?php echo $form->error($model,'fecha_inicio'); ?>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model,'hora_inicio'); ?>
				<?php echo $form->textField($model,'hora_inicio', array('placeholder'=>'hh:mm')); ?>
				<?php echo $form->error($model,'hora_inicio'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'fecha_fin'); ?>
				<?php echo $form->textField($model,'fecha_fin', array('class'=>'calendario', 'readonly'=>'readonly')); ?>
				<?php echo $form->error($model,'fecha_fin'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'hora_fin'); ?>
				<?php echo $form->textField($model,'hora_fin', array('placeholder'=>'hh:mm')); ?>
				<?php echo $form->error($model,'hora_fin'); ?>
			</div>
			<a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/CampSensado">Cancelar</a>
            <div class="siguiente uno">Siguiente</div>
		</div>

	</div>

    <div class="tab hide" data-tab="2">
   		<div class="pedidosWraper"></div>
   		<a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/CampSensado">Cancelar</a>
        <div class="siguiente dos">Siguiente</div>
    </div>
    <div class="tab hide" data-tab="3">

	<div class="row buttons">
        <div class="inner-third-wrapper"></div>
        <div class="row buttons floating">
         	<a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/CampSensado">Cancelar</a>
			<?php echo CHtml::submitButton('Finalizar'); ?>
		</div>
	</div>

    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->