<?php

class EspecieController extends Controller
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
//			'postOnly + delete', // we only allow deletion via POST request
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
            if(Yii::app()->user->checkAccess('createEspacion') || Yii::app()->user->id == 'smobiladmin')
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
            if(Yii::app()->user->checkAccess('readEspacion') || Yii::app()->user->id == 'smobiladmin')
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
            if(Yii::app()->user->checkAccess('editEspacion') || Yii::app()->user->id == 'smobiladmin')
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
            if(Yii::app()->user->checkAccess('deleteEspacion') || Yii::app()->user->id == 'smobiladmin')
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
		$model=new Especie;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Especie']))
		{
			$model->attributes=$_POST['Especie'];
			if($model->save())
				$this->redirect(array('index'));
		}
		$this->render('create',array(
			'model'=>$model,
		));
	}

	
	public function actionCreate1()
	{
		$especie=$_POST['especie'];
		$nuevo= new Especie;
		$nuevo->nombre=$especie;
		$nuevo->save();
		//$this->render('create',array('model'=>$nuevo));
		echo json_encode($especie);

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

		if(isset($_POST['Especie']))
		{
			$model->attributes=$_POST['Especie'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
		echo json_encode($model);
	}




	public function actionUpdate1()
	{
		$id=$_POST['id'];
		$model=$this->loadModel($id);
		$model->nombre=$_POST['especie'];

		if($model->save()){
		echo json_encode(true);	//$this->redirect(array('index'));
		}
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		//echo json_encode($model);
	}

	

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
            $model = $this->loadModel($id);
            $model->activo = 0;
            $update = Yii::app()->db->createCommand()
                    ->update('especie',$model->attributes,"id = ".(int)$id."");
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		//		if(!isset($_GET['ajax']))
		//                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            echo json_encode('true');
	}

	public function actionReactivar($id)
	{
            $model = Especie::model()->findByPk($id);
            $model->activo = 1;
            $update = Yii::app()->db->createCommand()
                ->update('especie',$model->attributes,"id = ".(int)$id."");
            echo json_encode('true');
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            $model=new Especie('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Especie']))
                    $model->attributes=$_GET['Especie'];
            $this->render('index',array(
                    'model'=>$model,
            ));

	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Especie('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Especie']))
			$model->attributes=$_GET['Especie'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Especie the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Especie::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Especie $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='especie-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
