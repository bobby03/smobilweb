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
<?php if($nuevo == false): ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'viajes-form',
    //'htmlOptions'=>array('name'=>'ViajesForm'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => true,
        'validateOnType' => true,
        //'afterValidate'=>'js:formSendViajes',
        ),
    )); 
 ?>
    <div class="menuTabs">
        <div class="bolaChica selected"></div>
        <div class="lineaChica selected"></div>
        <div class="bolaGrande selected">1<div class="infoBolas">Datos del viaje</div></div>
        <div class="lineaGandre <?php if(!$model->isNewRecord) echo 'selected';?>"></div>
        <div class="bolaGrande <?php if(!$model->isNewRecord) echo 'selected';?>">2<div class="infoBolas">Asignar tanques</div></div>
        <div class="lineaGandre"></div>
        <div class="bolaGrande">3<div class="infoBolas">Finalizar</div></div>
        <div class="lineaChica"></div>
        <div class="bolaChica"></div>
    </div>

    <!-- - - - - - - - - - - - - - - - -  TAB 1 - - - - - - - - - - - - - - - - - - - - - - -->
    <div class="tab <?php if(!$model->isNewRecord) echo 'hide';?>" data-tab="1">
        <div class="formContainer1">
            <?php if($model->isNewRecord):?>
            <input type="hidden" name="NuevoRecord" value="0" form="viajes-form">
            <?php else:?>
            <input type="hidden" name="NuevoRecord" value="1" form="viajes-form">
            <?php endif;?>
            <div class="row">
                <?php if(!$model->isNewRecord):?> ©
                    <input type="hidden" name="viajeId" value="<?php echo $model->id;?>" form="viajes-form">
                <?php endif;?>
		<?php echo $form->labelEx($model,'id_responsable'); ?>
                <span class="css-select-moz">
                    <?php echo $form->dropDownList($model,'id_responsable', $personal->getpersonal(3), array('empty'=>'Seleccionar','class'=>'css-select','value'=>$model->id_responsable));?>
                    <?php echo $form->error($model,'id_responsable'); ?>
                </span>
            </div>
            <?php if($model->isNewRecord):?>
                <div class="row">
                    <label>Técnico(s)</label>
                    <span class="css-select-moz">
                        <?php echo $form->dropDownList($personal,'id_personal[1][tecnico]', $personal->getpersonal(2), array('class'=>'css-select','multiple'=>'true')); ?>
                        <?php echo $form->error($model,'id_personal[1][tecnico]'); ?>
                    </span>
                </div>
                <div class="row">
                    <label>Chofer(es)</label>
                    <span class="css-select-moz">
                        <?php echo $form->dropDownList($personal,'id_personal[1][chofer]', $personal->getpersonal(1), array('class'=>'css-select','multiple'=>'true')); ?>
                        <?php echo $form->error($model,'id_personal[1][chofer]'); ?>
                    </span>
                    </span>
                </div>
            <?php endif;?>
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
                <?php echo $form->labelEx($model,'fecha_salida'); ?>
                <?php echo $form->textField($model,'fecha_salida', array('class'=>'calendario', 'readonly'=>'readonly')); ?>
                 <?php echo $form->error($model,'fecha_salida'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model,'hora_salida'); ?>
                <?php echo $form->textField($model,'hora_salida', array('placeholder'=>'hh:mm 24 horas')); ?>
                <?php echo $form->error($model,'hora_salida'); ?>
            </div>


        <div class="botonesWrapper2">
            <a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/viajes">Cancelar</a>
            <div class="siguiente dos">Siguiente</div>
        </div>



	</div>
    </div>
    <!-- - - - - - - - - - - - - - - - -  TAB 2 - - - - - - - - - - - - - - - - - - - - - - -->
    <div class="tab <?php if($model->isNewRecord) echo 'hide';?>" data-tab="2">
    <div class="pedidosWraper">
        <?php echo $form->hiddenField($solicitudes,'id_clientes',array('value'=>$pedidos['Solicitudes']['id_clientes']));?>
        <?php echo $form->hiddenField($solicitudes,'notas',array('value'=>$pedidos['Solicitudes']['notas']));?>
        <?php echo $form->hiddenField($solicitudes,'id',array('value'=>$pedidos['Solicitudes']['id']));?>
        <?php $tot = 1;?>
        <?php foreach($pedidos['pedido'] as $data):?>
            <?php for($i = 1; $i <= $data['tanques']; $i++):?>
                <div class="pedido">
                    <div class="tituloEspecie">Pedido <?php echo $tot;?></div>
                    <?php if(isset($data['id_tanque'])):?>
                    <div class="pedidoWraper gris">
                        <div>Especie: <span><?php echo Especie::model()->getEspecie($data['especie']);?></span></div>
                        <div>Cepa: <span><?php echo Cepa::model()->getCepa($data['cepa']);?></span></div>
                        <div>Cantidad: <span><?php echo $data['cantidad'];?></span></div>
                        <div>Destino: <span style="display: block"><?php echo ClientesDomicilio::model()->getDomicilio($data['destino']);?></span></div>
                        <div class="selectTanque">
                            <label>Tanque</label>
                            <div class="tanqueNombre" style="color: #000000" data-tanque="<?php echo $data['id_tanque'];?>">
                                <?php echo Tanque::model()->getTanque($data['id_tanque']);?>
                            </div>
                        </div>
                    </div>
                    <?php else:?>
                    <div class="pedidoWraper">
                        <div>Especie: <span><?php echo Especie::model()->getEspecie($data['especie']);?></span></div>
                        <?php echo $form->hiddenField($solicitudes,"codigo[$tot][especie]",array('value'=>$data['especie']))?>
                        <div>Cepa: <span><?php echo Cepa::model()->getCepa($data['cepa']);?></span></div>
                        <?php echo $form->hiddenField($solicitudes,"codigo[$tot][cepa]",array('value'=>$data['cepa']))?>
                        <div>Cantidad: <span><?php echo $data['cantidad']/$data['tanques'];?></span></div>
                        <?php echo $form->hiddenField($solicitudes,"codigo[$tot][cantidad]",array('value'=>($data['cantidad']/$data['tanques'])))?>
                        <div>Destino: <span style="display: block"><?php echo ClientesDomicilio::model()->getDomicilio($data['destino']);?></span></div>
                        <?php echo $form->hiddenField($solicitudes,"codigo[$tot][destino]",array('value'=>$data['destino']))?>
                        <div class="selectTanque hide">
                            <label>Seleccionar Tanque</label>
                            <?php echo $form->dropDownList($solicitudes, "codigo[$tot][tanque]",array(''=>''),array('empty'=>'Seleccionar', 'class'=>'css-select ttan ttan'.$i, 'data-tan'=>$tot));?>
                            <?php 
                            $t = "codigo[".$tot."][tanque]";

                            echo $form->error($model,$t); ?>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
                <?php $tot++; ?>
            <?php endfor;?>
        <?php endforeach; ?>
    </div>
