<?php

/**
 * This is the model class for table "camp_tanque".
 *
 * The followings are the available columns in table 'camp_tanque':
 * @property integer $id
 * @property integer $id_tanque
 * @property integer $id_camp_sensado
 * @property integer $id_cepa
 *
 * The followings are the available model relations:
 * @property CampSensado $idCampSensado
 * @property Cepa $idCepa
 * @property Tanque $idTanque
 */
class CampTanque extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'camp_tanque';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_tanque, id_camp_sensado, id_cepa', 'required'),
			array('id_tanque, id_camp_sensado, id_cepa, cantidad', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_tanque, id_camp_sensado, id_cepa', 'safe', 'on'=>'search'),
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
			'idCampSensado' => array(self::BELONGS_TO, 'CampSensado', 'id_camp_sensado'),
			'idCepa' => array(self::BELONGS_TO, 'Cepa', 'id_cepa'),
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
			'id_camp_sensado' => 'Id Camp Sensado',
			'id_cepa' => 'Id Cepa',
			'cantidad' => 'cantidad de peces',
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
		$criteria->compare('id_camp_sensado',$this->id_camp_sensado);
		$criteria->compare('id_cepa',$this->id_cepa);
		$criteria->compare('cantidad',$this->cantidad);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CampTanque the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
