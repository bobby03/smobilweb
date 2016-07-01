<?php
/* @var $this SolicitudesController */
/* @var $model Solicitudes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

 	<? echo CHtml::dropDownList('searchDropDown', 'id', $model->getSearchSolicitud(),array('empty' =>'Selecciona campo a buscar')); ?>


	<div class="row hide" data-id='1'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'codigo',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row hide" data-id='2'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'codigo',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row hide" data-id='3'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'fecha_alta'); ?>
	</div>

	<div class="row hide" data-id='4'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'hora_alta'); ?>
	</div>

	<div class="row hide" data-id='5'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'fecha_estimada'); ?>
	</div>

	<div class="row hide" data-id='6'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'hora_estimada'); ?>
	</div>

	<div class="row hide" data-id='7'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'fecha_entrega'); ?>
	</div>

	<div class="row hide" data-id='8'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'hora_entrega'); ?>
	</div>

	<div class="row hide" data-id='9'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'notas',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons hide">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->