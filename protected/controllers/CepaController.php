<?php

class CepaController extends Controller
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
			//'postOnly + delete', // we only allow deletion via POST request
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
            if(Yii::app()->user->checkAccess('createCepa') || Yii::app()->user->id == 'smobiladmin')
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
            if(Yii::app()->user->checkAccess('readCepa') || Yii::app()->user->id == 'smobiladmin')
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
            if(Yii::app()->user->checkAccess('updateCepa') || Yii::app()->user->id == 'smobiladmin')
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
            if(Yii::app()->user->checkAccess('deleteCepa') || Yii::app()->user->id == 'smobiladmin')
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
	public function actionCreate($especie)
	{
		$model=new Cepa;
                $model->id_especie = $especie;
		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Cepa']))
		{
                    $model->attributes=$_POST['Cepa'];
                    $model->id_especie = $especie;
                    if($model->save()){
                        $this->redirect(array('?id='.$model->id_especie));
                    }
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
	public  static function getNombres($id_especie){
		$lista= array();
		 $nombres= Yii::app()->db->createCommand('SELECT nombre_cepa 
		 	FROM cepa WHERE id_especie='.$id_especie)
                ->queryAll();
            foreach($nombres as $nom){
            	$lista[]=$nom['nombre_cepa'];
            }
            fb($lista);
                return $lista;
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Cepa']))
		{
			$model->attributes=$_POST['Cepa'];
				  if($model->save()){
                        $this->redirect(array('?id='.$model->id_especie));
                    }
				
			
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
            $model = $this->loadModel($id);
            $model->activo = 0;
            $update = Yii::app()->db->createCommand()
                    ->update('cepa',$model->attributes,"id = ".(int)$id."");

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		/*if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		*/   
		echo json_encode('true');

		}



	public function actionReactivar($id)
	{
            $model = Cepa::model()->findByPk($id);
            $model->activo = 1;
            $update = Yii::app()->db->createCommand()
                ->update('cepa',$model->attributes,"id = ".(int)$id."");
            echo json_encode('true');
	}



	/**
	 * Lists all models.
	 */
	public function actionIndex($id)
	{
            $model=new Cepa("search($id)");
            $model->unsetAttributes(); 
            $nombre = Especie::model()->findByPk($id);
            if(isset($_GET['Cepa']))
                    $model->attributes=$_GET['Cepa'];
            $this->render('index',array(
                    'model'     =>$model,
                    'id'        => $id,
                    'especie'   =>$nombre
            ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Cepa('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Cepa']))
			$model->attributes=$_GET['Cepa'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Cepa the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Cepa::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Cepa $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cepa-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
