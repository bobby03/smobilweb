<?php

class Personal extends SMActiveRecord
{
	public function tableName()
	{
		return 'personal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, nombre, apellido, tel, rfc, domicilio, id_rol, correo, puesto', 'required'),
			array('id, id_rol', 'numerical', 'integerOnly'=>true),
			array('nombre, apellido', 'length', 'max'=>50),
			array('tel', 'length', 'max'=>12),
			array('rfc', 'length', 'max'=>15),
			array('domicilio', 'length', 'max'=>150),
			array('correo, puesto', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, apellido, tel, rfc, domicilio, id_rol, correo, puesto', 'safe', 'on'=>'search'),
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
			'solicitudesViajes' => array(self::HAS_MANY, 'SolicitudesViaje', 'id_personal'),
			'viajes' => array(self::HAS_MANY, 'Viajes', 'id_responsable'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'apellido' => 'Apellido',
			'tel' => 'Tel',
			'rfc' => 'Rfc',
			'domicilio' => 'Domicilio',
			'id_rol' => 'Id Rol',
			'correo' => 'Correo',
			'puesto' => 'Puesto',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('rfc',$this->rfc,true);
		$criteria->compare('domicilio',$this->domicilio,true);
		$criteria->compare('id_rol',$this->id_rol);
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('puesto',$this->puesto,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Personal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
