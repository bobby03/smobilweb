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
			    	<div class="container-box">
			    			<div class="container-b1box">
					    		<label class="titulo1">1. Selecciona un viaje</label>
									<table class = "dashboardInicio">
										<thead>
											<th><label class="titulo2">Viajes en ruta</label></th><th></th><th></th>
										</thead>
										<tbody>	
											  	<?php foreach($enruta as $data ) {
											  		echo "<tr data-id= '{$data['id']}'>";
											    			echo "<td>".$data['identificador']."</td>";
											    			echo "<td>".Personal::model()->getChofer($data['id'])."</td>";
											    			echo "<td>".$data['nombre']." ".$data['apellido']."</td>";

											    			echo '<br>';
											    	echo"</tr>";
											    		}
									    			?>
									    </tbody>	
							    	</table>
							</div>
							<div class="container-b1box">


							</div>
					</div>
					<div class="container-box">

					</div>
					<div class="container-box">

					</div>
			    </div>
			    <div class="container-granja none"></div>
			</div>