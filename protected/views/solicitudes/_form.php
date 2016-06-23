<?php
    $baseUrl = Yii::app()->baseUrl;
?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDaG6uwH8h6edDH6rPh0PfGgq6yEqSedgg"></script>
<script type="text/javascript" src="<?php echo $baseUrl;?>/js/plugins/google-maps/jquery.ui.map.full.min.js"></script>
<?php
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/calendario.js');
    $cs->registerScriptFile($baseUrl.'/js/solicitudes/create.js');
    $cs->registerScriptFile($baseUrl.'/js/solicitudes/colorboxCreate.js');
    $cs->registerScriptFile($baseUrl.'/js/solicitudes/googleMap.js');
    $cs->registerScriptFile($baseUrl.'/js/solicitudes/pedidos.js');
    $cs->registerScriptFile($baseUrl.'/js/plugins/chosen/assets/js/chosen.jquery.min.js');
    $cs->registerCssFile($baseUrl.'/js/plugins/chosen/assets/css/chosen.min.css');
    $cs->registerScriptFile($baseUrl.'/js/plugins/ColorBox/jquery.colorbox.js');
    $cs->registerCssFile($baseUrl.'/js/plugins/ColorBox/colorbox.css');
    $cs->registerCssFile($baseUrl.'/css/solicitudes/create.css');
    date_default_timezone_set("Pacific/Easter");
    $direcciones = new ClientesDomicilio();
    $this->widget('zii.widgets.jui.CJuiDatePicker',array
    (
        'name' => 'SolicitudesForm',
        // additional javascript options for the date picker plugin
        'options'=>array(
            'showAnim'=>'fold',
        ),
        'htmlOptions'=>array(
            'style'=>'display:none;'
        ),
));
?>
<div class="form">
    <div class="formContainer1">
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'solicitudes-form',
    //        'htmlOptions'=>array('name'=>'SolicitudesForm'),
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation'=>false
    )); ?>
	<!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->

	<?php echo $form->errorSummary($model); ?>
        <div class="domicilioForm hide">
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
            <div class="row buttons">
                <div class="aceptarDireccion">Aceptar</div>
                <div class="cancelarDireccion">Cancelar</div>
            </div>
        </div>
        <h2>Clientes</h2>
	<div class="row">
		<span class='css-select-moz'>
                    <?php echo $form->dropDownList($model,'id_clientes', Clientes::model()->getAllClientes(), array('empty'=>'Seleccionar', 'class'=>'css-select')); ?>
                </span>
		<?php echo $form->error($model,'id_clientes'); ?>
	</div>
        <div class="row pedido hide">
            <h2>Pedido</h2>
            <div class="row">
                <label>Especie</label>
                <?php echo $form->dropDownList($especies,'id', $especies->getAllEspeciesSolicitud(), array('class'=>'css-select','empty'=>'Seleccionar')); ?>
                <?php echo $form->error($especies,'id'); ?>
            </div>

            <div class="row cepa hide">
                <label>Cepa</label>
                <?php echo $form->dropDownList($cepa,'id', array('1'=>'1'),array('empty'=>'Seleccionar','class'=>'css-select')); ?>
                <?php echo $form->error($cepa,'id'); ?>
            </div>
            <div class="row cantidad hide">
                <div class="disponible">
                    <label>Cantidad disponible</label>
                    <input type="text" readonly value="500">
                </div>
                <div class="requerida">
                    <label>Cantidad requerida</label>
                    <?php echo $form->numberField($cepa,'cantidad',array('min'=>1, 'max'=>50)); ?>
                    <?php echo $form->error($cepa,'cantidad'); ?>
                </div>
            </div>
            <div class="row direcciones hide">
                <label>Dirección</label>
                <div class="input boton">
                    <?php echo $form->dropDownList($direcciones,'domicilio',array(''),array('empty'=>'Seleccionar','class'=>'css-select'));?>
                    <?php echo $form->error($direcciones,'domicilio'); ?>
                    <div class="botonOtra">Otra</div>
                </div>
                <div class="row buttons hide">
                    <div class="agregar">Agregar pedido</div>
                        <?php // echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
                </div>
            </div>
    <!--	<div class="row">
                <label>Estación</label>
                <?php echo $form->dropDownList($estaciones,'identificador', $estaciones->getEstacionSolicitud(), array('class'=>'css-select','empty'=>'Selecionar')); ?>
                <?php echo $form->error($estaciones,'identifiacdor'); ?>
            </div>-->
    <!--        <div class="row">
                    <?php echo $form->labelEx($model,'codigo'); ?>
                    <?php echo $form->textField($model,'codigo',array('maxlength'=>50)); ?>
                    <?php echo $form->error($model,'codigo'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($model,'fecha_estimada'); ?>
                    <?php echo $form->textField($model,'fecha_estimada', array('class'=>'calendario', 'readonly'=>'readonly')); ?>
                    <?php echo $form->error($model,'fecha_estimada'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($model,'hora_estimada'); ?>
                    <?php echo $form->textField($model,'hora_estimada', array('placeholder'=>'hh:mm')); ?>
                    <?php echo $form->error($model,'hora_estimada'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($model,'fecha_entrega'); ?>
                    <?php echo $form->textField($model,'fecha_entrega', array('class'=>'calendario', 'readonly'=>'readonly')); ?>
                    <?php echo $form->error($model,'fecha_entrega'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($model,'hora_entrega'); ?>
                    <?php echo $form->textField($model,'hora_entrega', array('placeholder'=>'hh:mm')); ?>
                    <?php echo $form->error($model,'hora_entrega'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($model,'notas'); ?>
                    <?php echo $form->textField($model,'notas',array('maxlength'=>100)); ?>
                    <?php echo $form->error($model,'notas'); ?>
            </div>
            -->
        </div>
    </div>
    <div class="formContainer2">
        <h2>Detalles</h2>
        <div class="wraper">
            <div class="Cliente">
                <div class="titulo hide">Cliente</div>  
                <div class="datosCliente"></div>
            </div>
            <div class="fechaYora">
                <div class="dateHoy"><?php echo date('d/m/Y');?></div>
                <div class="timeHoy"><?php echo date('g:i A');?></div>
            </div>
            <div class="pedidos hide">
                <div class="titulo2">Pedido</div>
                <div class="pedidosWraper"></div>
            </div>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->