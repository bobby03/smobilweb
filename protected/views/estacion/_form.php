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
	'enableAjaxValidation'=>false,
)); ?>


<div class="form-containerWraper">

		<div class="form-cLeft">
			<div class="row">
				<label class= "letreros">Especie</label>
					<div class="form-cLarge">
						<span class="css-select-moz"><?php echo $form->dropDownList($model,'tipo', $model->getAllTipo(), array('empty'=>'Seleccionar','class'=>'css-select')); ?></span>
				
					</div>
			</div>

			<div class="row">
				<label class= "letreros">Identificador</label>
					<div class="form-cLarge">
					<?php echo $form->textField($model,'identificador',array('size'=>50,'maxlength'=>50)); ?>
				</div>
			</div>

			<div class="row">
				<label class= "letreros">No. Personal</label>
				<div class="form-cLarge">
					<?php echo $form->textField($model,'no_personal'); ?>
				</div>
			</div>

			<div class="row">
				<label class= "letreros">Marca</label>
					<div class="form-cLarge">	
					<?php echo $form->textField($model,'marca',array('size'=>50,'maxlength'=>50)); ?>
					</div>
			</div>
		</div>

		<div class="form-cLeft">
			<div class="row">
				<label class= "letreros">Color</label>
				<div class="form-cLarge"><?php echo $form->textField($model,'color',array('size'=>50,'maxlength'=>50)); ?></div>
			</div>

			<div class="row">
				<label class= "letreros">Ubicación</label>
				<div class="form-cXLarge"><?php echo $form->textField($model,'ubicacion',array('size'=>50,'maxlength'=>50)); ?></div>
				
			</div>
		        <?php if ($model->isNewRecord):?>
		        <?php else:?>
			<div class="row">
				<?php echo $form->labelEx($model,'disponible'); ?>
				<span class="css-select-moz"><?php echo $form->dropDownList($model,'disponible', $model->getAllDisponible(),array('empty'=>'Seleccionar','class'=>'css-select')); ?></span>
				</div>
			</div>
		<?php endif;?>

		    <div class="containerbutton">
				<div class="row buttons">
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Save'); ?>
				</div>
		</div>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->