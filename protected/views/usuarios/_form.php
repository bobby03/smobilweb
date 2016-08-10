<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/usuarios/create.css');
    $cs->registerScriptFile($baseUrl.'/js/usuarios/form.js');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuarios-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php //echo $form->errorSummary($model); ?>

	<div class="form-containerWraper">
	<span class="containerBox">
		<div class= "form-cLeft">
			<div class="row">
			<label class= "letreros">Usuario</label>
				<div class="form-cLarge">
					<?php echo $form->textField($model,'usuario',array('size'=>10,'maxlength'=>10)); ?>
				</div>
				<?php echo $form->error($model,'usuario'); ?>
			</div>
			<div class="row">
					<label class= "letreros">Tipo de Usuario</label>
					<div class="form-cMedium">
			 <span class="css-select-moz"><?php echo $form->dropDownList($model,'tipo_usr', $model->getAllTipoUsuario(), array('empty'=>'Seleecionar', 'class'=>'css-select')); ?></span></div>
					<?php echo $form->error($model,'tipo_usr'); ?>
			                <?php echo $form->hiddenField($model,'id_usr');?>
				</div>



						<div class="row hide" data-tipo="1">
											<label class= "letreros">Cliente</label>
											<div class="form-cMedium">
									 <span class="css-select-moz"><?php echo CHtml::dropDownList('clienteId', Clientes::model(), Clientes::model()->getAllClientes(), array('empty'=>'Seleccionar','class'=>'css-select', 'id'=>'clienteList')); ?></span></div>
											<?php echo $form->error($model,'id_usr'); ?>
										</div>
										<div class="row hide" data-tipo="2">
											<label class= "letreros">Personal</label>
									<div class="form-cLarge">
										 <span class="css-select-moz"><?php echo CHtml::dropDownList('personalId', Personal::model(), Personal::model()->getAllPersonal(), array('empty'=>'Seleccionar','class'=>'css-select', 'id'=>'personalList')); ?></span></div>
											<?php echo $form->error($model,'id_usr'); ?>
										</div>
		</div>
<!--
	<div class="row">
		<?php echo $form->labelEx($model,'pwd'); ?>
		<?php echo $form->passwordField($model,'pwd',array('size'=>35,'maxlength'=>35)); ?>
		<?php echo $form->error($model,'pwd'); ?>
	</div>
-->


		 <div class="form-cRight">

			<div class="row">
				<label class= "letreros">Contraseña</label>
				<div class="form-cLarge">
				<?php echo $form->textField($model,'pwd',array('size'=>35,'maxlength'=>35)); ?>
				</div>
				<?php echo $form->error($model,'pwd'); ?>
			</div>

	
			



				
			<div class="containerbutton">
				<div class="row buttons">
					<a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/usuarios">Cancelar</a> 
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar'); ?>
				</div>
			</div>
		</div>
		</span>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->