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
<!--<? echo CHtml::dropDownList('searchDropDown', 'id', $model->getSearchUsuarios(),array('empty' =>'Selecciona campo a buscar')); ?>-->
	<div class="row hi " data-id='1' >
		<label>Buscar:</label>
		<?php echo $form->textField($model,'usuario',array('size'=>10,'maxlength'=>10)); ?>
	</div>
	<!---<div class="row " data-id='2'>
		<label>Buscar:</label>
		<?php echo $form->dropDownList($model,'tipo_usr',Usuarios::model()->getAllTipoUsuario(),array('empty'=>'Seleccionar', 'class'=>'css-select')); ?>
	</div>
-->
	<div class="row buttons hide" >
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->