<?php

/**
 * This is the model class for table "registro".
 *
 * The followings are the available columns in table 'registro':
 * @property integer $id
 * @property integer $id_tanque
 * @property integer $id_viaje
 * @property integer $id_estacion
 * @property string $fecha
 * @property string $hora
 * @property double $temp
 * @property double $ph
 * @property double $ox
 * @property double $cond
 * @property double $orp
 *
 * The followings are the available model relations:
 * @property Tanque $idTanque
 */
class Registro extends SMActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'registro';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_tanque, id_viaje, id_estacion, fecha, hora, temp, ph, ox, cond, orp', 'required'),
			array('id_tanque, id_viaje, id_estacion', 'numerical', 'integerOnly'=>true),
			array('temp, ph, ox, cond, orp', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_tanque, id_viaje, id_estacion, fecha, hora, temp, ph, ox, cond, orp', 'safe', 'on'=>'search'),
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
			'idTanque' => array(self::BELONGS_TO, 'Tanque', 'id_tanque'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_tanque' => 'Id Tanque',
			'id_viaje' => 'Id Viaje',
			'id_estacion' => 'Id Estacion',
			'fecha' => 'Fecha',
			'hora' => 'Hora',
			'temp' => 'Temp',
			'ph' => 'Ph',
			'ox' => 'Ox',
			'cond' => 'Cond',
			'orp' => 'Orp',
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
		$criteria->compare('id_tanque',$this->id_tanque);
		$criteria->compare('id_viaje',$this->id_viaje);
		$criteria->compare('id_estacion',$this->id_estacion);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('hora',$this->hora,true);
		$criteria->compare('temp',$this->temp);
		$criteria->compare('ph',$this->ph);
		$criteria->compare('ox',$this->ox);
		$criteria->compare('cond',$this->cond);
		$criteria->compare('orp',$this->orp);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Registro the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
