<?php

/*
 * To change this template, choose Tools | Templates
<?php
/* @var $this EstacionController */
/* @var $model Estacion */
/* @var $form CActiveForm */
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $cs->registerCssFile($baseUrl.'/css/estacion/create.css');
   ?>
<h1>Crear nueva planta de producci&oacute;n</h1>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'estacion-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
//    'enableAjaxValidation'=>true,
//    'clientOptions' => array(
//        'validateOnSubmit' => true,
//        'validateOnChange' => true,
//        'validateOnType' => true,
//        ),
    )); 


?>
    
<div class="form-containerWraper">
    <div class="form-cLeftContainer">
        <div class="form-cLeft">
                <?php echo $form->hiddenField($model,'tipo');?>
                <div class="row">
                    <label class= "letreros">Identificador</label>
                    <div class="form-cLarge">
                        <?php echo $form->textField($model,'identificador',array('size'=>50,'maxlength'=>50)); ?>
                        <?php echo $form->error($model,'identificador'); ?>
                    </div>
                </div>
                <div class="row">
                    <label class= "letreros">Capacidad de personal</label>
                    <div class="form-cLarge">
                        <?php echo $form->textField($model,'no_personal'); ?>
                        <?php echo $form->error($model,'no_personal'); ?>
                    </div>
                </div>
                <div class="row">
                    <label class= "letreros">Marca</label>
                    <div class="form-cLarge">	
                    <?php echo $form->textField($model,'marca',array('size'=>50,'maxlength'=>50)); ?>
                    <?php echo $form->error($model,'marca'); ?>
                    </div>
                </div>
        </div>
        <div class="form-cLeft">
            <div class="row">
                <label class= "letreros">Color</label>
                <div class="form-cLarge"><?php echo $form->textField($model,'color',array('size'=>50,'maxlength'=>50)); ?></div>
                <?php echo $form->error($model,'color'); ?>
            </div>

            <div class="row">
                <label class= "letreros">Ubicación</label>
                <div class="form-cLarge"><?php echo $form->textField($model,'ubicacion',array('size'=>50,'maxlength'=>50)); ?></div>
                <?php echo $form->error($model,'ubicacion'); ?>
            </div>
            <div class="containerbutton">
                <div class="row buttons">
                        <?php echo CHtml::submitButton('Guardar'); ?>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $this->endWidget(); ?>

</div><!-- form -->