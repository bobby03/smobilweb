<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2>Error <?php echo $code; ?></h2>
<?php if($code == 'Error 403'):?>
<div class="error2">
    usted no está autorizado para realizar esta acción.
</div>
<?php else:?>
<div class="error3">
<?php echo $message; ?>
</div>
<?php endif;?>
