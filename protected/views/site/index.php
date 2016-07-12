<?php
/* @var $this SiteController */
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/dashboard.css');
    $this->pageTitle=Yii::app()->name;
?>
<div class="principal">
    <div class="tabs">
        <div data-id="1">Viajes</div>
        <div data-id="2">Estaciones</div>
    </div>
    
</div>