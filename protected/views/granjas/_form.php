<?php
/* @var $this GranjasController */
/* @var $model Granjas */
/* @var $form CActiveForm */
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/granjas/create.css');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'granjas-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<div class="form-containerWraper">
	<div class="form-cRight">
	<div class="row">
            <label class="letreros">Nombre</label>
            <div class="form-cLarge">
                <?php   echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>100)); 
                        echo $form->error($model,'nombre');
                ?>
            </div>
	</div>
	<div class="row">
            <label class="letreros">Direcci&oacute;n</label>
            <div class="form-cLarge">
                <?php   echo $form->textField($model,'direccion',array('size'=>60,'maxlength'=>100)); 
                        echo $form->error($model,'direccion');
                ?>
            </div>
	</div>
	<div class="row">
                <label class="letreros">Responsable</label>
                <div class="form-cLarge">
                    <?php   echo $form->textField($model,'responsable',array('size'=>60,'maxlength'=>100));
                            echo $form->error($model,'responsable');
                    ?>
	</div>
            </div>
	</div>
    <div class="form-cRight">
        <div class="containerbutton">
	<div class="row buttons">
                    <a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/granjas">Cancelar</a> 
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar'); ?>
	</div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->