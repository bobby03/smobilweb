<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/calendario.js');
    $cs->registerScriptFile($baseUrl.'/js/plugins/chosen/assets2/js/chosen.jquery.min.js');
    $cs->registerCssFile($baseUrl.'/js/plugins/chosen/assets2/css/chosen.min.css');
    $cs->registerScriptFile($baseUrl.'/js/viajes/create.js');
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
?>
<style>
    div.infoBolas
    {
        color: #0077b0;
        width: 150px;
        /* margin-right: 25px; */
        text-align: left;
    }
</style>
<h1>Datos del viajes</h1>
<div class="form">
<?php
    $cs->registerScriptFile($baseUrl.'/js/viajes/create-viajes.js');
    $form = $this->beginWidget('CActiveForm', array
    (
        'id'=>'viajes-form',
        'enableAjaxValidation'=>false
//        'clientOptions' => array
//        (
//            'validateOnSubmit' => true,
//            'validateOnChange' => true,
//            'validateOnType' => true,
//            //'afterValidate'=>'js:formSendViajes',
//        ),
    )); 
?>
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
        <div class="botonesWrapper3">
            <a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/viajes">Cancelar</a>
            <div class="siguiente uno">Siguiente</div>
        </div>
        <div class="formContainer1">
            <div class="row">
                <?php echo $form->labelEx($model,'id_responsable'); ?>
                <span class="css-select-moz">
                    <?php echo $form->dropDownList($model,'id_responsable', $personal->getpersonal(3), array('empty'=>'Seleccionar','class'=>'css-select','value'=>$model->id_responsable));?>
                    <?php echo $form->error($model,'id_responsable'); ?>
                </span>
            </div>
            <?php if($model->isNewRecord):?>
                <div class="row">
                    <label>Técnico(s) <span class="required">*</span></label>
                    <span class="css-select-moz">
                        <?php echo $form->dropDownList($personal,'id_personal[1][tecnico]', $personal->getpersonal(2), array('class'=>'css-select','multiple'=>'true')); ?>
                        <?php echo $form->error($model,'id_personal[1][tecnico]'); ?>
                    </span>
                </div>
                <div class="row">
                    <label>Chofer(es) <span class="required">*</span></label>
                    <span class="css-select-moz">
                        <?php echo $form->dropDownList($personal,'id_personal[1][chofer]', $personal->getpersonal(1), array('class'=>'css-select','multiple'=>'true')); ?>
                        <?php echo $form->error($model,'id_personal[1][chofer]'); ?>
                    </span>
                    </span>
                </div>
            <?php endif;?>
            <div class="row">
                <?php echo $form->labelEx($model,'fecha_salida'); ?>
                <?php echo $form->textField($model,'fecha_salida', array('class'=>'calendario', 'readonly'=>'readonly')); ?>
                 <?php echo $form->error($model,'fecha_salida'); ?>
            </div>
        </div>
        <div class="formContainer1"> 
            <div class="row">
                <label>Solicitudes sin asignar <span class="required">*</span></label>
                <span class="css-select-moz">
                    <?php echo $form->dropDownList($model,'id_solicitudes', Solicitudes::model()->getClientesEnEspera(),
                                array
                                (
                                    'class'=>'css-select',
                                    'multiple'=>'true'
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
//                                        'disabled'=>'disabled',
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
                <?php echo $form->textField($model,'hora_salida', array('placeholder'=>'hh:mm (24 horas)')); ?>
                <?php echo $form->error($model,'hora_salida'); ?>
            </div>
            
        </div>
    </div>
    <div class="tab hide" data-tab="2">
        <div class="botonesWrapper">
            <!--<a class="gBoton" href="<?php // echo Yii::app()->getBaseUrl(true); ?>/viajes">Cancelar</a>-->
            <div class="siguiente dos">Siguiente</div>
            <div class="bUno fBoton regresar">Regresar</div>
        </div>
        <div class="pedidosWraper"></div>   
    </div>
    <div class="tab last hide" data-tab="3">
        <div class='row buttons floating'>
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Finalizar' : 'Finalizar'); ?>
            <div class="bDos fBoton floatingbutton regresar">Regresar</div>
        </div>
        <div class="inner-third-wrapper"></div>
    </div>
<?php
    $this->endWidget();
?>
</div>



