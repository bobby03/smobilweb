<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/calendario.js');
    $cs->registerScriptFile($baseUrl.'/js/plugins/chosen/assets/js/chosen.jquery.min.js');
    $cs->registerCssFile($baseUrl.'/js/plugins/chosen/assets/css/chosen.min.css');
    $cs->registerScriptFile($baseUrl.'/js/viajes/create.js');
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

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'viajes-form',
//        'htmlOptions'=>array('name'=>'ViajesForm'),
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
                    <?php echo $form->dropDownList($model,'id_responsable', $personal->getpersonal(3), array('empty'=>'Seleccionar','class'=>'css-select')); ?>
                </span>
            </div>
            <div class="row">
                <label>Técnico(s)</label>
                <span class="css-select-moz">
                    <?php echo $form->dropDownList($personal,'id_personal[1][tecnico]', $personal->getpersonal(2), array('class'=>'css-select','multiple'=>'true')); ?>
                </span>
            </div>
            <div class="row">
                <label>Chofer(es)</label>
                <span class="css-select-moz">
                    <?php echo $form->dropDownList($personal,'id_personal[1][chofer]', $personal->getpersonal(1), array('class'=>'css-select','multiple'=>'true')); ?>
                </span>
            </div>
        </div>
        <div class="formContainer1">
            <div class="row">
                <?php echo $form->labelEx($model,'id_estacion'); ?>
                <span class="css-select-moz">
                    <?php echo $form->dropDownList($model,'id_estacion', Estacion::model()->getEstacionesDisponibles(), array('empty'=>'Seleccionar','class'=>'css-select')); ?>
                </span>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model,'fecha_salida'); ?>
                <?php echo $form->textField($model,'fecha_salida', array('class'=>'calendario', 'readonly'=>'readonly')); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model,'hora_salida'); ?>
                <?php echo $form->textField($model,'hora_salida', array('placeholder'=>'hh:mm')); ?>
            </div>
	</div>
    </div>
    <div class="tab" data-tab="2">
    <div class="pedidosWraper">
        <?php echo $form->hiddenField($solicitudes,'id_clientes',array('value'=>$pedidos['Solicitudes']['id_clientes']));?>
        <?php $tot = 1;?>
        <?php foreach($pedidos['pedido'] as $data):?>
            <?php for($i = 1; $i <=$data['tanques']; $i++):?>
                <div class="pedido">
                    <div class="tituloEspecie">Pedido <?php echo $tot;?></div>
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
                            <?php echo $form->dropDownList($solicitudes, "codigo[$tot][tanque]",array(''=>''),array('empty'=>'Seleccionar', 'class'=>'css-select', 'data-tan'=>$tot));?>
                        </div>
                    </div>
                </div>
                <?php $tot++; ?>
            <?php endfor;?>
        <?php endforeach; ?>
    </div>
    <div class="row">
            <?php echo $form->labelEx($model,'status'); ?>
            <?php echo $form->textField($model,'status',array('size'=>50,'maxlength'=>50)); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

</div>

<?php $this->endWidget(); ?>

</div><!-- form -->