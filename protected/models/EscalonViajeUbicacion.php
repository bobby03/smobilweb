<?php

/**
 * This is the model class for table "escalon_viaje_ubicacion".
 *
 * The followings are the available columns in table 'escalon_viaje_ubicacion':
 * @property integer $id
 * @property integer $id_estacion
 * @property integer $id_viaje
 * @property string $ubicacion
 * @property string $fecha
 * @property string $hora
 *
 * The followings are the available model relations:
 * @property Estacion $idEstacion
 * @property Viajes $idViaje
 */
class EscalonViajeUbicacion extends SMActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'escalon_viaje_ubicacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_estacion, id_viaje, ubicacion, fecha, hora', 'required'),
			array('id_estacion, id_viaje', 'numerical', 'integerOnly'=>true),
			array('ubicacion', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_estacion, id_viaje, ubicacion, fecha, hora', 'safe', 'on'=>'search'),
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
			'idEstacion' => array(self::BELONGS_TO, 'Estacion', 'id_estacion'),
			'idViaje' => array(self::BELONGS_TO, 'Viajes', 'id_viaje'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_estacion' => 'Id Estacion',
			'id_viaje' => 'Id Viaje',
			'ubicacion' => 'Ubicacion',
			'fecha' => 'Fecha',
			'hora' => 'Hora',
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
		$criteria->compare('id_estacion',$this->id_estacion);
		$criteria->compare('id_viaje',$this->id_viaje);
		$criteria->compare('ubicacion',$this->ubicacion,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('hora',$this->hora,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EscalonViajeUbicacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
