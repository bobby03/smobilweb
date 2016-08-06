<?php
/* @var $this CepaController */
/* @var $model Cepa */
/* @var $form CActiveForm */

 $baseUrl = Yii::app()->baseUrl;

$this->breadcrumbs=array(
	'Cepas'=>array('index'),
	$model->id,
);


    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/cepa/create.css?='.rand());

	$form=$this->beginWidget('CActiveForm', array(
	'id'=>'cepa-form',
));


?>

<h1>Ver Cepa <?php echo $model->nombre_cepa; ?></h1>

<div class="form cepa view-cepa">

	<div class="form-containerWraper">
			<span class="containerBox">


			 	<div class="form-container1">
			 	<!--NCEPA --> 
				        <div class="row">
							<label class= "letreros">Nombre de Cepa</label>
								<div class="form-cLarge">
								<?php 
								echo $form->textField($model,'nombre_cepa',array('size'=>50,'maxlength'=>50,'disabled'=>'true'));
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
									
								</div>
						</div>
					</div>
			</span>


			<!--separador-->		
			<span class="containerBox">
					<label class="cLetreros">Rangos minimos y maximos</label>
					<hr class="letrero-container"></hr>
			</span>


			<!--Temperatura-->
			<span class="containerBox">
				<div class="containertBoxLeft">
					<div class="form-container11">
						<div class="row">
							<label class= "letreros">Temperatura</label>
								<div class="form-cSmall">
	                                 <span>min</span>
									<?php 
									echo $form->numberField($model,'temp_min',array('disabled'=>'true'));
									 ?>
								</div>
						</div>
					</div>
					<div class="form-container12">
						<div class="row">
							<div class="form-cSmall">
	                            <span>max</span>
						    	<?php 
						    	echo $form->numberField($model,'temp_max',array('disabled'=>'true'));?>
							</div>
						</div>
					</div>

			<!--Ph-->
					<div class="form-container11">
						<div class="row">
							<label class= "letreros">pH</label>
								<div class="form-cSmall">
	                                <span>min</span>
									<?php echo $form->numberField($model,'ph_min',array('disabled'=>'true'));?>
								</div>
						</div>
					</div>
					<div class="form-container12">
						<div class="row">
							<div class="form-cSmall">
	                             <span>max</span>
								<?php echo $form->numberField($model,'ph_max',array('disabled'=>'true')); ?>
							</div>
						</div>
					</div>
				<!--Oxigeno-->
					<div class="form-container11">
						<div class="row">
							<label class= "letreros">Oxigeno</label>
								<div class="form-cSmall">
	                                <span>min</span>
									<?php echo $form->numberField($model,'ox_min',array('disabled'=>'true'));?>
								</div>
						</div>
					</div>
					<div class="form-container12">
						<div class="row">
							<div class="form-cSmall">
	                            <span>max</span>
								<?php echo $form->numberField($model,'ox_max',array('disabled'=>'true')); ?>
							</div>
						</div>
					</div>
				</div>


				<!--Conductividad-->   
				<div class="containerBoxRight">
						<div class="form-container11">
							<div class="row">
								<label class= "letreros">Conductividad</label>
									<div class="form-cSmall">	
	                                    <span>min</span>
										<?php echo $form->numberField($model,'cond_min',array('disabled'=>'true'));?>
									</div>
							</div>
						</div>
						<div class="form-container12">
							<div class="row">
								<div class="form-cSmall">
	                                 <span>max</span>
									<?php echo $form->numberField($model,'cond_max',array('disabled'=>'true')); ?>
								</div>
							</div>
						</div>

				<!-- ORP-->
					<div class="form-container11">
						<div class="row">
							<label class= "letreros">ORP</label>
								<div class="form-cSmall">
	                                <span>min</span>
									<?php echo $form->numberField($model,'orp_min',array('disabled'=>'true')); ?>
								</div>	
						</div>
					</div>
					<div class="form-container12">
						<div class="row">
							<div class="form-cSmall">
	                                <span>max</span>
									<?php echo $form->numberField($model,'orp_max',array('disabled'=>'true')); ?>
							</div>
						</div>
					</div>
						<div class="row buttons">
							<a class="gBoton" href="javascript:history.go(-1);">Regresar</a> 
						</div>
				</div>
	  		</span>
	</div>
	<?php $this->endWidget(); ?>
</div>
