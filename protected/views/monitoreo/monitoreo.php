<?php
    $baseUrl = Yii::app()->baseUrl;
?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDaG6uwH8h6edDH6rPh0PfGgq6yEqSedgg"></script>
<script type="text/javascript" src="<?php echo $baseUrl;?>/js/plugins/google-maps/jquery.ui.map.full.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.bundle.js"></script>
<?php
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/plugins/chosen/assets2/js/chosen.jquery.min.js');
    $cs->registerCssFile($baseUrl.'/js/plugins/chosen/assets2/css/chosen.min.css');
    $cs->registerScriptFile($baseUrl.'/js/plugins/ColorBox/jquery.colorbox.js');
    $cs->registerCssFile($baseUrl.'/js/plugins/ColorBox/colorbox.css');
    $cs->registerScriptFile($baseUrl.'/js/monitoreo/monitoreo.js'); 
?>
<h1>Siembra <?php echo $nombre; ?></h1>
<?php $id=$fijas['id'];?>

<div class="form">
    <div id="datosMon">
        <div class="divTit">
            <div id='titLeft'><h2>Datos de siembra</h2></div>
            <div id='titRight'><p>Ultima actualizaci&oacute;n</p></div>
        </div>
        <div id="esp">
            <div id="esp1">
                <p class="subtit">Granja:</p>  
                <p><?php echo Granjas::model()->getGranjaFromPlantaString($fijas['id']);?></p>
                <br>
                <p class="subtit">Planta de producci&oacute;n:</p>      
                <p><?php echo $fijas['identificador']?></p>
                <br>
                <p class="subtit">Rresponsable:</p>    
                <p><?php echo $responsable?></p>
            </div>
            <div id="esp2">
                <p class="subtit">Descripci&oacute;n:</p>  
                <p><?php echo $fijas['marca']?></p>
                <br>
                <p class="subtit">Ubicaci&oacute;n:</p>    
                <p><?php echo $fijas['ubicacion']?></p>
            </div>
            <div id="esp4">
                <p class="subtit">Fecha de inicio:</p>  
                <p><?php echo Viajes::model()->getFecha($siembra->fecha_inicio); ?></p>
                <br>
                <p class="subtit">Fecha de finalización:</p>    
                <p><?php echo Viajes::model()->getFecha($siembra->fecha_fin); ?></p>
            </div>
        </div>
    </div>
