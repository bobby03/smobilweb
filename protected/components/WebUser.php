<?php

/**
 * Overload of CWebUser to set some more methods.
 */
class WebUser extends CWebUser
{
        private $_model;

        public function getTipoUsuario(){
        	if(Yii::app()->user->name =='smobiladmin'){
        		return 2;
        	} else {
        	$usuario = Usuarios::model()->find('usuario=?', array(Yii::app()->user->name));
        	return $usuario->tipo_usr;	
        	}
        	
        
        }

 
}