<?php
/* @var $this SiteController */

$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/css/inicio/inicio.css');
$this->pageTitle=Yii::app()->name;

?>

			<div class="principal">
				<h1 class="barraViajeGranja">
				    <div class="tabs">
			        	<div id="viajes" class="selected">Viajes</div>
			       		<div id="granja" >Estaciones</div>
			    	</div>
			    </h1>
			    <div class="container-viaje"></div>
			    <div class="container-granja none"></div>
			</div>