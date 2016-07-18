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
?>

<h1>Usuarios #<?php echo $model->id; ?></h1>
<
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'usuario',
		'pwd',
		'tipo_usr',
		'id_usr',
	),
)); ?>

