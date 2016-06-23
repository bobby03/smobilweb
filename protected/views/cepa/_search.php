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

	

	<div class="row">
		<label>Buscar:</label>
		<?php echo $form->textField($model,'nombre_cepa',array('size'=>50,'maxlength'=>50)); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- search-form -->