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
    <span class="css-select-moz">
        <?php echo CHtml::dropDownList('searchDropDown', 'id', $model->getSearchPlanta(),array('empty' =>'Selecciona campo a buscar')); ?>
        
    </span>
	<div class="row hide" data-id="1">
		<?php echo $form->textField($model,'identificador',array('size'=>60,'maxlength'=>100)); ?>
	</div>
	<div class="row hide" data-id="2">
		<?php echo $form->textField($model,'ubicacion',array('size'=>60,'maxlength'=>100)); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->