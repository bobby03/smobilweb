<?php
/* @var $this CampSensadoController */
/* @var $model CampSensado */
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/js.cookie.js');
    $cs->registerScriptFile($baseUrl.'/js/viewTable.js');
    $cs->registerCssFile($baseUrl.'/css/campsensado/view.css');
    $this->breadcrumbs=array(
	'Siembra'=>array('index'),
	$model->id,
    );

    $camp = CampTanque::model()->findAll("id_camp_sensado = $model->id");
?>
<h1>Ver siembra <?php echo $model->nombre_camp; ?></h1>

<div class="form">
    <?php $this->widget('zii.widgets.CDetailView', array(
        'data'=>$model,
        'attributes'=>array
        (
            'id',
            'id_responsable',
            'id_estacion',
            'nombre_camp',
            'fecha_inicio',
            'hora_inicio',
            'fecha_fin',
            'hora_fin',
        ),
    )); ?>
    <div class="row">
        <h3>
            <label class="cLetreros">Pedidos</label>
        </h3>
        <h2 class="letrero-container"></h2>
    </div>
    <div class="row">
        <a class="gBoton" id="cBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/CampSensado">Regresar</a>                
        <script type="text/javascript">                     
//               urlC = $('#cBoton').attr('enla')+'#'+Cookies.get('tabse');
//               console.log(urlC);
//               $('#cBoton').attr('href',urlC);
        </script>
    </div>
     <?php if(count($camp)>0):?>
        
        <div class="row">
            <?php $tot = 1; $tempTtl = 0;?>
            <?php foreach($camp as $data):?> 
                <div class="pedido">
                    <div class="tituloEspecie"><?php echo Tanque::model()->getTanque($data->id_tanque);?></div>
                    <div class="pedidoWraper gris">
                        <div>Especie: <span><?php echo Cepa::model()->getEspecie($data['id_cepa']);?></span></div>
                        <div>Cepa: <span><?php echo Cepa::model()->getCepa($data['id_cepa']);?></span></div>
                        <div>Cantidad: <span><?php echo $data['cantidad']?></span></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        
    <?php endif;?>
</div>
