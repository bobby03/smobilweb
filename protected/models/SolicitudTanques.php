<?php

/**
 * This is the model class for table "solicitud_tanques".
 *
 * The followings are the available columns in table 'solicitud_tanques':
 * @property integer $id
 * @property integer $id_solicitud
 * @property integer $id_tanque
 * @property integer $id_domicilio
 * @property integer $id_cepas
 * @property integer $cantidad_cepas
 *
 * The followings are the available model relations:
 * @property Solicitudes $idSolicitud
 * @property Tanque $idTanque
 * @property ClientesDomicilio $idDomicilio
 * @property Cepa $idCepas
 */
class SolicitudTanques extends SMActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'solicitud_tanques';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_solicitud, id_tanque, id_domicilio, id_cepas, cantidad_cepas', 'required'),
			array('id_solicitud, id_tanque, id_domicilio, id_cepas, cantidad_cepas', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_solicitud, id_tanque, id_domicilio, id_cepas, cantidad_cepas', 'safe', 'on'=>'search'),
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
			'idSolicitud' => array(self::BELONGS_TO, 'Solicitudes', 'id_solicitud'),
			'idTanque' => array(self::BELONGS_TO, 'Tanque', 'id_tanque'),
			'idDomicilio' => array(self::BELONGS_TO, 'ClientesDomicilio', 'id_domicilio'),
			'idCepas' => array(self::BELONGS_TO, 'Cepa', 'id_cepas'),
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
			'id_tanque' => 'Id Tanque',
			'id_domicilio' => 'Id Domicilio',
			'id_cepas' => 'Id Cepas',
			'cantidad_cepas' => 'Cantidad Cepas',
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
		$criteria->compare('id_tanque',$this->id_tanque);
		$criteria->compare('id_domicilio',$this->id_domicilio);
		$criteria->compare('id_cepas',$this->id_cepas);
		$criteria->compare('cantidad_cepas',$this->cantidad_cepas);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SolicitudTanques the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
