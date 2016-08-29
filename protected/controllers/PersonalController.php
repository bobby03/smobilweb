<?php
    class PersonalController extends Controller
    {
	public $layout='//layouts/column2';
	public function filters()
	{
            return array(
                'accessControl', // perform access control for CRUD operations
               // 'postOnly + delete', // we only allow deletion via POST request
            );
	}
	public function accessRules()
        {
            $return = array();
            if(Yii::app()->user->checkAccess('createPersonal') || Yii::app()->user->id == 'smobiladmin')
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
            if(Yii::app()->user->checkAccess('readPersonal') || Yii::app()->user->id == 'smobiladmin')
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
            if(Yii::app()->user->checkAccess('editPersonal') || Yii::app()->user->id == 'smobiladmin')
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
            if(Yii::app()->user->checkAccess('deletePersonal') || Yii::app()->user->id == 'smobiladmin')
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
            $model=new Personal;

             $this->performAjaxValidation($model);
            if(isset($_POST['Personal']))
            {
                $model->attributes=$_POST['Personal'];
                if($model->save())
                    $this->redirect(array('index'));
            }

            $this->render('create',array
            (
                'model'=>$model
            ));
	}
	public function actionUpdate($id)
	{
            $model=$this->loadModel($id);
            if(isset($_POST['Personal']))
            {
                $model->attributes=$_POST['Personal'];
                if($model->save())
                    $this->redirect(array('index'));
            }
            $this->render('update',array
            (
                'model'=>$model,
            ));
	}
	public function actionDelete($id)
	{
            $model = $this->loadModel($id);
            $model->activo = 0;
            $update = Yii::app()->db->createCommand()
                ->update('personal',$model->attributes,"id = ".(int)$id."");
            $usu = Usuarios::model()->findAll("tipo_usr = 2 and id_usr = $id");
            if(isset($usu[0]->id))
            {
                $usu[0]->activo = 0;
                $update = Yii::app()->db->createCommand()
                        ->update('usuarios',$usu[0]->attributes,"id = {$usu[0]->id}");
            }
            echo json_encode('');
        }
	public function actionReactivar($id)
	{
            $model = $this->loadModel($id);
            $model->activo = 1;
            $update = Yii::app()->db->createCommand()
                    ->update('personal',$model->attributes,"id = ".(int)$id."");
            /*if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                */
            echo json_encode('');
            }
	public function actionIndex()
	{
            $model=new Personal('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Personal']))
                $model->attributes=$_GET['Personal'];
            $this->render('index',array
            (
                'model'=>$model,
            ));
	}
	public function actionAdmin()
	{
            $model=new Personal('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Personal']))
                $model->attributes=$_GET['Personal'];

            $this->render('admin',array
            (
                'model'=>$model,
            ));
	}
	public function loadModel($id)
	{
            $model=Personal::model()->findByPk($id);
            if($model===null)
                throw new CHttpException(404,'The requested page does not exist. For now');
            return $model;
	}
	protected function performAjaxValidation($model)
	{
            if(isset($_POST['ajax']) && $_POST['ajax']==='personal-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
	}
}
