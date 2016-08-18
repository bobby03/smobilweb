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
	     
		<?php echo $form->textField($model,'nombre',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row hide" data-id='2'>
		
		<?php echo $form->textField($model,'apellido',array('size'=>50,'maxlength'=>50)); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->