<?php
/* @var $this EspecieController */
/* @var $model Especie */
/* @var $form CActiveForm */
 $baseUrl = Yii::app()->baseUrl;

?>

<div class="form">
<?php 
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/especie/create.css');
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'especie-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>
<div class="form-containerWraper">
	<div class="form-cRight">
			<div class="row">
				<label class="letreros">Nueva Especie</label>
					<div class="form-cLarge">
						<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>100)); ?>
					</div>
				</div>
	</div>
    <div class="form-cRight">
			<div class="containerbutton">
				<div class="row buttons">
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Save'); ?>
				</div>
			</div>
	</div>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->