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

 	<? echo CHtml::dropDownList('searchDropDown', 'id', $model->getSearchClientes(),array('empty' =>'Selecciona campo a buscar')); ?>
	
	<div class="row">
		<label>Buscar:</label>
		<?php echo $form->textField($model,'tipo',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
	    <label>Buscar:</label>
		<?php echo $form->textField($model,'identificador',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<label>Buscar:</label>
		<?php echo $form->textField($model,'no_personal'); ?>
	</div>

	<div class="row">
		<label>Buscar:</label>
		<?php echo $form->textField($model,'marca',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<label>Buscar:</label>
		<?php echo $form->textField($model,'color',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<label>Buscar:</label>
		<?php echo $form->textField($model,'ubicacion',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<label>Buscar:</label>
		<?php echo $form->textField($model,'disponible'); ?>
	</div>

	<div class="row">
		<label>Buscar:</label>
		<?php echo $form->textField($model,'activo'); ?>
	</div>

	<!--<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>-->

<?php $this->endWidget(); ?>

</div><!-- search-form -->