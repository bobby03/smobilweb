<?php
/* @var $this CepaController */
/* @var $model Cepa */
/* @var $form CActiveForm */

 $baseUrl = Yii::app()->baseUrl;

$this->breadcrumbs=array(
	'Cepas'=>array('index'),
	$model->id,
);


    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/viewTable.js');
    $cs->registerCssFile($baseUrl.'/css/cepa/create.css');
    $cs->registerCssFile($baseUrl.'/css/cepa/create.css?='.rand());
    $cs->registerCssFile($baseUrl.'/css/cepa/view.css');

	$form=$this->beginWidget('CActiveForm', array(
	'id'=>'cepa-form',
));


?>

<h1>Ver Cepa <?php echo $model->nombre_cepa; ?></h1>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array
        (
		'nombre_cepa',
                array(
                    'name' => 'id_especie',
                    'value' => Especie::model()->getEspecie($model->id_especie)
                ),
		'temp_min',
		'temp_max',
		'ph_min',
		'ph_max',
		'ox_min',
		'ox_max',
		'cond_min',
		'cond_max',
		'orp_min',
		'orp_max',
	),
)); 
?>
	<?php $this->endWidget(); ?>
<a class="gBoton" href="<?php echo Yii::app()->getBaseUrl(true).'/cepa?id='.$model->id_especie ;?>">Regresar</a>

