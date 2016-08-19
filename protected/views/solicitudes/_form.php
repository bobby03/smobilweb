<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/calendario.js');
    $cs->registerScriptFile($baseUrl.'/js/solicitudes/create.js?r='.rand());
    $cs->registerScriptFile($baseUrl.'/js/solicitudes/colorboxCreate.js');
    $cs->registerScriptFile($baseUrl.'/js/solicitudes/googleMap.js');
    $cs->registerScriptFile($baseUrl.'/js/solicitudes/pedidos.js');
    $cs->registerScriptFile($baseUrl.'/js/plugins/chosen/assets2/js/chosen.jquery.min.js');
    $cs->registerCssFile($baseUrl.'/js/plugins/chosen/assets2/css/chosen.min.css');
    $cs->registerScriptFile($baseUrl.'/js/plugins/ColorBox/jquery.colorbox.js');
    $cs->registerCssFile($baseUrl.'/js/plugins/ColorBox/colorbox.css');
    $cs->registerCssFile($baseUrl.'/css/solicitudes/create.css');

    $mystring =  $this->classes;
    $findme   = 'update';
    $ButtonAddUpdate = strpos($mystring, $findme)===false?'Agregar pedido':'Actualizar pedido';


?>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDaG6uwH8h6edDH6rPh0PfGgq6yEqSedgg"></script>
<script type="text/javascript" src="<?php echo $baseUrl;?>/js/plugins/google-maps/jquery.ui.map.full.min.js"></script>
<?php
    
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
<?php if($model->status == 1):?>
    <style>
        .save
        {
            border-radius: 5px;
            color: #FFFFFF;
            cursor: pointer;
            float: right;
            height: 35px;
            line-height: 35px;
            margin-right: 35px;
            text-align: center;
            width: 135px;
            font-size: 18px;
            background-color: #09b7c9
        }
        div.mensaje-content
        {
            font-size: 18px !important;
        }
    </style>
    <script>
        $(document).ready(function()
        {
            $('.guardar').click(function(evt)
            {
                evt.preventDefault();
                var html = '\n\
                    <div class="sub-content">\n\
                        <div class="title-content">Confirmación</div>\n\
                        <div class="separador-content"></div>\n\
                        <div class="mensaje-content">\n\
                            Si modifica esta solicitud se eliminará\n\
                            del viaje al que está asignada y se pasará a\n\
                            solicitudes sin asignar.\n\
                        </div>\n\
                        <div class="botones-content">\n\
                            <div class="gBoton cancel" style="margin-left: 35px">Cancelar</div>\n\
                            <div class="save">Continuar</div>\n\
                        </div>\n\
                    </div>';
                $.colorbox(
                {
                    html: html,
                    width: 400,
                    height: 200,
                    onComplete: function()
                    {
                        $('.save').click(function()
                        {
                            var baseUrl = window.location.href;
                            $('form#solicitudes-form').attr('action',baseUrl);
                            $('#solicitudes-form').submit();
                        });
                        $('.cancel').click(function()
                        {
                            $.colorbox.close();
                        });
                    }
                });
            });
        });
    </script>
<?php else:?>
    <script>
        $(document).ready(function()
    {
        $('div.guardar').click(function()
        {
            var baseUrl = window.location.href;
            $('form#solicitudes-form').attr('action',baseUrl);
            $('#Solicitudes_id_clientes').removeAttr('disabled');
            $('#Solicitudes_id_clientes').trigger('chosen:update');
    //        console.log('hola');
            $('#solicitudes-form').submit();
        });
    })
    </script>
<?php endif;?>
<?php 
    $flag = false;
    if($pedidos != '')
    {
        $flag = true;
        $cliente = Clientes::model()->findByPk($model->id_clientes);
        $domicilios = ClientesDomicilio::model()->getDireccionClienteSolicitudes($model->id_clientes);
        $return = array();
        $cliente = <<<eof
                <div class="datosContacto">$cliente->nombre_empresa</div>
                <div class="datosContacto"><span>RFC: </span>$cliente->rfc</div>
                <div class="datosContacto"><span>Contacto: </span>$cliente->nombre_contacto $cliente->apellido_contacto</div>
                <div class="datosContacto"><span>E-mail: </span>$cliente->correo</div>
                <div class="datosContacto"><span>Teléfono: </span>$cliente->tel</div>
eof;
        $return['cliente'] = $cliente;
        $return['domicilio'] = $domicilios;
        $cs->registerScriptFile($baseUrl.'/js/solicitudes/update.js');
    }