<?php
        $emsg=0;
        if($cantTanques['cTan']==0)
            $emsg=1;
        if(empty($tanques)):?>
            <div id="detallesMon">
                <?php 
                if($emsg==1){
                    echo '<h3>Estación sin tanques</h3>';
            }else{
                echo '<h3>Estación sin monitoreo</h3>';
            }
            ?>
                
            </div>
            <?php else:?>
    <div id="detallesMon">
        <div class="divTit">
            <div id='enLeft'><h2>Detalles del monitoreo</h2></div>
            <div id='enRight'>      
                <div class="enlace" data-id="2">Por parámetro</div>
                <div class="enlace select" data-id="1">Por tanque</div>
            </div>
        </div>
        <div class="divTit hide">
            <div id='enLeft'><h2>Estación sin datos</h2></div>
        </div>

        <!-- Gráficas por parametro -->
        

        <div class="tab" data-tab='1'>
            <?php
            $l=true;
            
            foreach($tanques as $data):
                if($l==true){
                    $lado="der";
                }else{$lado="izq";}
                ?>

            <div class="tanque <?php echo $lado;?>" >
                <div class="hDatos">
                <div class="datIzq">
                    <p class="tit"><?php echo $data['nombre'];?></p>
                    <p><span class="subtit">Capacidad: </span><?php echo $data['capacidad']." litros";?></p>
                </div>
                <div class="datDer">
                    <div class="boton graf" datos="<?php echo $id;?>" data-graf="<?php echo $data['idTan'];?>"></div>
                    <div class="boton adve" datos="<?php echo $id;?>" data-ale="<?php echo $data['idTan'];?>"></div>
                </div>
                </div>
                <h3>Variables de monitoreo</h3>
            <div class='grafica' datos="<?php echo $id;?>" data-tanque="<?php echo $data['idTan'];?>">
                
                <div class="graf" data-num="1"><canvas id="graf1" width="96.39" height="190"></canvas></div>
                <div class="graf" data-num="2"><canvas id="graf2" width="96.39" height="190"></canvas></div>
                <div class="graf" data-num="3"><canvas id="graf3" width="96.39" height="190"></canvas></div>
                <div class="graf" data-num="4"><canvas id="graf4" width="96.39" height="190"></canvas></div>
                <div class="graf" data-num="5"><canvas id="graf5" width="96.39" height="190"></canvas></div>
            </div>
            </div>
            
        <?php $l=!$l; endforeach?>
            
        </div>
        <div class="tab hide" data-tab='2'>
            <div class="tanque der" datos="<?php echo $id;?>" data-para="1">
                <div class="hDatos">
                    <div class="datIzq">
                        <div ><p class="tit">Oxígeno disuelto</p></div>
                    </div>
                    <div class="datDer">
                        <div class="boton graf" datos="<?php echo $id;?>" data-ale="ox"></div>
                        <div class="boton adve" datos="<?php echo $id;?>" data-ale="ox"></div>
                    </div>

                </div>
                <h3>Tanques</h3>
                <div class="grafica">
                    <canvas id="grafP1" width="447" height="190"></canvas>
                </div>
            </div>
            <div class="tanque izq" datos="<?php echo $id;?>" data-para="2">
                <div class="hDatos">
                    <div class="datIzq">
                        <div ><p class="tit">Temperatura</p></div>
                    </div>
                    <div class="datDer" datos="<?php echo $id;?>">
                        <div class="boton graf" datos="<?php echo $id;?>" data-ale="temp"></div>
                        <div class="boton adve" datos="<?php echo $id;?>" data-ale="temp"></div>
                    </div>
                </div>
                <h3>Tanques</h3>
                <div class="grafica">
                    <canvas id="grafP2" width="447" height="190"></canvas>
                </div>
            </div>
            <div class="tanque der" datos="<?php echo $id;?>" data-para="3">
                <div class="hDatos">
                    <div class="datIzq">
                        <div ><p class="tit">PH</p></div>
                    </div>
                    <div class="datDer">
                        <div class="boton graf" datos="<?php echo $id;?>" data-ale="ph"></div>
                        <div class="boton adve" datos="<?php echo $id;?>" data-ale="ph"></div>
                    </div>
                </div>
                <h3>Tanques</h3>
                <div class="grafica">
                    <canvas id="grafP3" width="447" height="190"></canvas>
                </div>
            </div>
            <div class="tanque izq" datos="<?php echo $id;?>" data-para="4">
                <div class="hDatos">
                    <div class="datIzq">
                        <div ><p class="tit">Conductividad</p></div>
                    </div>
                    <div class="datDer">
                        <div class="boton graf" datos="<?php echo $id;?>" data-ale="cond"></div>
                        <div class="boton adve" datos="<?php echo $id;?>" data-ale="cond"></div>
                    </div>
                </div>
                <h3>Tanques</h3>
                <div class="grafica">
                    <canvas id="grafP4" width="447" height="190"></canvas>
                </div>
            </div>
            <div class="tanque der" datos="<?php echo $id;?>" data-para="5">
                <div class="hDatos">
                    <div class="datIzq">
                        <div ><p class="tit">Potencial óxido de reducción</p></div>
                    </div>
                    <div class="datDer">
                        <div class="boton graf" datos="<?php echo $id;?>" data-ale="orp"></div>
                        <div class="boton adve" datos="<?php echo $id;?>" data-ale="orp"></div>
                    </div>
                </div>
                <h3>Tanques</h3>
                <div class="grafica">
                    <canvas id="grafP5" width="447" height="190"></canvas>
                </div>
            </div>
        </div>
    <?php endif;?>
        <?php if( $siembra->status ==1 ): ?>
            <a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/campsensado#proceso">Regresar</a>
        <?php elseif( $siembra->status==2 ): ?>
            <a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/campsensado#historico">Regresar</a>
        <?php else: ?>
            <a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/campsensado">Regresar</a>
        <?php endif;?>
    </div>
</div>
<?php  $cs->registerCssFile($baseUrl.'/css/monitoreo/monitoreo.css');?>