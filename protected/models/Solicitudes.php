<?php

/**
 * This is the model class for table "solicitudes".
 *
 * The followings are the available columns in table 'solicitudes':
 * @property integer $id
 * @property integer $id_clientes
 * @property string $codigo
 * @property string $fecha_alta
 * @property string $hora_alta
 * @property string $fecha_estimada
 * @property string $hora_estimada
 * @property string $fecha_entrega
 * @property string $hora_entrega
 * @property string $notas
 *
 * The followings are the available model relations:
 * @property SolicitudTanques[] $solicitudTanques
 * @property Clientes $idClientes
 * @property SolicitudesViaje[] $solicitudesViajes
 */
class Solicitudes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'solicitudes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' id_clientes, codigo, fecha_alta, hora_alta, fecha_estimada, hora_estimada, fecha_entrega, hora_entrega, notas', 'required'),
			array('id, id_clientes', 'numerical', 'integerOnly'=>true),
			array('codigo', 'length', 'max'=>50),
			array('notas', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_clientes, codigo, fecha_alta, hora_alta, fecha_estimada, hora_estimada, fecha_entrega, hora_entrega, notas', 'safe', 'on'=>'search'),
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
			'solicitudTanques' => array(self::HAS_MANY, 'SolicitudTanques', 'id_solicitud'),
			'idClientes' => array(self::BELONGS_TO, 'Clientes', 'id_clientes'),
			'solicitudesViajes' => array(self::HAS_MANY, 'SolicitudesViaje', 'id_solicitud'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_clientes' => 'Cliente',
			'codigo' => 'Codigo',
			'fecha_alta' => 'Fecha Alta',
			'hora_alta' => 'Hora Alta',
			'fecha_estimada' => 'Fecha Estimada',
			'hora_estimada' => 'Hora Estimada',
			'fecha_entrega' => 'Fecha Entrega',
			'hora_entrega' => 'Hora Entrega',
			'notas' => 'Notas',
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
		$criteria->compare('id_clientes',$this->id_clientes);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('fecha_alta',$this->fecha_alta,true);
		$criteria->compare('hora_alta',$this->hora_alta,true);
		$criteria->compare('fecha_estimada',$this->fecha_estimada,true);
		$criteria->compare('hora_estimada',$this->hora_estimada,true);
		$criteria->compare('fecha_entrega',$this->fecha_entrega,true);
		$criteria->compare('hora_entrega',$this->hora_entrega,true);
		$criteria->compare('notas',$this->notas,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Solicitudes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
