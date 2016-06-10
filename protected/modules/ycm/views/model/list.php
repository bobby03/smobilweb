<?php
/* @var $this ModelController */
/* @var $title string */
/* @var $model object */
/* @var $data array */

$this->pageTitle=$title;
?>
<?php

?>

<div class="btn-toolbar">
	<?php
	if ($this->module->getHideCreate($model) === false) {
		$this->widget('bootstrap.widgets.TbButtonGroup',array(
			'type'=>'',
			'buttons'=>array(
				array(
					'type'=>'primary',
					'label'=>Yii::t('YcmModule.ycm',
						'Agregar {name}',
						array('{name}'=>$this->module->getSingularName($model))
					),
					'url'=>$this->createUrl('model/create',array('name'=>get_class($model))),
				),
			),
		));
	}
        if(get_class($model)==='GeoGeotermia')
{
    $this->widget('bootstrap.widgets.TbButtonGroup',array(
			'type'=>'',
			'buttons'=>array(
				array(
					'type'=>'primary',
					'label'=>Yii::t('YcmModule.ycm',
						'{name}',
						array('{name}'=>$this->module->getSingularName('GeoCategoria'))
					),
					'url'=>$this->createUrl('model/list',array('name'=>'GeoCategoria')),
				),
			),
		));
}
	if(get_class($model)==='GeoNoticia')
	{
		$this->widget('bootstrap.widgets.TbButtonGroup',array(
			'type'=>'',
			'buttons'=>array(
				array(
					'type'=>'primary',
					'label'=>Yii::t('YcmModule.ycm',
						'Agregar {name}',
						array('{name}'=>$this->module->getSingularName('GeoNewsGallery'))
					),
					'url'=>$this->createUrl('model/list',array('name'=>'GeoNewsGallery')),
				),
			),
		));
		$this->widget('bootstrap.widgets.TbButtonGroup',array(
			'type'=>'',
			'buttons'=>array(
				array(
					'type'=>'primary',
					'label'=>Yii::t('YcmModule.ycm',
						'Agregar {name}',
						array('{name}'=>$this->module->getSingularName('GeoNewsVideos'))
					),
					'url'=>$this->createUrl('model/list',array('name'=>'GeoNewsVideos')),
				),
			),
		));
	}
//	if(get_class($model)==='GeoLabView')
//	{
//		$this->widget('bootstrap.widgets.TbButtonGroup',array(
//			'type'=>'',
//			'buttons'=>array(
//				array(
//					'type'=>'primary',
//					'label'=>Yii::t('YcmModule.ycm',
//						'Agregar {name}',
//						array('{name}'=>$this->module->getSingularName('GeoUnidadGallery'))
//					),
//					'url'=>$this->createUrl('model/list',array('name'=>'GeoUnidadGallery')),
//				),
//			),
//		));
//	}
	
	?>
</div>
<?php 
$this->widget('bootstrap.widgets.TbGridView',$data); ?>
