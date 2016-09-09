<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);

switch ($code) {
	case 400:
	case 403:
		echo "<h2>Error $code	No puede acceder </h2>";
		break;
	case 404:
		# code...
	echo "<h2>Error $code	No existe la sección</h2>";
		break;
	
	default:
		# code...
	echo "<h2>Error $code </h2>" ;
		break;
}
?>


