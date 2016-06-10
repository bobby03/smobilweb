<?php
/* @var $this ModelController */
/* @var $title string */
/* @var $model object */
/* @var $form TbActiveForm */

$model->css();
$model->js();

$this->pageTitle=$title;
//var_dump($_SESSION['post']);
//echo '<br><br>';
//var_dump($_SESSION['paths']);
//echo '<br><br>';
//var_dump($_SESSION['prueba']);
$attributes=array();
foreach ($model->attributeLabels() as $attribute=>$label) {
	if (isset($model->tableSchema->columns[$attribute]) && $model->tableSchema->columns[$attribute]->isPrimaryKey===true) {
		continue;
	}
	$attributes[]=$attribute;
}
$attributes=array_filter(array_unique(array_map('trim',$attributes)));
?>
<?php if(get_class($model) === 'GeoAboutUs'):?>
	<?php if($update === true) :?>
		<div class ="button-gallery">
			<?php
				//$_SESSION['id_project'] = $model->id;
				$this->widget('bootstrap.widgets.TbButtonGroup',array(
					'type'=>'info',
					'buttons'=>array(
						array(
							'type'=>'info',
							'label'=>Yii::t('YcmModule.ycm',
								'Agregar {name}',
								array('{name}'=>$this->module->getSingularName('GeoAboutUsGallery'))
							),
							'url'=>$this->createUrl('model/list',array('name'=>'GeoAboutUsGallery')),
						),
					),
				));
			?>
		</div>
	<?php endif?>
<?php endif; ?>

<div class="row-fluid">
	<div class="span10">
		<div class="required-message">Los campos con <span class="required">*</span> son obligatorios.</div>
		<?php
		$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
			'id'=>get_class($model).'-id-form',
			'type'=>'horizontal',
			'inlineErrors'=>false,
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),
		));
		echo $form->errorSummary($model);
		foreach ($attributes as $attribute) {
			
			$this->module->createWidget($form,$model,$attribute,$model->extraOptions(),$model->extraHtml());
		}
		?>
		<div class="form-actions">
			<?php
			if (($this->module->getHideCreate($model) === true && Yii::app()->controller->action->id == 'create') ||
				($this->module->getHideUpdateAdmin($model) === true && Yii::app()->controller->action->id == 'update')) {
				$buttons=array();
			} else {
				if(get_class($model) === 'GeoAboutUsGallery') {
					$buttons=array(
						array(
							'buttonType'=>'submit',
							'type'=>'primary',
							'label'=>Yii::t('YcmModule.ycm','Guardar'),
							'htmlOptions'=>array('name'=>'_save')
						),
	//					array(
	//						'buttonType'=>'submit',
	//						'label'=>Yii::t('YcmModule.ycm','Guardar y continuar editando'),
	//						'htmlOptions'=>array('name'=>'_continue')
	//					),
					);
				}
				else {
					$buttons=array(
						array(
							'buttonType'=>'submit',
							'type'=>'primary',
							'label'=>Yii::t('YcmModule.ycm','Guardar'),
							'htmlOptions'=>array('name'=>'_save')
						),
						array(
							'buttonType'=>'submit',
							'label'=>Yii::t('YcmModule.ycm','Guardar y continuar editando'),
							'htmlOptions'=>array('name'=>'_continue')
						),
					);
					
				}
			}
            if(get_class($model) === "GeoProjectsGallery" || get_class($model) === 'GeoCursosMaterials' || get_class($model)=== 'GeoCoursesGallery'  || get_class($model)=== 'GeoAboutUsGallery' || get_class($model)=== 'GeoUnidadGallery' || get_class($model)=== 'GeoNewGallery' || get_class($model)=== 'GeoNewsGallery' || get_class($model)=== 'GeoNewsVideos') {
					array_push($buttons, array(
							'buttonType'=>'submit',
							'label'=>Yii::t('YcmModule.ycm','Guardar y agregar otro'),
							'htmlOptions'=>array('name'=>'_addanother')
					));
					/*array(
						'buttonType'=>'submit',
						'label'=>Yii::t('YcmModule.ycm','Save and add another'),
						'htmlOptions'=>array('name'=>'_addanother')
					),*/
			}        
                        /* OPCION DE CANCELAR */
                        array_push($buttons,array(
                                'buttonType'=>'link',
                                'type'=>'danger',
                                'url'=>Yii::app()->baseUrl.'/index.php/ycm/model/list/name/'.get_class($model),
                                /*'label'=>Yii::t('YcmModule.ycm','Delete'),*/
                                'label'=>Yii::t('YcmModule.ycm','Cancelar'),
                        ));

			/*if (!$model->isNewRecord && $this->module->getHideDelete($model) === false) {
                            
				array_push($buttons,array(
					'buttonType'=>'link',
					'type'=>'danger',
					'url'=>'#',
					'label'=>Yii::t('YcmModule.ycm','Delete'),
					'htmlOptions'=>array(
						'submit'=>array(
							'model/delete',
							'name'=>get_class($model),
							'pk'=>$model->primaryKey,
						),
						'confirm'=>Yii::t('YcmModule.ycm','Are you sure you want to delete this item?'),
					)
				));
			}*/

			$this->widget('bootstrap.widgets.TbButtonGroup',array(
				'type'=>'',
				'buttons'=>$buttons,
			));
			?>
		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>