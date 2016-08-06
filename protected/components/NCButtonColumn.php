<?php

    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/plugins/ColorBox/jquery.colorbox.js');
    $cs->registerCssFile($baseUrl.'/js/plugins/ColorBox/colorbox.css');
//    $cs->registerScriptFile($baseUrl.'/js/delete.js');

class NCButtonColumn extends CButtonColumn
{

   // $baseUrl = Yii::app()->baseUrl;
    public $grid_name;
    public $grid_function = null;
    public $grid_message = null;
    public $grid_other_message = null;
    protected function initDefaultButtons()
    {

        $baseUrl = Yii::app()->baseUrl;
        if($this->viewButtonLabel===null)
            $this->viewButtonLabel=Yii::t('zii','Ver');
        if($this->updateButtonLabel===null)
            $this->updateButtonLabel=Yii::t('zii','Editar');
        if($this->deleteButtonLabel===null)
            $this->deleteButtonLabel=Yii::t('zii','Eliminar');
        if($this->viewButtonImageUrl===null)
            $this->viewButtonImageUrl=$baseUrl.'/images/ver.svg';
        if($this->updateButtonImageUrl===null)
            $this->updateButtonImageUrl=$baseUrl.'/images/editar.svg';
        if($this->deleteButtonImageUrl===null)
            $this->deleteButtonImageUrl=$baseUrl.'/images/borrar.svg';
        if($this->deleteConfirmation===null){
            $this->deleteConfirmation=Yii::t('zii','¿Seguro que desea borrar esta entrada?');
        }
        foreach(array('view','update','delete') as $id)
        {
            $button=array
            (
                'label'=>$this->{$id.'ButtonLabel'},
                'url'=>$this->{$id.'ButtonUrl'},
                'imageUrl'=>$this->{$id.'ButtonImageUrl'},
                'options'=>$this->{$id.'ButtonOptions'},
            );
            if(isset($this->buttons[$id]))
                $this->buttons[$id]=array_merge($button,$this->buttons[$id]);
            else
                $this->buttons[$id]=$button;
        }
        if(!isset($this->buttons['delete']['click']))
        {
            if(Yii::app()->request->enableCsrfValidation)
            {
                $csrfTokenName = Yii::app()->request->csrfTokenName;
                $csrfToken = Yii::app()->request->csrfToken;
                $csrf = "\n\t\tdata:{ '$csrfTokenName':'$csrfToken' },";
            }
            else
                $csrf = '';
            if(is_string($this->deleteConfirmation))
                if($this->afterDelete===null)
                    $this->afterDelete='function(){}';
            $this->buttons['delete']['click']=<<<EOD
            function(evt)
            {


                evt.preventDefault();
                var href = $(this).attr('href');
                var index1 = (href.lastIndexOf('/'))+1;
                var index2 = href.length;
                var id = href.substring(index1, index2);
                var miHtml = '';
                var header = $('.grid-view').attr('id');
                var nombre = $(this).parents('tr').eq(0).find('td').html();
                var mensaje = '¿Está seguro que desea eliminar este registro?';
                
                miHtml= miHtml +='<div class="sub-content">';
                miHtml= miHtml +='  <div class="title-content">Eliminar</div>';
                miHtml= miHtml +='      <div class="separator-content"></div>';
                miHtml= miHtml +='      <div class="mensaje-content">'+mensaje+'</div>';
                miHtml= miHtml +='      <div class="value-content">'+nombre+'</div>';
                
                miHtml= miHtml +='      <div class="botones-content">';
                miHtml= miHtml +='          <div class="aceptar-boton">Aceptar</div>';
                miHtml= miHtml +='          <div class="cancelar-boton">Cancelar</div>';
                miHtml= miHtml +='      </div>';
                miHtml= miHtml +='</div>';
                $.colorbox(
                {
                    html: miHtml,
                    width:'450px', 
                    height:'190px',
                    onComplete: function()
                    {
                        $('.cancelar-boton').click(function()
                        {
                            $('#cboxClose').click();
                        });
                        $('.aceptar-boton').click(function()
                        {
                            $.ajax(
                            {
                                type: 'GET',
                                url: href,
                                dataType: 'JSON', 
                                data:
                                {
                                    id: id
                                },
                                success: function(data)
                                {
                                    $.fn.yiiGridView.update(header);
                                    $('#cboxClose').click();
                                },
                                error: function(a, b, c)
                                {
                                  /* console.log(a, b, c);
                                   
                                    $.ajax(
                                    {
                                        type: 'GET',
                                        url: href,
                                        dataType: 'JSON', 
                                        data:
                                        {
                                            id: id
                                        },
                                        success: function(data)
                                        {
                                            $.fn.yiiGridView.update(header);
                                            $('#cboxClose').click();
                                        },
                                        error: function(a, b, c)
                                        {
                                            console.log(a, b, c);
                                        }
                                    });*/
                                }
                            });
                        });

                       
                      
                    }
                });
            }
EOD;
	}
    }
}?>
