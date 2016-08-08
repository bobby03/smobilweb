<?php
/* @var $this GranjasController */
/* @var $model Granjas */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
    <?php echo CHtml::dropDownList('searchDropDown', 'id', $model->getSearchGranjas(),array('empty' =>'Selecciona Búsqueda')); ?>
	<div class="row hide" data-id="1">
		<?php echo $form->label($model,'direccion'); ?>
		<?php echo $form->textField($model,'direccion',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row hide" data-id="2">
		<?php echo $form->label($model,'responsable'); ?>
		<?php echo $form->textField($model,'responsable',array('size'=>60,'maxlength'=>100)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->