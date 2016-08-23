<?php
/* @var $this ClientesController */
/* @var $model Clientes */

    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDaG6uwH8h6edDH6rPh0PfGgq6yEqSedgg"></script>
<script type="text/javascript" src="<?php echo $baseUrl;?>/js/plugins/google-maps/jquery.ui.map.full.min.js"></script>
<?php
    $cs->registerScriptFile($baseUrl.'/js/viewTable.js');
    $cs->registerScriptFile($baseUrl.'/js/clientes/view.js');
    $cs->registerCssFile($baseUrl.'/css/clientes/create.css');
    $this->breadcrumbs=array(
	'Clientes'=>array('index'),
	$model->id,
    );
?>
<style>
    div.form-cLeft1 .table-view
    {
        margin: 0;
        width: 100%;
        display: block;
    }
    .table-view .title
    {
        font-size: 14px !important;
        color: #0077B0;
        margin-bottom: 5px;
    }
</style>
<h1>Ver cliente <?php echo $model->nombre_empresa; ?></h1>
<div class="form">

    <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'nullDisplay'=>'No hay datos disponibles',
            'attributes'=>array
            (
                'nombre_empresa',
                'rfc',
                'nombre_contacto',
                'correo',
                'apellido_contacto',
                'tel',
                array('name'=>'id', 'value'=>$model->getUserName($model->id) ),
                'ext', 
                'cel',                 
            ),
    )); 
    ?>
    <div class="row">
        <h3><label class="cLetreros">Direcciones</label></h3><h2 class="letrero-container"></h2><a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/clientes">Regresar</a>
    </div>
    <div class="form-cLeft1">

        <div class="table-view">
            <?php $i = 1;?>
            <?php if(count($direccion['domicilio'])>0):?>
                <?php foreach($direccion['domicilio'] as $data):?>
                    <div class="allMapa" data-id="<?php echo $i;?>">
                        <div id="map" data-map="<?php echo $i;?>"></div>
                        <div class="row ubi hide">
                            <div class="form-cXMedium">
                                <div class="data"><?php echo $data['ubicacion_mapa'];?></div>
                            </div>
                        </div>
                        <div class="row dom">
                            <div class="form-cXLarge">
                                <div class="title">Domicilio</div>
                                <div class="data"><?php echo $data['domicilio'];?></div>
                            </div>
                        </div>
                        <div class="row des">
                            <div class="form-cXLarge">
                                <div class="title">Descripci&oacute;n</div>
                                <div class="data"><?php echo $data['descripcion'];?></div>
                            </div>
                        </div>
                    </div>
                    <?php $i++;?>
                <?php endforeach;?>
            <?php endif;?>
        </div>
    </div>
</div>
