<?php
/* @var $this CampSensadoController */
/* @var $model CampSensado */

$this->breadcrumbs=array(
	'Siembra'=>array('index'),
	'Nueva',
);
 $update = false
?>

<h1>Nueva siembra</h1>

<?php $this->renderPartial('_form', array(
		'model'=>$model, 
		'granjas' => $granjas,
		'personal' => $personal,
                'update' => $update,
                'tanques'   => null
		)); 
?>