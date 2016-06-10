<?php
/* @var $this DefaultController */
/* @var $code string */
/* @var $message string */
$baseUrl = Yii::app()->baseUrl;
$this->pageTitle=Yii::t('YcmModule.ycm','Error');
//$this->breadcrumbs=array(
//	//Yii::t('YcmModule.ycm','Error'),
//);
?>

<!--<h2><?php //echo Yii::t('YcmModule.ycm','Error').' '.$code; ?></h2>-->

<!--<div class="alert alert-error">
	<?php //echo CHtml::encode($message); ?>
</div>-->

<div class="error">
	<div class="imagen404" style="background-image:url(<?php echo $baseUrl.'/images/ERROR404.jpg' ?>)">
		
	</div>
<?php //echo CHtml::encode($message); ?>
</div>