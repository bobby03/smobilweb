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
    <span class="css-select-moz">
         <?php echo CHtml::dropDownList('searchDropDown2', 'id', $model->getSearchClientes(),array('empty' =>'Selecciona campo a buscar')); ?>
    </span>

	<div class="row hide" data-id='1'>
		
		<?php echo $form->textField($model,'nombre_empresa',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row hide" data-id='2'>
		
		<?php echo $form->textField($model,'nombre_contacto',array('size'=>50,'maxlength'=>50)); ?>
	</div>
	
	<div class="row hide" data-id='3'>			
		
		<?php echo $form->textField($model,'apellido_contacto',array('size'=>50,'maxlength'=>50)); ?>
	</div>
	<div class="row hide" data-id='4'>
		
		<?php echo $form->textField($model,'rfc',array('size'=>15,'maxlength'=>15)); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->