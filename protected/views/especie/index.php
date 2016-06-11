<?php
/* @var $this EspecieController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Especies',
);

$this->menu=array(
	array('label'=>'Create Especie', 'url'=>array('create')),
	array('label'=>'Manage Especie', 'url'=>array('admin')),
);
?>

<h1>Especies</h1>

<?php $this->widget('zii.widgets.grid.CGridView', 
    array(
        'id'            => 'especieGrid',
        'dataProvider'  => $dataProvider,
        'summaryText'=>'',
        'columns'       => 
        array(
            'nombre'
        ),
        'pager'=>array(
            'header'         => '',
            'firstPageLabel' => 'primera página',
            'prevPageLabel'  => '&nbsp;',
            'nextPageLabel'  => '&nbsp;',
            'lastPageLabel'  => 'ultima página',
        ),
)); ?>
