<?php
/* @var $this ViajesController */
/* @var $model Viajes */
$baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/calendario.js');
    $cs->registerScriptFile($baseUrl.'/js/plugins/chosen/assets2/js/chosen.jquery.min.js');
    $cs->registerCssFile($baseUrl.'/js/plugins/chosen/assets2/css/chosen.min.css');
//    $cs->registerScriptFile($baseUrl.'/js/viajes/create.js');
    $cs->registerScriptFile($baseUrl.'/js/viajes/update.js');
//    $cs->registerScriptFile($baseUrl.'/js/viajes/create-viaje.js');
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
<style>
    div.infoBolas
    {
        color: #0077b0;
        width: 150px;
        /* margin-right: 25px; */
        text-align: left;
    }
    .gBoton
    {
        margin-right: 80px;
    }
</style>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'viajes-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
    <div class="menuTabs">
        <div class="bolaChica selected"></div>
        <div class="lineaChica selected"></div>
        <div class="bolaGrande selected">1<div class="infoBolas">Datos del viaje</div></div>
        <div class="lineaGandre"></div>
        <div class="bolaGrande">2<div class="infoBolas">Asignar tanques</div></div>
        <div class="lineaGandre"></div>
        <div class="bolaGrande">3<div class="infoBolas">Finalizar</div></div>
        <div class="lineaChica"></div>
        <div class="bolaChica"></div>
    </div>
    <div class="tab" data-tab="1">
     <div class="botonesWrapper">
        <div style="float:right">
                <a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/viajes">Cancelar</a>
                <div class="siguiente uno">Siguiente</div>
        </div>
    </div>
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
            <div class="row">
                <?php echo $form->labelEx($model,'fecha_salida'); ?>
                <?php echo $form->textField($model,'fecha_salida', array('class'=>'calendario', 'readonly'=>'readonly')); ?>
                 <?php echo $form->error($model,'fecha_salida'); ?>
            </div>
        </div>
        <div class="formContainer1">
            <div class="row">
                <label>Solicitudes sin asignar</label>
                <span class="css-select-moz">
                    <?php echo $form->dropDownList($model,'id_solicitudes', $solicitudes = Solicitudes::model()->getClientesEnEsperaId($model->id),
                                array
                                (
                                    'class'=>'css-select',
                                    'multiple'=>'true',
                                    'options'=>$roles['solicitudes']
                                ));
                     ?>
                    <?php echo $form->error($model,'id_solicitudes[1]'); ?>
                </span>
            </div>
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
                                        'class'=>'css-select',
                                        'value'=>$model->id_estacion
                                    ));
                        }
                         
                          echo $form->error($model,'id_estacion');
                    ?>
                </span>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model,'hora_salida'); ?>
                <?php echo $form->textField($model,'hora_salida', array('placeholder'=>'hh:mm')); ?>
                <?php echo $form->error($model,'hora_salida'); ?>
            </div>
           
	</div>
    </div>
    <div class="tab hide" data-tab="2">
        
        <div class="botonesWrapper2">
            <div class="siguiente dos">Siguiente</div>
            <div class="bUno fBoton regresar floatingbutton">Regresar</div>
        </div>
        <div class="pedidosWraper"></div>   
    </div>
    <div class="tab hide last" data-tab="3">
       <div class="inner-third-wrapper">
            <div class='row buttons floating'>
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Finalizar' : 'Finalizar'); ?>
                <div class="bDos fBoton  regresar floatingbutton">Regresar</div>
                <!--<div class="fBoton floatingbutton" >Cancelar</div>-->
            </div>
       </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
