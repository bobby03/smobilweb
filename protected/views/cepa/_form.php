<?php
/* @var $this CepaController */
/* @var $model Cepa */
/* @var $form CActiveForm */
 $baseUrl = Yii::app()->baseUrl;
?>

<div class="form cepa">
    <?php 
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($baseUrl.'/css/cepa/create.css');
        $form=$this->beginWidget('CActiveForm', array(
            'id'=>'cepa-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation'=>false,
            'clientOptions' => array(
                'validateOnSubmit' => true,
    //            'validateOnChange' => true,
    //            'validateOnType' => true,
            ),
    )); ?>
    <div class="form-containerWraper">
        <span class="containerBox">
            <div class="form-container1">
    <!--NCEPA --> 
                <div class="row">
                    <label class= "letreros">Nombre de Cepa</label>
                    <div class="form-cLarge">
                        <?php 
                            echo $form->textField($model,'nombre_cepa',array('size'=>50,'maxlength'=>50));
                            echo $form->error($model,'nombre_cepa');
                        ?>
                    </div>
                </div>
            </div>
    <!--Especie-->  
            <div class="form-container1 last">
                <div class="row">
                    <label class= "letreros">Especie</label>
                    <div class="form-cLarge">
                        <span class="css-select-moz"><?php echo $form->dropDownList($model,'id_especie', Especie::model()->getAllEspecies(),array('empty'=>'Seleccionar', 'class'=>'css-select','disabled'=>'disabled')); ?></span>
                        <?php echo $form->error($model,'id_especie'); ?>
                    </div>
                </div>
            </div>
        </span>
    <!--separador-->		
        <span class="containerBox rangosCepa">
            <label class="cLetreros">Rangos m&iacute;nimos y m&aacute;ximos</label>
            <hr class="letrero-container"></hr>
        </span>
    <!--Temperatura-->
        <span class="containerBox">
            <div class="containertBoxLeft">
                <div class="row">
                    <div class="form-container11">
                        <div class="row">
                            <label class= "letreros">Temperatura</label>
                            <div class="form-cSmall">
                                <span>min</span>
                                <?php 
                                    echo $form->numberField($model,'temp_min', array('step'=>'any'));
                                    echo $form->error($model,'temp_min');
                                 ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-container12">
                        <div class="row">
                            <div class="form-cSmall">
                                <span>max</span>
                                <?php 
                                    echo $form->numberField($model,'temp_max', array('step'=>'any'));
                                    echo $form->error($model,'temp_max');
                                 ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Ph-->
                <div class="row">
                    <div class="form-container11">
                        <div class="row">
                            <label class= "letreros">pH</label>
                            <div class="form-cSmall">
                                <span>min</span>
                                <?php echo $form->numberField($model,'ph_min', array('step'=>'any'));
                                echo $form->error($model,'ph_min'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-container12">
                        <div class="row">
                            <div class="form-cSmall">
                                <span>max</span>
                                <?php echo $form->numberField($model,'ph_max', array('step'=>'any'));
                                echo $form->error($model,'ph_max'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Oxigeno-->
                <div class="row">
                    <div class="form-container11">
                        <div class="row">
                            <label class= "letreros">Ox&iacute;geno</label>
                            <div class="form-cSmall"><span>min</span>
                                <?php echo $form->numberField($model,'ox_min', array('step'=>'any'));
                                echo $form->error($model,'ox_min'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-container12">
                        <div class="row">
                            <div class="form-cSmall"><span>max</span>
                                <?php echo $form->numberField($model,'ox_max', array('step'=>'any'));
                                echo $form->error($model,'ox_max'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Conductividad-->   
            <div class="containerBoxRight">
                <div class="row">
                    <div class="form-container11">
                        <div class="row">
                            <label class= "letreros">Conductividad</label>
                            <div class="form-cSmall">	
                                <span>min</span>
                                <?php echo $form->numberField($model,'cond_min', array('step'=>'any'));
                                echo $form->error($model,'cond_min'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-container12">
                        <div class="row">
                            <div class="form-cSmall">
                                <span>max</span>
                                <?php echo $form->numberField($model,'cond_max', array('step'=>'any'));
                                echo $form->error($model,'cond_max'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ORP-->
                <div class="row">
                    <div class="form-container11">
                        <div class="row">
                            <label class= "letreros">ORP</label>
                            <div class="form-cSmall">
                                <span>min</span>
                                <?php echo $form->numberField($model,'orp_min', array('step'=>'any'));
                                echo $form->error($model,'orp_min'); ?>

                            </div>	
                        </div>
                    </div>
                    <div class="form-container12">
                        <div class="row">
                            <div class="form-cSmall">
                                <span>max</span>
                                <?php echo $form->numberField($model,'orp_max', array('step'=>'any'));
                                echo $form->error($model,'orp_max'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row buttons">
                    <div class='btnsCepa'>
                        <a class="gBoton regresarCepa" href="<?php echo Yii::app()->getBaseUrl(true)."/cepa?id=".$model->id_especie?>">Cancelar</a> 
                        <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar'); ?>
                    </div>
                </div>
            </div>
        </span>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->