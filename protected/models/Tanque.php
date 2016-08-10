<?php

/**
 * This is the model class for table "tanque".
 *
 * The followings are the available columns in table 'tanque':
 * @property integer $id
 * @property integer $id_estacion
 * @property integer $capacidad
 * @property string $nombre
 * @property integer $status
 * @property integer $activo
 *
 * The followings are the available model relations:
 * @property EscalonViajeUbicacion[] $escalonViajeUbicacions
 * @property Registro[] $registros
 * @property SolicitudTanques[] $solicitudTanques
 * @property Estacion $idEstacion
 */
class Tanque extends SMActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tanque';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_estacion, capacidad, nombre, status', 'required'),
			array('id_estacion, capacidad, status, activo', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_estacion, capacidad, nombre, status, activo', 'safe', 'on'=>'search'),
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
			'escalonViajeUbicacions' => array(self::HAS_MANY, 'EscalonViajeUbicacion', 'id_tanque'),
			'registros' => array(self::HAS_MANY, 'Registro', 'id_tanque'),
			'solicitudTanques' => array(self::HAS_MANY, 'SolicitudTanques', 'id_tanque'),
			'idEstacion' => array(self::BELONGS_TO, 'Estacion', 'id_estacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_estacion' => 'Estacion',
			'capacidad' => 'Capacidad (Litros)',
			'nombre' => 'Nombre',
			'status' => 'Status',
			'activo' => 'Activo'
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
		$criteria->compare('id_estacion',$this->id_estacion);
		$criteria->compare('capacidad',$this->capacidad);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('activo',$this->activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tanque the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function getAllStatus()
        {
            $return = array
            (
                '1' => 'Disponible',
                '2' => 'Ocupado'
            );
            return $return;
        }
        public function getStatus($id)
        {
            switch ($id)
            {
                case 1: return 'Disponible'; break;
                case 2: return 'Ocupado'; break;
            }
        }
        public function getAllActivo()
        {
            $return = array
            (
                '1' => 'Sí',
                '2' => 'No',
            );
            return $return;
        }
        public function getActivo($id)
        {
            switch ($id)
            {
                case 1: return 'Sí'; break;
                case 2: return 'No'; break;
            }
        }
        public function getTanque($id)
        {
            $tanque = Tanque::model()->findByPk($id);
            return $tanque->nombre;
        }
        
}
