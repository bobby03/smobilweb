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

 	<?php echo CHtml::dropDownList('searchDropDown', 'id', $model->getSearchEstaciones(),array('empty' =>'Selecciona campo a buscar')); ?>
	
	<div class="row hide" data-id='1';>
		<label>Buscar:</label>
		<?php echo $form->dropDownList($model,'tipo',Estacion::model()->getAllTipo(),array('empty'=>'Seleccionar','class'=>'css-select')); ?>
	</div>

	<div class="row hide" data-id='2'>
	    <label>Buscar:</label>
		<?php echo $form->textField($model,'identificador',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row hide" data-id='3'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'no_personal'); ?>
	</div>

	<div class="row hide" data-id='4'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'marca',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row hide" data-id='5'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'color',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row hide" data-id='6'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'ubicacion',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row hide" data-id='7'>
		<label>Buscar:</label>
		<?php echo $form->dropDownList($model,'disponible',Estacion::model()->getAllDisponible(),array('empty'=>'Seleccionar','class'=>'css-select')); ?>
	</div>

	<div class="row hide" data-id='8'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'activo'); ?>
	</div>

	<div class="row buttons hide">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->