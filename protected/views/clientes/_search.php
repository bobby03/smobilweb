<?php
/* @var $this ClientesController */
/* @var $model Clientes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

     <?php echo CHtml::dropDownList('searchDropDown', 'id', $model->getSearchClientes(),array('empty' =>'Selecciona Búsqueda')); ?>


	<div class="row hide" data-id='1'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'nombre_empresa',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row hide" data-id='2'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'nombre_contacto',array('size'=>50,'maxlength'=>50)); ?>
	</div>
	
	<div class="row hide" data-id='3'>			
		<label>Buscar:</label>
		<?php echo $form->textField($model,'apellido_contacto',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row hide" data-id='4'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'correo',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row hide" data-id='5'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'rfc',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row hide" data-id='6'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'tel',array('size'=>12,'maxlength'=>12)); ?>
	</div>

     <div class="row buttons hide">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->