<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
    <span class="css-select-moz">
        <?php echo CHtml::dropDownList('searchDropDown2', 'id', $model->getSearchUsuarios(),array('empty' =>'Selecciona campo a buscar')); ?>
    </span>
    <div class="row hide" data-id='1' >
        <?php echo $form->textField($model,'usuario',array('size'=>10,'maxlength'=>10)); ?>
    </div>
    <div class="row hide" data-id='2'>
        <span class="css-select-moz">
            <?php echo $form->dropDownList($model,'tipo_usr',Usuarios::model()->getAllTipoUsuario(),array('empty'=>'Seleccionar', 'class'=>'css-select')); ?>
        </span>
    </div>
    <div class="row buttons hide" >
        <?php echo CHtml::submitButton('Search'); ?>
    </div>
<?php $this->endWidget(); ?>
</div><!-- search-form -->