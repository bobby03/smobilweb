<?php
/* @var $this SiteController */


$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/css/inicio/inicio.css');
$cs->registerScriptFile($baseUrl.'/js/inicio/inicio.js');
$this->pageTitle=Yii::app()->name;

// IF NOT LOGGED IN, GO TO LOGIN SCREEN
if(Yii::app()->user->isGuest)
{
$this->redirect(Yii::app()->homeUrl);
}

?>


			<div class="principal index">
				<h1 class="barraViajeGranja">
				    <div class="tabs">
			        	<div id="viaje" class="selected">Viajes</div>
			       		<div id="granja" >Estaciones</div>
			    	</div>
			    </h1>
			    <div class="container-viaje">
			    	<div class="container-box">
			    			<div class="divBox1">
			    				<div class="divTitulo1">
			    					<label class="tituloV1">1. Selecciona un viaje:</label>
			    				</div>	
								<div class="containerTable">
										<div class ="divTable">
											<div class="divThead">	
												<label class="tituloV2">Viajes en ruta</label>
											</div>
											<div class= "divTbody">	
												  	<?php foreach($enruta as $data ) {
												  		echo "<div class='divTr' data-id= '{$data['id']}'>";
												    			echo "<div class='divTd'><div class='iconCamion'></div><label class='estiloV1'>".$data['identificador']."</label></div>";
												    			echo "<div class='divTd'><div class='iconChofer'></div><label class='estiloV1'>".Personal::model()->getChofer($data['id'])."</label></div>";
												    			echo "<div class='divTd'><div class='iconPersonal'></div><label class='estiloV1'>".$data['nombre']." ".$data['apellido']."</label></div>";
												    	echo"</div>";
												    		}
										    			?>
										    </div>	
								    	</div>
					    		</div>

					    		<div class="container-line">
							    	<h3 class="container-line2"></h3><h3 class="container-line1"></h3>
								</div>
							</div>
							<div class="divBox2">
								<div class="divTitulo1">
  									<label class = "tituloV1">2. Contenido:</label>
  								</div>
  								<div class="contenedor-tanques"></div>
								<div class="container-lineBox"><h3 class="container-line2"></h3></div>
							</div>

					</div>
					<div class="container-box">
						<div class="separador1"></div>

						<div class="contenedor-rutas-entregas">
							<div class="containerSalidaV2"></div>
							<div class="containerEntregaV2"></div>
								<div class="drawLine1"></div>

						</div>
						<div class="separador2"></div>

					</div>
					<div class="container-box">
						<div class="container-table viaje">
							<div class = "divTable2">
								<div class="divThead2">
									<label class="tituloV2">Viajes disponibles</label>
								</div>
								<div class="divTbody2">	
								  	<?php foreach($enespera as $data ) {
										  	if((int)$data["disponibles"] > 0){	
										  		echo "<div class='divTr2'>";
										    			echo "<div class='divCamion1'><div class='divIcon2'><div class='iconCamion1'></div></div><div class='divText2'><label class='titulo3'>Camión</label><br><label class='estilov2'>".$data['nombre']."</lablel></div></div>";
										    			echo "<div class='divTanque1'><div class='divIcon2'><div class='iconTanque1'></div></div><div class='divText3'><label class='titulo3'>Tanques disponibles</label><br><label class='estilov2'>".$data['disponibles']."</lablel></div></div>";
										    			echo "<div class='divUbicacion1'><div class='divIcon2'><div class='iconGPS1'></div></div><div class='divText2'><label class='titulo3'>Último destino</label><br><label class='estilov2'>".$data['ultimo']."</lablel></div></div>";
										    			echo "<div class='divTdBoton'><div class='botonIrViaje'><a href='".$baseUrl."/index.php/viajes/".$data['id_viaje']."'><div class='botonIr'><label class='titulo2'>Ir</label></div></a></div></div>";
										    			echo '<br>';
										    	echo "</div>";
								    		}
								    	}
							    			?>
							    </div>	
					    	</div>
			    		</div>
			    		<div class="container-logo"></div>
					</div>
			  
			    <div class="container-granja none"></div>
			</div>