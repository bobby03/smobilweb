<?php
/* @var $this RolesController */
/* @var $model Roles */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'roles-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_rol'); ?>
		<?php echo $form->textField($model,'nombre_rol',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nombre_rol'); ?>
	</div>
        <div class="formContainer1">
	<div class="row titulos">
            <div>Sección</div>
            <div>Alta</div>
            <div>Baja</div>
            <div>Consulta</div>
            <div>Edición</div>
        </div>
	<div class="row">
            <div class="nombreSeccion">Cepas</div>
            <div class="separador">
                <div><?php echo $form->checkBox($acciones,'seccion[1][alta]'); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[1][baja]'); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[1][consulta]'); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[1][edicion]'); ?></div>
            </div>
	</div>
	<div class="row">
            <div class="nombreSeccion">Clientes</div>
            <div class="separador">
                <div><?php echo $form->checkBox($acciones,'seccion[2][alta]'); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[2][baja]'); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[2][consulta]'); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[2][edicion]'); ?></div>
            </div>
	</div>
	<div class="row">
            <div class="nombreSeccion">Especie</div>
            <div class="separador">
                <div><?php echo $form->checkBox($acciones,'seccion[3][alta]'); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[3][baja]'); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[3][consulta]'); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[3][edicion]'); ?></div>
            </div>
	</div>
	<div class="row">
            <div class="nombreSeccion">Estación</div>
            <div class="separador">
                <div><?php echo $form->checkBox($acciones,'seccion[4][alta]'); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[4][baja]'); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[4][consulta]'); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[4][edicion]'); ?></div>
            </div>
	</div>
	<div class="row">
            <div class="nombreSeccion">Personal</div>
            <div class="separador">
                <div><?php echo $form->checkBox($acciones,'seccion[5][alta]'); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[5][baja]'); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[5][consulta]'); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[5][edicion]'); ?></div>
            </div>
	</div>
	<div class="row">
            <div class="nombreSeccion">Roles</div>
            <div class="separador">
                <div><?php echo $form->checkBox($acciones,'seccion[6][alta]'); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[6][baja]'); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[6][consulta]'); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[6][edicion]'); ?></div>
            </div>
	</div>
	<div class="row">
            <div class="nombreSeccion">Solicitudes</div>
            <div class="separador">
                <div><?php echo $form->checkBox($acciones,'seccion[7][alta]'); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[7][baja]'); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[7][consulta]'); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[7][edicion]'); ?></div>
            </div>
	</div>
	<div class="row">
            <div class="nombreSeccion">Usuarios</div>
            <div class="separador">
                <div><?php echo $form->checkBox($acciones,'seccion[8][alta]'); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[8][baja]'); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[8][consulta]'); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[8][edicion]'); ?></div>
            </div>
	</div>
	<div class="row">
            <div class="nombreSeccion">Viajes</div>
            <div class="separador">
                <div><?php echo $form->checkBox($acciones,'seccion[9][alta]'); ?></div>   
                <div><?php echo $form->checkBox($acciones,'seccion[9][baja]'); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[9][consulta]'); ?></div>
                <div><?php echo $form->checkBox($acciones,'seccion[9][edicion]'); ?></div>
            </div>
	</div>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>
        


<?php $this->endWidget(); ?>

</div><!-- form -->