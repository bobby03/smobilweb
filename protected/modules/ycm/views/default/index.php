<?php
/* @var $this DefaultController */
/* @var $models array */

    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCoreScript('jquery');
    $cs->registerCssFile($baseUrl.'/css/ycm/index.css');
    $this->pageTitle=Yii::t('YcmModule.ycm','Administración');
	
	$arrAdministrador = array();
	$addHtml = '<div style="top: -28px; right: -13px; display: block;" class="tooltip fade top in hide">
				<div class="tooltip-arrow"></div>
				<div class="tooltip-inner">Nuevo</div>
			</div>';
	$editHtml = '<div style="top: -28px; right: -13px; display: block;" class="tooltip fade top in hide">
				<div class="tooltip-arrow"></div>
				<div class="tooltip-inner">Editar</div>
			</div>';
	$listHtml = '<div style="top: -28px; right: -18px; display: block;" class="tooltip fade top in hide">
				<div class="tooltip-arrow"></div>
				<div class="tooltip-inner">Ver lista</div>
			</div>';
	
	$this->beginWidget('bootstrap.widgets.TbHeroUnit');
		foreach ($models as $model): 
			if($this->module->getAdminName($model) != 'ContactForm' && $this->module->getAdminName($model) != 'LoginForm' ):
?>
				<?php
				$buttons=array();
				$download=false;
				$downloadItems=array();
				$buttonsLabel = '';	
				
				array_push($buttons,array(
					'type'=>'primary',
					'label'=>$this->module->getAdminName($model),
					'url'=>$this->createUrl('model/list',array('name'=>$model)),
				));
				if ($this->module->getHideCreate($model) === false) {
					array_push($buttons,array(
						'buttonType'=>'buttonManual',
						'label'=>Yii::t('YcmModule.ycm','<span class="icon-plus"></span>'.$addHtml),
						'url'=>$this->createUrl('model/create',array('name'=>$model)),
					));
				}
				if ($this->module->getHideUpdate($model) === false) {
					array_push($buttons,array(
						'buttonType'=>'buttonManual',
						'label'=>Yii::t('YcmModule.ycm','<span class="icon-pencil"></span>'.$editHtml),
						'url'=>$this->createUrl('model/update',array('name'=>$model,'pk'=>'1')),
					));
				}
				if ($this->module->getHideList($model) === false) {
					array_push($buttons,array(
							'buttonType'=>'buttonManual',
							'label'=>Yii::t('YcmModule.ycm','<span class="icon-list-alt"></span>'.$listHtml),
							'url'=>$this->createUrl('model/list',array('name'=>$model)),
					));
				}

				if ($this->module->getDownloadExcel($model)) {
					$download=true;
					array_push($downloadItems,array(
						'label'=>Yii::t('YcmModule.ycm','Excel'),
						'url'=>$this->createUrl('model/excel',array('name'=>$model)),
					));
				}
				if ($this->module->getDownloadMsCsv($model)) {
					$download=true;
					array_push($downloadItems,array(
						'label'=>Yii::t('YcmModule.ycm','MS CSV'),
						'url'=>$this->createUrl('model/mscsv',array('name'=>$model)),
					));
				}
				if ($this->module->getDownloadCsv($model)) {
					$download=true;
					array_push($downloadItems,array(
						'label'=>Yii::t('YcmModule.ycm','CSV'),
						'url'=>$this->createUrl('model/csv',array('name'=>$model)),
					));
				}

				if ($download) {
					$this->widget('bootstrap.widgets.TbButtonGroup',array(
						'type'=>'',
						'buttons'=>array(
							array('label'=>Yii::t('YcmModule.ycm',
								'Download {name}',
								array('{name}'=>$this->module->getPluralName($model))
							)),
							array('items'=>$downloadItems),
						),
					));
				}
				$modelObject = new $model;
				$arrAdministrador[$modelObject->getModelName()]['buttons'][] = $buttons;
				?>
		<?php endif;?>
		<?php endforeach; ?>
