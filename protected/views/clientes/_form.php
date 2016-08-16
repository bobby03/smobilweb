<?php
/* @var $this ClientesController */
/* @var $model Clientes */
/* @var $form CActiveForm */
    $baseUrl = Yii::app()->baseUrl;
?>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDaG6uwH8h6edDH6rPh0PfGgq6yEqSedgg"></script>
<script type="text/javascript" src="<?php echo $baseUrl;?>/js/plugins/google-maps/jquery.ui.map.full.min.js"></script>
<?php 
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/clientes/googleMap.js');
    $cs->registerScriptFile($baseUrl.'/js/jquery.mask.min.js');
    $cs->registerScriptFile($baseUrl.'/js/clientes/validacion.js');
    $cs->registerCssFile($baseUrl.'/css/clientes/create.css');
    $cs->registerCssFile($baseUrl.'/css/clientes/clientes.css');
?>
<div class="form">

<?php 
    $form=$this->beginWidget('CActiveForm', array(
    'id'=>'clientes-form',

    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    // 'enableAjaxValidation'=>true,
    'enableAjaxValidation'=>TRUE,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
            'validateOnType' => true,
        ),
    )); 
?>

<div class="form-containerWraper">
         <span class="containerBox">
            <div class="form-cLeft">
                    <div class="row">
                        <label class="letreros">Nombre de empresa</label>
                            <div class="form-cLarge">
                            <?php echo $form->textField($model,'nombre_empresa',array('size'=>60,'maxlength'=>150)); ?>
                            <?php echo $form->error($model,'nombre_empresa'); ?>
                           </div>
                    </div>

                    <div class="row">
                        <label class="letreros">Nombre(s) de contacto</label>
                            <div class="form-cLarge">
                            <?php echo $form->textField($model,'nombre_contacto',array('size'=>50,'maxlength'=>50,'class'=>'ValidaAlpha')); ?>
                            <?php echo $form->error($model,'nombre_contacto'); ?>
                           </div>
                    </div>

                    <div class="row">
                        <label class="letreros"> Apellido(s) de contacto </label>
                            <div class="form-cLarge">
                            <?php echo $form->textField($model,'apellido_contacto',array('size'=>50,'maxlength'=>50,'class'=>'ValidaAlpha')); ?>
                            <?php echo $form->error($model,'apellido_contacto'); ?>
                            </div>
                    </div>

            </div>
            <div class="form-cRight">
                    <div class="row">
                        <label class="letreros">E-mail</label>
                            <div class="form-cLarge">
                            <?php echo $form->emailField($model,'correo',array('size'=>60,'maxlength'=>100)); ?>
                            <?php echo $form->error($model,'correo'); ?>
                           </div>
                    </div>
                    <div class="row">
                        <label class="letreros">RFC</label>
                            <div class="form-cLarge">
                            <?php echo $form->textField($model,'rfc',array('size'=>12,'maxlength'=>12)); ?>
                            <?php echo $form->error($model,'rfc'); ?>
                           </div>
                    </div>

                    <div class="row">
                        <label class="letreros">Teléfono</label>
                            <div class="form-cLarge">
                            <?php echo $form->textField($model,'tel',array('size'=>14,'minlength'=>14)); ?>
                            <?php echo $form->error($model,'tel'); ?>
                           </div>
                    </div>
                    <!-- Extensión -->
                    <div class="row">
                        <label class="letreros">Extensi&oacute;n</label>
                            <div class="form-cLarge">
                            <?php echo $form->textField($model,'ext',array('size'=>4,'minlength'=>3)); ?>
                            <?php echo $form->error($model,'ext'); ?>
                           </div>
                    </div>
                </div>
        </span>   
         <span class="containerBox">
                    <div class="row">
                        <h3><label class="cLetreros">Direcciones</label><h2 class = "letrero-container"></h2></h3>
                   </div>
        </span>
        <div class="addDireccion">Nueva dirección</div> 
        <span class= "containerBox">
            <div class="form-cLeft1">   
                <div class="row mapa">
                    <?php $i = 1;?>
                    <?php if(count($direccion['domicilio'])>0):?>
                        <?php foreach($direccion['domicilio'] as $data):?>
                            <div class="allMapa" data-id="<?php echo $i;?>">
                                <div id="map" data-map="<?php echo $i;?>"></div>
                                <div class="row ubi">
                                    <div class="form-cXMedium">
                                        <?php echo $form->hiddenField($direccion,"domicilio[$i][ubicacion_mapa]",array('size'=>60,'maxlength'=>250,'readonly'=>'readonly')); ?>
                                        <?php echo $form->error($direccion,'ubicacion_mapa'); ?>
                                    </div>
                                </div>
                                <div class="row dom">
                                    <div class="form-cXLarge">
                                        <label class="letreros">Domicilio</label>
                                        <?php echo $form->textField($direccion,"domicilio[$i][domicilio]",array('size'=>60,'maxlength'=>250)); ?>
                                        <?php echo $form->error($direccion,'domicilio'); ?>
                                    </div>
                                </div>
                                <div class="row des">
                                    <div class="form-cXLarge">
                                        <label class="letreros">Descripción</label>
                                        <?php echo $form->textField($direccion,"domicilio[$i][descripcion]",array('size'=>60,'maxlength'=>250)); ?>
                                        <?php echo $form->error($direccion,'descripcion');?>
                                    </div>
                                </div>
                                <?php if(isset($data['id'])):?>
                                    <div class="row">
                                        <?php echo $form->hiddenField($direccion,"domicilio[$i][id]")?>
                                    </div>
                                <?php endif;?>
                            </div>
                            <?php $i++;?>
                        <?php endforeach;?>
                    <?php else:?>
                        <div class="allMapa" data-id="1">
                          <div id="map" data-map="1"></div>
                            <div class="row ubi">
                                <div class="form-cXMedium">
                                    <?php echo $form->hiddenField($direccion,"domicilio[1][ubicacion_mapa]",array('size'=>60,'maxlength'=>250,'readonly'=>'readonly')); ?>
                                    <?php echo $form->error($direccion,'ubicacion_mapa'); ?>
                                </div>
                            </div>
                            <div class="row dom">
                                <div class="form-cXLarge">
                                    <label class="letreros">Domicilio</label>
                                    <?php echo $form->textField($direccion,"domicilio[1][domicilio]",array('size'=>60,'maxlength'=>250)); ?>
                                    <?php echo $form->error($direccion,'domicilio'); ?>
                                </div>
                            </div>
                            <div class="row des">
                                <div class="form-cXLarge">
                                    <label class="letreros">Descripción</label>
                                    <?php echo $form->textField($direccion,"domicilio[1][descripcion]",array('size'=>60,'maxlength'=>250)); ?>
                                    <?php echo $form->error($direccion,'descripcion');?>
                                </div>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>

                </div>
           </span>
    </div>
    <div class="containerbutton">
        <div class="row buttons">
            <a class="cancelarDireccion gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/clientes">Cancelar</a> 
           <!--<div class="addDireccion">Nueva dirección</div> -->
           <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar'); ?>
       </div>
   </div>
<?php $this->endWidget(); ?>

</div><!-- form -->