<?php

class CampSensadoController extends Controller
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
            $return = array();
            if(Yii::app()->user->checkAccess('createSiembra') || Yii::app()->user->id == 'smobiladmin')
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
            if(Yii::app()->user->checkAccess('readSiembra') || Yii::app()->user->id == 'smobiladmin')
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
            if(Yii::app()->user->checkAccess('editSiembra') || Yii::app()->user->id == 'smobiladmin')
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
            if(Yii::app()->user->checkAccess('deleteSiembra') || Yii::app()->user->id == 'smobiladmin')
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
		$model=new CampSensado;
		$granjas = Granjas::model()->findAll();
		$personal = new SolicitudesViaje;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CampSensado']))
		{
			$model->attributes=$_POST['CampSensado'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
			'granjas' => $granjas,
			'personal' => $personal
		));
	}
	public function actionGetEstacionesFromGranja($id) {
		$estaciones = Estacion::model()->findAll('id_granja = '.(int)$id.' AND activo = 1 AND disponible = 1');
		$return = array();

		$return['html'] = "<option value=''>Seleccionar</option>";
		if(count($estaciones>0)){
			foreach ($estaciones as $data ) {
				$return['html'] .= "<option value='{$data->id}'>{$data->identificador}</option>";
			} 
		}
		else {
			$return['html'] = "<option value=''>No hay Plantas de producción disponibles</option>";
		}
		echo json_encode( $return );
	}
	public function actionGetTanquesFromEstacion($id) {
		$tanques_libres   = Tanque::model()->findAll('id_estacion = '.(int)$id.' AND status = 1 AND activo = 1');
		$tanques_ocupados = Tanque::model()->findAll('id_estacion = '.(int)$id.' AND status = 2 AND activo = 1');
		$return = array();

		$tot = 1;
		$return['libres'] = "";
		foreach($tanques_libres as $data) {
			$especies = Especie::model()->findAll('activo = 1');
			$return['libres'] .= "<div class='pedido'>
								<input name='Solicitudes[codigo][{$tot}][id_tanque' id='Solicitudes_codigo_{$tot}_cantidad' type='hidden' value='$data->id' autocomplete='off'>
                                <div class='tituloEspecie'>Tanque: $data->nombre</div>
                                <div class='pedidoWraper' style='height: 178px;'>
                                    <div><label>Seleccionar especie: </label>
                                    	<select class='css-select especie ttan{$tot}' data-esp='{$tot}' name='CampSensado[{$tot}][id_especie]' id='CampSensado_id_especie_{$tot}'>
                                        <option>Seleccionar</option>";
                                        foreach($especies as $dt) {
                                        	$return['libres'] .= "<option value='{$dt->id}'>{$dt->nombre}</option>";
                                        }


                                    $return['libres'].="</select>
                                    	<div class='errorMessage' id='CampSensado_{$tot}_id_especie_em_' style='display:none'></div> 
                                    </div>
                                    <div><label>Seleccionar cepa:</label> <span> <select class='css-select cepa ttan{$tot}' name ='CampSensado[{$tot}][id_cepa]' id='CampSensado_id_cepa_{$tot}' disabled><option>Seleccionar</option></select></span>
                            			<div class='errorMessage' id='CampSensado_{$tot}_id_cepa_em_' style='display:none'></div> 
                                    </div>              
                                    <div>Cantidad: <span> <input name='CampSensado[{$tot}][cantidad]' id='CampSensado_{$tot}_cantidad' type='text' autocomplete='off'></span></div>";
                                   
                               
                            $return['libres'] .="<div class='errorMessage' id='CampSensado_{$tot}_tanque_em_' style='display:none'></div>                        
                            </div>                     
                            </div>
                        </div>"   ;
                        $tot++;
		}
		echo json_encode( $return );
	}
	public function actionGetCepasFromEspecie($id) {

		$cepas  = Cepa::model()->findAll('id_especie = '.(int)$id.' AND activo = 1');
		$return = array();
		$return['cepas'] = "<option>Seleccionar</option>";
		foreach($cepas as $data ) {
			$return['cepas'] .= "<option value='{$data->id}'>{$data->nombre_cepa}</option>"; 
		}

		echo json_encode($return);
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

		if(isset($_POST['CampSensado']))
		{
			$model->attributes=$_POST['CampSensado'];
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
		//$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		//if(!isset($_GET['ajax']))
		//	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			/*$model=$this->loadModel($id);
            $model = $this->loadModel($id);
            $model->activo = 0;
            $update = Yii::app()->db->createCommand()
                    ->update('camp_sensado',$model->attributes,"id = ".(int)$id."");*/
            echo json_encode('');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		/*$dataProvider=new CActiveDataProvider('CampSensado');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
		$model=new CampSensado('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Estacion']))
			$model->attributes=$_GET['Estacion'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CampSensado('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CampSensado']))
			$model->attributes=$_GET['CampSensado'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CampSensado the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CampSensado::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CampSensado $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='camp-sensado-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
