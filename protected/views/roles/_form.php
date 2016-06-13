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
        <?php
            if($model->isNewRecord)
                $model2 = new RolesPermisos;
            else
                $model2 = RolesPermisos::model ()->findByPk($model->id);
            $this->renderPartial('_formPermisos', array('model'=>$model2)); 
        ?>

<?php $this->endWidget(); ?>

</div><!-- form -->