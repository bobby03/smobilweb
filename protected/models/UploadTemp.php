<?php

/**
 * This is the model class for table "uploadTemp".
 *
 * The followings are the available columns in table 'uploadTemp':
 * @property integer $id
 * @property integer $id_tanque
 * @property integer $id_escalon_viaje_ubicacion
 * @property integer $ct
 * @property double $ox
 * @property double $ph
 * @property double $t2
 * @property double $ec
 * @property double $od
 * @property double $orp
 * @property integer $alerta
 *
 * The followings are the available model relations:
 * @property Tanque $idTanque
 * @property EscalonViajeUbicacion $idEscalonViajeUbicacion
 */
class UploadTemp extends SMActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'uploadTemp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_tanque, id_escalon_viaje_ubicacion', 'required'),
			array('id_tanque, id_escalon_viaje_ubicacion, ct, alerta', 'numerical', 'integerOnly'=>true),
			array('ox, ph, t2, ec, od, orp', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_tanque, id_escalon_viaje_ubicacion, ct, ox, ph, t2, ec, od, orp, alerta', 'safe', 'on'=>'search'),
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
			'idEscalonViajeUbicacion' => array(self::BELONGS_TO, 'EscalonViajeUbicacion', 'id_escalon_viaje_ubicacion'),
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
			'id_escalon_viaje_ubicacion' => 'Id Escalon Viaje Ubicacion',
			'ct' => 'Ct',
			'ox' => 'Ox',
			'ph' => 'Ph',
			't2' => 'T2',
			'ec' => 'Ec',
			'od' => 'Od',
			'orp' => 'Orp',
			'alerta' => 'Alerta',
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
		$criteria->compare('id_escalon_viaje_ubicacion',$this->id_escalon_viaje_ubicacion);
		$criteria->compare('ct',$this->ct);
		$criteria->compare('ox',$this->ox);
		$criteria->compare('ph',$this->ph);
		$criteria->compare('t2',$this->t2);
		$criteria->compare('ec',$this->ec);
		$criteria->compare('od',$this->od);
		$criteria->compare('orp',$this->orp);
		$criteria->compare('alerta',$this->alerta);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UploadTemp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
