<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MGActiveRecord
 *
 * @author Bob
 */
class SMAßctiveRecord extends CActiveRecord {
	
	public $textAlert = '';
	/**
	 * Esta funcion regresa el nombre del modelo tal cual se busca, por
	 * default regresa el nombre de la clase.
	 * @return string
	 */
	public function getModelName()
	{
		return __CLASS__;
	}
	
	/**
	 * Esta funcion regresa una variable extraOptions que sustituira a la variable
	 * options original
	 * @return string
	 */
	public function extraOptions() {
		return '';		 
	}

	/**
	 * Esta funcion carga los archivos .js en el formulario ycm
	 * @return string
	 */
	public function js() {
		return '';
	}

	/**
	 * Esta funcion carga los archivos .css en el formulario ycm
	 * @return string
	 */
	public function css() {
		return '';
	}

	/**
	 * Esta funcion anexa codigo de html en el formulario ycm
	 * @return string
	 */
	public function extraHtml() {
		return '';
	}
	/**
	 * Esta funcion anexa codigo de php en el formulario ycm
	 * @return string
	 */
	public function extraPhpBeforeSaveValidate($model='',$post='',$paths='',$module='') {
		return '';
	}
	/**
	 * Esta funcion anexa codigo de php en el formulario ycm
	 * @return string
	 */
	public function extraPhpAfterSaveValidate($model='',$post='',$paths='',$module='') {
//		if(isset($post['eliminate_image'])) {
//			foreach($post['eliminate_image'] as $attribute=>$eliminate) {
//				if($eliminate && $model->$attribute != '') {
//					$path = $module->getAttributePath(__CLASS__,$attribute).DIRECTORY_SEPARATOR.$model->$attribute;
//					$pExtension = pathinfo($path, PATHINFO_EXTENSION);
//					if($pExtension == 'jpg') {
//						if(file_exists($path)) {
//							@unlink($path);
//						}
//						else {
//							$path = str_replace("jpg", "jpeg", $path);
//							@unlink($path);
//						}
//					}
//					else{
//						@unlink($path);
//					}
//					$model->$attribute = '';
//					$model->save(false);
//				}
//			}
//		}
		return '';
	}
	
	public function returnNewModel($model='',$post='',$paths='') {
		return '';
	}
	
	public function allowDelImage() {
		return false;
	}
}

?>
