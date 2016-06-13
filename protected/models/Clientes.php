<?php

/**
 * This is the model class for table "clientes".
 *
 * The followings are the available columns in table 'clientes':
 * @property integer $id
 * @property string $nombre_empresa
 * @property string $nombre_contacto
 * @property string $apellido_contacto
 * @property string $correo
 * @property string $rfc
 * @property string $tel
 *
 * The followings are the available model relations:
 * @property ClientesDomicilio[] $clientesDomicilios
 * @property Solicitudes[] $solicitudes
 * @property Viajes[] $viajes
 */
class Clientes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'clientes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_empresa, nombre_contacto, apellido_contacto, correo, rfc, tel', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('nombre_empresa', 'length', 'max'=>150),
			array('nombre_contacto, apellido_contacto', 'length', 'max'=>50),
			array('correo', 'length', 'max'=>100),
			array('rfc', 'length', 'max'=>15),
			array('tel', 'length', 'max'=>12),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre_empresa, nombre_contacto, apellido_contacto, correo, rfc, tel', 'safe', 'on'=>'search'),
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
			'clientesDomicilios' => array(self::HAS_MANY, 'ClientesDomicilio', 'id_cliente'),
			'solicitudes' => array(self::HAS_MANY, 'Solicitudes', 'id_clientes'),
			'viajes' => array(self::HAS_MANY, 'Viajes', 'id_clientes'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre_empresa' => 'Nombre Empresa',
			'nombre_contacto' => 'Nombre Contacto',
			'apellido_contacto' => 'Apellido Contacto',
			'correo' => 'Correo',
			'rfc' => 'Rfc',
			'tel' => 'Tel',
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
		$criteria->compare('nombre_empresa',$this->nombre_empresa,true);
		$criteria->compare('nombre_contacto',$this->nombre_contacto,true);
		$criteria->compare('apellido_contacto',$this->apellido_contacto,true);
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('rfc',$this->rfc,true);
		$criteria->compare('tel',$this->tel,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Clientes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
