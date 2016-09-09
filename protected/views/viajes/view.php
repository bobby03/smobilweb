<?php
/* @var $this ViajesController */
/* @var $model Viajes */
    $baseUrl = Yii::app()->baseUrl;
?>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDaG6uwH8h6edDH6rPh0PfGgq6yEqSedgg"></script>
<script type="text/javascript" src="<?php echo $baseUrl;?>/js/plugins/google-maps/jquery.ui.map.full.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.bundle.js"></script>
<?php

    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/viewTable.js');
    $cs->registerCssFile($baseUrl.'/css/viajes/view.css');
    $cs->registerScriptFile($baseUrl.'/js/plugins/ColorBox/jquery.colorbox.js');
    $cs->registerScriptFile($baseUrl.'/js/viajes/back.js');
    $cs->registerCssFile($baseUrl.'/js/plugins/ColorBox/colorbox.css');
    
    $this->breadcrumbs=array(
            'Viajes'=>array('index'),
            $model->id,
    );
?>
<?php if($model->status == 1 ):?>
<h1>Detalles de viaje #<?php echo $model->id; ?></h1>
<?php elseif ($model->status == 2):?>
<h1>Viaje en ruta</h1>
<style>
    div.form {
    margin-top: 60px !important;
}
</style>
<?php else:?>
<h1>Historico del viaje</h1>
<style>
    div.form {
    margin-top: 60px !important;
}
</style>
<?php endif;?>
<div class="principal">
    <!--EN ESPERA-->
    <?php if($model->status == 1):?>
    <?php $cs->registerCssFile($baseUrl.'/css/viajes/create.css');?>
    <div class="form">
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                array(
                    'name'=>'status',
                    'value'=> Viajes::model()->getStatus($model->status)
                ),
                array(
                    'name'=>'id_responsable',
                    'value'=> Personal::model()->getPersonal($model->id_responsable)
                ),
                array(
                    'name'=>'fecha_salida',
                    'value'=> Viajes::model()->getFecha($model->fecha_salida)
                ),
                array(
                    'name'=>'hora_salida',
                    'value'=> Viajes::model()->getHora($model->hora_salida)
                ),
                array(
                    'name'=>'fecha_entrega',
                    'value'=> Viajes::model()->getFecha($model->fecha_entrega)
                ),
                array(
                    'name'=>'hora_entrega',
                    'value'=> Viajes::model()->getHora($model->hora_entrega)
                ),
                array(
                    'name'=>'id_estacion',
                    'value'=>Estacion::model()->getEstacion($model->id_estacion)
                )
            ),
        )); ?>
        <div style="width: 100%; height:35px;">
        <!--    <a style="margin-left: 10px !important;" class="gBoton" href="<?php echo $baseUrl.'/viajes'?>">Regresar</a>-->
        </div>
        <div class="todosPedidosVer">
        <?php $tot = 1;?>
        <?php if(isset($pedidos['pedido'])):?>
        <?php foreach($pedidos['pedido'] as $data):?>
            <?php for($i = 1; $i <= $data['tanques']; $i++):?>
                <div class="pedido">
                    <!--<div class="tituloEspecie">Pedido <?php echo $tot;?></div>-->
                    <div class="tituloEspecie"><?php echo Tanque::model()->getTanque($data['id_tanque']);?></div>
                    <?php if(isset($data['id_tanque'])):?>
                    <div class="pedidoWraper gris">
                        <div>Cliente: <span><?php echo Solicitudes::model()->getCliente($data['id_solicitud']);?></span></div>
                        <div>Especie: <span><?php echo Especie::model()->getEspecie($data['especie']);?></span></div>
                        <div>Cepa: <span><?php echo Cepa::model()->getCepa($data['cepa']);?></span></div>
                        <div>Cantidad: <span><?php echo $data['cantidad']/$data['tanques'];?></span></div>
                        <div>Destino: <span style="display: block"><?php echo ClientesDomicilio::model()->getDomicilio($data['destino']);?></span></div>
