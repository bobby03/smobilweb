<?php
/* @var $this RolesController */
/* @var $model Roles */

 $baseUrl = Yii::app()->baseUrl;
 $cs = Yii::app()->getClientScript();
 $cs->registerScriptFile($baseUrl.'/js/viewTable.js');

$this->breadcrumbs=array(
	'Roles'=>array('index'),
	$model->id,
);
$model->activo = Roles::model()->g
?>

<h1>Rol #<?php echo $model->nombre_rol; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'nullDisplay'=>'No hay datos disponibles',
	'attributes'=>array
        (
            'nombre_rol',
	),
)); ?>
