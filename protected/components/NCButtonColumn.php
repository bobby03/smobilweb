<?php

//$jquery = new ScriptStyle();
//$jquery->AddScriptTrans('test/test.js');

class NCButtonColumn extends CButtonColumn
{
    public $grid_name;
    public $grid_function = null;
    public $grid_message = null;
    public $grid_other_message = null;
    protected function initDefaultButtons()
    {
        if($this->viewButtonLabel===null)
            $this->viewButtonLabel=Yii::t('zii','View');
        if($this->updateButtonLabel===null)
            $this->updateButtonLabel=Yii::t('zii','Update');
        if($this->deleteButtonLabel===null)
            $this->deleteButtonLabel=Yii::t('zii','Delete');
        if($this->viewButtonImageUrl===null)
            $this->viewButtonImageUrl=$this->grid->baseScriptUrl.'/view.png';
        if($this->updateButtonImageUrl===null)
            $this->updateButtonImageUrl=$this->grid->baseScriptUrl.'/update.png';
        if($this->deleteButtonImageUrl===null)
            $this->deleteButtonImageUrl=$this->grid->baseScriptUrl.'/delete.png';
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
        {
            if($this->grid_message===null)
                $this->grid_message = '¿Est&aacute; seguro que desea borrar este '.$this->grid_name.'?';
            var_dump($this->grid_name);
            ?>
            <script>
                $(document).ready(function()
                {
                    $('a.delete img').click(function(evt)
                    {
                        evt.preventDefault();
                        var miHtml = '';
                        var mensaje = 'hola: <?php echo $this->grid_message;?> ftht';
                        var firstTDValue = $(this).parents('tr').eq(0).find('td').html();
                        miHtml= '<div class="sub-content">\n\
                                <div class="title-content">Eliminar <?php echo $this->grid_name;?></div>\n\
                                <div class="value-content">'+firstTDValue+'</div>\n\
                                <div class="separator-content"></div>\n\
                                <div class="mensaje-content"></div>\n\
                                <div class="botones-content">\n\
                                    <div class="aceptar-boton"></div>\n\
                                    <div class="cancelar-boton"></div>\n\
                                </div>\n\
                        </div>';
                        $.colorbox(
                        {
                            html: miHtml,
                            onComplete: function()
                            {
                                $('.cancelar-boton').click(function()
                                {
                                    $('#cboxClose').click();
                                });
                            }
                        });
                    });
                });
            </script>
            <?php 
                if($this->afterDelete===null)
                    $this->afterDelete='function(){}';
            }
	}
    }
}?>
