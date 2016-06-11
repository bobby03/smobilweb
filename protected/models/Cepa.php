<?php

/**
 * This is the model class for table "cepa".
 *
 * The followings are the available columns in table 'cepa':
 * @property integer $id
 * @property integer $id_especie
 * @property string $nombre_cepa
 * @property double $temp_min
 * @property double $temp_max
 * @property double $ph_min
 * @property double $ph_max
 * @property double $ox_min
 * @property double $ox_max
 * @property integer $cantidad
 * @property double $cond_min
 * @property double $cond_max
 * @property double $orp_min
 * @property double $orp_max
 *
 * The followings are the available model relations:
 * @property Especie $idEspecie
 * @property SolicitudTanques[] $solicitudTanques
 */
class Cepa extends SMActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cepa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, id_especie, nombre_cepa, temp_min, temp_max, ph_min, ph_max, ox_min, ox_max, cantidad, cond_min, cond_max, orp_min, orp_max', 'required'),
			array('id, id_especie, cantidad', 'numerical', 'integerOnly'=>true),
			array('temp_min, temp_max, ph_min, ph_max, ox_min, ox_max, cond_min, cond_max, orp_min, orp_max', 'numerical'),
			array('nombre_cepa', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_especie, nombre_cepa, temp_min, temp_max, ph_min, ph_max, ox_min, ox_max, cantidad, cond_min, cond_max, orp_min, orp_max', 'safe', 'on'=>'search'),
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
			'idEspecie' => array(self::BELONGS_TO, 'Especie', 'id_especie'),
			'solicitudTanques' => array(self::HAS_MANY, 'SolicitudTanques', 'id_cepas'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_especie' => 'Id Especie',
			'nombre_cepa' => 'Nombre Cepa',
			'temp_min' => 'Temp Min',
			'temp_max' => 'Temp Max',
			'ph_min' => 'Ph Min',
			'ph_max' => 'Ph Max',
			'ox_min' => 'Ox Min',
			'ox_max' => 'Ox Max',
			'cantidad' => 'Cantidad',
			'cond_min' => 'Cond Min',
			'cond_max' => 'Cond Max',
			'orp_min' => 'Orp Min',
			'orp_max' => 'Orp Max',
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
		$criteria->compare('id_especie',$this->id_especie);
		$criteria->compare('nombre_cepa',$this->nombre_cepa,true);
		$criteria->compare('temp_min',$this->temp_min);
		$criteria->compare('temp_max',$this->temp_max);
		$criteria->compare('ph_min',$this->ph_min);
		$criteria->compare('ph_max',$this->ph_max);
		$criteria->compare('ox_min',$this->ox_min);
		$criteria->compare('ox_max',$this->ox_max);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('cond_min',$this->cond_min);
		$criteria->compare('cond_max',$this->cond_max);
		$criteria->compare('orp_min',$this->orp_min);
		$criteria->compare('orp_max',$this->orp_max);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cepa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}