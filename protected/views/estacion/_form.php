<?php
/* @var $this EstacionController */
/* @var $model Estacion */
/* @var $form CActiveForm */
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/search.js');
   ?>

<div class="form">
	<?php $cs->registerCssFile($baseUrl.'/css/estacion/create.css') ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'estacion-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => true,
        'validateOnType' => true,
        ),
    )); 

?>
<div class="form-containerWraper">
    <div class="form-cLeftContainer">
        <div class="form-cLeft">
                <div class="row hide">
                    <label class= "letreros">Tipo</label>
                    <div class="form-cLarge">
                        <span class="css-select-moz"><?php echo $form->dropDownList($model,'tipo', $model->getAllTipo(), array('empty'=>'Seleccionar','class'=>'css-select','disabled'=>'disabled')); ?></span>
                        <?php echo $form->error($model,'tipo'); ?>
                    </div>
                </div>
                <div class="row">
                    <label class= "letreros">Identificador <span class="required">*</span></label>
                    <div class="form-cLarge">
                        <?php echo $form->textField($model,'identificador',array('size'=>50,'maxlength'=>50)); ?>
                        <?php echo $form->error($model,'identificador'); ?>
                    </div>
                </div>
                <div class="row">
                    <label class= "letreros">Capacidad de pasajeros <span class="required">*</span></label>
                    <div class="form-cLarge">
                        <?php echo $form->textField($model,'no_personal'); ?>
                        <?php echo $form->error($model,'no_personal'); ?>
                    </div>
                </div>
                <div class="row">
                    <label class= "letreros">Marca <span class="required">*</span></label>
                    <div class="form-cLarge">	
                    <?php echo $form->textField($model,'marca',array('size'=>50,'maxlength'=>50)); ?>
                    <?php echo $form->error($model,'marca'); ?>
                    </div>
                </div>
        </div>
        <div class="form-cLeft">
            <div class="row">
                <label class= "letreros">Color <span class="required">*</span></label>
                <div class="form-cLarge"><?php echo $form->textField($model,'color',array('size'=>50,'maxlength'=>50)); ?></div>
                <?php echo $form->error($model,'color'); ?>
            </div>

            <div class="row">
                <label class= "letreros">Ubicación <span class="required">*</span></label>
                <div class="form-cLarge"><?php echo $form->textField($model,'ubicacion',array('size'=>50,'maxlength'=>50)); ?></div>
                <?php echo $form->error($model,'ubicacion'); ?>
            </div>
            <?php if ($model->isNewRecord):?>
            <?php else:?>
<!--            <div class="row">
                <?php echo $form->labelEx($model,'disponible'); ?>
                <span class="css-select-moz"><?php echo $form->dropDownList($model,'disponible', $model->getAllDisponible(),array('empty'=>'Seleccionar','class'=>'css-select')); ?></span>
                <?php echo $form->error($model,'disponile'); ?>

            </div>-->
            <?php endif;?>
            <div class="containerbutton">
                    <div class="row buttons">
                        <a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true);?>/estacion">Cancelar</a> 
                        <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar'); ?>
                    </div>
            </div>
        </div>
    </div>

</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

