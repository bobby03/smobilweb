<?php

/**
 * This is the model class for table "viajes".
 *
 * The followings are the available columns in table 'viajes':
 * @property integer $id
 * @property integer $id_solicitudes
 * @property integer $id_responsable
 * @property string $status
 * @property string $fecha_salida
 * @property string $hora_salida
 * @property string $fecha_entrega
 * @property string $hora_entrega
 *
 * The followings are the available model relations:
 * @property SolicitudesViaje[] $solicitudesViajes
 * @property Clientes $idClientes
 * @property Personal $idResponsable
 */
class Viajes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'viajes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(


			array('id_responsable','required','message'=>'Debe seleccionar un responsable'),
			array('id_estacion','required','message'=>'Debe seleccionar una estacion'),
			array('fecha_salida','required','message'=>'Debe especificar una fecha'),



            array('hora_salida','required','message'=>'Este campo es obligatorio'),
            array(
                'hora_salida',
                'match',
                'pattern'=>"/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/",
                'message'=>'Formato de Hora no valido'),

	
			array('id_solicitudes, status', 'required'),
			array('id, id_solicitudes, id_responsable, id_estacion, status', 'numerical', 'integerOnly'=>true),
                        //array('id_estacion','unique','message'=>'Esa estación ya está registrada en un viaje'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_solicitudes, id_responsable, id_estacion, status, fecha_salida, hora_salida, fecha_entrega, hora_entrega', 'safe', 'on'=>'search'),


            //([01]?[0-9]|2[0-3]):[0-5][0-9]
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'solicitudesViajes' => array(self::HAS_MANY, 'SolicitudesViaje', 'id_viaje'),
			'idSolicitudes' => array(self::BELONGS_TO, 'Solicitudes', 'id_solicitudes'),
			'idResponsable' => array(self::BELONGS_TO, 'Personal', 'id_responsable'),
			'idEstacion' => array(self::BELONGS_TO, 'Estacion', 'id_estacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_solicitudes' => 'Cliente',
			'id_responsable' => 'Responsable',
			'id_estacion' => 'Camión',
			'status' => 'Status',
			'fecha_salida' => 'Fecha estimada de salída',
			'hora_salida' => 'Hora estimada de salída',
			'fecha_entrega' => 'Fecha Entrega',
			'hora_entrega' => 'Hora Entrega',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_solicitudes',$this->id_solicitudes);
		$criteria->compare('id_responsable',$this->id_responsable);
		$criteria->compare('id_estacion',$this->id_estacion);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('fecha_salida',$this->fecha_salida,true);
		$criteria->compare('hora_salida',$this->hora_salida,true);
		$criteria->compare('fecha_entrega',$this->fecha_entrega,true);
		$criteria->compare('hora_entrega',$this->hora_entrega,true);

        return new CActiveDataProvider($this, array(
           'criteria'=>$criteria,
                                'pagination'=>array(
                                    'pageSize'=>15,
                            ),
          ));

	}
        public function searchStatus1($flag)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_solicitudes',$this->id_solicitudes);
		$criteria->compare('id_responsable',$this->id_responsable);
		$criteria->compare('id_estacion',$this->id_estacion);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('fecha_salida',$this->fecha_salida,true);
		$criteria->compare('hora_salida',$this->hora_salida,true);
		$criteria->compare('fecha_entrega',$this->fecha_entrega,true);
		$criteria->compare('hora_entrega',$this->hora_entrega,true);
                $criteria->addCondition("status = $flag");
		
        return new CActiveDataProvider($this, array(
           'criteria'=>$criteria,
                                'pagination'=>array(
                                    'pageSize'=>15,
                            ),
          ));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Viajes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public function getFecha($date)
    {
        if($date != null && $date != '')
            return date("d-m-Y", strtotime($date));
        else
            return 'N/A'; 
    }
    public function getHora($date)
    {
        if($date != null && $date != '')
            return date("H:i", strtotime($date));
        else
            return 'N/A'; 
    }
    public function getAllStatus()
    {
        return array
        (
            '1' => 'En espera',
            '2' => 'En ruta',
            '3' => 'Terminado',
        );
    }
    public function getStatus($id)
    {
        switch ($id)
        {
            case 1: return 'En espera'; break;
            case 2: return 'En ruta'; break;
            case 3: return 'Terminado'; break;
        }
    }
    public function getAllClientesViajes($idViaje,$id)
    {
        $cliente = Clientes::model()->getClienteViajes($id);
        $clientes = Yii::app()->db->createCommand()
                ->select('cli.nombre_empresa, sol.codigo, sol.id_clientes')
                ->from('solicitudes_viaje as solVia')
                ->join('solicitudes as sol','sol.id = solVia.id_solicitud')
                ->join('clientes as cli','cli.id = sol.id_clientes')
                ->where("solVia.id_viaje = $idViaje")
                ->andWhere('solVia.id_personal = 0')
                ->queryAll();
        if(count($clientes)>0)
            foreach($clientes as $data)
                $cliente = $cliente."<br><b>{$data['nombre_empresa']}</b>({$data['codigo']})";
        return $cliente;
    }
    public function adminSearch1()
    {
        return array
        (
            array
            (
                'name' => 'id_solicitudes',
                'value' => 'Clientes::model()->getClienteViajes($data->id_solicitudes)',
                'filter' => Clientes::model()->getAllClientesViajes(),
                'type' => 'raw'
            ),
            array
            (
                'name' => 'id_responsable',
                'value' => 'Personal::model()->getPersonal($data->id_responsable)',
                'filter' => Personal::model()->getAllPersonal()
            ),
            array
            (
                'name' => 'id_estacion',
                'value' => 'Estacion::model()->getEstacion($data->id_estacion)',
                'filter' => Estacion::model()->getAllEstacionMovil()
            ),
            array
            (
                'name'=>'fecha_salida',
                'value' => 'date("d-m-Y", strtotime($data->fecha_salida))'
            ),
            array
            (
                'name'=>'hora_salida',
                'value' => 'date("H:i", strtotime($data->hora_salida))'
            ),
//            array
//            (
//                'name'=>'fecha_entrega',
//                'value' => 'Viajes::model()->getFecha($data->fecha_entrega)'
//            ),
//            array
//            (
//                'name'=>'hora_entrega',
//                'value' => 'date("H:i", strtotime($data->hora_entrega))'
//            ),
            array
            (
                'class'=>'NCButtonColumn',
                'header'=>'Acciones',
                'template'=>'<div class="buttonsWraper">{view} {update} {delete}</div>'
            ),
        );
    }
    public function adminSearch2()
    {
        return array
        (

            array
            (
                'name' => 'id_solicitudes',
                'value' => 'Clientes::model()->getClienteViajes($data->id_solicitudes)',
                'filter' => Clientes::model()->getAllClientesViajes(),
                'type' => 'raw'
            ),
            array
            (
                'name' => 'id_responsable',
                'value' => 'Personal::model()->getPersonal($data->id_responsable)',
                'filter' => Personal::model()->getAllPersonal()
            ),



            array
            (
                'name' => 'id_estacion',
                'value' => 'Estacion::model()->getEstacion($data->id_estacion)',
                'filter' => Estacion::model()->getAllEstacionMovil()
            ),






            array
            (
                'name'=>'fecha_salida',
                'value' => 'date("d-m-Y", strtotime($data->fecha_salida))'
            ),
            array
            (
                'name'=>'hora_salida',
                'value' => 'date("H:i", strtotime($data->hora_salida))'
            ),
//            array
//            (
//                'name'=>'fecha_entrega',
//                'value' => 'Viajes::model()->getFecha($data->fecha_entrega)'
//            ),
//            array
//            (
//                'name'=>'hora_entrega',
//                'value' => 'date("H:i", strtotime($data->hora_entrega))'
//            ),
            array
            (
                'class'=>'NCButtonColumn',
                'header'=>'Acciones',
                'template'=>'<div class="buttonsWraper">{view}</div>'
            ),
        );
    }
    public function adminSearch3()
    {
        return array
        (
            array
            (
                'name' => 'id_solicitudes',
                'value' => 'Clientes::model()->getClienteViajes($data->id_solicitudes)',
                'filter' => Clientes::model()->getAllClientesViajes(),
                'type' => 'raw'
            ),
            array
            (
                'name' => 'id_responsable',
                'value' => 'Personal::model()->getPersonal($data->id_responsable)',
                'filter' => Personal::model()->getAllPersonal()
            ),
            array
            (
                'name' => 'id_estacion',
                'value' => 'Estacion::model()->getEstacion($data->id_estacion)',
                'filter' => Estacion::model()->getAllEstacionMovil()
            ),
            array
            (
                'name'=>'fecha_salida',
                'value' => 'date("d-m-Y", strtotime($data->fecha_salida))'
            ),
            array
            (
                'name'=>'hora_salida',
                'value' => 'date("H:i", strtotime($data->hora_salida))'
            ),
//            array
//            (
//                'name'=>'fecha_entrega',
//                'value' => 'Viajes::model()->getFecha($data->fecha_entrega)'
//            ),
//            array
//            (
//                'name'=>'hora_entrega',
//                'value' => 'date("H:i", strtotime($data->hora_entrega))'
//            ),
            array
            (
                'class'=>'NCButtonColumn',
                'header'=>'Acciones',
                'template'=>'<div class="buttonsWraper">{view}</div>'
            ),
        );
    }
}
