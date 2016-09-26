<?php

class GranjasController extends Controller
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
            if(Yii::app()->user->checkAccess('createGranja') || Yii::app()->user->id == 'smobiladmin')
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
            if(Yii::app()->user->checkAccess('readGranja') || Yii::app()->user->id == 'smobiladmin')
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
            if(Yii::app()->user->checkAccess('updateGranja') || Yii::app()->user->id == 'smobiladmin')
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
            if(Yii::app()->user->checkAccess('deleteGranja') || Yii::app()->user->id == 'smobiladmin')
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
        public function actionPlantaProduccion($id)
        {
            $model=new Estacion();
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Estacion']))
			$model->attributes=$_GET['Estacion'];

		$this->render('plantaProduccion',array(
                    'model'=>$model,
                    'id'=>$id
		));
        }
        public function actionNuevaPlanta($id)
        {
            $model = new Estacion();
            $model->tipo = (int)2;
		// Uncomment the following line if AJAX validation is needed
            $this->performAjaxValidation($model);
            if(isset($_POST['Estacion']))
            {
                $model->attributes=$_POST['Estacion'];
                $model->id_granja = (int)$id;
                $model->activo = 1;
                $model->disponible = 1;
                $model->no_personal = 1;
                $model->color = "na";
                $model->tipo = (int)2;
                $columnas = array
                (
                    'id_granja' => $id,
                    'identificador' => $_POST['Estacion']['identificador'],
                    'no_personal' => isset($_POST['Estacion']['no_personal'])?$_POST['Estacion']['no_personal']:0,
                    'marca' => isset($_POST['Estacion']['marca'])?$_POST['Estacion']['marca']:"na",
                    'color' => isset($_POST['Estacion']['color'])?$_POST['Estacion']['color']:"na",
                    'ubicacion' => $_POST['Estacion']['ubicacion'],
                    'activo' => 1,
                    'disponible' => 1,
                    'tipo' => 2,
                );
                fb($model->attributes);
//                $insert = YII::app()->db->createCommand()->insert('estacion',$columnas);
                if($model->save())
                {
                    unset($_POST['Estacion']);
                    $this->redirect(array('granjas/plantaProduccion/'.$id));
                }
                else{
                    fb($model->save());
                }
            }

            $this->render('nuevaPlanta',array(
                    'model'=>$model,
                    'idPlanta'=>$id
            ));
        }
        public function actionEditarPlanta($id)
        {
            $model = Estacion::model()->findByPk($id);
		// Uncomment the following line if AJAX validation is needed
//            $this->performAjaxValidation($model);
            if(isset($_POST['Estacion']))
            {
                print_r($_POST['Estacion']);
                $model->attributes=$_POST['Estacion'];
                if($model->save(false))
                {
                    $this->redirect(array('granjas/plantaProduccion/'.$model->id_granja));
                }
            }
            // $this->redirect(array('granjas/plantaProduccion/'.$model->id_granja));
            $this->render('editarPlanta',array('model'=>$model, ));
        }
        
	public function actionCreate()
	{
		$model=new Granjas;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Granjas']))
		{
			$model->attributes=$_POST['Granjas'];
			if($model->save(true)){
                            $this->redirect('index');
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
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed

		$this->performAjaxValidation($model);

		if(isset($_POST['Granjas']))
		{
			$model->attributes=$_POST['Granjas'];
			if($model->save(false))
				$this->redirect(array('index'));
                                
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
            $model = Granjas::model()->findByPk($id);
            $model->activo = 0;
            $update = Yii::app()->db->createCommand()
                ->update('granjas',$model->attributes,"id = ".(int)$id."");
            echo json_encode('');
	}
	public function actionReactivar($id)
	{
            $model = Granjas::model()->findByPk($id);
            $model->activo = 1;
            $update = Yii::app()->db->createCommand()
                ->update('granjas',$model->attributes,"id = ".(int)$id."");
            echo json_encode('');
	}
        
        
	public function actionDeletePlanta($id)
	{
            $model = Estacion::model()->findByPk($id);
            $model->activo = 0;
            $update = Yii::app()->db->createCommand()
                ->update('estacion',$model->attributes,"id = ".(int)$id."");
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            $model=new Granjas('search');
            $model->unsetAttributes();  // clear any default values



            if(isset($_GET['Granjas']))
                    $model->attributes=$_GET['Granjas'];
            $this->render('index',array(
                    'model'=>$model,
            ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Granjas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Granjas']))
			$model->attributes=$_GET['Granjas'];
		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Granjas the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Granjas::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Granjas $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='granjas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
