<?php
/* @var $this ViajesController */
/* @var $model Viajes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'htmlOptions'=>array('data-form'=>2)
)); ?>
    <span class="css-select-moz">
        <?php echo CHtml::dropDownList('searchDropDown2', 'id', $model->getSearchViajes(),array('empty' =>'Selecciona campo a buscar','data-s'=>2)); ?>
        
    </span>
	<div class="row hide" data-id="1">
            <?php echo $form->textField($model,'id'); ?>
	</div>
<!--	<div class="row hide" data-id="2">
            <span class="css-select-moz">
                <?php echo $form->dropDownList($model,'id_solicitudes', Solicitudes::model()->getSolicitudes(1), array('empty'=>'Seleccionar', 'class'=>'css-select','style'=>'height:30px')); ?>
            </span>
	</div> -->
	<div class="row hide" data-id="3">
            <span class="css-select-moz">
                <?php echo $form->dropDownList($model,'id_responsable', SolicitudesViaje::model()->getpersonal(3), array('empty'=>'Seleccionar', 'class'=>'css-select','style'=>'height:30px')); ?>
            </span>
	</div>
	<div class="row hide" data-id="4">
            <span class="css-select-moz">
                <?php echo $form->dropDownList($model,'id_estacion', Estacion::model()->getEstacionesOcupadas(), array('empty'=>'Seleccionar', 'class'=>'css-select','style'=>'height:30px')); ?>
            </span>
	</div>
	<div class="row hide" data-id='5'>
            <?php echo $form->textField($model,'fecha_salida',array('placeholder'=>'aaaa-mm-dd')); ?>
	</div>
        <div class="row hide" data-id="6">
            <?php echo $form->textField($model,'hora_salida'); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->