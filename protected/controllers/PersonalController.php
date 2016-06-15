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
            return array
            (
                array('allow',  // allow all users to perform 'index' and 'view' actions
                    'actions'=>array('index','view'),
                    'users'=>array('*'),
                ),
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                    'actions'=>array('create','update'),
                    'users'=>array('@'),
                ),
                array('allow', // allow admin user to perform 'admin' and 'delete' actions
                    'actions'=>array('admin','delete'),
                    'users'=>array('admin'),
                ),
                array('deny',  // deny all users
                    'users'=>array('*'),
                ),
            );
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
            $this->loadModel($id)->delete();
            /*if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    */                echo json_encode('');

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
                throw new CHttpException(404,'The requested page does not exist.');
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
