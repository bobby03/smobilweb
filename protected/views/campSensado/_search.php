<?php
/* @var $this CampSensadoController */
/* @var $model CampSensado */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<div class="row">
		<?php echo $form->label($model,'nombre_camp'); ?>
		<?php echo $form->textField($model,'nombre_camp',array('size'=>45,'maxlength'=>45)); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- search-form -->