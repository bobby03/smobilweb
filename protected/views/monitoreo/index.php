<?php
    $baseUrl = Yii::app()->baseUrl;
?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDaG6uwH8h6edDH6rPh0PfGgq6yEqSedgg"></script>
<script type="text/javascript" src="<?php echo $baseUrl;?>/js/plugins/google-maps/jquery.ui.map.full.min.js"></script>
<?php
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/calendario.js');
    $cs->registerScriptFile($baseUrl.'/js/plugins/chosen/assets2/js/chosen.jquery.min.js');
    $cs->registerCssFile($baseUrl.'/js/plugins/chosen/assets2/css/chosen.min.css');
    $cs->registerScriptFile($baseUrl.'/js/plugins/ColorBox/jquery.colorbox.js');
    $cs->registerCssFile($baseUrl.'/js/plugins/ColorBox/colorbox.css');
   
?>
<h1>Monitoreo fijo</h1>
<div class="container">
	<div id="datosMon">
		<div class="divTit">
			<div id='titLeft'><h2>Datos del monitoreo</h2></div>
			<div id='titRight'><p>Ultima actualización</p></div>
		</div>

		<p class="tit">Id de granja</p>


		<div id="esp">
			<div id="esp1">
				<p class="subtit">Cliente:</p>		
				<p>Granja pastel</p>
			</div>

			<div id="esp2">
				<p class="subtit">Ubicación:</p>	
				<p>Mexicali 185 Periferico Norte</p>	
			</div>

			<div id="esp3">
				<p class="subtit">Tiempo de monitoreo:</p>	
				<p>2 dias, diez horas, 14 minutos</p>

			</div>

			<div id="esp4">
				<p class="subtit">Fecha de inicio:</p>		
				<p>20-03-2016</p>
				<p class="subtit">Fecha de término:</p>		
				<p>27-03-2016</p>
			</div>
		</div>

	</div>


	<div id="detallesMon">
		<div class="divTit">
			<div id='enLeft'><h2>Detalles del monitoreo</h2></div>
			<div id='enRight'>		
				<div class="enlace">Por parámetro</div>
				<div class="enlace">Por tanque</div>
			</div>
		</div>
		<!-- Gráficas -->

		<div class='grafica der'>
			<p class="tit">Oxígeno disuelto</p>
		</div>
		<div class='grafica'>
			<p class="tit">Temperatura</p>
		</div>
		<div class='grafica der'>
			<p class="tit">PH</p>
		</div>
		<div class='grafica'>
			<p class="tit">Conectividad</p>
		</div>
		<div class='grafica der'>
			<p class="tit">Potencial óxido reducción</p>
		</div>


	</div>
</div>
<?php  $cs->registerCssFile($baseUrl.'/css/monitoreo/monitoreo.css');?>