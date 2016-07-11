<?php
/* @var $this ViajesController */
/* @var $model Viajes */
    $baseUrl = Yii::app()->baseUrl;
?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDaG6uwH8h6edDH6rPh0PfGgq6yEqSedgg"></script>
<script type="text/javascript" src="<?php echo $baseUrl;?>/js/plugins/google-maps/jquery.ui.map.full.min.js"></script>
<?php
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/viajes/view.css');
    $cs->registerScriptFile($baseUrl.'/js/viajes/view.js');
$this->breadcrumbs=array(
	'Viajes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Viajes', 'url'=>array('index')),
	array('label'=>'Create Viajes', 'url'=>array('create')),
	array('label'=>'Update Viajes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Viajes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Viajes', 'url'=>array('admin')),
);
?>
<?php if($model->status == 1):?>
<h1>Detalles de viaje #<?php echo $model->id; ?></h1>
<?php elseif ($model->status == 2):?>
<h1>Viaje en ruta</h1>
<?php else:?>
<h1>Historico del viaje</h1>
<?php endif;?>
<div class="principal">
    <?php if($model->status == 1):?>
    <?php // $this->widget('zii.widgets.CDetailView', array(
//            'data'=>$model,
//            'attributes'=>array(
//                array(
//                    'name'=>'id_solicitudes',
//                    'value'=> Viajes::model()->getAllClientesViajes($model->id, $model->id_solicitudes),
//                    'type'=>'raw'
//                ),
//                array(
//                    'name'=>'status',
//                    'value'=> Viajes::model()->getStatus($model->status)
//                ),
//                array(
//                    'name'=>'id_responsable',
//                    'value'=> Personal::model()->getPersonal($model->id_responsable)
//                ),
//                array(
//                    'name'=>'fecha_salida',
//                    'value'=> Viajes::model()->getFecha($model->fecha_salida)
//                ),
//                array(
//                    'name'=>'hora_salida',
//                    'value'=> Viajes::model()->getHora($model->hora_salida)
//                ),
//                array(
//                    'name'=>'fecha_entrega',
//                    'value'=> Viajes::model()->getFecha($model->fecha_entrega)
//                ),
//                array(
//                    'name'=>'hora_entrega',
//                    'value'=> Viajes::model()->getHora($model->hora_entrega)
//                ),
//                array(
//                    'name'=>'id_estacion',
//                    'value'=>Estacion::model()->getEstacion($model->id_estacion)
//                )
//            ),
//    )); ?>
    <?php endif;?>
    <?php if($model->status == 2 || $model->status == 1):?>
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
                    <span><?php echo $model->fecha_salida;?></span>
                    <div class="txtA ultimo">Distancia recorrida:</div>
                    <span>Prueba</span>
                </div>
                <div>
                    <div class="txtA">Ubicación:</div>
                    <span><?php echo $model->fecha_salida;?></span>
                </div>
            </div>
        </div>
        <div class="mapaWraper">
            <div class="titulo">Mapa</div>
            <div id="map"></div>
        </div>
    </div>
    <div class="tanquesViajes">
        <h2>Detalles de tanque</h2>
        <div class="allTanques">
            <?php // print_r($tanques);?>
            <?php foreach($tanques as $data):?>
                <div class="tanque">
                    <div class="titulosWraper">
                        <div><?php echo $data['nombre'];?></div>
                        <div><?php echo $data['nombre_empresa'];?></div>
                        <div><?php echo $data['codigo'];?></div>
                    </div>
                    <div class="grafica">
                        
                    </div>
                    <div> </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
    <?php endif;?>
</div>