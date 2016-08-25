<?php
/* @var $this SolicitudesController */
/* @var $model Solicitudes */

 $baseUrl = Yii::app()->baseUrl;
 $cs = Yii::app()->getClientScript();
 $cs->registerScriptFile($baseUrl.'/js/viewTable.js');
 $cs->registerCssFile($baseUrl.'/css/viajes/create.css');
 $cs->registerCssFile($baseUrl.'/css/solicitudes/view.css');

$this->breadcrumbs=array(
	'Solicitudes'=>array('index'),
	$model->id,
);
$pedidos = Pedidos::model()->findAll("id_solicitud = $model->id");
$model->id_clientes = Clientes::model()->getCliente($model->id_clientes);
?>
<style>
.cLetreros 
{
    margin-left: 29px;
    font-size: 14px !important;
    color: #0077B0;
}
.letrero-container 
{
    background-color: #E4E7EB;
    height: 4px;
    /* width: 80%; */
}
</style>
<h1>Ver solicitud #<?php echo $model->id; ?></h1>
<?php if($model->status == 1) : ?>
<div class="form">
    <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'nullDisplay'=>'No se ha asignado a un viaje',
            'attributes'=>array
            (
                'id_clientes',
                'codigo',
                'fecha_alta',
                'hora_alta',
                 array('name'=>'id_viaje', 'value'=>Solicitudes::model()->getViaje($model->id)), 
                'fecha_estimada',
                'hora_estimada',
                'fecha_entrega',
                'hora_entrega',
                'notas',
            ),
    )); ?>
    <?php else: ?>
     <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'nullDisplay'=>'No se ha asignado a un viaje',
            'attributes'=>array
            (
                'id_clientes',
                'codigo',
                'fecha_alta',
                'hora_alta',
                'fecha_estimada',
                'hora_estimada',
                'fecha_entrega',
                'hora_entrega',
                'notas',
            ),
    )); ?>   
    
    <?php endif?>
    <?php if(count($pedidos)>0):?>
        <div class="row">
            <h3>
                <label class="cLetreros">Pedidos</label>
            </h3>
            <h2 class="letrero-container"></h2>
        </div>
        <div class="row">
            <?php $tot = 1; $tempTtl = 0;?>
            <?php foreach($pedidos as $data):?> 
                <?php for($i = 1; $i <= $data['tanques']; $i++):?>
                    <?php 
                        if ( $i == $data['tanques'] ) {
                            $tempTtl = ceil($data['cantidad'] / $data['tanques']) - floor($data['cantidad'] / $data['tanques']) ;
                        }
                    ?>
                    <div class="pedido">
                        <div class="tituloEspecie">Pedido <?php echo $tot;?></div>
                        <div class="pedidoWraper gris">
                            <div>Especie: <span><?php echo Especie::model()->getEspecie($data['id_especie']);?></span></div>
                            <div>Cepa: <span><?php echo Cepa::model()->getCepa($data['id_cepa']);?></span></div>
                            <div>Cantidad: <span><?php echo ceil($data['cantidad']/$data['tanques']) - $tempTtl; ?></span></div>
                            <div>Destino: <span style="display: block"><?php echo ClientesDomicilio::model()->getDomicilio($data['id_direccion']);?></span></div>
                        </div>
                    </div>
                    <?php $tot++; ?>
                <?php endfor;?>
            <?php endforeach; ?>
        </div>
        <div class="row"><a class="cancelarDireccion gBoton" style="margin-left: 10px;" href="<?php echo Yii::app()->getBaseUrl(true); ?>/solicitudes">Regresar</a></div>
    <?php endif;?>
</div>