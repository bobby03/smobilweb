<?php
/* @var $this TanqueController */
/* @var $model Tanque */
/* @var $form CActiveForm */
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/estacion/create.js');
    $cs->registerCssFile($baseUrl.'/css/estacion/create.css');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tanque-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        <div class="allTanques">
            <?php $i = 1;?>
            <?php if(count($model->status)>0):?>
            <?php foreach($model->status as $data):?>
                <div class="tanque" data-id="<?php echo $i;?>">
                    <?php echo $form->hiddenField($model,"status[$i][id]");?>
                    <div class="row cap">
                            <?php echo $form->labelEx($model,'capacidad'); ?>
                            <?php echo $form->textField($model,"status[$i][capacidad]"); ?>
                            <?php echo $form->error($model,'capacidad'); ?>
                    </div>
                    <div class="row nom">
                            <?php echo $form->labelEx($model,'nombre'); ?>
                            <?php echo $form->textField($model,"status[$i][nombre]", array('size'=>50,'maxlength'=>50)); ?>
                            <?php echo $form->error($model,'nombre'); ?>
                    </div>
                    <div class="row sta">
                            <?php echo $form->labelEx($model,'status'); ?>
                            <?php echo $form->dropDownList($model,"status[$i][status]", Tanque::model()->getAllStatus(), array('empty'=>'Seleccionar', 'class'=>'css-select')); ?>
                            <?php echo $form->error($model,'status'); ?>
                    </div>
                    <div class="row act">
                            <?php echo $form->labelEx($model,'activo'); ?>
                            <?php echo $form->dropDownList($model,"status[$i][activo]", Tanque::model()->getAllActivo(), array('empty'=>'Seleccionar', 'class'=>'css-select')); ?>
                            <?php echo $form->error($model,'activo'); ?>
                    </div>
                    <div class="editarTanque">Editar</div>
                    <?php $i++;?>
                </div>
            <?php endforeach;?>
            <?php else:?>
                <div class="tanque" data-id="<?php echo $i;?>">
                    <div class="row cap">
                            <?php echo $form->labelEx($model,'capacidad'); ?>
                            <?php echo $form->textField($model,"status[$i][capacidad]"); ?>
                            <?php echo $form->error($model,'capacidad'); ?>
                    </div>
                    <div class="row nom">
                            <?php echo $form->labelEx($model,'nombre'); ?>
                            <?php echo $form->textField($model,"status[$i][nombre]", array('size'=>50,'maxlength'=>50)); ?>
                            <?php echo $form->error($model,'nombre'); ?>
                    </div>
                </div>
            <?php endif;?>
	</div>

	<div class="row buttons">
            <div class="addTanque">Agregar tanque</div>
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->