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
        $this->redirect(Yii::app()->homeUrl)
?>
<div class="principal index">
    <h1 class="barraViajeGranja">
        <div class="tabs">
            <div id="viaje" class="selected">Viajes</div>
            <?php if(Yii::app()->user->getTipoUsuario()!=1):?>   
                <div id="granja" >Siembras</div>
            <?php endif;?>
        </div>
    </h1>
    <?php if($enruta != null): ?>
        <div class="container-viaje">
            <div class="container-box">
                <div class="divBox1">
                    <div class="divTitulo1">
                        <p class="tituloV1">1. Selecciona un viaje:</p>
                    </div>	
                    <div class="containerTable">
                        <div class ="divTable">
                            <div class="divThead">	
                                <label class="tituloV2">Viajes en ruta</label>
                            </div>
                            <div class= "divTbody">	
                                <?php foreach($enruta as $data ):?>
                                    <div class='divTr' data-id="<?php echo $data['id'];?>">
                                        <div class='divTd'>
                                            <div class='iconCamion'></div>
                                            <div class='estiloV1'><?php echo $data['identificador'];?></div>
                                        </div>
                                        <div class='divTd'>
                                            <div class='iconChofer'></div>
                                            <div class='estiloV1'><?php echo Personal::model()->getChofer($data['id']);?></div>
                                        </div>
                                        <div class='divTd'>
                                            <div class='iconPersonal'></div>
                                            <div class='estiloV1'><?php echo $data['nombre'].' '.$data['apellido'];?></div>
                                        </div>
                                    </div>	
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                    <div class="container-line">
                        <h3 class="container-line2"></h3>
                        <h3 class="container-line1"></h3>
                    </div>
                </div>
                <div class="divBox2">
                    <div class="divTitulo1">
                        <label class="tituloV1">2. Contenido:</label>
                    </div>
                    <div class="contenedor-tanques"></div>
                    <div class="container-lineBox">
                        <h3 class="container-line2"></h3>
                    </div>					
                </div>
            </div>
            <div class="container-box">
                <div class="separador1"></div>
                <div class="containerRuta">
                    <div class="containerR1"></div>
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
                            <?php foreach($enespera as $data ):?>
                                <?php if((int)$data["disponibles"] > 0):?>	
                                    <div class='divTr2'>
                                        <div class='divCamion1'>
                                            <div class='divIcon2'>
                                                <div class='iconCamion1'></div>
                                            </div>
                                            <div class='divText2'>
                                                <div class='titulo3'>Camión</div>
                                                <div class='estilov2'><?php echo $data['nombre'];?></div>
                                            </div>
                                        </div>
                                        <div class='divTanque1'>
                                            <div class='divIcon2'>
                                                <div class='iconTanque1'></div>
                                            </div>
                                            <div class='divText3'>
                                                <div class='titulo3'>Tanques disponibles</div>
                                                <div class='estilov2'><?php echo $data['disponibles'];?></div>
                                            </div>
                                        </div>
                                        <div class='divUbicacion1'>
                                            <div class='divIcon2'>
                                                <div class='iconGPS1'></div>
                                            </div>
                                            <div class='divText2'>
                                                <div class='titulo3'>Último destino</div>
                                                <div class='estilov2'><?php echo $data['ultimo'];?></div>
                                            </div>
                                        </div>
                                        <div class='divTdBoton'>
                                            <a href="<?php echo $baseUrl.'/index.php/viajes/'.$data['id_viaje'];?>">
                                                <div class='botonIr'><label class='titulo2'>Ir</label></div>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif;?>
                            <?php endforeach;?>
                        </div>	
                    </div>
                </div>
            </div>
        </div>
    <?php else :?>
        <div id='no-viajes'>
            <div class='container-viaje center'></div>
        </div>
    <?php endif;?>  
    <?php if($estaciones != null):?>
        <?php if(Yii::app()->user->getTipoUsuario()!=1):?>
            <div class="container-granja none"> <!--Aquí empieza el tab de estaciones-->
                <div class="container-box">
                    <div class="divBox1">
                        <div class="divTitulo1">
                            <p class="tituloV1">1. Selecciona una estación:</p>
                        </div>
                        <div class="estacion">
                            <div class="divTable">
                                <p class="divThead">Estaciones</p>
                                <div class="lestacion">
                                    <?php $i=1;?>
                                    <?php foreach($estaciones as $est):?>
                                        <div data-estacion="<?php echo $est['idest'];?>" data-id="est<?php echo $i;?>" class="liest">
                                            <div>
                                                <div class="est"><?php echo $est['identificador'];?></div>
                                            </div>
                                            <div>
                                                <div class="est"><?php echo $est['nombre']." ".$est['apellido'];?></div>
                                            </div>
                                            <div>
                                                <div class='est'> 
                                                    <a href="monitoreo/<?php echo $est['idest'];?>">
                                                        <div class='botonIrViaje'>Ver Historial</div>
                                                    </a> 
                                                </div>
                                            </div>
                                        </div>
                                    <?php $i++; endforeach;?>
                                </div>
                            </div>
                        </div>
                        <div class="container-line">
                            <h3 class="container-line2"></h3>
                            <h3 class="container-line1"></h3>
                        </div>
                    </div>
                    <div class="divBox2">
                        <p class="topcont">2. Contenido:</p>
                        <div class="lcontenido">
                            <div>
                                <p class="estv" >Seleccione una estación</p>
                            </div>
                            <?php $o=1; foreach($estaciones as $est):?>
                                <div data-id="est<?php echo $o;?>" class="cont hide">
                                    <?php 
                                        $id = $est['id_estacion'];
                                        $datos = $this->actionGetTanques($id);
                                    ?>
                                    <?php if(count($datos) > 0):?>
                                    <?php foreach($datos as $dato):?>
                                        <div class="tanque">
                                            <div class="tanque-container-titulo">
                                                <span class="titulotanque"><?php echo $dato['tnombre']; ?></span>
                                            </div>
                                            <div class="variables-wrapper">
                                                <div class="var-oz">
                                                    <div class="icon-oz"></div>
                                                    <div class="txt"><?php echo intval($dato['ox']); ?><span> mg/L</span></div>
                                                </div>
                                                <div class="var-ph">
                                                    <div class="icon-ph"></div>
                                                    <div class="txt"><?php echo intval($dato['ph']); ?></div>
                                                </div>
                                                <div class="var-tm">
                                                    <div class="icon-tm"></div>
                                                    <div class="txt"><?php echo intval($dato['temp']); ?><span>°C</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                    <?php else:?>
                                        <div class="letreroError">Esta siembra no tiene registros, porfavor, p&oacute;ngase en contacto con el administrador.</div>
                                    <?php endif;?>
                                </div>
                            <?php $o++; endforeach;?>
                        </div> <!-- Fin de div contenido-->
                        <div class="container-lineBox">
                            <h3 class="container-line2"></h3>
                        </div>
                    </div>
                </div>
            <?php 
                if(isset($est['id_estacion']))
                    $id = $est['id_estacion'];
                else 
                    $id = 0;
                $datos = $this->actionGetTanques2($id);
                $us = 1;
            ?>
            <div class="container-box">
                <?php foreach($estaciones as $est):?>
                    <div class="ubicacion hide" data-id="est<?php echo $us;?>">
                        <span>3. Ubicación: <?php echo $est['ubicacion'];?> .</span>
                    </div>
                <?php $us++; endforeach;?>
            </div>
            <div class="container-box info">
                <?php 
                    if(isset($est['id_estacion']))
                        $id = $est['id_estacion'];
                    else 
                        $id = 0;
                    $datos = $this->actionGetTanques2($id);
                    $us = 1;
                ?>
                <?php foreach($estaciones as $est):?>
                    <div>
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
                    </div>
                <?php $u++; endforeach;?>
            </div>
        </div>
        <?php endif;?>
    <?php else:?> 
        <div class='container-granja none'></div>
    <?php endif;?>
</div>
