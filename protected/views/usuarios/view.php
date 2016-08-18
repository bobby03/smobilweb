<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */

 $baseUrl = Yii::app()->baseUrl;
 $cs = Yii::app()->getClientScript();
 $cs->registerScriptFile($baseUrl.'/js/viewTable.js');


$this->breadcrumbs=array(
	'Usuarioses'=>array('index'),
	$model->id,
);
$model->tipo_usr = Usuarios::model()->getTipoUsuario($model->tipo_usr);
$model->id_usr = Usuarios::model()->getUsuario($model->tipo_usr, $model->id_usr);
?>

<h1>Usuario <?php echo $model->usuario; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'nullDisplay'=>'No hay datos disponibles',
	'attributes'=>array(
//		'usuario',
		'tipo_usr',
		'id_usr',
	),
)); ?>

