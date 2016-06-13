<?php

/**
 * This is the model class for table "viajes".
 *
 * The followings are the available columns in table 'viajes':
 * @property integer $id
 * @property integer $id_clientes
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
			array('id_clientes, id_responsable, status, fecha_salida, hora_salida, fecha_entrega, hora_entrega', 'required'),
			array('id, id_clientes, id_responsable', 'numerical', 'integerOnly'=>true),
			array('status', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_clientes, id_responsable, status, fecha_salida, hora_salida, fecha_entrega, hora_entrega', 'safe', 'on'=>'search'),
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
			'idClientes' => array(self::BELONGS_TO, 'Clientes', 'id_clientes'),
			'idResponsable' => array(self::BELONGS_TO, 'Personal', 'id_responsable'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_clientes' => 'Id Clientes',
			'id_responsable' => 'Id Responsable',
			'status' => 'Status',
			'fecha_salida' => 'Fecha Salida',
			'hora_salida' => 'Hora Salida',
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
		$criteria->compare('id_clientes',$this->id_clientes);
		$criteria->compare('id_responsable',$this->id_responsable);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('fecha_salida',$this->fecha_salida,true);
		$criteria->compare('hora_salida',$this->hora_salida,true);
		$criteria->compare('fecha_entrega',$this->fecha_entrega,true);
		$criteria->compare('hora_entrega',$this->hora_entrega,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
}
