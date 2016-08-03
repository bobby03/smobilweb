<?php

/**
 * This is the model class for table "personal".
 *
 * The followings are the available columns in table 'personal':
 * @property integer $id
 * @property string $nombre
 * @property string $apellido
 * @property string $tel
 * @property string $rfc
 * @property string $domicilio
 * @property integer $id_rol
 * @property string $correo
 * @property string $puesto
 *
 * The followings are the available model relations:
 * @property SolicitudesViaje[] $solicitudesViajes
 * @property Viajes[] $viajes
 */
class Personal extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'personal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, apellido, tel, rfc, domicilio, id_rol, correo, puesto', 'required','message'=>'Campo obligatorio'),
			array('id, id_rol', 'numerical', 'integerOnly'=>true),
			array('correo','email','message'=>'No tiene formato de email'),
			array('nombre, apellido', 'length', 'max'=>50),
			array('tel', 'length', 'max'=>12),
			array('rfc', 'length', 'max'=>15),
			array('domicilio', 'length', 'max'=>150),
			array('correo, puesto', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, apellido, tel, rfc, domicilio, id_rol, correo, puesto', 'safe', 'on'=>'search'),
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
			'solicitudesViajes' => array(self::HAS_MANY, 'SolicitudesViaje', 'id_personal'),
			'viajes' => array(self::HAS_MANY, 'Viajes', 'id_responsable'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'apellido' => 'Apellido',
			'domicilio' => 'Domicilio',
			'id_rol' => 'Rol',
			'puesto' => 'Puesto',
			'correo' => 'Correo electrónico',
			'rfc' => 'RFC',
			'tel' => 'Teléfono',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('rfc',$this->rfc,true);
		$criteria->compare('domicilio',$this->domicilio,true);
		$criteria->compare('id_rol',$this->id_rol);
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('puesto',$this->puesto,true);
		/*$criteria->addcondition("(nombre LIKE '%".$this->nombre."%' OR apellido LIKE '%".$this->nombre.
                                "%' OR tel LIKE '%".$this->nombre.
                                "%' OR rfc LIKE '%".$this->nombre.
                                "%' OR domicilio LIKE '%".$this->nombre.
                                "%' OR id_rol LIKE '%".$this->nombre.
                                "%' OR correo LIKE '%".$this->nombre.
                                "%' OR puesto LIKE '%".$this->nombre."%')");*/


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	 public function getSearchPersonal(){
            return array('1'=>'Nombre',
                         '2'=>'Apellido',
                        /* '3'=>'Teléfono',*/
                         '4'=>'RFC'
                        /* '5'=>'Domicilio',
                         '6'=>'Rol',
                         '7'=>'Correo',
                         '8'=>'Puesto'*/);
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Personal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function getAllPersonal()
        {
            $personal = Personal::model()->findAll();
            $return = array();
            foreach($personal as $data)
                $return[$data->id] = $data->nombre.' '.$data->apellido;
            return $return;
        }
        public function getPersonal($id)
        {
            $personal = $this->findByPk($id);
            return $personal->nombre.' '.$personal->apellido;
        }
        public function getChofer($id)
        {
        	$chofer = Yii::app()->db->createCommand()
        		->select('per.nombre, per.apellido')
        		->from('solicitudes_viaje as solv')
        		->join('personal as per','per.id = solv.id_personal')
        		->where("solv.id_viaje = ".$id)
        		->andWhere("per.id_rol = 1")
        		->queryRow();
    		return $chofer['nombre'].' '.$chofer['apellido'];
        }
        public function getRolPersonal($id)
        {
            $personal = Personal::model()->findByPk($id);
            return $personal->id_rol;
        }
        public function adminSearch()
        {
            return array
            (
                'nombre',
                'apellido',
                
                
               // 'domicilio',
                array
                (
                    'name' => 'id_rol',
                    'value' => 'Roles::model()->getRol($data->id_rol)',
                    'filter' => Roles::model()->getAllRoles()
                ),
                'puesto', 
                'correo',
                'rfc',
                'tel',
                array
                (
                    'class'=>'NCButtonColumn',
                    'header'=>'Operaciones',
                    'template'=>'<div class="buttonsWraper">{view} {update} {delete}</div>'
		)
            );
        }
}
