<?php

/**
 * This is the model class for table "solicitudes_viaje".
 *
 * The followings are the available columns in table 'solicitudes_viaje':
 * @property integer $id
 * @property integer $id_personal
 * @property integer $id_viaje
 * @property integer $id_solicitud
 *
 * The followings are the available model relations:
 * @property Personal $idPersonal
 * @property Viajes $idViaje
 * @property Solicitudes $idSolicitud
 */
class SolicitudesViaje extends SMActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'solicitudes_viaje';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_personal, id_viaje, id_solicitud', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_personal, id_viaje, id_solicitud', 'safe', 'on'=>'search'),
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
			'idPersonal' => array(self::BELONGS_TO, 'Personal', 'id_personal'),
			'idViaje' => array(self::BELONGS_TO, 'Viajes', 'id_viaje'),
			'idSolicitud' => array(self::BELONGS_TO, 'Solicitudes', 'id_solicitud'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_personal' => 'Id Personal',
			'id_viaje' => 'ID de viaje',
			'id_solicitud' => 'Id Solicitud',
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
		$criteria->compare('id_personal',$this->id_personal);
		$criteria->compare('id_viaje',$this->id_viaje);
		$criteria->compare('id_solicitud',$this->id_solicitud);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SolicitudesViaje the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public function getpersonal($rol)
        {
            $personal = Personal::model()->findAll("id_rol = $rol AND activo=1");
            $return = array();
            foreach($personal as $data)
                $return[$data->id] = $data->nombre.' '.$data->apellido;
            return isset($return)?$return:null; 
        }
}
