<?php
/* @var $this SolicitudesController */
/* @var $model Solicitudes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
    <span class="css-select-moz">
 	<?php echo CHtml::dropDownList('searchDropDown3', 'id', $model->getSearchSolicitud(),array('empty' =>'Selecciona campo a buscar')); ?>
        
    </span>


	<div class="row hide" data-id='1'>
            <span class="css-select-moz">
		<?php echo $form->dropDownList($model,'id_clientes',Clientes::model()->getAllClientes(),array('empty'=>'Seleccionar','class'=>'css-select','style'=>'height:30px')); ?>
                
            </span>
	</div>

	<div class="row hide" data-id='2'>
		
		<?php echo $form->textField($model,'codigo',array('size'=>50,'maxlength'=>50)); ?>
	</div>
	
	<div class="row hide" data-id='3'>
		
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row hide" data-id='4'>
		
		<?php echo $form->textField($model,'fecha_alta',array('placeholder'=>'aaaa-mm-dd')); ?>
	</div>
	
	<div class="row hide" data-id='5'>
		
		<?php echo $form->textField($model,'hora_alta'); ?>
	</div>


	<div class="row hide" data-id='6'>
		
		<?php echo $form->textField($model,'fecha_estimada',array('placeholder'=>'aaaa-mm-dd')); ?>
	</div>

	<div class="row hide" data-id='7'>
		
		<?php echo $form->textField($model,'hora_estimada'); ?>
	</div>


  <!--	

	<div class="row hide" data-id='4'>
		
		<?php echo $form->textField($model,'hora_alta'); ?>
	</div>


	<div class="row hide" data-id='6'>
		
		<?php echo $form->textField($model,'hora_estimada'); ?>
	</div>

	
	<div class="row hide" data-id='9'>
		
		<?php echo $form->textField($model,'notas',array('size'=>60,'maxlength'=>100)); ?>
	</div>-->

	<div class="row buttons hide">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->