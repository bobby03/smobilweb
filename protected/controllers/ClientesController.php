<?php
class ClientesController extends Controller
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
        if(Yii::app()->user->checkAccess('createClientes') || Yii::app()->user->id == 'smobiladmin')
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
        if(Yii::app()->user->checkAccess('readClientes') || Yii::app()->user->id == 'smobiladmin')
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
        if(Yii::app()->user->checkAccess('updateClientes') || Yii::app()->user->id == 'smobiladmin')
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
        if(Yii::app()->user->checkAccess('deleteClientes') || Yii::app()->user->id == 'smobiladmin')
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
            $query = ClientesDomicilio::model()->findAllBySql("SELECT * FROM clientes_domicilio WHERE id_cliente = {$id}");
            $array = array();
            $direccion = new ClientesDomicilio;
            $i = 1;
            foreach($query as $data)
            {
                $array[$i]['domicilio'] = $data->domicilio;
                $array[$i]['ubicacion_mapa'] = $data->ubicacion_mapa;
                $array[$i]['descripcion'] = $data->descripcion;
                $array[$i]['id'] = $data->id;
                $i++;
            }
            $direccion->domicilio = $array;
            $this->render('view',array(
                'model'=>$this->loadModel($id),
                'direccion' => $direccion
            ));
    }
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
            $model = new Clientes;
            $direccion = new ClientesDomicilio;
            // Uncomment the following line if AJAX validation is needed
             $this->performAjaxValidation($model);
            if(isset($_POST['Clientes']))
            {
                $model->attributes=$_POST['Clientes'];
//                        print_r($_POST);
                if($model->save())
                {
                    foreach($_POST['ClientesDomicilio']['domicilio'] as $data)
                    {
                        $direccion = new ClientesDomicilio();
                        $direccion->id_cliente = $model->id;
                        $direccion->domicilio = $data['domicilio'];
                        $direccion->ubicacion_mapa = $data['ubicacion_mapa'];
                        $direccion->descripcion = $data['descripcion'];
                        $direccion->save();
                    }
                    $this->redirect(array('index'));
                }
                else
                {
                    $i = 1;
                    $array = array();
                    foreach($_POST['ClientesDomicilio']['domicilio'] as $data)
                    {
                        $array[$i]['domicilio'] = $data['domicilio'];
                        $array[$i]['ubicacion_mapa'] = $data['ubicacion_mapa'];
                        $array[$i]['descripcion'] = $data['descripcion'];
//                        $array[$i]['id'] = $data->id;
                        $i++;
                    }
                    $direccion->domicilio = $array;   
                }
            }
            $this->render('create',array(
                    'model'=>$model,
                    'direccion'=>$direccion
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
            $query = ClientesDomicilio::model()->findAllBySql("SELECT * FROM clientes_domicilio WHERE id_cliente = {$id} ");
            $array = array();
            $direccion = new ClientesDomicilio;
            $i = 1;
            foreach($query as $data)
            {
                $array[$i]['domicilio'] = $data->domicilio;
                $array[$i]['ubicacion_mapa'] = $data->ubicacion_mapa;
                $array[$i]['descripcion'] = $data->descripcion;
                $array[$i]['id'] = $data->id;
                $i++;
            }
            $direccion->domicilio = $array;
            
            // Uncomment the following line if AJAX validation is needed
            $this->performAjaxValidation($model);
            if(isset($_POST['Clientes']))
            {
                print_r($_POST['Clientes']);
                // $this->redirect(array('index'));
                
                $model->attributes=$_POST['Clientes'];
                if($model->save())
                {

                    foreach($_POST['ClientesDomicilio']['domicilio'] as $data)
                    {
                        if(isset($data['id']))
                        {
                            $update = ClientesDomicilio::model()->findBySql("SELECT * FROM clientes_domicilio WHERE id = {$data['id']}");
                            $update->attributes = $data;
                        }
                        else
                        {
                            $update = new ClientesDomicilio();    
                            $update->attributes = $data;
                            $update->id_cliente = $model->id;
                        }
                        $update->save();
                    }
                    $this->redirect(array('clientes/index'));
                }
                else
                {
                    $array = array();
                    $i = 1;
                    foreach($_POST['ClientesDomicilio']['domicilio'] as $data)
                    {
                        $array[$i]['domicilio'] = $data['domicilio'];
                        $array[$i]['ubicacion_mapa'] = $data['ubicacion_mapa'];
                        $array[$i]['descripcion'] = $data['descripcion'];
//                        $array[$i]['id'] = $data->id;
                        $i++;
                    }
                    $direccion->domicilio = $array; 
                }

            }  
            // $this->redirect(array('index'));
            $this->render('update',array(
                'model'     =>$model,
                'direccion' =>$direccion
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
                ->update('clientes',$model->attributes,"id = ".(int)$id."");
        // print_r($update);
        $usu = Usuarios::model()->findAll("tipo_usr = 1 and id_usr = $id");
        // print_r($usu);
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
            $model = Clientes::model()->findByPk($id);
            $model->activo = 1;
            $update = Yii::app()->db->createCommand()
                ->update('clientes',$model->attributes,"id = ".(int)$id."");
            echo json_encode('');
    }
    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model=new Clientes('search');
        $model->unsetAttributes(); 
        if(isset($_GET['Clientes']))
            $model->attributes=$_GET['Clientes'];
        $this->render('index',array(
            'model'=>$model,
        ));
    }
    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Clientes('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Clientes']))
            $model->attributes=$_GET['Clientes'];
        $this->render('admin',array(
            'model'=>$model,
        ));
    }
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Clientes the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Clientes::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
    /**
     * Performs the AJAX validation.
     * @param Clientes $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='clientes-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}