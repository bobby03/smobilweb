<?php
/* @var $this PersonalController */
/* @var $model Personal */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
 	<?php echo CHtml::dropDownList('searchDropDown', 'id', $model->getSearchPersonal(),array('empty' =>'Selecciona campo a buscar')); ?>

	<div class="row hide" data-id='1'>
	     <label>Buscar:</label>
		<?php echo $form->textField($model,'nombre',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row hide" data-id='2'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'apellido',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row hide" data-id='3'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'tel',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row hide" data-id='4'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'rfc',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row hide" data-id='5'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'domicilio',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row hide" data-id='6'>
		<label>Buscar:</label>
		<?php echo $form->dropDownList($model,'id_rol',Roles::model()->getAllRoles(),array('empty'=>'Seleccionar','class'=>'css-select')); ?>
	</div>

	<div class="row hide" data-id='7'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'correo',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row hide" data-id='8'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'puesto',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons hide">
		<?php echo CHtml::submitButton('Search'); ?>
	</div> 

<?php $this->endWidget(); ?>

</div><!-- search-form -->