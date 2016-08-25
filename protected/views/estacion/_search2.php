<?php
/* @var $this EstacionController */
/* @var $model Estacion */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

 	<?php echo CHtml::dropDownList('searchDropDown2', 'id', $model->getSearchEstaciones(),array('empty' =>'Selecciona campo a buscar')); ?>
	<div class="row hide" data-id='1'>
		<?php echo $form->textField($model,'identificador',array('size'=>50,'maxlength'=>50)); ?>
	</div>
	<div class="row hide" data-id='2'>
		<?php echo $form->textField($model,'no_personal'); ?>
	</div>
	<div class="row hide" data-id='3'>
		
		<?php echo $form->textField($model,'marca',array('size'=>50,'maxlength'=>50)); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->