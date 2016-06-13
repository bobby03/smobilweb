<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NCButtonColumn
 *
 * @author Israel
 */

//$jquery = new ScriptStyle();
//$jquery->AddScriptTrans('test/test.js');

class NCButtonColumn extends CButtonColumn{
        public $grid_name;
        public $grid_function = null;
        public $grid_message = null;
        public $grid_other_message = null;
    	/**
	 * Initializes the default buttons (view, update and delete).
	 */
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
			$this->deleteConfirmation=Yii::t('zii','Are you sure you want to delete this item?');
                }

		foreach(array('view','update','delete') as $id)
		{
			$button=array(
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
                    
			if(is_string($this->deleteConfirmation)){
                            
                            if($this->grid_message===null)
                                $this->grid_message = '¿Est&aacute; seguro que desea borrar este '.$this->grid_name.'?';
                                
                                if($this->grid_function===null){
                                    $confirmation="
                                        var miHtml;
                                        var firstTDValue = $(this).parents('tr').eq(0).find('td').html();

                                        if($('.alertMessage').length==0){
                                            $('.grid-view').append('".'<div class="alertMessage"></div>'."');
                                            miHtml = '';

                                            miHtml += '".'<div class="sub-content">'."';
                                                miHtml += '".'<div class="title-content">Eliminar '.$this->grid_name.'</div>'."';
                                                miHtml += '".'<div class="value-content">'."'+firstTDValue+'".'</div>'."';
                                                miHtml += '".'<div class="separator-content"></div>'."';
                                                miHtml += '".'<div class="mensaje-content">'.$this->grid_message.'</div>'."';
                                                miHtml += '".'<div class="botones-content">'."';
                                                    miHtml += '".'<div class="boton-content"><img src="images/iconos_alerta/aceptar_alerta.svg" class="aceptar-boton"></div>'."';
                                                    miHtml += '".'<div class="boton-content"><img src="images/iconos_alerta/cancelar_alerta.svg" class="cancelar-boton"></div>'."';
                                                miHtml += '".'</div>'."';
                                            miHtml += '".'</div>'."';

                                            $('.alertMessage').html(miHtml);
                                        }
                                        else{
                                            miHtml = '';
                                            miHtml += '".'<div class="sub-content">'."';
                                                miHtml += '".'<div class="title-content">Eliminar '.$this->grid_name.'</div>'."';
                                                miHtml += '".'<div class="value-content">'."'+firstTDValue+'".'</div>'."';
                                                miHtml += '".'<div class="separator-content"></div>'."';
                                                miHtml += '".'<div class="mensaje-content">'.$this->grid_message.'</div>'."';
                                                miHtml += '".'<div class="botones-content">'."';
                                                    miHtml += '".'<div class="boton-content"><img src="images/iconos_alerta/aceptar_alerta.svg" class="aceptar-boton"></div>'."';
                                                    miHtml += '".'<div class="boton-content"><img src="images/iconos_alerta/cancelar_alerta.svg" class="cancelar-boton"></div>'."';
                                                miHtml += '".'</div>'."';
                                            miHtml += '".'</div>'."';

                                            $('.alertMessage').html(miHtml);
                                        }

                                        $('.alertMessage').dialog({
                                            modal: true,
                                            width: 'auto',
                                            open: function(){
                                                var parent = $('.alertMessage.ui-dialog-content').parent('.ui-dialog');
                                                    parent.attr('id','alertMessage');

                                                $('.aceptar-boton').on('click',function(){                                                
                                                    jQuery('#{$this->grid->id}').yiiGridView('update', {
                                                            type: 'POST',
                                                            url: jQuery(th).attr('href'),$csrf
                                                            success: function(data) {
                                                                    jQuery('#{$this->grid->id}').yiiGridView('update');
                                                                    afterDelete(th, true, data);
                                                            },
                                                            error: function(XHR) {
                                                                    return afterDelete(th, false, XHR);
                                                            }
                                                    });
                                                    $('.alertMessage').dialog('close');
                                                    return false;                                                
                                                });

                                                $('.cancelar-boton').on('click',function(){
                                                    $('.alertMessage').dialog('close');
                                                    return false
                                                });
                                            },
                                            resizable: false,
                                        });

                                        $(window).resize(function(){
                                            $('.alertMessage').dialog('option','position',{ my: 'center', at: 'center', of: window });
                                        });
                                    ";
                                }
                                else{
                                    $confirmation="
                                        
                                    if(".$this->grid_function."){
                                        var miHtml;
                                        var firstTDValue = $(this).parents('tr').eq(0).find('td').html();

                                        if($('.alertMessage').length==0){
                                            $('.grid-view').append('".'<div class="alertMessage"></div>'."');
                                            miHtml = '';

                                            miHtml += '".'<div class="sub-content">'."';
                                                miHtml += '".'<div class="title-content">Eliminar '.$this->grid_name.'</div>'."';
                                                miHtml += '".'<div class="value-content">'."'+firstTDValue+'".'</div>'."';
                                                miHtml += '".'<div class="separator-content"></div>'."';
                                                miHtml += '".'<div class="mensaje-content">'.$this->grid_message.'</div>'."';
                                                miHtml += '".'<div class="botones-content">'."';
                                                    miHtml += '".'<div class="boton-content"><img src="images/iconos_alerta/aceptar_alerta.svg" class="aceptar-boton"></div>'."';
                                                    miHtml += '".'<div class="boton-content"><img src="images/iconos_alerta/cancelar_alerta.svg" class="cancelar-boton"></div>'."';
                                                miHtml += '".'</div>'."';
                                            miHtml += '".'</div>'."';

                                            $('.alertMessage').html(miHtml);
                                        }
                                        else{
                                            miHtml = '';
                                            miHtml += '".'<div class="sub-content">'."';
                                                miHtml += '".'<div class="title-content">Eliminar '.$this->grid_name.'</div>'."';
                                                miHtml += '".'<div class="value-content">'."'+firstTDValue+'".'</div>'."';
                                                miHtml += '".'<div class="separator-content"></div>'."';
                                                miHtml += '".'<div class="mensaje-content">'.$this->grid_message.'</div>'."';
                                                miHtml += '".'<div class="botones-content">'."';
                                                    miHtml += '".'<div class="boton-content"><img src="images/iconos_alerta/aceptar_alerta.svg" class="aceptar-boton"></div>'."';
                                                    miHtml += '".'<div class="boton-content"><img src="images/iconos_alerta/cancelar_alerta.svg" class="cancelar-boton"></div>'."';
                                                miHtml += '".'</div>'."';
                                            miHtml += '".'</div>'."';

                                            $('.alertMessage').html(miHtml);
                                        }

                                        $('.alertMessage').dialog({
                                            modal: true,
                                            width: 'auto',
                                            open: function(){
                                                var parent = $('.alertMessage.ui-dialog-content').parent('.ui-dialog');
                                                    parent.attr('id','alertMessage');

                                                $('.aceptar-boton').on('click',function(){                                                
                                                    jQuery('#{$this->grid->id}').yiiGridView('update', {
                                                            type: 'POST',
                                                            url: jQuery(th).attr('href'),$csrf
                                                            success: function(data) {
                                                                    jQuery('#{$this->grid->id}').yiiGridView('update');
                                                                    afterDelete(th, true, data);
                                                            },
                                                            error: function(XHR) {
                                                                    return afterDelete(th, false, XHR);
                                                            }
                                                    });
                                                    $('.alertMessage').dialog('close');
                                                    return false;                                                
                                                });

                                                $('.cancelar-boton').on('click',function(){
                                                    $('.alertMessage').dialog('close');
                                                    return false
                                                });
                                            },
                                            resizable: false,
                                        });

                                        $(window).resize(function(){
                                            $('.alertMessage').dialog('option','position',{ my: 'center', at: 'center', of: window });
                                        });
                                    }
                                    else{
                                        var miHtml;
                                        var firstTDValue = $(this).parents('tr').eq(0).find('td').html();

                                        $('.grid-view').append('".'<div class="alertMessage"></div>'."');
                                        miHtml = '';

                                        miHtml += '".'<div class="sub-content">'."';
                                            miHtml += '".'<div class="title-content">Eliminar '.$this->grid_name.'</div>'."';
                                            miHtml += '".'<div class="mensaje-content">'.$this->grid_other_message.'</div>'."';
                                            miHtml += '".'<div class="botones-content">'."';
                                                miHtml += '".'<div class="boton-content"><img src="images/iconos_alerta/cancelar_alerta.svg" class="cancelar-boton"></div>'."';
                                            miHtml += '".'</div>'."';
                                        miHtml += '".'</div>'."';

                                        $('.alertMessage').html(miHtml);

                                        $('.alertMessage').dialog({
                                            modal: true,
                                            width: 'auto',
                                            open: function(){
                                                var parent = $('.alertMessage.ui-dialog-content').parent('.ui-dialog');
                                                    parent.attr('id','alertMessage');

                                                $('.cancelar-boton').on('click',function(){
                                                    $('.alertMessage').dialog('close');
                                                    return false
                                                });
                                            },
                                            resizable: false,
                                        });

                                        $(window).resize(function(){
                                            $('.alertMessage').dialog('option','position',{ my: 'center', at: 'center', of: window });
                                        });
                                    }
                                    ";
                                }
                        }
			else{
				$confirmation='';
                        }

			if($this->afterDelete===null)
				$this->afterDelete='function(){}';

			$this->buttons['delete']['click']=<<<EOD
function(e) {
        e.preventDefault();
	var th = this,
		afterDelete = $this->afterDelete;
                                
        $confirmation
}
EOD;
		}
	}
}

?>
