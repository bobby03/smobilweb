<?php

/**
 * This is the model class for table "pedidos".
 *
 * The followings are the available columns in table 'pedidos':
 * @property integer $id
 * @property integer $id_solicitud
 * @property integer $id_especie
 * @property integer $id_cepa
 * @property integer $id_direccion
 * @property integer $tanques
 */
class Pedidos extends SMActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pedidos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_solicitud, id_especie, id_cepa, id_direccion, tanques', 'required'),
			array('id_solicitud, id_especie, id_cepa, id_direccion, tanques', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_solicitud, id_especie, id_cepa, id_direccion, tanques', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_solicitud' => 'Id Solicitud',
			'id_especie' => 'Id Especie',
			'id_cepa' => 'Id Cepa',
			'id_direccion' => 'Id Direccion',
			'tanques' => 'Tanques',
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
		$criteria->compare('id_solicitud',$this->id_solicitud);
		$criteria->compare('id_especie',$this->id_especie);
		$criteria->compare('id_cepa',$this->id_cepa);
		$criteria->compare('id_direccion',$this->id_direccion);
		$criteria->compare('tanques',$this->tanques);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pedidos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
