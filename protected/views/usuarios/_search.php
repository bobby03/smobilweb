<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<div class="row">
		<label>Buscar:</label>
		<?php echo $form->textField($model,'usuario',array('size'=>10,'maxlength'=>10)); ?>
	</div>
	<!--<div class="row">
		<?php echo $form->label($model,'tipo_usr'); ?>
		<?php echo $form->dropDownList($model,'tipo_usr',$model->getAllTipoUsuario(),array('empty'=>'Seleccionar', 'class'=>'css-select')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>-->

<?php $this->endWidget(); ?>

</div><!-- search-form -->