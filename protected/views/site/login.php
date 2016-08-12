<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/css/login/login.css');
//$cs->registerScriptFile($baseUrl.'/js/login.js');
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
if(Yii::app()->user->isGuest){ 
?>

<!--<h1>Login</h1>-->

<!--<p>Please fill out the following form with your login credentials:</p>-->
<div id="top"></div>

<div class="form">

	<img src="./../images/esmobil-logo.png" id="slogo" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->

	<div class="row">
		<label class= "llogin">Usuario</label>
		<?php echo $form->textField($model,'username',array('autocomplete'=>'off')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<label class= "llogin">Contraseña</label>
		<?php echo $form->passwordField($model,'password',array('autocomplete'=>'off')); ?>
		<?php echo $form->error($model,'password'); ?>
		
	</div>

	<div class="row rememberMe">
		<div class="checkboxcolor"></div>
  <?php echo $form->checkBox($model,'rememberMe'); ?>
  <?php echo $form->label($model,'rememberMe'); ?>
  <?php echo $form->error($model,'rememberMe'); ?>
 </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('ACCEDER'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<?php } else{
	$this->redirect(Yii::app()->baseUrl);
	} ?>
