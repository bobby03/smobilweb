<?php
/* @var $this SiteController */


$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/css/inicio/inicio.css');
$cs->registerScriptFile($baseUrl.'/js/inicio/inicio.js');
$this->pageTitle=Yii::app()->name;
?>


			<div class="principal">
				<h1 class="barraViajeGranja">
				    <div class="tabs">
			        	<div id="viaje" class="selected">Viajes</div>
			       		<div id="granja" >Estaciones</div>
			    	</div>
			    </h1>
			    <div class="container-viaje">
			    	<?php foreach($enruta as $data ) {
			    			print_r($data['nombre']);
			    			echo '<br>';
			    		}
	    			?>

			    </div>
			    <div class="container-granja none"></div>
			</div>