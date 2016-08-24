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
<<<<<<< HEAD
    <?php echo CHtml::dropDownList('searchDropDown', 'id', $model->getSearchGranjas(),array('empty' =>'Selecciona campo a buscar')); ?>
	<div class="row hide" data-id="1">
=======
    <?php //echo CHtml::dropDownList('searchDropDown', 'id', $model->getSearchGranjas(),array('empty' =>'Selecciona Búsqueda')); ?>
	<div class="row" data-id="1">
		<?php echo $form->label($model,'nombre'); ?>
>>>>>>> b412a666db4f6bc404a924090d87af35c7300f51
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>100)); ?>
	</div>
	<div class="row hide" data-id="2">
		<?php echo $form->textField($model,'direccion',array('size'=>60,'maxlength'=>100)); ?>
	</div>
	<div class="row hide" data-id="3">
		<?php echo $form->textField($model,'responsable',array('size'=>60,'maxlength'=>100)); ?>
	</div>
<<<<<<< HEAD
        <div class="row buttons hide">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>
=======
	<div class="row hide" data-id="3">
		<?php echo $form->label($model,'direccion'); ?>
		<?php echo $form->textField($model,'direccion',array('size'=>60,'maxlength'=>100)); ?>
	</div>


>>>>>>> b412a666db4f6bc404a924090d87af35c7300f51
<?php $this->endWidget(); ?>

</div><!-- search-form -->