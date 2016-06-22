<?php

class RolesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		//	'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
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
            if(Yii::app()->user->checkAccess('editRoles') || Yii::app()->user->id == 'smobiladmin')
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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Roles;
                $acciones = new RolesPermisos;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Roles']))
		{
                    $model->attributes = $_POST['Roles'];
                    $model->activo = 1;
                    if($model->save())
                    {
                        $i = 1;
                        $auth = Yii::app()->authManager;
                        foreach($_POST['RolesPermisos']['seccion'] as $data)
                        {
                            $acciones2 = new RolesPermisos;
                            $acciones2->id_rol = $model->id;
                            $acciones2->seccion = $i;
                            $acciones2->alta = $data['alta'];
                            $acciones2->baja = $data['baja'];
                            $acciones2->consulta = $data['consulta'];
                            $acciones2->edicion = $data['edicion'];
                            $acciones2->save();
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
                            $i++;
                        }
                        $this->redirect(array('index'));
                    }
		}

		$this->render('create',array(
                    'model'     => $model,
                    'acciones'  => $acciones
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
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
		// $this->performAjaxValidation($model);
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
                            $update = RolesPermisos::model()->findBySql("SELECT * FROM roles_permisos WHERE id_rol = {$id} AND seccion = {$i}");
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

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		/*if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	*/                 echo json_encode('');

		}

	/**
	 * Lists all models.
	 */
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

	/**
	 * Manages all models.
	 */
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

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Roles the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Roles::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Roles $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='roles-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
