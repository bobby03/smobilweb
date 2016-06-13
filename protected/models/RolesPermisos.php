<?php

/**
 * This is the model class for table "roles_permisos".
 *
 * The followings are the available columns in table 'roles_permisos':
 * @property integer $id
 * @property integer $id_rol
 * @property integer $seccion
 * @property integer $alta
 * @property integer $baja
 * @property integer $consulta
 * @property integer $edicion
 * @property integer $activo
 *
 * The followings are the available model relations:
 * @property Roles $idRol
 */
class RolesPermisos extends SMActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'roles_permisos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_rol, seccion, alta, baja, consulta, edicion, activo', 'required'),
			array('id_rol, seccion, alta, baja, consulta, edicion, activo', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_rol, seccion, alta, baja, consulta, edicion, activo', 'safe', 'on'=>'search'),
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
			'idRol' => array(self::BELONGS_TO, 'Roles', 'id_rol'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_rol' => 'Id Rol',
			'seccion' => 'Seccion',
			'alta' => 'Alta',
			'baja' => 'Baja',
			'consulta' => 'Consulta',
			'edicion' => 'Edicion',
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
		$criteria->compare('id_rol',$this->id_rol);
		$criteria->compare('seccion',$this->seccion);
		$criteria->compare('alta',$this->alta);
		$criteria->compare('baja',$this->baja);
		$criteria->compare('consulta',$this->consulta);
		$criteria->compare('edicion',$this->edicion);
		$criteria->compare('activo',$this->activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RolesPermisos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
