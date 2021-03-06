<?php
/* @var $this CampSensadoController */
/* @var $model CampSensado */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
    <span class="css-select-moz">
	<?php echo CHtml::dropDownList('searchDropDown3', 'id', $model->getSearchViajes(),array('empty' =>'Selecciona campo a buscar','data-s'=>1)); ?>
    </span>
<!--	<div class="row hide" data-id="1">
            <?php echo $form->dropDownList($model,'id', CampSensado::model()->getGranjasName(2), array('empty'=>'Seleccionar', 'class'=>'css-select')); ?>
	</div>-->
	
	<div class="row hide" data-id="2">
            <?php echo $form->textField($model,'nombre_camp'); ?>
	</div>

	<div class="row hide" data-id="3">
            <span class="css-select-moz"><?php echo $form->dropDownList($model,'id_estacion', CampSensado::model()->getProduccionName(0), array('empty'=>'Seleccionar', 'class'=>'css-select','style'=>'height:30px')); ?></span>
        </div>
        <div class="row hide" data-id="4">
            <span class="css-select-moz"><?php echo $form->dropDownList($model,'id_responsable', CampSensado::model()->getResponsableName(0), array('empty'=>'Seleccionar', 'class'=>'css-select','style'=>'height:30px')); ?></span>
        </div>
	
	<div class="row hide" data-id="5">
            <?php echo $form->textField($model,'fecha_inicio',array('placeholder'=>'aaaa-mm-dd')); ?>
	</div>
	
<?php $this->endWidget(); ?>

</div><!-- search-form -->