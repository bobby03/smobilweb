<?php
/* @var $this ViajesController */
/* @var $model Viajes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'htmlOptions'=>array('data-form'=>1)
)); ?>
    <span class="css-select-moz">
        <?php echo CHtml::dropDownList('searchDropDown', 'id', $model->getSearchViajes(),array('empty' =>'Selecciona campo a buscar','data-s'=>1)); ?>
        
    </span>
	<div class="row hide" data-id="1">
            <?php echo $form->textField($model,'id'); ?>
	</div>
	<div class="row hide" data-id="2">
            <?php echo $form->dropDownList($model,'id_solicitudes', Solicitudes::model()->getSolicitudes(1), array('empty'=>'Seleccionar', 'class'=>'css-select','style'=>'height:30px')); ?>
	</div>
	<div class="row hide" data-id="3">
            <?php echo $form->dropDownList($model,'id_responsable', SolicitudesViaje::model()->getpersonal(3), array('empty'=>'Seleccionar', 'class'=>'css-select','style'=>'height:30px')); ?>
	</div>
	<div class="row hide" data-id="4">
            <?php echo $form->dropDownList($model,'id_estacion', Estacion::model()->getEstacionesOcupadas(), array('empty'=>'Seleccionar', 'class'=>'css-select','style'=>'height:30px')); ?>
	</div>
	<div class="row hide" data-id='5'>
            <?php echo $form->textField($model,'fecha_salida',array('placeholder'=>'aaaa-mm-dd')); ?>
	</div>
	<div class="row hide" data-id="6">
            <?php echo $form->textField($model,'hora_salida'); ?>
	</div>
<!--
	<div class="row hide" data-id="3">
		<?php echo $form->textField($model,'status',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row" data-id="4">
		<?php echo $form->textField($model,'fecha_salida'); ?>
	</div>


	<div class="row" data-id="6">
		<?php echo $form->textField($model,'fecha_entrega'); ?>
	</div>

	<div class="row" data-id="7">
		<?php echo $form->textField($model,'hora_entrega'); ?>
	</div>

	<div class="row buttons hide">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>-->


<?php $this->endWidget(); ?>

</div><!-- search-form -->