<?php
/* @var $this RolesController */
/* @var $model Roles */
/* @var $form CActiveForm */
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/roles/roles.css?id='.rand());
    $cs->registerScriptFile($baseUrl.'/js/roles/roles.js');
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
            <div class="nombreSeccion">Cepas</div>
            <div class="separador">
                <?php echo $form->hiddenField($acciones,'seccion[1][seccion]'); ?>
                <div><div class="botonTodos" data-id="1">Marcar</div></div>
                <div class="cb1"><?php echo $form->checkBox($acciones,'seccion[1][alta]', array('class'=>'altaBox')); ?></div>   
                <div class="cb1"><?php echo $form->checkBox($acciones,'seccion[1][baja]', array('class'=>'bajaBox')); ?></div>
                <div class="cb1"><?php echo $form->checkBox($acciones,'seccion[1][consulta]', array('class'=>'consultaBox')); ?></div>
                <div class="cb1"><?php echo $form->checkBox($acciones,'seccion[1][edicion]', array('class'=>'editBox')); ?></div>
            </div>
	</div>
	<div class="row">
            <div class="nombreSeccion">Clientes</div>
            <div class="separador">
                <?php echo $form->hiddenField($acciones,'seccion[2][seccion]'); ?>
                <div><div class="botonTodos" data-id="2">Marcar</div></div>
                <div><?php echo $form->checkBox($acciones,'seccion[2][alta]', array('class'=>'altaBox')); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[2][baja]', array('class'=>'bajaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[2][consulta]',array('class'=>'consultaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[2][edicion]', array('class'=>'editBox')); ?></div>
            </div>
	</div>
	<div class="row">
            <div class="nombreSeccion">Especie</div>
            <div class="separador">
                <?php echo $form->hiddenField($acciones,'seccion[3][seccion]'); ?>
                <div><div class="botonTodos" data-id="3">Marcar</div></div>
                <div><?php echo $form->checkBox($acciones,'seccion[3][alta]', array('class'=>'altaBox')); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[3][baja]', array('class'=>'bajaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[3][consulta]',array('class'=>'consultaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[3][edicion]', array('class'=>'editBox')); ?></div>
            </div>
	</div>
	<div class="row">
            <div class="nombreSeccion">Estación</div>
            <div class="separador">
                <?php echo $form->hiddenField($acciones,'seccion[4][seccion]'); ?>
                <div><div class="botonTodos" data-id="4">Marcar</div></div>
                <div><?php echo $form->checkBox($acciones,'seccion[4][alta]', array('class'=>'altaBox')); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[4][baja]', array('class'=>'bajaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[4][consulta]',array('class'=>'consultaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[4][edicion]', array('class'=>'editBox')); ?></div>
            </div>
	</div>
	<div class="row">
            <div class="nombreSeccion">Personal</div>
            <div class="separador">
                <?php echo $form->hiddenField($acciones,'seccion[5][seccion]'); ?>
                <div><div class="botonTodos" data-id="5">Marcar</div></div>
                <div><?php echo $form->checkBox($acciones,'seccion[5][alta]', array('class'=>'altaBox')); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[5][baja]', array('class'=>'bajaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[5][consulta]', array('class'=>'consultaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[5][edicion]', array('class'=>'editBox')); ?></div>
            </div>
	</div>
	<div class="row">
            <div class="nombreSeccion">Roles</div>
            <div class="separador">
                <?php echo $form->hiddenField($acciones,'seccion[6][seccion]'); ?>
                <div><div class="botonTodos" data-id="6">Marcar</div></div>
                <div><?php echo $form->checkBox($acciones,'seccion[6][alta]', array('class'=>'altaBox')); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[6][baja]', array('class'=>'bajaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[6][consulta]', array('class'=>'consultaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[6][edicion]', array('class'=>'editBox')); ?></div>
            </div>
	</div>
	<div class="row">
            <div class="nombreSeccion">Solicitudes</div>
            <div class="separador">
                <?php echo $form->hiddenField($acciones,'seccion[7][seccion]'); ?>
                <div><div class="botonTodos" data-id="7">Marcar</div></div>
                <div><?php echo $form->checkBox($acciones,'seccion[7][alta]', array('class'=>'altaBox')); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[7][baja]', array('class'=>'bajaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[7][consulta]', array('class'=>'consultaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[7][edicion]', array('class'=>'editBox')); ?></div>
            </div>
	</div>
	<div class="row">
            <div class="nombreSeccion">Usuarios</div>
            <div class="separador">
                <?php echo $form->hiddenField($acciones,'seccion[8][seccion]'); ?>
                <div><div class="botonTodos" data-id="8">Marcar</div></div>
                <div><?php echo $form->checkBox($acciones,'seccion[8][alta]', array('class'=>'altaBox')); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[8][baja]', array('class'=>'bajaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[8][consulta]', array('class'=>'consultaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[8][edicion]', array('class'=>'editBox')); ?></div>
            </div>
	</div>
	<div class="row">
            <div class="nombreSeccion">Viajes</div>
            <div class="separador">
                <?php echo $form->hiddenField($acciones,'seccion[9][seccion]'); ?>
                <div><div class="botonTodos" data-id="9">Marcar</div></div>
                <div><?php echo $form->checkBox($acciones,'seccion[9][alta]', array('class'=>'altaBox')); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[9][baja]', array('class'=>'bajaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[9][consulta]', array('class'=>'consultaBox')); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[9][edicion]', array('class'=>'editBox')); ?></div>
            </div>
	</div>
    </div>
    <div class="row buttons submitb">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar'); ?>
    </div>
        


<?php $this->endWidget(); ?>

</div><!-- form -->