<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */

    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/usuarios/view.css');
    $cs->registerScriptFile($baseUrl.'/js/usuarios/form.js');


$this->breadcrumbs=array(
	'Usuarioses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Usuarios', 'url'=>array('index')),
	array('label'=>'Create Usuarios', 'url'=>array('create')),
	array('label'=>'Update Usuarios', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Usuarios', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Usuarios', 'url'=>array('admin')),
);
?>

<h1>Usuarios #<?php echo $model->id; ?></h1>
<!--
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'usuario',
		'pwd',
		'tipo_usr',
		'id_usr',
	),
)); ?>-->


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuarios-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>




<div class="form">
	
	<div class="form-containerWraper viewUsuarios">
	<span class="containerBox">
		<div class= "form-cLeft">
			<div class="row">
			<label class= "letreros">Usuario</label>
				<div class="form-cLarge">
					<?php echo $form->textField($model,'usuario',array('size'=>10,'maxlength'=>10,'disabled'=>'disabled')); ?>
				</div>
				
			</div>
			<div class="row">
					<label class= "letreros">Tipo de Usuario</label>
					<div class="form-cMedium">
			 		<span class="css-select-moz">
			 		<?php echo $form->dropDownList($model,'tipo_usr', $model->getAllTipoUsuario(), array('empty'=>'Seleecionar', 'class'=>'css-select','disabled'=>'disabled')); ?></span></div>
					<?php echo $form->error($model,'tipo_usr'); ?>
			                <?php echo $form->hiddenField($model,'id_usr');?>
				</div>



						<div class="row hide" data-tipo="1">
											<label class= "letreros">Cliente</label>
											<div class="form-cMedium">
									 			<span class="css-select-moz"><?php echo CHtml::dropDownList('clienteId', Clientes::model(), Clientes::model()->getAllClientes(), array('empty'=>'Seleccionar','class'=>'css-select', 'id'=>'clienteList','disabled'=>'disabled')); ?></span></div>
											
										</div>
										<div class="row hide" data-tipo="2">
											<label class= "letreros">Personal</label>


									<div class="form-cLarge">
										 <span class="css-select-moz"><?php echo CHtml::dropDownList('personalId', Personal::model(), Personal::model()->getAllPersonal(), array('empty'=>'Seleccionar','class'=>'css-select', 'id'=>'personalList','disabled'=>'disabled')); ?></span></div>
											<?php echo $form->error($model,'id_usr'); ?>
										</div>
		</div>


		 <div class="form-cRight">

			<div class="row">
				<label class= "letreros">Contraseña</label>
				<div class="form-cLarge">
				<?php echo $form->textField($model,'pwd',array('size'=>35,'maxlength'=>35,'disabled'=>'disabled')); ?>
				</div>
				<?php echo $form->error($model,'pwd'); ?>
			</div>

	
				
			<div class="containerbutton">
				<div class="row buttons">
				<!--	<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Save'); ?>-->
				</div>
			</div>
		</div>
		</span>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->