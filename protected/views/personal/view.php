<?php
/* @var $this PersonalController */
/* @var $model Personal */

 $baseUrl = Yii::app()->baseUrl;
 $cs = Yii::app()->getClientScript();
 $cs->registerScriptFile($baseUrl.'/js/viewTable.js');

$this->breadcrumbs=array(
	'Personals'=>array('index'),
	$model->id,
);
$model->id_rol = Roles::model()->getRol($model->id_rol);
?>

<h1>Ver personal #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'nullDisplay'=>'No hay datos disponibles',
	'attributes'=>array
        (
            'nombre',
            'apellido',
            'tel',
            'rfc',
            'domicilio',
            'id_rol',
            'correo',
            'puesto',
	),
)); ?>
