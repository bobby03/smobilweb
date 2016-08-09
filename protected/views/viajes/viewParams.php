
<div class="alertas vParams">
	<div class="tituloAlerta">Alertas'</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array
    (
        'id'=>'alertaGrid',
        'dataProvider'=>$model->search(),
        'summaryText'=> 'Alertas del {start} al {end} de un total de {count} registros.',
        'template' => "{items}{summary}{pager}",
        'columns'=>$model->adminSearch(),
        'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
    )) ;
?>
</div>
