<?php
/* @var $this CampSensadoController */
/* @var $model CampSensado */
/* @var $form CActiveForm */
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();

    $cs->registerCssFile($baseUrl.'/js/plugins/chosen/assets2/css/chosen.min.css');
    $cs->registerScriptFile($baseUrl.'/js/monitoreo/crear.js');
    $cs->registerCssFile($baseUrl.'/css/campsensado/create.css');

    // Javascript
    $cs->registerScriptFile($baseUrl.'/js/calendario.js');
    $cs->registerScriptFile($baseUrl.'/js/plugins/chosen/assets2/js/chosen.jquery.min.js');
    $cs->registerScriptFile($baseUrl.'/js/jquery.mask.min.js');
    $cs->registerScriptFile($baseUrl.'/js/campsensado/create.js?='.rand());

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'camp-sensado-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => true,
        'validateOnType' => true,
        //'afterValidate'=>'js:formSendViajes',
        ),
    ));
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
<?php if(!$model->isNewRecord):?>
<?php endif;?>
<div class="form">

<?php  ?>

    <div class="menuTabs">
        <div class="bolaChica selected"></div>
        <div class="lineaChica selected"></div>
        <div class="bolaGrande selected">1</div>
        <div class="lineaGandre "></div>
        <div class="bolaGrande ">2</div>
        <div class="lineaGandre"></div>
        <div class="bolaGrande">3</div>
        <div class="lineaChica"></div>
        <div class="bolaChica"></div>
    </div>
    <div class="tab " data-tab="1">
    		<div class="botonesWrapper">
				<a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/CampSensado">Cancelar</a>
	            <div class="siguiente uno">Siguiente</div>
	           
            </div>
	     <div class="formContainer1">
				<?php echo $form->hiddenField($model,'status', array('value' => '1')); ?>
			<div class="row">
				<?php 
                                        $granja = new Granjas;
					echo $form->labelEx($model,'granja_nombre'); 
				?>
		        <span class="css-select-moz">
		            <?php echo $form->dropDownList($granja,'id', ($model->isNewRecord) ? $granja->getNombreGranjasConPlantas() : $granja->getGranjaFromPlanta($model->id_estacion) ,($model->isNewRecord) ? array('empty'=>'Seleccionar','class'=>'css-select') : array('disabled'=>'disabled', 'value'=>$granja->getGranjaId($model->id_estacion)));?>
		            <?php echo $form->error($granja,'id'); ?>
		        </span>
			</div>
			<div class="row">
				<?php
					$est = new Estacion;
				?>
	           
					<?php echo $form->labelEx($model,'id_estacion'); ?>
				<span class="css-select-moz">
		            <?php echo $form->dropDownList($model,'id_estacion', ($model->isNewRecord) ? array() : $granjas->getPlantasofGranjaFromPlanta($model->id_estacion) , ($model->isNewRecord) ? array('empty'=>'Seleccionar', 'disabled'=>'disabled') : array('empty'=>'Seleccionar', 'disabled'=>'disabled'));?>
		            <?php echo $form->error($model,'id_estacion'); ?>
		        </span>
			</div>
			<div class="row">
				<?php $prs = new Personal;  echo $form->labelEx($model,'id_responsable'); ?>
		        <span class="css-select-moz">
		            <?php echo $form->dropDownList($model,'id_responsable', $prs->getBiologos(), array('empty'=>'Seleccionar','class'=>'css-select','value'=>$model->id_responsable));?>

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
				<?php echo $form->textField($model,'hora_inicio', array('placeholder'=>'hh:mm (24 horas)')); ?>
				<?php echo $form->error($model,'hora_inicio'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'fecha_fin'); ?>
				<?php echo $form->textField($model,'fecha_fin', array('class'=>'calendario', 'readonly'=>'readonly')); ?>
				<?php echo $form->error($model,'fecha_fin'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'hora_fin'); ?>
				<?php echo $form->textField($model,'hora_fin', array('placeholder'=>'hh:mm (24 horas)')); ?>
				<?php echo $form->error($model,'hora_fin'); ?>
			</div>

		</div>

	</div>

    <div class="tab hide" data-tab="2">
        <div class="botonesWrapper2">
            <div class="siguiente dos">Siguiente</div>
            <div class="gBoton regresar uno" >Regresar</div>
        </div>
        <div class="pedidosWraper">
            <?php 
                if($tanques != null)
                    echo $tanques;
            ?>
        </div>
        
    </div>
    <div class="tab hide last" data-tab="3">

    <div class="inner-third-wrapper"></div>
	<div class="row buttons">
        <div class="row buttons floating">
         	<div class="gBoton regresar dos" >Regresar</div>
			<?php echo CHtml::submitButton('Finalizar'); ?>
		</div>
	</div>

    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->