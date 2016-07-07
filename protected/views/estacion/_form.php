<?php
/* @var $this EstacionController */
/* @var $model Estacion */
/* @var $form CActiveForm */
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/search.js');
   ?>

<div class="form">
	<?php $cs->registerCssFile($baseUrl.'/css/clientes/create.css') ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'estacion-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>
<div class="form-containerWraper">

		<div class="form-cLeft">
			<div class="row">
				<label class= "letreros">Especie</label>
					<div class="form-cMed">
						<span class="css-select-moz"><?php echo $form->dropDownList($model,'tipo', $model->getAllTipo(), array('empty'=>'Seleccionar','class'=>'css-select')); ?></span>
						<?php echo $form->error($model,'tipo'); ?>
					</div>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'identificador'); ?>
				<?php echo $form->textField($model,'identificador',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($model,'identificador'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'no_personal'); ?>
				<?php echo $form->textField($model,'no_personal'); ?>
				<?php echo $form->error($model,'no_personal'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'marca'); ?>
				<?php echo $form->textField($model,'marca',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($model,'marca'); ?>
			</div>
		</div>

		<div class="form-cRight">
			<div class="row">
				<?php echo $form->labelEx($model,'color'); ?>
				<?php echo $form->textField($model,'color',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($model,'color'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'ubicacion'); ?>
				<?php echo $form->textField($model,'ubicacion',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($model,'ubicacion'); ?>
			</div>
		        <?php if ($model->isNewRecord):?>
		        <?php else:?>
			<div class="row">
				<?php echo $form->labelEx($model,'disponible'); ?>
				<span class="css-select-moz"><?php echo $form->dropDownList($model,'disponible', $model->getAllDisponible(),array('empty'=>'Seleccionar','class'=>'css-select')); ?></span>
				<?php echo $form->error($model,'disponible'); ?>
			</div></div>
		        <?php endif;?>
			<div class="row buttons">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
			</div>
		</div>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->