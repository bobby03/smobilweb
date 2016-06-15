<?php

    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/plugins/ColorBox/jquery.colorbox.js');
    $cs->registerCssFile($baseUrl.'/js/plugins/ColorBox/colorbox.css');
    $cs->registerScriptFile($baseUrl.'/js/delete.js');;

class NCButtonColumn extends CButtonColumn
{
    public $grid_name;
    public $grid_function = null;
    public $grid_message = null;
    public $grid_other_message = null;
    protected function initDefaultButtons()
    {
        if($this->viewButtonLabel===null)
            $this->viewButtonLabel=Yii::t('zii','Ver');
        if($this->updateButtonLabel===null)
            $this->updateButtonLabel=Yii::t('zii','Editar');
        if($this->deleteButtonLabel===null)
            $this->deleteButtonLabel=Yii::t('zii','Eliminar');
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
            if($this->afterDelete===null)
                $this->afterDelete='function(){}';
	}
    }
}?>
