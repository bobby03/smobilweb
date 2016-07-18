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
			    			<div class="container-b1box1">	
								<div class="container-table">
										<table class = "dashboardInicio">
											<thead><label class="titulo1">1. Selecciona un viaje:</label>	
												<th><label class="titulo2">Viajes en ruta</label></th><th></th><th></th>
											</thead>
											<tbody>	
												  	<?php foreach($enruta as $data ) {
												  		echo "<tr data-id= '{$data['id']}'>";
												    			echo "<td><div class='iconCamion'></div>".$data['identificador']."</td>";
												    			echo "<td><div class='iconChofer'></div>".Personal::model()->getChofer($data['id'])."</td>";
												    			echo "<td><div class='iconPersonal'></div>".$data['nombre']." ".$data['apellido']."</td>";
												    	echo"</tr>";
												    		}
										    			?>
										    </tbody>	
								    	</table>
					    		</div>

					    		<div class="container-line">
							    	</h2><h2 class="container-line2"></h2><h2 class="container-line1"></h2>
								</div>
							</div>
							<div class="container-b1box2">
  									<label class = "titulo1">2. Contenido:</label>
  									<div class="contenedor-tanques"></div>
								<div class="container-lineBox"><h2 class="container-line2"></h2></div>
							</div>

					</div>
					<div class="container-box">
							<div class="container-boxSeparador1"><label class="titulo1">Ubicacion Camion de prueba</label></div>

					</div>
					<div class="container-box">
						<div class="container-table viaje">
							<table class = "dashboardviajes-disponibles">
								<thead>
									<th><label class="titulo2">Viajes disponibles</label></th><th></th><th></th><th></th>
								</thead>
								<tbody>	
								  	<?php foreach($enespera as $data ) {
										  	if((int)$data["disponibles"] > 0){	
										  		echo "<tr>";
										    			echo "<td><div class='divIcon'><div class='iconCamion'></div></div><div class='divText'><label class='titulo3'>Camión</label><br>".$data['nombre']."</div></td>";
										    			echo "<td><div class='divIcon'><div class='iconChofer'></div></div><div class='divText'><label class='titulo3'>Tanques disponibles</label><br>".$data['disponibles']."</div></td>";
										    			echo "<td><div class='divIcon'><div class='iconPersonal'></div></div><div class='divText'><label class='titulo3'>Último destino</label><br>".$data['ultimo']."</div></td>";
										    			echo "<td class='botonIrViaje'><a href='".$baseUrl."/index.php/viajes/".$data['id_viaje']."'><div class='botonIr'><label class='titulo2'>Ir</label></div></a></td>";
										    			echo '<br>';
										    	echo "</tr>";
								    		}
								    	}
							    			?>
							    </tbody>	
					    	</table>
			    		</div>
					</div>
			  
			    <div class="container-granja none"></div>
			</div>