<div class ="principal">
    <div class="cabezera"><p class="subtitulo">Administrador de contenido</p></div>
	<?php if($_SESSION['usuario'] == 'admin'):?>
		<?php if(isset($arrAdministrador['general'])):?>
                    <div class="secciones">
                        <div class="titulo">General</div>
                        <?php foreach($arrAdministrador['general']['buttons'] as $key=>$seccionAdmin)
                        {
                            $this->widget('bootstrap.widgets.TbButtonGroup',array(
                                    'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                                    'buttons'=>$seccionAdmin,
                            ));
                        }
                        ?>
                    </div>
		<?php endif;?>
                <?php endif;?>
	<?php if($_SESSION['usuario'] == 'admin'):?>
		<?php if(isset($arrAdministrador['nosotros'])):?>
		<div class="secciones">
			<div class="titulo">Nosotros</div>
			<?php foreach($arrAdministrador['nosotros']['buttons'] as $key=>$seccionAdmin)
			{
				if($seccionAdmin[0]['label'] == 'Quiénes somos') 
								$seccionAdmin[0]['url'] = $baseUrl . '/index.php/ycm/model/update/name/GeoAboutUs/pk/1';
				$this->widget('bootstrap.widgets.TbButtonGroup',array(
					'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
					'buttons'=>$seccionAdmin,
				));
			}
			?>

		</div>
		<?php endif;?>
	<?php endif;?>
    <?php if(isset($arrAdministrador['proyectos'])):?>
    <div class="secciones">
        <div class="titulo">Proyectos</div>
        <?php foreach($arrAdministrador['proyectos']['buttons'] as $key=>$seccionAdmin) {
			if($_SESSION["usuario"]!== 'admin') 
			{
				if($seccionAdmin[0]["label"] == 'Proyectos de investigación') 
				{
					$this->widget('bootstrap.widgets.TbButtonGroup',
							array
							(
								'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
								'buttons'=>$seccionAdmin,
							));
				}
			}
			else {
				$this->widget('bootstrap.widgets.TbButtonGroup',array(
						'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
						'buttons'=>$seccionAdmin,
				));
			}
//			$this->widget('bootstrap.widgets.TbButtonGroup',array(
//					'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
//					'buttons'=>$seccionAdmin,
//			));
		}
        ?>
      
    </div>
    <?php endif;?>
	<?php if($_SESSION["usuario"] == 'admin') : ?>
    <?php if(isset($arrAdministrador['laboratorios'])):?>
    <div class="secciones">
        <div class="titulo">Laboratorios</div>
        <?php foreach($arrAdministrador['laboratorios']['buttons'] as $key=>$seccionAdmin) 
            {
            $this->widget('bootstrap.widgets.TbButtonGroup',array(
                    'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'buttons'=>$seccionAdmin,
            ));
        }
        ?>
    </div>
    <?php endif;?>
    <?php endif;?>
	<?php if($_SESSION["usuario"] == 'admin') : ?>
    <?php if(isset($arrAdministrador['educacion'])):?>
    <div class="secciones">
        <div class="titulo">Educación</div>
        <?php foreach($arrAdministrador['educacion']['buttons'] as $key=>$seccionAdmin)
        {
            $this->widget('bootstrap.widgets.TbButtonGroup',array(
                    'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'buttons'=>$seccionAdmin,
            ));
        }
        ?>
       
    </div>
    <?php endif;?>
    <?php endif;?>
	<?php if($_SESSION["usuario"] == 'admin') : ?>
    <?php if(isset($arrAdministrador['difusion'])):?>
    <div class="secciones">
			<div class="titulo">Difusión</div>
			<?php foreach($arrAdministrador['difusion']['buttons'] as $key=>$seccionAdmin)
			{
				$this->widget('bootstrap.widgets.TbButtonGroup',array(
						'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
						'buttons'=>$seccionAdmin,
				));
			}
			?>

		</div>
    
    <?php if($_SESSION["usuario"] == 'admin') : ?>
    <?php if(isset($arrAdministrador['informacion'])):?>
    <div class="secciones">
        <div class="titulo">Información</div>
        <?php foreach($arrAdministrador['informacion']['buttons'] as $key=>$seccionAdmin)
        {
            if($seccionAdmin[0]['label'] == 'Contacto') {
                                $seccionAdmin[0]['url'] = $baseUrl . '/index.php/ycm/model/update/name/GeoContact/pk/1';
                            }
            $this->widget('bootstrap.widgets.TbButtonGroup',array(
                    'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'buttons'=>$seccionAdmin,
            ));
        }
        ?>
        
    </div>
    <?php endif;?>
    <?php endif;?>
    <?php endif;?>
    <?php endif;?>
	
</div>
<?php $this->endWidget(); ?>