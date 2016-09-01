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
            $granjas = Granjas::model()->findAll('activo = 1');
            $personal = new SolicitudesViaje;
            $update = false;
            // Uncomment the following line if AJAX validation is needed
             $this->performAjaxValidation($model);

            if(isset($_POST['CampSensado']))
            {
//                    print_r($_POST);
                $model->attributes=$_POST['CampSensado'];
                $model->status = 0;
                $model->activo = 1;
                $model->fecha_fin = date('Y-m-d', strtotime($model->fecha_fin));
                $model->fecha_inicio = date('Y-m-d', strtotime($model->fecha_inicio));
                $model->hora_fin = date('h:i', strtotime($model->hora_fin));
                $model->hora_inicio = date('h:i', strtotime($model->hora_inicio));
                if($model->save())
                {
                    $id = Yii::app()->db->getLastInsertID();
                    foreach($_POST['camp_tanques'] as $data) 
                    {
                        $camptanque = new CampTanque;
                        if(isset($data['id_tanque']) && $data['id_tanque'] !='' && 
                           isset($data['id_cepa']) && $data['id_cepa'] != "" && 
                           isset($data['cantidad']) && $data['cantidad'] !="") 
                        {
                            $camptanque->id_tanque = $data['id_tanque'];
                            $camptanque->id_camp_sensado = $id;
                            $camptanque->id_cepa = $data['id_cepa'];
                            $camptanque->cantidad = $data['cantidad'];
                            $camptanque->save();
                        }
                    }
                    $this->redirect(array('index'));
                }
            }

            $this->render('create',array(
                    'model'=>$model,
                    'granjas' => $granjas,
                    'personal' => $personal,
                    'update' => $update
            ));
	}
        public function actionUpdate($id)
	{
            $model=$this->loadModel((int)$id);
            $AllTanque = Tanque::model()->findAll("id_estacion = $model->id_estacion");
            $tanques = CampTanque::model()->findAll('id_camp_sensado ='.(int)$id);
            $personal = new SolicitudesViaje;
            $granjas = new Granjas();
            $update = true;
            $return = '';
            $this->performAjaxValidation($model);
            $i = 1;
            $especie = Especie::model()->findAll('activo = 1');
            foreach($AllTanque as $data)
            {
                $flag = null;
                $id_especie = null;
                $cepaId = -1;
                $cantidad = '';
                foreach($tanques as $data2)
                {
                    if($data2->id_tanque == $data->id)
                    {
                        $flag = Cepa::model()->findByPk($data2->id_cepa);
                        $cepaId = $data2->id_cepa;
                        $cantidad = $data2->cantidad;
                    }
                }
                $especieTexto = "<option>Seleccionar</option>";
                foreach($especie as $data3)
                {
                    if(isset($flag->id_especie))
                    {
                        if($flag->id_especie == $data3->id)
                        {
                            $especieTexto = $especieTexto.'<option value="'.$data3->id.'" selected>'.$data3->nombre.'</option>';
                            $id_especie = $data3->id;
                        }
                        else
                            $especieTexto = $especieTexto.'<option value="'.$data3->id.'">'.$data3->nombre.'</option>';
                    }
                    else
                        $especieTexto = $especieTexto.'<option value="'.$data3->id.'">'.$data3->nombre.'</option>';
                }
                $cepaTexto = '<option>Seleccionar</option>';
                if($id_especie != null)
                {
                    $cepaFlag = null;
                    $cepa = Cepa::model()->findAll("id_especie = $id_especie AND activo = 1");
                    foreach($cepa as $data4)
                    {
                        if($data4->id == $cepaId)
                            $cepaTexto = $cepaTexto.'<option value="'.$data4->id.'" selected>'.$data4->nombre_cepa.'</option>';
                        else
                            $cepaTexto = $cepaTexto.'<option value="'.$data4->id.'">'.$data4->nombre_cepa.'</option>';
                    }
                }
                else
                    $cepaFlag = 'disabled';
                $return = $return.<<<eof
                    <div class="pedido">
                        <input name="camp_tanques[$i][id_tanque]" id="Solicitudes_codigo_{$i}_cantidad" type="hidden" value="{$data->id}">
                        <div class="tituloEspecie">Tanque: {$data->nombre}</div>
                        <div class="pedidoWraper">
                            <div>
                                <label>Seleccionar especie:</label>
                                <select class="css-select especie ttan$i" data-esp="$i" name="especies[$i][id_especie]" id="CampSensado_id_especie_$i">
                                    $especieTexto
                                </select>
                                <div class="errorMessage" id="CampSensado_{$i}_id_especie_em_" style="display:none"></div>
                            </div>
                            <div>
                                <label>Seleccionar cepa:</label>
                                <span>
                                    <select class="css-select cepa ttan$i" data-esp="$i" name="camp_tanques[$i][id_cepa]" id="CampSensado_id_cepa_$i" $cepaFlag>
                                        $cepaTexto
                                    </select>
                                </span>
                                <div class="errorMessage" id="CampSensado_{$i}_id_cepa_em_" style="display:none"></div>
                            </div>
                            <div>
                                <label>Seleccionar :</label>
                                <span>
                                    <input class="cant-peces ValidaNum cantt$i " name="camp_tanques[$i][cantidad]" id="CampSensado_{$i}_cantidad" type="text" value="$cantidad" autocomplete="off">
                                </span>
                                <div class="errorMessage" id="CampSensado_{$i}_tanque_em_" style="display:none"></div>
                            </div>
                        </div>
                    </div>    
                        
eof;
                $i++;
            }
            if(isset($_POST['CampSensado']))
            {
                $model->attributes=$_POST['CampSensado'];
                $model->fecha_fin = date('Y-m-d', strtotime($model->fecha_fin));
                $model->fecha_inicio = date('Y-m-d', strtotime($model->fecha_inicio));
                $model->hora_fin = date('h:i', strtotime($model->hora_fin));
                $model->hora_inicio = date('h:i', strtotime($model->hora_inicio));
                if($model->save())
                {
                    $delete = Yii::app()->db->createCommand("DELETE FROM camp_tanque WHERE id_camp_sensado = $model->id")->execute();
                    foreach($_POST['camp_tanques'] as $data) 
                    {
                        $camptanque = new CampTanque;
                        if(isset($data['id_tanque']) && $data['id_tanque'] !='' && 
                           isset($data['id_cepa']) && $data['id_cepa'] != "" && 
                           isset($data['cantidad']) && $data['cantidad'] !="") 
                        {
                            $camptanque->id_tanque = $data['id_tanque'];
                            $camptanque->id_camp_sensado = $model->id;
                            $camptanque->id_cepa = $data['id_cepa'];
                            $camptanque->cantidad = $data['cantidad'];
                            $camptanque->save();
                        }
                    }
                    $this->redirect(array('index'));
                }
            }
            $this->render('update',array(
                    'model'     =>$model,
                    'personal'  =>$personal,
                    'granjas'   =>$granjas,
                    'update'    =>$update,
                    'tanques'   =>$return
            ));
	}
	public function actionGetEstacionesFromGranja($id) 
        {
            $estaciones = Estacion::model()->findAll('id_granja = '.(int)$id.' AND activo = 1 AND disponible = 1');
            $return = array();


            $return['html'] = "<option value=''>Seleccionar</option>";
            if(count($estaciones>0)){
                foreach ($estaciones as $data ) 
                {
                        $cr = new CDbCriteria;
                        $cr->condition = "id_estacion = {$data->id} AND activo = 1";
                        $tanquesfromestaciones = Tanque::model()->findAll($cr);
                        $numero = count($tanquesfromestaciones);
                        $return['html'] .= "<option value='{$data->id}'>{$data->identificador} - {$numero} tanques disponibles</option>";
                } 
            }
            else {
                    $return['html'] = "<option value=''>No hay Plantas de producción disponibles</option>";
            }
            echo json_encode( $return );
	}
	public function actionGetTanquesFromEstacion($id, $update, $fecha_inicial, $fecha_final, $id_siembra) {
            $tlc = new CDbCriteria;
            $fi = date('Y-m-d', strtotime($fecha_inicial));
            $ff = date('Y-m-d', strtotime($fecha_final));
            $tlc->condition="id_estacion = {$id} AND activo = 1 ";
            
            $tanques_libres   = Tanque::model()->findAll($tlc);
            // $tanques_ocupados = Tanque::model()->findAll('id_estacion = '.(int)$id.' AND activo = 1');
            $return = array();

            $tot = 1;
            $return['libres'] = "";
            if($update == 0) {
                foreach($tanques_libres as $data) {
                    $especies = Especie::model()->findAll('activo = 1');
                    $return['libres'] .= "<div class='pedido'>
                        <input name='camp_tanques[{$tot}][id_tanque]' id='Solicitudes_codigo_{$tot}_cantidad' type='hidden' value='$data->id' autocomplete='off'>
                        <div class='tituloEspecie'>Tanque: $data->nombre</div>
                        <div class='pedidoWraper' style='height: 178px;'>
                            <div><label>Seleccionar especie: </label>
                            <select class='css-select especie ttan{$tot}' data-esp='{$tot}' name='especies[{$tot}][id_especie]' id='CampSensado_id_especie_{$tot}'>
                            <option>Seleccionar</option>";
                            foreach($especies as $dt) {
                                $return['libres'] .= "<option value='{$dt->id}'>{$dt->nombre}</option>";
                            }
                            $return['libres'].="</select>
                                <div class='errorMessage' id='CampSensado_{$tot}_id_especie_em_' style='display:none'></div> 
                            </div>
                            <div><label>Seleccionar cepa:</label> <span> <select class='css-select cepa ttan{$tot}' name ='camp_tanques[{$tot}][id_cepa]' id='CampSensado_id_cepa_{$tot}' disabled><option>Seleccionar</option></select></span>
                                <div class='errorMessage' id='CampSensado_{$tot}_id_cepa_em_' style='display:none'></div> 
                            </div>              
                            <div>Cantidad: <span> <input class='cant-peces ValidaNum cantt{$tot} 'name='camp_tanques[{$tot}][cantidad]' id='CampSensado_{$tot}_cantidad' type='text' autocomplete='off'></span></div>";
                        $return['libres'] .="<div class='errorMessage' id='CampSensado_{$tot}_tanque_em_' style='display:none'></div>                        
                        </div>                     
                        </div>
                    </div>"   ;
                    $tot++;
                }
            }
            else {
                foreach($tanques_libres as $data) {
                    $camp_tanques = CampTanque::model()->findByAttributes('id_camp_sensado = '.$id_siembra);
                    $especies = Especie::model()->findAll('activo = 1');
                    if(isset($camp_tanques->id) ) {
                        $camp_sensado = CampSensado::model()->findByPk($camp_tanques->id_camp_sensado);  
                        fb($camp_sensado->attributes);
                        if($camp_sensado->status < 2){
                            if($camp_sensado->fecha_inicio > $fi || $camp_sensado->fecha_final < $ff) {
                               $return['libres'] .= "<div class='pedido'>
                                    <input name='camp_tanques[{$tot}][id_tanque]' id='Solicitudes_codigo_{$tot}_cantidad' type='hidden' value='$data->id' autocomplete='off'>
                                    <div class='tituloEspecie'>Tanque: $data->nombre</div>
                                    <div class='pedidoWraper' style='height: 178px;'>
                                        <div><label>Seleccionar especie: </label>
                                        <select class='css-select especie ttan{$tot}' data-esp='{$tot}' name='especies[{$tot}][id_especie]' id='CampSensado_id_especie_{$tot}'>
                                        <option>Seleccionar</option>";
                                        foreach($especies as $dt) {
                                            $return['libres'] .= "<option value='{$dt->id}'>{$dt->nombre}</option>";
                                        }
                                        $return['libres'].="</select>
                                            <div class='errorMessage' id='CampSensado_{$tot}_id_especie_em_' style='display:none'></div> 
                                        </div>
                                        <div><label>Seleccionar cepa:</label> <span> <select class='css-select cepa ttan{$tot}' name ='camp_tanques[{$tot}][id_cepa]' id='CampSensado_id_cepa_{$tot}' disabled><option>Seleccionar</option></select></span>
                                            <div class='errorMessage' id='CampSensado_{$tot}_id_cepa_em_' style='display:none'></div> 
                                        </div>              
                                        <div>Cantidad: <span> <input class='cant-peces ValidaNum cantt{$tot} 'name='camp_tanques[{$tot}][cantidad]' id='CampSensado_{$tot}_cantidad' type='text' autocomplete='off'></span></div>";
                                    $return['libres'] .="<div class='errorMessage' id='CampSensado_{$tot}_tanque_em_' style='display:none'></div>                        
                                    </div>                     
                                    </div>
                                </div>"   ;
                                $tot++; 
                            }
                            elseif ($camp_sensado->fecha_inicio == $fi && $camp_sensado->fecha_final == $ff) {
                                $id_cepa = Cepa::model()->findByPk($camp_tanques->id_cepa);
                                $especie = Especie::model()->findByPk($id_cepa->id_especie);
                                $cepasDEspecie = Cepa::model()->findAll('id_especie= '.(int)$especie->id);
                                $return['libres'] .= "<div class='pedido'>
                                    <input name='camp_tanques[{$tot}][id_tanque]' id='Solicitudes_codigo_{$tot}_cantidad' type='hidden' value='$data->id' autocomplete='off'>
                                    <div class='tituloEspecie'>Tanque: $data->nombre</div>
                                    <div class='pedidoWraper' style='height: 178px;'>
                                        <div><label>Seleccionar especie: </label>
                                        <select class='css-select especie ttan{$tot}' data-esp='{$tot}' name='especies[{$tot}][id_especie]' id='CampSensado_id_especie_{$tot}'>
                                        <option>Seleccionar</option>";
                                        foreach($especies as $dt) {
                                            if($especie->id == $dt->id){
                                                $return['libres'] .= "<option value='{$dt->id}' selected='selected'>{$dt->nombre}</option>";
                                            }
                                            else {
                                                $return['libres'] .= "<option value='{$dt->id}'>{$dt->nombre}</option>";
                                                
                                            }
                                        }
                                        $return['libres'].="</select>
                                            <div class='errorMessage' id='CampSensado_{$tot}_id_especie_em_' style='display:none'></div> 
                                        </div>
                                        <div><label>Seleccionar cepa:</label> <span> <select class='css-select cepa ttan{$tot}' name ='camp_tanques[{$tot}][id_cepa]' id='CampSensado_id_cepa_{$tot}'>
                                            <option>Seleccionar</option></select></span>";
                                        foreach($cepasDEspecie as $dt) {
                                            if($camp_tanques->id_cepa == $dt->id){
                                                $return['libres'] .= "<option value='{$dt->id}' selected='selected'>{$dt->nombre_cepa}</option>";
                                            }
                                            else {
                                                $return['libres'] .= "<option value='{$dt->id}'>{$dt->nombre_cepa}</option>";
                                                
                                            }
                                        }
                                         $return['libres'].="<div class='errorMessage' id='CampSensado_{$tot}_id_cepa_em_' style='display:none'></div> 
                                        </div>              
                                        <div>Cantidad: <span> <input class='cant-peces ValidaNum cantt{$tot} 'name='camp_tanques[{$tot}][cantidad]' id='CampSensado_{$tot}_cantidad' type='text' value='{$camp_tanques->cantidad}' autocomplete='off'></span></div>";
                                    $return['libres'] .="<div class='errorMessage' id='CampSensado_{$tot}_tanque_em_' style='display:none'></div>                        
                                    </div>                     
                                    </div>
                                </div>"   ;
                                $tot++; 
                            }
                            
                        }
                    }
                    else {
                        $return['libres'] .= "<div class='pedido'>
                            <input name='camp_tanques[{$tot}][id_tanque]' id='Solicitudes_codigo_{$tot}_cantidad' type='hidden' value='$data->id' autocomplete='off'>
                            <div class='tituloEspecie'>Tanque: $data->nombre</div>
                            <div class='pedidoWraper' style='height: 178px;'>
                                <div><label>Seleccionar especie: </label>
                                <select class='css-select especie ttan{$tot}' data-esp='{$tot}' name='especies[{$tot}][id_especie]' id='CampSensado_id_especie_{$tot}'>
                                <option>Seleccionar</option>";
                                foreach($especies as $dt) {
                                    $return['libres'] .= "<option value='{$dt->id}'>{$dt->nombre}</option>";
                                }
                                $return['libres'].="</select>
                                    <div class='errorMessage' id='CampSensado_{$tot}_id_especie_em_' style='display:none'></div> 
                                </div>
                                <div><label>Seleccionar cepa:</label> <span> <select class='css-select cepa ttan{$tot}' name ='camp_tanques[{$tot}][id_cepa]' id='CampSensado_id_cepa_{$tot}' disabled><option>Seleccionar</option></select></span>
                                    <div class='errorMessage' id='CampSensado_{$tot}_id_cepa_em_' style='display:none'></div> 
                                </div>              
                                <div>Cantidad: <span> <input class='cant-peces ValidaNum cantt{$tot} 'name='camp_tanques[{$tot}][cantidad]' id='CampSensado_{$tot}_cantidad' type='text' autocomplete='off'></span></div>";
                            $return['libres'] .="<div class='errorMessage' id='CampSensado_{$tot}_tanque_em_' style='display:none'></div>                        
                            </div>                     
                            </div>
                        </div>"   ;
                        $tot++;
                    }
                }
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
	public function actionGetInfoCepa($id) {
		$cepa = Cepa::model()->findByPk((int)$id);
		$return = array();
		$return['nombre'] = $cepa->nombre_cepa;
		$return['temp_min'] = $cepa->temp_min;
		$return['temp_max'] = $cepa->temp_max;
		$return['ph_min'] = $cepa->ph_min;
		$return['ph_max'] = $cepa->ph_max;
		$return['ox_min'] = $cepa->ox_min;
		$return['ox_max'] = $cepa->ox_max;

		echo json_encode($return);
	}
	public function actionGetNombreEspecie($id) {
		$cepa = Especie::model()->findByPk((int)$id);
		$return = array();
		$return['nombre'] = $cepa->nombre;

		echo json_encode($return);
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */

	

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
        
        public function actionBorrar($id) {
            $camptanques = CampTanque::model()->deleteAll('id_camp_sensado='.(int)$id);
            if($camptanques) {
                $model = CampSensado::model()->deleteAll('id='.(int)$id);
            }
            echo json_encode("");
        }
	public function actionDelete($id)
	{
		//$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		//if(!isset($_GET['ajax']))
		//	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            $model = CampSensado::model()->findByPk($id);
            $model->activo = 0;
            $update = Yii::app()->db->createCommand()
                    ->update('camp_sensado',$model->attributes,"id = ".(int)$id."");
            echo json_encode('');
	}
	public function actionDelete1($id)
	{
		//$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		//if(!isset($_GET['ajax']))
		//	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            $model = CampSensado::model()->findByPk($id);
            $model->activo = 0;
            $update = Yii::app()->db->createCommand()
                    ->update('camp_sensado',$model->attributes,"id = ".(int)$id."");
            echo json_encode('');
	}
	public function actionReactivar($id)
	{
		//$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		//if(!isset($_GET['ajax']))
		//	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            $model = $this->loadModel($id);
            $model->activo = 1;
            $update = Yii::app()->db->createCommand()
                    ->update('camp_sensado',$model->attributes,"id = ".(int)$id."");
            echo json_encode(true);
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
		if(isset($_GET['CampSensado']))
			$model->attributes=$_GET['CampSensado'];

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