<!--    <div class="row">
        <?php 
            echo $form->labelEx($model,'status');
            if($model->isNewRecord)
                echo $form->textField($model,'status',array('size'=>50,'maxlength'=>50));
            else
                echo $form->textField($model,'status',array('readonly'=>'readonly','size'=>50,'maxlength'=>50, 'value'=>  Viajes::model()->getStatus($model->status)));
        ?>
    </div>-->
        <div class="botonesWrapper2">
            <a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/index.php/viajes">Cancelar</a>
            <div class="siguiente dos">Siguiente</div>
        </div>

</div>
    <!-- - - - - - - - - - - - - - - - -  TAB 3 - - - - - - - - - - - - - - - - - - - - - - -->
    <div class="tab hide" data-tab="3"> esaqui
        <!--
         <div class="contenedorClientes">
            <?php // print_r($pedidos);?>
            <?php // $this->getClientes($pedidos);?>
        </div>-->
        <?php 
        $o=1;
        foreach($pedidos['pedido'] as $data)
        {
            for($i=1;$i<=$data['tanques'];$i++)
            {
                include 'xviaje.php';
                $o++;
            }
        }

        ?>

    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->

<?php else:?>

<div class="form">
<?php
    $cs->registerScriptFile($baseUrl.'/js/viajes/create-viajes.js');
    
    /**** CREAR VIAJE DESDE SECCION PRINCIPAL DE VIAJES ****/

    $form = $this->beginWidget('CActiveForm', array(
    'id'=>'viajes-form',
//        'htmlOptions'=>array('name'=>'ViajesForm'),
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => true,
        'validateOnType' => true,
        //'afterValidate'=>'js:formSendViajes',
        ),
    )); 
