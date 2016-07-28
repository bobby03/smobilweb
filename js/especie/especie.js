$(document).ready(function()
{
    $('div.agregar.especie').click(function(evt)
    {
       /* <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'especie-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>


    <?php //echo $form->errorSummary($model); ?>
<div class="form-containerWraper">
    <div class="form-cRight">
            <div class="row">
                <label class="letreros">Nueva Especie</label>
                    <div class="form-cLarge">
                        <?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>100));
                        echo $form->error($model,'nombre');
                         ?>
                    </div>
                </div>
    </div>
    <div class="form-cRight">
            <div class="containerbutton">
                <div class="row buttons">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Save'); ?>
                </div>
            </div>
    </div>
</div>
<?php $this->endWidget(); ?>*/





        evt.preventDefault();
        miHtml= '<div class="sub-content">\n\
                <div class="title-content">Agregar especie '+'</div>\n\
                <div class="esp">Especie</div>\n\
                <div class="separator-content"></div>\n\
                <input id="ingesp" class="ingesp" type="text">\n\
                <div class="botones-content">\n\
                    <div class="btnadd">Agregar</div>\n\
                </div>\n\
        </div>';
        $.colorbox(
        {
            html: miHtml,
            onComplete: function()
            {
                ;
                $('.btnadd').click(function()
                {
                    var Especie = document.getElementById('ingesp').value;
                    $.ajax(
                    {
                        type: 'POST',
                        url: '/especie/create',
                        dataType: 'JSON', 
                        data:
                        {
                            Especie: Especie
                        },
                        success: function(data)
                        {
                            //$('#cboxClose').click();
                            alert(hola);
                        },
                        error: function(a, b, c)
                        {
                            console.log('error');
                        }
                    });
                });
            }
        });
    });
});