<?php
/* @var $this GranjasController */
/* @var $model Granjas */

    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/viewTable.js');
    $cs->registerScriptFile($baseUrl.'/js/clientes/view.js');
    $cs->registerCssFile($baseUrl.'/css/clientes/create.css');
$this->breadcrumbs=array(
	'Granjases'=>array('index'),
	$model->id,
);
?>

<h1>Ver <?php echo $model->nombre; ?></h1>
<div class="form">
    <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                    'direccion',
                    'responsable',
            ),
    )); ?>
    <a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true); ?>/viajes">Cancelar</a>
</div>