?>
<div class="form">
    <div class="formContainer1">
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'solicitudes-form',
            'action'=>$baseUrl.'/viajes/create',
    //        'htmlOptions'=>array('name'=>'SolicitudesForm'),
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation'=>false,
    )); ?>
	<!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->
        <?php echo $form->hiddenField($model, 'id');?>
	<?php echo $form->errorSummary($model); ?>

        <div class="domicilioForm hide"> 
            <div class="Odom">
            <div id="map" data-map="1"></div>
            <div class="row dom">
                <?php echo $form->labelEx($direccion,'domicilio'); ?>
                <?php echo $form->textField($direccion,"domicilio[1][domicilio]",array('size'=>60,'maxlength'=>250,'class'=>'OtroDom inputDom')); ?>
            </div>
            
            <div class="row ubi">
                <?php echo $form->hiddenField($direccion,"domicilio[1][ubicacion_mapa]",array('size'=>60,'maxlength'=>250,'readonly'=>'readonly','class'=>'OtroDom readOnly')); ?>
            </div>
            <div class="row des">
                <?php echo $form->labelEx($direccion,'descripcion'); ?>
                <?php echo $form->textField($direccion,"domicilio[1][descripcion]",array('size'=>60,'maxlength'=>250,'class'=>'OtroDom')); ?>
            </div>
            <div class="row buttons">

                <div class="aceptarDireccion">Aceptar</div>
                <div class="cancelarDireccion">Cancelar</div>
            </div>
            </div>
        </div>





        <h2>Clientes</h2>
	<div class="row">
            <span class='css-select-moz'>
                <span class="css-select-moz"> <?php echo $form->dropDownList($model,'id_clientes', Clientes::model()->getAllClientes(), array('empty'=>'Seleccionar', 'class'=>'css-select')); ?></span>
            </span>
	</div>
        <div class="row pedido hide"><!--hide-->
            <h2>Pedido</h2>
            <div class="row">
                <label>Especie</label>
                <span class="css-select-moz"><?php echo $form->dropDownList($especies,'id', $especies->getAllEspeciesSolicitud(), array('class'=>'css-select','empty'=>'Seleccionar')); ?></span>
                <?php echo $form->error($especies,'id'); ?>
            </div>

            <div class="row cepa hide">
                <label>Cepa</label>
               <span class="css-select-moz"><?php echo $form->dropDownList($cepa,'id', array('1'=>'1'),array('empty'=>'Seleccionar','class'=>'css-select')); ?></span>
                <?php echo $form->error($cepa,'id'); ?>
            </div>
            <div class="row cantidad hide"> <!--hide-->
                <div class="requerida">
                    <label>Cantidad requerida</label>
                    <div id="inputC"><?php echo $form->numberField($cepa,'nombre_cepa[1][cantidad]',array('min'=>1,'class'=>'ValidaNum')); ?></div>
                    <p class="ierror" id="errorCan"></p>
                </div>
                <div class="noTanques">
                    <label>Tanques requeridos</label>
                    <div id="inputC"><input id="tanquesNO" type="number" name="noTanques" min="1" max="8" class="ValidaNum"></div>
                    <p class="ierror" id="errorTan"></p>
                </div>

            </div>
            <div class="row direcciones hide">
                <label>Dirección</label>
                <div class="input boton">
                   <span class="css-select-moz"> <?php echo $form->dropDownList($direcciones,'domicilio',array(''),array('empty'=>'Seleccionar','class'=>'css-select'));?></span>
                    <?php echo $form->error($direcciones,'domicilio'); ?>
                    <div class="botonOtra">Otra</div>
                </div>
                <div class="row buttons hide">
                    <div class="row">
                        <?php echo $form->hiddenField($direccion,'id_cliente',array('value'=>0));?>
                        <?php echo $form->labelEx($model,'notas'); ?>
                        <?php echo $form->textField($model,'notas',array('maxlength'=>100)); ?>
                    </div>
                    <div class="agregar"><?php echo $ButtonAddUpdate; ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="formContainer2">
        <h2>Detalles</h2>
        <div class="wraper">
            <div class="Cliente">
                <div class="titulo hide">Cliente</div>  
                <div class="datosCliente">
                    <?php 
                        if($flag)
                            echo $return['cliente'];
                    ?>
                </div>
            </div>
            <div class="fechaYora">
                <div class="dateHoy"><?php echo date('d/m/Y');?></div>
                <div class="timeHoy"><?php echo date('g:i A');?></div>
            </div>
            <div class="pedidos <?php if($pedidos == '') echo 'hide';?>">
                <!-- <div class="titulo2"> -->
                    <div class="titulo3">Pedido</div>
                    <div class="titulo3">Organismos</div>
                <!-- </div> -->
                <div class="pedidosWraper" id="scroll">
                    <?php if($pedidos != ''):?>
                    <?php $i = 1;?>
                    <?php foreach($pedidos as $data):?>
                        <div class="pedidoViaje" data-id="<?php echo $i;?>">
                            <div class="datosPedido">
                                <input form="solicitudes-form" type="hidden" name="pedido[<?php echo $i;?>][especie]" readonly value="<?php echo $data->id_especie;?>">
                                <input form="solicitudes-form" type="hidden" name="pedido[<?php echo $i;?>][cepa]" readonly value="<?php echo $data->id_cepa;?>">
                                <input form="solicitudes-form" type="hidden" name="pedido[<?php echo $i;?>][cantidad]" value="<?php echo $data->cantidad;?>" readonly>
                                <input form="solicitudes-form" type="hidden" name="pedido[<?php echo $i;?>][destino]" readonly value="<?php echo $data->id_direccion;?>">
                                <input form="solicitudes-form" type="hidden" name="pedido[<?php echo $i;?>][tanques]" readonly value="<?php echo $data->tanques;?>">
                                <div class="pedidoInfo"><?php echo isset(Especie::model()->findByPk($data->id_especie)->nombre)?Especie::model()->findByPk($data->id_especie)->nombre:'<b>No hay data</b>'; ?></div>
                                <div class="pedidoInfo"><?php echo isset(Cepa::model()->findByPk($data->id_cepa)->nombre_cepa)?Cepa::model()->findByPk($data->id_cepa)->nombre_cepa:'<b>No hay data</b>';?></div>
                                <div class="pedidoInfo"><?php echo $data->cantidad;?></div>
                                <?php 
                                    if($data->tanques > 1)
                                        $tanque = 'Tanques';
                                    elseif($data->tanques == 1)
                                        $tanque = 'Tanque';
                                ?>
                                <div class="pedidoInfo"><?php echo $tanque;?>: <?php echo $data->tanques;?></div>
                                <div class="pedidoInfo"><?php echo ClientesDomicilio::model()->findByPk($data->id_direccion)->domicilio;?></div>
                            </div>
                            <div class="botonesPedido">
                                <div class="editarPedido" data-id="<?php echo $i;?>"></div>
                                <div class="borrarPedido"></div>
                            </div>
                        </div>
                    <?php $i++;?>
                    <?php endforeach;?>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <div class="botones hide">
            <a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/solicitudes">Cancelar</a>
            <!--<div class="continuar">Continuar</div>-->
            <div class="guardar">Guardar</div>
        </div>
<!--        <div class="row crearViaje hide">
            <div class="viajes">
                <?php $this->getViajes();?>
            </div>
            <?php 
                $contenedores = Estacion::model()->findAll('disponible = 1 AND activo = 1 AND tipo = 1');
                if(count($contenedores)>0)
                    echo CHtml::submitButton($model->isNewRecord ? 'Crear nuevo viaje' : 'Crear nuevo viaje'); ?>
        </div>-->
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->