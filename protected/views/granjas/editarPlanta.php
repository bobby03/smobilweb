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
<h1>Editar planta de producci&oacute;n <?php echo $model->identificador;?></h1>
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
<style>
    textarea
    {
        resize: none;
        height: 150px;
    }
</style>
<div class="form-containerWraper">
    <div class="form-cLeftContainer">
        <div class="form-cLeft">
                <div class="row">
                    <label class= "letreros">Identificador</label>
                    <div class="form-cLarge">
                        <?php echo $form->textField($model,'identificador',array('size'=>50,'maxlength'=>50)); ?>
                        <?php echo $form->error($model,'identificador'); ?>
                    </div>
                </div>
                <div class="row">
                    <label class= "letreros">Descripcion</label>
                    <div class="form-cLarge">	
                    <?php echo $form->textArea($model,'marca',array('size'=>150,'maxlength'=>150)); ?>
                    <?php echo $form->error($model,'marca'); ?>
                    </div>
                </div>
        </div>
        <div class="form-cLeft">
            <div class="row">
                <label class= "letreros">Ubicación</label>
                <div class="form-cLarge"><?php echo $form->textField($model,'ubicacion',array('size'=>50,'maxlength'=>50)); ?></div>
                <?php echo $form->error($model,'ubicacion'); ?>
            </div>
            <div class="containerbutton">
                <div class="row buttons">
                    <a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true).'/granjas/plantaProduccion/'.$model->id_granja; ?>">Cancelar</a> 
                    <?php echo CHtml::submitButton('Guardar'); ?>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $this->endWidget(); ?>

</div><!-- form -->