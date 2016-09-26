<?php

class RolesController extends Controller
{
    public $layout='//layouts/column2';
    public function filters()
    {
            return array(
                    'accessControl', // perform access control for CRUD operations
            //	'postOnly + delete', // we only allow deletion via POST request
            );
    }
    public function accessRules()
    {
        $return = array();
        if(Yii::app()->user->checkAccess('createRoles') || Yii::app()->user->id == 'smobiladmin')
            $return[] = array
            (
                'allow',
                'actions'   => array('create'),
                'users'     => array('*')
            );
        else
            $return[] = array
            (
                'deny',
                'actions'   => array('create'),
                'users'     => array('*')
            );
        if(Yii::app()->user->checkAccess('readRoles') || Yii::app()->user->id == 'smobiladmin')
            $return[] = array
            (
                'allow',
                'actions'   => array('index','view'),
                'users'     => array('*')
            );
        else
            $return[] = array
            (
                'deny',
                'actions'   => array('index','view'),
                'users'     => array('*')
            );
        if(Yii::app()->user->checkAccess('updateRoles') || Yii::app()->user->id == 'smobiladmin')
            $return[] = array
            (
                'allow',
                'actions'   => array('update'),
                'users'     => array('*')
            );
        else
            $return[] = array
            (
                'deny',
                'actions'   => array('update'),
                'users'     => array('*')
            );
        if(Yii::app()->user->checkAccess('deleteRoles') || Yii::app()->user->id == 'smobiladmin')
            $return[] = array
            (
                'allow',
                'actions'   => array('delete'),
                'users'     => array('*')
            );
        else
            $return[] = array
            (
                'deny',
                'actions'   => array('delete'),
                'users'     => array('*')
            );
        return $return;
    }
    public function actionView($id)
    {
            $this->render('view',array(
                    'model'=>$this->loadModel($id),
            ));
    }
    public function actionCreate()
    {
        $model = new Roles;
        $acciones = new RolesPermisos;
        // Uncomment the following line if AJAX validation is needed
         $this->performAjaxValidation($model);

        if(isset($_POST['Roles']))
        {
            $model->attributes = $_POST['Roles'];
            $model->activo = 1;
            if($model->save())
            {
                $auth = Yii::app()->authManager;
//                        print_r($_POST['RolesPermisos']['seccion']);
                foreach($_POST['RolesPermisos']['seccion'] as $data)
                {
                    $acciones2 = new RolesPermisos;
                    $acciones2->id_rol = $model->id;
                    $acciones2->seccion = $data['seccion'];
                    $acciones2->alta = $data['alta'];
                    $acciones2->baja = $data['baja'];
                    $acciones2->consulta = $data['consulta'];
                    $acciones2->edicion = $data['edicion'];
                    $acciones2->save();
                    $roles = new Roles();
                    $nombreSeccion = $roles->getSeccion($acciones2->seccion);
//                    $seccion = '';
                    if($data['alta'] == 1)
                    {
                        $seccion = 'create'.$nombreSeccion;
                        $auth->assign($seccion,$model->nombre_rol);
                    }
                    if($data['baja'] == 1)
                    {
                        $seccion = 'delete'.$nombreSeccion;
                        $auth->assign($seccion,$model->nombre_rol);
                    }
                    if($data['consulta'] == 1)
                    {
                        $seccion = 'read'.$nombreSeccion;
                        $auth->assign($seccion,$model->nombre_rol);
                    }
                    if($data['edicion'] == 1)
                    {
                        $seccion = 'update'.$nombreSeccion;
                        $auth->assign($seccion,$model->nombre_rol);
                    }
                }
                $this->redirect(array('index'));
            }
        }

        $this->render('create',array(
            'model'     => $model,
            'acciones'  => $acciones
        ));
    }
    public function actionUpdate($id)
    {
            $model=$this->loadModel($id);
            $query = RolesPermisos::model()->findAllBySql("SELECT * FROM roles_permisos WHERE id_rol = {$id}");
            $array = array();
            $acciones = new RolesPermisos;
            foreach($query as $data)
            {
                $array[$data->seccion]['seccion'] = $data->seccion;
                $array[$data->seccion]['alta'] = $data->alta;
                $array[$data->seccion]['baja'] = $data->baja;
                $array[$data->seccion]['consulta'] = $data->consulta;
                $array[$data->seccion]['edicion'] = $data->edicion;
            }
            // Uncomment the following line if AJAX validation is needed
            $this->performAjaxValidation($model);

            $acciones->seccion = $array;
            if(isset($_POST['Roles']))
            {
                $oldRol = Roles::model()->findByPk($model->id);
                $model->attributes=$_POST['Roles'];

                if($model->save())
                {
                    $delete = Yii::app()->db->createCommand("DELETE FROM AuthAssignment WHERE userid = '{$oldRol->nombre_rol}'")->execute();
                    $auth = Yii::app()->authManager;
                    $i = 1;
                    foreach($_POST['RolesPermisos']['seccion'] as $data)
                    {
                        $update = RolesPermisos::model()->findBySql("SELECT * FROM roles_permisos WHERE id_rol = {$id} AND seccion = {$data['seccion']}");
                        if($update != '' && $update != null)
                        {
                            $update->attributes = $data;
                            $update->save();
                            $roles = new Roles();
                            $nombreSeccion = $roles->getSeccion($data['seccion']);
                            $seccion = '';
                            if($data['alta'] == 1)
                            {
                                $seccion = 'create'.$nombreSeccion;
                                $auth->assign($seccion,$model->nombre_rol);
                            }
                            if($data['baja'] == 1)
                            {
                                $seccion = 'delete'.$nombreSeccion;
                                $auth->assign($seccion,$model->nombre_rol);
                            }
                            if($data['consulta'] == 1)
                            {
                                $seccion = 'read'.$nombreSeccion;
                                $auth->assign($seccion,$model->nombre_rol);
                            }
                            if($data['edicion'] == 1)
                            {
                                $seccion = 'update'.$nombreSeccion;
                                $auth->assign($seccion,$model->nombre_rol);
                            }
                        }
                        $i++;
                    }
                }
                $this->redirect(array('index'));
            }
            $this->render('create',array(
                    'model'=>$model,
                    'acciones'=>$acciones
            ));
    }
    public function actionDelete($id)
    {
        $this->loadModel($id);
        $model = $this->loadModel($id);
        $model->activo = 0;
        $update = Yii::app()->db->createCommand()
                ->update('roles',$model->attributes,"id = ".(int)$id."");
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            /*if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    */                 echo json_encode('');

            }
    public function actionReactivar($id)
    {
        $model = Roles::model()->findByPk($id);
        $model->activo = 1;
        $update = Yii::app()->db->createCommand()
            ->update('roles',$model->attributes,"id = ".(int)$id."");
        echo json_encode('');
    }
    public function actionIndex()
    {
            $model = new Roles('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Roles']))
                    $model->attributes=$_GET['Roles'];
            $this->render('index',array(
                    'model'=>$model,
            ));
    }
    public function actionAdmin()
    {
            $model=new Roles('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Roles']))
                    $model->attributes=$_GET['Roles'];

            $this->render('admin',array(
                    'model'=>$model,
            ));
    }
    public function loadModel($id)
    {
            $model=Roles::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
    }
    protected function performAjaxValidation($model)
    {
            if(isset($_POST['ajax']) && $_POST['ajax']==='roles-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
    }
}
