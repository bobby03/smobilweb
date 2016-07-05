<?php
/* @var $this ClientesController */
/* @var $model Clientes */
/* @var $form CActiveForm */
    $baseUrl = Yii::app()->baseUrl;
?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="<?php echo $baseUrl;?>/js/plugins/google-maps/jquery.ui.map.full.min.js"></script>
<?php 
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/clientes/googleMap.js');
    $cs->registerCssFile($baseUrl.'/css/clientes/create.css');
?>
<div class="form">

<?php 
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'clientes-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    )); 
    $noDireccion = 1;
?>



<div class="form-containerWraper">
<div class="form-container1">
	<div class="row">
		<?php echo $form->labelEx($model,'nombre_empresa'); ?>
		<?php echo $form->textField($model,'nombre_empresa',array('size'=>60,'maxlength'=>150)); ?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_contacto'); ?>
		<?php echo $form->textField($model,'nombre_contacto',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellido_contacto'); ?>
		<?php echo $form->textField($model,'apellido_contacto',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'correo'); ?>
		<?php echo $form->emailField($model,'correo',array('size'=>60,'maxlength'=>100)); ?>
	</div>
</div>
<div class="form-container2">
	<div class="row">
		<?php echo $form->labelEx($model,'rfc'); ?>
		<?php echo $form->textField($model,'rfc',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tel'); ?>
		<?php echo $form->textField($model,'tel',array('size'=>12,'maxlength'=>12)); ?>
	</div>
    </div>
</div>
    <div class="row">
            <h3>Direcciones <div class="addDireccion">Agregar dirección</div> </h3>
        </div>
        <div class="row mapa">
            <?php if($model->isNewRecord):?> 
                <div class="allMapa" data-id="1">
                    <div class="row dom">
                        <?php echo $form->labelEx($direccion,'domicilio'); ?>
                        <?php echo $form->textField($direccion,"domicilio[1][domicilio]",array('size'=>60,'maxlength'=>250)); ?>
                        <?php echo $form->error($direccion,'domicilio'); ?>
                    </div>
                    <div id="map" data-map="1"></div>
                    <div class="row ubi">
                        <?php echo $form->labelEx($direccion,'ubicacion_mapa'); ?>
                        <?php echo $form->textField($direccion,"domicilio[1][ubicacion_mapa]",array('size'=>60,'maxlength'=>250,'readonly'=>'readonly')); ?>
                        <?php echo $form->error($direccion,'ubicacion_mapa'); ?>
                    </div>
                    <div class="row des">
                        <?php echo $form->labelEx($direccion,'descripcion'); ?>
                        <?php echo $form->textField($direccion,"domicilio[1][descripcion]",array('size'=>60,'maxlength'=>250)); ?>
                        <?php echo $form->error($direccion,'descripcion');?>
                    </div>
                </div>
            <?php else:?>
                <?php $i = 1;?>
                <?php if(count($direccion['domicilio'])>0):?>
                    <?php foreach($direccion['domicilio'] as $data):?>
                        <div class="allMapa" data-id="<?php echo $i;?>">
                            <div class="row dom">
                                <?php echo $form->labelEx($direccion,'domicilio'); ?>
                                <?php echo $form->textField($direccion,"domicilio[$i][domicilio]",array('size'=>60,'maxlength'=>250)); ?>
                                <?php echo $form->error($direccion,'domicilio'); ?>
                            </div>
                            <div id="map" data-map="<?php echo $i;?>"></div>
                            <div class="row ubi">
                                <?php echo $form->labelEx($direccion,'ubicacion_mapa'); ?>
                                <?php echo $form->textField($direccion,"domicilio[$i][ubicacion_mapa]",array('size'=>60,'maxlength'=>250,'readonly'=>'readonly')); ?>
                                <?php echo $form->error($direccion,'ubicacion_mapa'); ?>
                            </div>
                            <div class="row des">
                                <?php echo $form->labelEx($direccion,'descripcion'); ?>
                                <?php echo $form->textField($direccion,"domicilio[$i][descripcion]",array('size'=>60,'maxlength'=>250)); ?>
                                <?php echo $form->error($direccion,'descripcion');?>
                            </div>
                            <div class="row">
                                <?php echo $form->hiddenField($direccion,"domicilio[$i][id]")?>
                            </div>
                        </div>
                        <?php $i++;?>
                    <?php endforeach;?>
                <?php else:?>
                    <div class="allMapa" data-id="1">
                        <div class="row dom">
                            <?php echo $form->labelEx($direccion,'domicilio'); ?>
                            <?php echo $form->textField($direccion,"domicilio[1][domicilio]",array('size'=>60,'maxlength'=>250)); ?>
                            <?php echo $form->error($direccion,'domicilio'); ?>
                        </div>
                        <div id="map" data-map="1"></div>
                        <div class="row ubi">
                            <?php echo $form->labelEx($direccion,'ubicacion_mapa'); ?>
                            <?php echo $form->textField($direccion,"domicilio[1][ubicacion_mapa]",array('size'=>60,'maxlength'=>250,'readonly'=>'readonly')); ?>
                            <?php echo $form->error($direccion,'ubicacion_mapa'); ?>
                        </div>
                        <div class="row des">
                            <?php echo $form->labelEx($direccion,'descripcion'); ?>
                            <?php echo $form->textField($direccion,"domicilio[1][descripcion]",array('size'=>60,'maxlength'=>250)); ?>
                            <?php echo $form->error($direccion,'descripcion');?>
                        </div>
                    </div>
                <?php endif;?>
            <?php endif;?>
        </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->