<?php
/* @var $this ViajesController */
/* @var $model Viajes */
$baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/calendario.js');
    $cs->registerScriptFile($baseUrl.'/js/plugins/chosen/assets2/js/chosen.jquery.min.js');
    $cs->registerCssFile($baseUrl.'/js/plugins/chosen/assets2/css/chosen.min.css');
    $cs->registerScriptFile($baseUrl.'/js/viajes/update.js');
    $cs->registerScriptFile($baseUrl.'/js/jquery.mask.min.js');
    $cs->registerScriptFile($baseUrl.'/js/viajes/validacion.js');
    $cs->registerCssFile($baseUrl.'/css/viajes/create.css');
    $this->widget('zii.widgets.jui.CJuiDatePicker',array
    (
        'name' => 'ViajesForm',
        // additional javascript options for the date picker plugin
        'options'=>array(
            'showAnim'=>'fold',
        ),
        'htmlOptions'=>array(
            'style'=>'display:none;'
        )
    ));
$this->breadcrumbs=array(
	'Viajes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Editar viaje #<?php echo $model->id; ?></h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'viajes-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
    <div class="tab" data-tab="1">
	<div class="formContainer1">
            <div class="row">
		<?php echo $form->labelEx($model,'id_responsable'); ?>
                <span class="css-select-moz">
                    <?php echo $form->dropDownList($model,'id_responsable', $personal->getpersonal(3), array('empty'=>'Seleccionar','class'=>'css-select'));?>
                    <?php echo $form->error($model,'id_responsable'); ?>
                </span>
            </div>
            <div class="row">
                <label>Técnico(s)</label>
                <span class="css-select-moz">
                    <?php echo $form->dropDownList($personal,'id_personal[1][tecnico]', $personal->getpersonal(2), array('class'=>'css-select','multiple'=>'true','options'=>$roles['tecnico'])); ?>
                    <?php echo $form->error($model,'id_personal[1][tecnico]'); ?>
                </span>
            </div>
            <div class="row">
                <label>Chofer(es)</label>
                <span class="css-select-moz">
                    <?php echo $form->dropDownList($personal,'id_personal[1][chofer]', $personal->getpersonal(1), array('class'=>'css-select','multiple'=>'true','options'=>$roles['chofer'])); ?>
                    <?php echo $form->error($model,'id_personal[1][chofer]'); ?>
                </span>
                </span>
            </div>
        </div>
        <div class="formContainer1">
            <div class="row">
                <?php echo $form->labelEx($model,'id_estacion'); ?>
                <span class="css-select-moz">
                    <?php 
                        if($model->isNewRecord){
                            echo $form->dropDownList($model,'id_estacion', Estacion::model()->getEstacionesDisponibles(), array('empty'=>'Seleccionar','class'=>'css-select'));
                        }else{
                               echo $form->dropDownList($model,'id_estacion', Estacion::model()->getAllEstacion(), 
                                    array
                                    (
                                        'disabled'=>'disabled',
                                        'class'=>'css-select',
                                        'value'=>$model->id_estacion
                                    ));
                        }
                         
                          echo $form->error($model,'id_estacion');
                    ?>
                </span>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model,'fecha_salida'); ?>
                <?php echo $form->textField($model,'fecha_salida', array('class'=>'calendario', 'readonly'=>'readonly')); ?>
                 <?php echo $form->error($model,'fecha_salida'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model,'hora_salida'); ?>
                <?php echo $form->textField($model,'hora_salida', array('placeholder'=>'hh:mm')); ?>
                 <?php echo $form->error($model,'hora_salida'); ?>
            </div>
	</div>

	<div class="row buttons ">
        <div class="bBoton fBoton update" >Regresar</div>
		<?php echo CHtml::submitButton('Guardar'); ?>
	</div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
