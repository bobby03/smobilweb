<?php
/* @var $this SiteController */


$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/css/inicio/inicio.css');
$cs->registerCssFile($baseUrl.'/css/inicio/estilo.css');
$cs->registerScriptFile($baseUrl.'/js/inicio/inicio.js');
$cs->registerScriptFile($baseUrl.'/js/inicio/estaciones.js');
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
								<div class="container-lineBox"><h3 class="container-line2"></h3></div> 							</div>
  
  					</div>
  					<div class="container-box">
						<div class="separador1"></div>
 						<div class="containerRuta"><div class="containerR1"></div></div>
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
 			  
  					</div>
  				</div>
  			  
  			    <div class="container-granja none"> <!--Aquí empieza el tab de estaciones-->
  			    	<div class="dash1">
	  			    	<div class="estacion">
	  			    		<p class="topcont">1. Selecciona una estación</p>
	  			    		<p class="divThead">Estaciones</p>
	  			    		<div class="lestacion">
	  			    			<?php 
	  			    			$i=1;
	  			    			foreach($estaciones as $est):?>
	  			    				<div data-estacion="<?php echo $est['idest'];?>" data-id="est<?php echo $i;?>" class="liest">
	  			    					<div class="estIco"></div><label class="est"><?php echo $est['identificador'];?></label><div class="respIco"></div><label class="resp"><?php echo $est['nombre']." ".$est['apellido'];?></label>
	  			    				</div>
	  			    			<?php
	  			    			$i++;
	  			    			endforeach;
	  			    			?>
	  			    		</div>
	  			    	</div>
	  			    	<div class="reg"></div>
	  			    	<div class="reg2"></div>


	  			    	<div class="contenido">
	  			    		<p class="topcont">2. Contenido:</p>
	  			    		
	  			    		<div class="lcontenido">
	  			    			<div>
	  			    				<p class="estv" >Seleccione una estación</p>
	  			    			</div>
	  			    			<?php 
	  			    			$o=1;
	  			    			foreach($estaciones as $est):?>
	  			    			<div data-id="est<?php echo $o;?>" class="cont hide">
	  			    				<?php 
	  			    				$id=$est['id_estacion'];
	  			    				$datos=$this->actionGetTanques($id);
	  			    				?>
	  			    			<?php

	  			    			foreach($datos as $dato):?>
	  			    				<div class="litan">
	  			    					<div class="tanT"><p class="pTan"><?php echo $dato['tnombre']; ?></p></div>

		  			    					<div class="oxico"></div><label class="clab"><?php echo intval($dato['ox']); ?> mg/L</label>
		  			    					<div class="phico"></div><label class="clab"><?php echo intval($dato['ph']); ?></label>
		  			    					<div class="tempico"></div><label class="clab"><?php echo intval($dato['temp']); ?>°C</label>
	  			    				</div>
	  			    			<?php
	  			    			endforeach;
	  			    			?>
	  			    			</div>
	  			    		</div> <!-- Fin de div contenido-->
	  			    	<?php 
	  			    	$o++;
	  			    	endforeach;?>
	  			    	<div class="reg3"></div>
	  			    	</div>


  			    	</div>
  			    	<?php 
  			    	$id=$est['id_estacion'];
	  			   	$datos=$this->actionGetTanques2($id);
  			    	$us=1;
  			    	foreach($estaciones as $est):?>
  			    	<div data-id="est<?php echo $us;?>"class="ubicacion hide">
  			    		<span>3. Ubicación: <?php echo $est['ubicacion'];?> .</span>
  			    	</div>
  			    	<?php 
	  			    $us++;
	  			    endforeach;?>
  			    	<div class="progressbar">

  			    		<div class="container-est">
						<div class="sepest"></div>
 						<div class="containerEst"><div class="containerE1"></div></div>
 						<div class="sepest2"></div>		
						</div>


						
  			    	</div>

  			    	<div class="info">
  			    		<?php 
  			    		$id=$est['id_estacion'];
	  			    	$datos=$this->actionGetTanques2($id);
  			    		$u=1;
  			    		foreach($estaciones as $est):?>
	  			    		<div data-id="est<?php echo $u;?>" class="infocliente hide">
  			    			<p id="titc" class="tit"><?php echo $est['identificador'];?></p>
  			    			<p class="infocont">
  			    				<span><?php echo $est['ubicacion']?></span>
  			    			</p>
  			    		</div>

  			    		<div data-id="est<?php echo $u;?>" class="infocontacto hide">
  			    			<p class="tit">Contacto:</p>
  			    			<p class="infocont">
  			    				<span><?php echo $est['nombre']." ".$est['apellido'];?></span>
  			    				<span>Tel. <?php echo $est['tel'];?></span>
  			    				<span>E-mail: <?php echo $est['correo'];?></span>
  			    			</p>
  			    		</div>	
	  			    	<?php 
	  			    	$u++;
	  			    	endforeach;?>
  			    		
  			    	</div>

  			    	

  			    </div>
			</div>