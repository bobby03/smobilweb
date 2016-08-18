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
            //return isset($usuario->tipo_usr)?$usuario->tipo_usr:0;	
        	}
        
        }
        
       /* public function getID(){
            if(Yii::app()->user->name =='smobiladmin'){
                return 0;
            } else {
            $usuario = Usuarios::model()->find('usuario=?', array(Yii::app()->user->name));
            return $usuario;  
            }
        
        }*/

      public function getIDc(){
            if(Yii::app()->user->name =='smobiladmin'){
                return 0;
            } else {
            $usuario = Usuarios::model()->find('usuario=?', array(Yii::app()->user->name));
            fb($usuario);
            fb('-----');
            fb($usuario->id_usr);

            return $usuario->id_usr;  
            }
        }


        public function getIdUsuario(){

                // Obtiene el Nombre del rol del usuario Logueado
                $nombre_rol = Yii::app()->user->getID();

                //Obtengo los datos del Rol y Verifico si el rol se encuentra activo
                $query = Roles::model()->findBySql("SELECT * FROM roles WHERE nombre_rol = '{$nombre_rol}' AND activo = 1");
                $count = count($query);

                $id_rol= (string)$query->id;
                $roles =array();

               //Si el rol está activo consulto las secciones a las que tiene acceso el rol y las retorno en array
               if($count){

                     $queryRoles = RolesPermisos::model()->findAllBySql("SELECT * FROM roles_permisos WHERE id_rol = '{$id_rol}'");
                     foreach($queryRoles as $data)
                        {
                            $roles[(string)$data->seccion]['alta']= $data->alta;
                            $roles[(string)$data->seccion]['baja']=$data->baja;
                            $roles[(string)$data->seccion]['consulta']=$data->consulta;
                            $roles[(string)$data->seccion]['edicion']=$data->edicion;
                        }
                        Yii::app()->user->setState('rolesa',$roles);
               }
               return $roles;
       

                
        }

 
}