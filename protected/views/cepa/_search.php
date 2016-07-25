<?php
/* @var $this CepaController */
/* @var $model Cepa */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	
     <?php echo CHtml::dropDownList('searchDropDown', 'id', Cepa::model()->getSearchCepa(),array('empty' =>'Selecciona Búsqueda')); ?>

	<div class="row hide" data-id='1'>
		<label>Buscar:</label>
		<?php echo $form->dropDownList($model,'id_especie',Especie::model()->getAllEspecies(),array('empty'=>'Seleccionar','class'=>'css-select')); ?>
	</div>
	<div class="row hide" data-id='2'>
		<label>Buscar:</label>
		<?php echo $form->textField($model,'nombre_cepa',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons hide">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->