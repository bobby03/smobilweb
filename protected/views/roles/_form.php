<?php
/* @var $this RolesController */
/* @var $model Roles */
/* @var $form CActiveForm */
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/roles/roles.css?id='.rand());
    $cs->registerScriptFile($baseUrl.'/js/roles/roles.js');
    $cs->registerCssFile($baseUrl.'/css/roles/create.css');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'roles-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => true,
        'validateOnType' => true,
        ),
    )); 
 ?>

	

	<?php //echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_rol'); ?>
		<?php echo $form->textField($model,'nombre_rol',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nombre_rol'); ?>
	</div>
        <div class="formContainer1">
	<div class="row titulos">
            <div>Sección</div>
            <div>Todos</div>
            <div>Alta</div>
            <div>Baja</div>
            <div>Consulta</div>
            <div>Edición</div>
        </div>
    <div class="row">
            <div class="nombreSeccion">Solicitudes</div>
            <div class="separador">
                <?php echo $form->hiddenField($acciones,'seccion[1][seccion]',array('value'=>1)); ?>
                <div><div class="botonTodos" data-id="1">Marcar</div></div>
                <div><?php echo $form->checkBox($acciones,'seccion[1][alta]', array('class'=>'altaBox')); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[1][baja]', array('class'=>'bajaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[1][consulta]', array('class'=>'consultaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[1][edicion]', array('class'=>'editBox')); ?></div>
            </div>
    </div>
    <div class="row">
            <div class="nombreSeccion">Viajes</div>
            <div class="separador">
                <?php echo $form->hiddenField($acciones,'seccion[2][seccion]',array('value'=>2)); ?>
                <div><div class="botonTodos" data-id="2">Marcar</div></div>
                <div><?php echo $form->checkBox($acciones,'seccion[2][alta]', array('class'=>'altaBox')); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[2][baja]', array('class'=>'bajaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[2][consulta]', array('class'=>'consultaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[2][edicion]', array('class'=>'editBox')); ?></div>
            </div>
    </div>
    <div class="row">
            <div class="nombreSeccion">Camiones</div>
            <div class="separador">
                <?php echo $form->hiddenField($acciones,'seccion[3][seccion]',array('value'=>3)); ?>
                <div><div class="botonTodos" data-id="3">Marcar</div></div>
                <div><?php echo $form->checkBox($acciones,'seccion[3][alta]', array('class'=>'altaBox')); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[3][baja]', array('class'=>'bajaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[3][consulta]',array('class'=>'consultaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[3][edicion]', array('class'=>'editBox')); ?></div>
            </div>
    </div>
    <div class="row">
            <div class="nombreSeccion">Siembras</div>
            <div class="separador">
                <?php echo $form->hiddenField($acciones,'seccion[4][seccion]',array('value'=>4)); ?>
                <div><div class="botonTodos" data-id="4">Marcar</div></div>
                <div><?php echo $form->checkBox($acciones,'seccion[4][alta]', array('class'=>'altaBox')); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[4][baja]', array('class'=>'bajaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[4][consulta]', array('class'=>'consultaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[4][edicion]', array('class'=>'editBox')); ?></div>
            </div>
    </div>
    <div class="row">
            <div class="nombreSeccion">Granjas</div>
            <div class="separador">
                <?php echo $form->hiddenField($acciones,'seccion[5][seccion]',array('value'=>5)); ?>
                <div><div class="botonTodos" data-id="5">Marcar</div></div>
                <div><?php echo $form->checkBox($acciones,'seccion[5][alta]', array('class'=>'altaBox')); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[5][baja]', array('class'=>'bajaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[5][consulta]', array('class'=>'consultaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[5][edicion]', array('class'=>'editBox')); ?></div>
            </div>
    </div>
    <div class="row">
            <div class="nombreSeccion">Clientes</div>
            <div class="separador">
                <?php echo $form->hiddenField($acciones,'seccion[6][seccion]',array('value'=>6)); ?>
                <div><div class="botonTodos" data-id="6">Marcar</div></div>
                <div><?php echo $form->checkBox($acciones,'seccion[6][alta]', array('class'=>'altaBox')); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[6][baja]', array('class'=>'bajaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[6][consulta]',array('class'=>'consultaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[6][edicion]', array('class'=>'editBox')); ?></div>
            </div>
    </div>
    <div class="row">
            <div class="nombreSeccion">Usuarios</div>
            <div class="separador">
                <?php echo $form->hiddenField($acciones,'seccion[7][seccion]',array('value'=>7)); ?>
                <div><div class="botonTodos" data-id="7">Marcar</div></div>
                <div><?php echo $form->checkBox($acciones,'seccion[7][alta]', array('class'=>'altaBox')); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[7][baja]', array('class'=>'bajaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[7][consulta]', array('class'=>'consultaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[7][edicion]', array('class'=>'editBox')); ?></div>
            </div>
    </div>
    <div class="row">
            <div class="nombreSeccion">Personal</div>
            <div class="separador">
                <?php echo $form->hiddenField($acciones,'seccion[8][seccion]',array('value'=>8)); ?>
                <div><div class="botonTodos" data-id="8">Marcar</div></div>
                <div><?php echo $form->checkBox($acciones,'seccion[8][alta]', array('class'=>'altaBox')); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[8][baja]', array('class'=>'bajaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[8][consulta]', array('class'=>'consultaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[8][edicion]', array('class'=>'editBox')); ?></div>
            </div>
    </div>
    <div class="row">
            <div class="nombreSeccion">Roles</div>
            <div class="separador">
                <?php echo $form->hiddenField($acciones,'seccion[9][seccion]',array('value'=>9)); ?>
                <div><div class="botonTodos" data-id="9">Marcar</div></div>
                <div><?php echo $form->checkBox($acciones,'seccion[9][alta]', array('class'=>'altaBox')); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[9][baja]', array('class'=>'bajaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[9][consulta]', array('class'=>'consultaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[9][edicion]', array('class'=>'editBox')); ?></div>
            </div>
    </div>
    <div class="row">
            <div class="nombreSeccion">Especie</div>
            <div class="separador">
                <?php echo $form->hiddenField($acciones,'seccion[11][seccion]',array('value'=>11)); ?>
                <div><div class="botonTodos" data-id="11">Marcar</div></div>
                <div><?php echo $form->checkBox($acciones,'seccion[11][alta]', array('class'=>'altaBox')); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[11][baja]', array('class'=>'bajaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[11][consulta]',array('class'=>'consultaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[11][edicion]', array('class'=>'editBox')); ?></div>
            </div>
    </div>
	<div class="row">
            <div class="nombreSeccion">Cepas</div>
            <div class="separador">
                <?php echo $form->hiddenField($acciones,'seccion[12][seccion]',array('value'=>12)); ?>
                <div><div class="botonTodos" data-id="12">Marcar</div></div>
                <div class="cb1"><?php echo $form->checkBox($acciones,'seccion[12][alta]', array('class'=>'altaBox')); ?></div>   
                <div class="cb1"><?php echo $form->checkBox($acciones,'seccion[12][baja]', array('class'=>'bajaBox')); ?></div>
                <div class="cb1"><?php echo $form->checkBox($acciones,'seccion[12][consulta]', array('class'=>'consultaBox')); ?></div>
                <div class="cb1"><?php echo $form->checkBox($acciones,'seccion[12][edicion]', array('class'=>'editBox')); ?></div>
            </div>
	</div>
    </div>
    <div class="row buttons submitb">
        <a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/roles">Cancelar</a> 
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar'); ?>
    </div>
        


<?php $this->endWidget(); ?>

</div><!-- form -->