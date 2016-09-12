<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/especie/especie.css');
    $cs->registerScriptFile($baseUrl.'/js/search.js');
    $cs->registerScriptFile($baseUrl.'/js/changeTab.js');
    $cs->registerScriptFile($baseUrl.'/js/especie/search.js');
    $cs->registerScriptFile($baseUrl.'/js/especie/especie.js');
    $cs->registerScriptFile($baseUrl.'/js/changeTab.js');


    $this->breadcrumbs=array(
	'Especies',
    )
?>
<?php 
    $function = <<<EOF
        function(id,data)
        {
            function UpperCaseInput()
            {
                  $('#ingesp').bind('keyup',function(){ 
                    var node = $(this);
                    node.val(node.val().replace(/^\s+[a-zA-záéíóúñÁÉÍÓÚÑ ]/g,'') ); 
                    node.val(capitalizeFirstLetter(node.val()));
                });
            }
            $.fn.yiiGridView.update('especies-grid2');
            $('a.update img').click(function(evt)
            {
                evt.preventDefault();
                var href = window.location.href;
                var hrefId = $(this).parent().attr('href');
                var urlSplit = hrefId.split( '/' );
                var id = urlSplit[ urlSplit.length - 1 ]; 
                var miHtml = '';
                var nombre = $(this).parents('tr').eq(0).find('td').html();
                miHtml = miHtml+'<div class="sub-content">';
                miHtml = miHtml+'<div class="title-content">Editar especie '+'</div>';
                miHtml = miHtml+'<div class="esp">Especie</div>';
                miHtml = miHtml+'<div class="separator-content"></div>';
                miHtml = miHtml+'<input name="ingesp" id="ingesp" value="'+nombre+'" class="ingesp" type="text">';
                miHtml = miHtml+'<p id="ierror"></p>';
                miHtml = miHtml+'<div class="botones-content">';
                miHtml = miHtml+'<a class="gBoton" href="">Cancelar</a>';
                miHtml = miHtml+'<div class="btnadd btnUpdate">Aceptar</div>';
                miHtml = miHtml+'</div>';
                miHtml = miHtml+'</div>';
                $.colorbox(
                {
                    html: miHtml,
                    width:'400px', 
                    height:'200px',
                    onComplete: function()
                    {        
                        UpperCaseInput();
                        $('.btnUpdate').click(function()
                        {
                            var nombre=$('#ingesp').val();
                            r = validField(nombre, mCallback);
                            if(r == 1)
                            {
                                $.colorbox.resize();
                            }
                            else
                            {
                                var val = $('#ingesp').val();
                                $('#ingesp').val(val);
                                var especie = $('#ingesp').val();
                                $.ajax(
                                {
                                    type: 'POST',
                                    url: href+'/Update1',
                                    dataType: 'JSON', 
                                    data:
                                    {
                                        id:id,
                                        especie: especie
                                    },
                                    success: function(dataR)
                                    {
                                       $.colorbox.close();
                                       window.location = "especie";
                                    },
                                    error: function(a, b, c)
                                    {

                                    }
                                });
                            }
                        });
                    }
                });
            });
        }
EOF;
?>

<h1>Especies</h1>
<div class="principal">
    <div class="tabs">
        <div class="tab select" data-id="1"><span>Activos</span></div>
        <div class="tab" data-id="2"><span>Inactivos</span></div>
    </div>
    <div class="tabContent" data-tan="1">
        <div class="search-form" ><!-- search-form -->
            <?php $this->renderPartial('_search',array(
                    'model'=>$model,
            )); ?>
            <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/especie/create">
                <div class="agregar especie"></div>
            </a>
        </div><!-- search-form -->
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'especies-grid',
            'htmlOptions'=>array('class'=>'si-busqueda grid-view'),
            'dataProvider'=>$model->search(1),
            'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
            'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
            'emptyText'=>"No hay registros",
            'template' => "{items}{summary}{pager}",
            'columns'=>$model->adminSearch(),
            'afterAjaxUpdate' => $function
        )); ?>
    </div>



    <!--Inactivos-->
    <div class="tabContent hide" data-tan="2"> 
        <div class="search-form2" ><!-- search-form -->
            <?php $this->renderPartial('_search',array(
                    'model'=>$model,
            )); ?>
            
        </div><!-- search-form -->
        <?php $this->widget('zii.widgets.grid.CGridView', array
        (
            'id'=>'especies-grid2',
            'dataProvider'=>$model->search(0),
            'ajaxUpdate'=>true,
            'pager' => array
            (
                'class' => 'PagerSA',
                'header'=>'',
            ),
            'summaryText'=> 'Mostrando registros del {start} al {end} de un total de {count} registros.',
            'emptyText'=>"No hay registros",
            'template' => "{items}{summary}{pager}",
            'columns'=>$model->adminSearchBorrados(),
        )); ?>
    </div>
</div>