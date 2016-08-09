<?php
/* @var $this RolesController */
/* @var $model Roles */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<div class="row">
		
		<?php echo $form->textField($model,'nombre_rol',array('size'=>50,'maxlength'=>50)); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- search-form -->