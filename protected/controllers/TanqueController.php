<?php

class TanqueController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
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
	public function actionCreate($id)
	{
            $model = new Tanque;
            $query = Tanque::model()->findAllBySql("SELECT * FROM tanque WHERE id_estacion = ".(int)$id);
            $array = array();
            $i = 1;
            foreach($query as $data)
            {
                $array[$i]['id'] = $data->id;
                $array[$i]['id_estacion'] = $data->id_estacion;
                $array[$i]['capacidad'] = $data->capacidad;
                $array[$i]['nombre'] = $data->nombre;
                $array[$i]['status'] = $data->status;
                $array[$i]['activo'] = $data->activo;
                $i++;
            }
            $model->status = $array;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

            if(isset($_POST['Tanque']))
            {
                foreach($_POST['Tanque']['status'] as $data)
                {
                    $update = new Tanque();
                    $update->attributes = $data;
                    if(isset($data['id']))
                    {
                        $update->id_estacion = $id;
                        $update->id = $data['id'];
                        $jquery = Yii::app()->db->createCommand()->update('tanque',$update->attributes,"id = $update->id");
                    }
                    else
                    {
                        $update->id_estacion = $id;
                        $update->status = 1;
                        $update->activo = 1;
                        $update->save();
                    }
                }
                $this->redirect(array('/estacion'));
//                print_r($_POST);
            }
            $this->render('create',array(
                    'model'=>$model,
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tanque']))
		{
			$model->attributes=$_POST['Tanque'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
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
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Tanque');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Tanque('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tanque']))
			$model->attributes=$_GET['Tanque'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Tanque the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Tanque::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Tanque $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tanque-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
