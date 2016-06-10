<?php
/* @var $this DefaultController */
/* @var $model LoginForm */
/* @var $form TbActiveForm */

$this->pageTitle=Yii::t('YcmModule.ycm','Inicio de Sesión');
$this->breadcrumbs=array(
	Yii::t('YcmModule.ycm','Iniciar Sesión'),
);
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile( $baseUrl.'/js/ycm/login.js' );
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'verticalForm',
	'type'=>'inline',
	'htmlOptions'=>array('class'=>'well'),
));

echo '<p>'.Yii::t('YcmModule.ycm','Porfavor, ingrese su usuario y contraseña.').'</p>';
echo $form->textFieldRow($model,'username',array('class'=>'input-medium','prepend'=>'<i class="icon-user"></i>')).' ';
echo $form->passwordFieldRow($model,'password',array('class'=>'input-medium','prepend'=>'<i class="icon-lock"></i>')).' ';
$this->widget('bootstrap.widgets.TbButton',array('buttonType'=>'submit','label'=>Yii::t('YcmModule.ycm','Iniciar Sesión')));
$this->endWidget();