?>
    <div class="menuTabs <?php $nuevo?>">
        <div class="bolaChica selected"></div>
        <div class="lineaChica selected"></div>
        <div class="bolaGrande selected">1<div class="infoBolas">Datos del viaje</div></div>
        <div class="lineaGandre <?php if(!$model->isNewRecord) echo 'selected';?>"></div>
        <div class="bolaGrande <?php if(!$model->isNewRecord) echo 'selected';?>">2<div class="infoBolas">Asiganr tanques</div></div>
        <div class="lineaGandre"></div>
        <div class="bolaGrande">3<div class="infoBolas">Finalizar</div></div>
        <div class="lineaChica"></div>
        <div class="bolaChica"></div>
    </div>
    <div class="tab <?php  if(!$model->isNewRecord) echo 'hide';?>" data-tab="1">
           
            <div class="formContainer1">
                <?php if($model->isNewRecord):?>
                <input type="hidden" name="NuevoRecord" value="0" form="viajes-form">
                <?php else:?>
                <input type="hidden" name="NuevoRecord" value="1" form="viajes-form">
                <?php endif;?>
                <div class="row">
                    <?php if(!$model->isNewRecord):?> 
                        <input type="hidden" name="viajeId" value="<?php echo $model->id;?>" form="viajes-form">
                    <?php endif;?>
            <?php echo $form->labelEx($model,'id_responsable'); ?>
                    <span class="css-select-moz">
                        <?php echo $form->dropDownList($model,'id_responsable', $personal->getpersonal(3), array('empty'=>'Seleccionar','class'=>'css-select','value'=>$model->id_responsable));?>
                        <?php echo $form->error($model,'id_responsable'); ?>
                    </span>
                </div>
                <?php if($model->isNewRecord):?>
                    <div class="row">
                        <label>Técnico(s)</label>
                        <span class="css-select-moz">
                            <?php echo $form->dropDownList($personal,'id_personal[1][tecnico]', $personal->getpersonal(2), array('class'=>'css-select','multiple'=>'true')); ?>
                            <?php echo $form->error($model,'id_personal[1][tecnico]'); ?>
                        </span>
                    </div>
                    <div class="row">
                        <label>Chofer(es)</label>
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
                    <label>Solicitudes sin asignar</label>
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
<!--                     <span class="hidden-input">
                        <input  class="hiden-input" name='Solicitudes[id_clientes]' id='Solicitudes_id_clientes' type='hidden' autocomplete='off'>
                        <input  class="hiden-input-id" name='Solicitudes[id]' id='Solicitudes_id' type='hidden' autocomplete='off'>
                        <input  class="hiden-input-notas" name='Solicitudes[notas]' id='Solicitudes_notas' type='hidden' autocomplete='off'>
                    </span>-->
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
                    <?php echo $form->textField($model,'hora_salida', array('placeholder'=>'hh:mm')); ?>
                    <?php echo $form->error($model,'hora_salida'); ?>
                </div>


            <div class="botonesWrapper">
                <a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/index.php/viajes">Cancelar</a>
                <div class="siguiente uno">Siguiente</div>
            </div>
        </div>
        </div>
         <div class="tab <?php if($model->isNewRecord) echo 'hide';?>" data-tab="2">
            <div class="pedidosWraper"></div>   
               <div class="botonesWrapper2">
            <a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/index.php/viajes">Cancelar</a>
            <div class="siguiente dos">Siguiente</div>

        </div>
        </div>

         <div class="tab <?php if($model->isNewRecord) echo 'hide';?>" data-tab="3">
            <div class="inner-third-wrapper"> es en el else
                <!--<div class="siguiente fBoton bBoton" >Regresar</div>-->
            </div>
         </div>
<?php
    $this->endWidget();
?>
</div>


<?php endif;?>



