<?php

/**
 * This is the model class for table "registro_camp".
 *
 * The followings are the available columns in table 'registro_camp':
 * @property integer $id
 * @property integer $id_tanque
 * @property integer $id_camp_sensado
 * @property integer $id_estacion
 * @property string $fecha
 * @property string $hora
 * @property double $temp
 * @property double $ph
 * @property double $ox
 * @property double $cond
 * @property double $orp
 * @property integer $ct
 * @property integer $alerta
 *
 * The followings are the available model relations:
 * @property CampSensado $idCampSensado
 * @property Estacion $idEstacion
 * @property Tanque $idTanque
 */
class RegistroCamp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'registro_camp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_tanque, id_camp_sensado, id_estacion, fecha, hora, temp, ph, ox, cond, orp, ct, alerta', 'required'),
			array('id_tanque, id_camp_sensado, id_estacion, ct, alerta', 'numerical', 'integerOnly'=>true),
			array('temp, ph, ox, cond, orp', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_tanque, id_camp_sensado, id_estacion, fecha, hora, temp, ph, ox, cond, orp, ct, alerta', 'safe', 'on'=>'search'),
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
			'idEstacion' => array(self::BELONGS_TO, 'Estacion', 'id_estacion'),
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
			'id_estacion' => 'Id Estacion',
			'fecha' => 'Fecha',
			'hora' => 'Hora',
			'temp' => 'Temp',
			'ph' => 'Ph',
			'ox' => 'Ox',
			'cond' => 'Cond',
			'orp' => 'Orp',
			'ct' => 'Ct',
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
		$criteria->compare('id_camp_sensado',$this->id_camp_sensado);
		$criteria->compare('id_estacion',$this->id_estacion);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('hora',$this->hora,true);
		$criteria->compare('temp',$this->temp);
		$criteria->compare('ph',$this->ph);
		$criteria->compare('ox',$this->ox);
		$criteria->compare('cond',$this->cond);
		$criteria->compare('orp',$this->orp);
		$criteria->compare('ct',$this->ct);
		$criteria->compare('alerta',$this->alerta);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RegistroCamp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
