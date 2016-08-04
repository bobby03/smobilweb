<?php
/* @var $this CepaController */
/* @var $model Cepa */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row" data-id='1'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'nombre_cepa',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons hide">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->