<!--                        <div class="selectTanque">
                            <label>Tanque</label>
                            <div style="color: #000000">
                                <?php echo Tanque::model()->getTanque($data['id_tanque']);?>
                            </div>
                        </div>-->
                    </div>
                    <?php else:?>
                    <div class="pedidoWraper">
                        <div>Especie: <span><?php echo Especie::model()->getEspecie($data['especie']);?></span></div>
                        <div>Cepa: <span><?php echo Cepa::model()->getCepa($data['cepa']);?></span></div>
                        <div>Cantidad: <span><?php echo $data['cantidad']/$data['tanques'];?></span></div>
                        <div>Destino: <span style="display: block"><?php echo ClientesDomicilio::model()->getDomicilio($data['destino']);?></span></div>
                        <div class="selectTanque hide">
                            <label>Seleccionar Tanque</label>
                            <?php echo $form->dropDownList($solicitudes, "codigo[$tot][tanque]",array(''=>''),array('empty'=>'Seleccionar', 'class'=>'css-select', 'data-tan'=>$tot));?>
                            <?php 
                            $t = "codigo[".$tot."][tanque]";

                            echo $form->error($model,$t); ?>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
                <?php $tot++; ?>
            <?php endfor;?>
        <?php endforeach; ?>

        <?php endif;?>
        </div>
        <div style="width: 100%; height:35px;">
            <!--<a style="margin-left: 10px !important;" class="gBoton" href="<?php echo $baseUrl.'/viajes'?>">Regresar</a>-->
        </div>

    </div>
    <?php endif;?>
    <!--EN RUTA-->
    <?php if($model->status == 2):?>
    <?php $cs->registerScriptFile($baseUrl.'/js/viajes/view.js'); ?>
    <div class="detallesViaje">
        <div class="datosViaje">
            <div class="titulo">Datos del viaje<span>Ultima actualización:</span></div>
            <div class="datosWraper">
                <div>
                    <div class="subtitulo">Viaje #<?php echo $model->id;?></div>
                    <div class="txtA">Fecha:<span><?php echo $model->fecha_salida;?></span></div>
                    <div class="txtA ultimo">Último destino:<span></span></div>
                </div>
                <div>
                    <div class="txtA">Tiempo de viaje:</div>
                    <span class="tiempo"></span>
                    <div class="txtA ultimo">Distancia recorrida:</div>
                    <span class="distancia"></span>
                </div>
                <div>
                    <div class="txtA">Ubicación:</div>
                    <span></span>
                </div>
            </div>
        </div>
        <div class="mapaWraper">
            <div class="titulo">Mapa</div>
            <div id="map"></div>
        </div>
    </div>
    <div class="row" style="height: 55px;" >
        <a class="gBoton" id="cBoton">Cancelar</a>
    </div>
    <div class="tanquesViajes">
        <h2>Detalles de viaje ( <?php echo count($tanques); ?> tanques ) <span data-id="2">Por parametro</span><span class="selected" data-id="1">Por tanque</span></h2>
        <div class="allTanques" data-id="1">
            <?php // print_r($tanques);?>
            <?php foreach($tanques as $data):?>
                <div class="tanque">
                    <div class="titulosWraper">
                        <div class="izquierda">
                            <div><?php echo $data['nombre'];?></div>
                            <div><?php echo $data['nombre_empresa'];?></div>
                            <div><?php echo $data['codigo'];?></div>
                        </div>
                        <div class="derecha">
                            <div class="boton graf" data-graf="<?php echo $data['id'];?>"></div>
                            <div class="boton adve" data-ale="<?php echo $data['id'];?>"></div>
                        </div>
                    </div>
                    <h3>Variables de monitoreo</h3>
                    <div class="grafica" data-tanque="<?php echo $data['id'];?>">
                        <div data-num="1"><canvas id="graf1" width="100" height="190"></canvas></div>
                        <div data-num="2"><canvas id="graf2" width="96.39" height="190"></canvas></div>
                        <div data-num="3"><canvas id="graf3" width="96.39" height="190"></canvas></div>
                        <div data-num="4"><canvas id="graf4" width="96.39" height="190"></canvas></div>
                        <div data-num="5"><canvas id="graf5" width="96.39" height="190"></canvas></div>
                    </div>
                    <div> </div>
                </div>
            <?php endforeach;?>
        </div>

        <div class="allTanques hide" data-id="2">
            <div class="tanque" data-para="1">
                <div class="titulosWraper">
                    <div class="izquierda">
                        <div>Oxígeno disuelto</div>
                    </div>
                    <div class="derecha">
                        <div class="boton graf" data-ale="ox"></div>
                        <div class="boton adve" data-ale="ox"></div>
                    </div>
                </div>
                <div class="grafica">
                    <canvas id="grafP1" width="447" height="190"></canvas>
                </div>
            </div>
            <div class="tanque" data-para="2">
                <div class="titulosWraper">
                    <div class="izquierda">
                        <div>Temperatura</div>
                    </div>
                    <div class="derecha">
                        <div class="boton graf" data-ale="temp"></div>
                        <div class="boton adve" data-ale="temp"></div>
                    </div>
                </div>
                <div class="grafica">
                    <canvas id="grafP2" width="447" height="190"></canvas>
                </div>
            </div>
            <div class="tanque" data-para="3">
                <div class="titulosWraper">
                    <div class="izquierda">
                        <div>PH</div>
                    </div>
                    <div class="derecha">
                        <div class="boton graf" data-ale="ph"></div>
                        <div class="boton adve" data-ale="ph"></div>
                    </div>
                </div>
                <div class="grafica">
                    <canvas id="grafP3" width="447" height="190"></canvas>
                </div>
            </div>
            <div class="tanque" data-para="4">
                <div class="titulosWraper">
                    <div class="izquierda">
                        <div>Conductividad</div>
                    </div>
                    <div class="derecha">
                        <div class="boton graf" data-ale="cond"></div>
                        <div class="boton adve" data-ale="cond"></div>
                    </div>
                </div>
                <div class="grafica">
                    <canvas id="grafP4" width="447" height="190"></canvas>
                </div>
            </div>
            <div class="tanque" data-para="5">
                <div class="titulosWraper">
                    <div class="izquierda">
                        <div>Potencial óxido reducción</div>
                    </div>
                    <div class="derecha">
                        <div class="boton graf" data-ale="orp"></div>
                        <div class="boton adve" data-ale="orp"></div>
                    </div>
                </div>
                <div class="grafica">
                    <canvas id="grafP5" width="447" height="190"></canvas>
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <!--  FINALIZADO -->

    <?php if($model->status == 3):?>
    <?php $cs->registerScriptFile($baseUrl.'/js/viajes/view.js'); 
    ?>
    <div class="detallesViaje">
         <div class="datosViaje" >
            <div class="titulo">Datos del viaje<span>Ultima actualización:</span></div>
            <div class="datosWraper">
                <div>
                    <div class="subtitulo">Viaje #<?php echo $model->id;?></div>
                    <div class="txtA">Fecha:<span><?php echo $model->fecha_salida;?></span></div>
                    <div class="txtA ultimo">Último destino:<span></span></div>
                </div>
                <div>
                     <div class="txtA">Tiempo de viaje:</div>
                    <span class="tiempo"></span>
                    <div class="txtA ultimo">Distancia recorrida:</div>
                    <span class="distancia"></span>
                </div>
                <div>
                    <div class="txtA">Ubicación:</div>
                    <span></span>
                </div>
            </div>
        </div> 
        <div class="mapaWraper" >
            <div class="titulo">Mapa</div>
            <div id="map2" ></div>
        </div>
    </div>
    
    <div class="row" style="height: 55px;" >
        <a class="gBoton" id="cBoton">Cancelar</a>
    </div>

    <div class="tanquesViajes">
        <h2>Detalles de viaje ( <?php echo count($tanques); ?> tanques ) <span data-id="2">Por parametro</span><span class="selected" data-id="1">Por tanque</span></h2>
        <div class="allTanques" data-id="1">
            <?php // print_r($tanques);?>
            <?php foreach($tanques as $data):?>
                <div class="tanque">
                    <div class="titulosWraper">
                        <div class="izquierda">
                            <div><?php echo $data['nombre'];?></div>
                            <div><?php echo $data['nombre_empresa'];?></div>
                            <div><?php echo $data['codigo'];?></div>
                        </div>
                        <div class="derecha">
                            <div class="boton graf" data-graf="<?php echo $data['id'];?>"></div>
                            <div class="boton adve" data-ale="<?php echo $data['id'];?>"></div>
                        </div>
                    </div>
                    <h3>Variables de monitoreo</h3>
                    <div class="grafica" data-tanque="<?php echo $data['id'];?>">
                        <div data-num="1"><canvas id="graf1" width="100" height="190"></canvas></div>
                        <div data-num="2"><canvas id="graf2" width="96.39" height="190"></canvas></div>
                        <div data-num="3"><canvas id="graf3" width="96.39" height="190"></canvas></div>
                        <div data-num="4"><canvas id="graf4" width="96.39" height="190"></canvas></div>
                        <div data-num="5"><canvas id="graf5" width="96.39" height="190"></canvas></div>
                    </div>
                    <div> </div>
                </div>
            <?php endforeach;?>
        </div>
        <div class="allTanques hide" data-id="2">
            <div class="tanque" data-para="1">
                <div class="titulosWraper">
                    <div class="izquierda">
                        <div>Oxígeno disuelto</div>
                    </div>
                    <div class="derecha">
                        <div class="boton graf" data-ale="ox"></div>
                        <div class="boton adve" data-ale="ox"></div>
                    </div>
                </div>
                <div class="grafica">
                    <canvas id="grafP1" width="447" height="190"></canvas>
                </div>
            </div>
            <div class="tanque" data-para="2">
                <div class="titulosWraper">
                    <div class="izquierda">
                        <div>Temperatura</div>
                    </div>
                    <div class="derecha">
                        <div class="boton graf" data-ale="temp"></div>
                        <div class="boton adve" data-ale="temp"></div>
                    </div>
                </div>
                <div class="grafica">
                    <canvas id="grafP2" width="447" height="190"></canvas>
                </div>
            </div>
            <div class="tanque" data-para="3">
                <div class="titulosWraper">
                    <div class="izquierda">
                        <div>PH</div>
                    </div>
                    <div class="derecha">
                        <div class="boton graf" data-ale="ph"></div>
                        <div class="boton adve" data-ale="ph"></div>
                    </div>
                </div>
                <div class="grafica">
                    <canvas id="grafP3" width="447" height="190"></canvas>
                </div>
            </div>
            <div class="tanque" data-para="4">
                <div class="titulosWraper">
                    <div class="izquierda">
                        <div>Conductividad</div>
                    </div>
                    <div class="derecha">
                        <div class="boton graf" data-ale="cond"></div>
                        <div class="boton adve" data-ale="cond"></div>
                    </div>
                </div>
                <div class="grafica">
                    <canvas id="grafP4" width="447" height="190"></canvas>
                </div>
            </div>
            <div class="tanque" data-para="5">
                <div class="titulosWraper">
                    <div class="izquierda">
                        <div>Potencial óxido reducción</div>
                    </div>
                    <div class="derecha">
                        <div class="boton graf" data-ale="orp"></div>
                        <div class="boton adve" data-ale="orp"></div>
                    </div>
                </div>
                <div class="grafica">
                    <canvas id="grafP5" width="447" height="190"></canvas>
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>

    <div class="row">
        <a class="gBoton" id="cBoton">Regresar</a>
    </div>

</div>