<?php

/**
 * This is the model class for table "estacion".
 *
 * The followings are the available columns in table 'estacion':
 * @property integer $id
 * @property integer $tipo
 * @property string $identificador
 * @property integer $no_personal
 * @property string $marca
 * @property string $color
 * @property string $ubicacion
 * @property integer $disponible
 * @property integer $activo
 *
 * The followings are the available model relations:
 * @property Tanque[] $tanques
 */
class Estacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'estacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipo, identificador, no_personal, marca, color, ubicacion, disponible, activo', 'required'),
			array('id, tipo, no_personal, disponible, activo', 'numerical', 'integerOnly'=>true),
			array('identificador, marca, color, ubicacion', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tipo, identificador, no_personal, marca, color, ubicacion, disponible, activo', 'safe', 'on'=>'search'),
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
			'tanques' => array(self::HAS_MANY, 'Tanque', 'id_estacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tipo' => 'Tipo',
			'identificador' => 'Identificador',
			'no_personal' => 'No Personal',
			'marca' => 'Marca',
			'color' => 'Color',
			'ubicacion' => 'Ubicacion',
			'disponible' => 'Disponible',
			'activo' => 'Activo',
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
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('identificador',$this->identificador,true);
		$criteria->compare('no_personal',$this->no_personal);
		$criteria->compare('marca',$this->marca,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('ubicacion',$this->ubicacion,true);
		$criteria->compare('disponible',$this->disponible);
		$criteria->compare('activo',$this->activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Estacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function getAllTipo()
        {
            return array
            (
                '1' => 'Movil',
                '2' => 'Fíja',
            );
        }
}
