<?php
/* @var $this TanqueController */
/* @var $model Tanque */
/* @var $form CActiveForm */
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/estacion/create.js');
    $cs->registerScriptFile($baseUrl.'/js/jquery.mask.min.js');
     $cs->registerScriptFile($baseUrl.'/js/estacion/validacion.js');
         $cs->registerScriptFile($baseUrl.'/js/changeTab.js');

    $cs->registerCssFile($baseUrl.'/css/estacion/create.css');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'tanque-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>true,
    'clientOptions' => array
    (
        'validateOnSubmit' => true,
        'validateOnChange' => true,
        'validateOnType' => true,
    ),
)); ?>


	<?php //echo $form->errorSummary($model); ?>
	<div class="row buttons">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar',array('id'=>'btnguardar')); ?>
            <a class="gBoton bBoton" >Cancelar</a>
            <div class="addTanque">Nuevo tanque</div>
	</div>
        <div class="allTanques">
            <?php $i = 1;?>
            <?php if(count($model->activo)>0):?>
            <?php foreach($model->activo as $data):?>
                <div class="tanque" data-id="<?php echo $i;?>">
                    <?php echo $form->hiddenField($model,"activo[$i][id]");?>
                    <div class="row nom">
                            <?php echo $form->labelEx($model,'nombre'); ?>
                            <?php echo $form->textField($model,"activo[$i][nombre]", array('size'=>50,'maxlength'=>50)); ?>
                            <?php echo $form->error($model,'nombre'); ?>
                    </div>
                    <div class="row cap">
                            <?php echo $form->labelEx($model,'capacidad'); ?>
                            <?php echo $form->textField($model,"activo[$i][capacidad]",array('class'=>'ttan fcapacidad','placeholder'=>'500')); ?>
                            <?php echo $form->error($model,'capacidad'); ?>
                            <div class="errorMessage" id="Tanque_capacidad_em_" ></div>
                    </div>
                    <div class="row act">
                            <?php echo $form->labelEx($model,'activo'); ?>
                            <?php echo $form->dropDownList($model,"activo[$i][activo]", Tanque::model()->getAllActivo(), array('empty'=>'Seleccionar', 'class'=>'css-select activo')); ?>
                            <?php echo $form->error($model,'activo'); ?>
                    </div>
                    <?php $i++;?>
                </div>
            <?php endforeach;?>
            <?php else:?>
                <div class="tanque nuevo" data-id="<?php echo $i;?>">
                    <div class="tacha">X</div>
                    <div class="row nom">
                            <?php echo $form->labelEx($model,'nombre'); ?>
                            <?php echo $form->textField($model,"activo[$i][nombre]", array('size'=>50,'maxlength'=>50)); ?>
                            <?php echo $form->error($model,'nombre'); ?>
                    </div>
                    <div class="row cap">
                            <?php echo $form->labelEx($model,'capacidad'); ?>
                            <?php echo $form->textField($model,"activo[$i][capacidad]",array('class'=>'ttan','placeholder'=>'500')); ?>
                            <?php echo $form->error($model,'capacidad'); ?>
                    </div>
                </div>
            <?php endif;?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->