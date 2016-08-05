<?php

/**
 * This is the model class for table "solicitudes".
 *
 * The followings are the available columns in table 'solicitudes':
 * @property integer $id
 * @property integer $id_clientes
 * @property string $codigo
 * @property string $fecha_alta
 * @property string $hora_alta
 * @property string $fecha_estimada
 * @property string $hora_estimada
 * @property string $fecha_entrega
 * @property string $hora_entrega
 * @property string $notas
 *
 * The followings are the available model relations:
 * @property SolicitudTanques[] $solicitudTanques
 * @property Clientes $idClientes
 * @property SolicitudesViaje[] $solicitudesViajes
 */
class Solicitudes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'solicitudes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_clientes', 'required'),
			array('id, id_clientes', 'numerical', 'integerOnly'=>true),
                        //array('codigo','unique','message'=>'Ya hay una solicitud con ese codigo'),
			array('codigo', 'length', 'max'=>50),
			array('notas', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_clientes, codigo, fecha_alta, hora_alta, fecha_estimada, hora_estimada, fecha_entrega, hora_entrega, notas', 'safe', 'on'=>'search'),
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
			'solicitudTanques' => array(self::HAS_MANY, 'SolicitudTanques', 'id_solicitud'),
			'idClientes' => array(self::BELONGS_TO, 'Clientes', 'id_clientes'),
			'solicitudesViajes' => array(self::HAS_MANY, 'SolicitudesViaje', 'id_solicitud'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_clientes' => 'Cliente',
			'codigo' => 'Codigo',
			'fecha_alta' => 'Fecha Alta',
			'hora_alta' => 'Hora Alta',
			'fecha_estimada' => 'Fecha Estimada',
			'hora_estimada' => 'Hora Estimada',
			'fecha_entrega' => 'Fecha Entrega',
			'hora_entrega' => 'Hora Entrega',
			'notas' => 'Notas',
		);
	}
public function getSearchSolicitud(){
            return array('1'=>'Cliente',
                         '2'=>'Codigo'/*,
                         '3'=>'Fecha Alta',
                         '4'=>'Hora Alta',
                         '5'=>'Fecha Estimada',
                         '6'=>'Hora fecha_estimada',
                         '7'=>'Fecha Entrega',
                         '8'=>'Hora Entrega',
                         '9'=>'Notas'*/);
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

		$criteria->select = '*';
		$criteria->condition = false;

		if($this->id_clientes!=''){
			$criteria->select = '*';
			$criteria->condition = "id_clientes = '".$this->id_clientes."'";
			
		}
		
		if($this->codigo!=''){	
			$criteria->select = '*';
			$criteria->condition = "codigo LIKE '%".$this->codigo."%'";
		}

		/*
		OR fecha_alta LIKE '%".$this->codigo.
                                "%' OR hora_alta LIKE '%".$this->codigo.
                                "%' OR fecha_estimada LIKE '%".$this->codigo.
                                "%' OR hora_estimada LIKE '%".$this->codigo.
                                "%' OR fecha_entrega LIKE '%".$this->codigo.
                                "%' OR hora_entrega LIKE '%".$this->codigo.
                                "%' OR notas LIKE '%".$this->codigo."%'*/


		/*$criteria->compare('id_clientes',$this->id_clientes);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('fecha_alta',$this->fecha_alta,true);
		$criteria->compare('hora_alta',$this->hora_alta,true);
		$criteria->compare('fecha_estimada',$this->fecha_estimada,true);
		$criteria->compare('hora_estimada',$this->hora_estimada,true);
		$criteria->compare('fecha_entrega',$this->fecha_entrega,true);
		$criteria->compare('hora_entrega',$this->hora_entrega,true);
		$criteria->compare('notas',$this->notas,true);*/
		
  
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));

	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Solicitudes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public function getFechaTabla($date)
    {
        if($date == null)
            return 'Sin fecha';
        else
            return date("d-m-Y", strtotime($date));
    }
    public function getHoraTabla($date)
    {
        if($date == null)
            return 'Sin hora';
        else
            return date("H:i", strtotime($date));
    }
    public function adminSearch()
    {
        return array
        (
            array
            (
                'name'=>'id_clientes',
                'value' => 'Clientes::model()->getCliente($data->id_clientes)',
                'filter'=> Clientes::model()->getAllClientes()
            ),
            'codigo',
            array
            (
                'name'=>'fecha_alta',
                'value' => 'date("d-m-Y", strtotime($data->fecha_alta))'
            ),
            array
            (
                'name'=>'hora_alta',
                'value' => 'date("H:i", strtotime($data->hora_alta))'
            ),
            array
            (
                'name'=>'fecha_estimada',
                'value' => 'Solicitudes::model()->getFechaTabla($data->fecha_estimada)'
            ),
            array
            (
                'name'=>'hora_estimada',
                'value' => 'Solicitudes::model()->getHoraTabla($data->hora_estimada)'
            ),
//            array
//            (
//                'name'=>'fecha_entrega',
//                'value' => 'date("d-m-Y", strtotime($data->fecha_entrega))'
//            ),
//            array
//            (
//                'name'=>'hora_entrega',
//                'value' => 'date("H:i", strtotime($data->hora_entrega))'
//            ),
//            'notas',
            array
            (
                'class'=>'NCButtonColumn',
                'header'=>'Acciones',
                'template'=>'<div class="buttonsWraper">{view} {update} {delete}</div>'
            )
        );
    }
}
