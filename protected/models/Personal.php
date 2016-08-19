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
			array('nombre, apellido, tel, id_rol, correo, puesto', 'required','message'=>'Campo obligatorio'),
			array('id, id_rol', 'numerical', 'integerOnly'=>true),
			array('correo','email','message'=>'No tiene formato de email'),
            array('rfc', 'unique', 'message'=>'Ya existe un empleado con ese RFC'),
            array('correo', 'unique', 'message'=>'Ya existe un empleado con ese correo'),
			array('nombre, apellido', 'length', 'max'=>50),
			
			
			
		/*	array('domicilio', 'length', 'max'=>150),*/
			array('correo, puesto', 'length', 'max'=>100),

			array('rfc','required','message'=>'RFC No Valido'),
			array('rfc',
				  	'match',
			    	'pattern'=>"/^(([A-Za-z]){4})([0-9]{6})(([A-Z]|[a-z]|[0-9]){3})$/",
					'message'=>'RFC No Valido'),


			array('tel','required','message'=>'Teléfono no Valido'),
			array('tel',
				  'length',
				   'is'=>14,
				   'message'=>'Teléfono no Valido'),

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
			'nombre' => 'Nombre(s)',
			'apellido' => 'Apellido(s)',
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
	public function search($flag)
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
		$criteria->addcondition("activo = $flag");
		return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination'=>array
                    (
                        'pageSize'=>15,
                    )
		));
	}
	 public function getSearchPersonal(){
            return array('1'=>'Nombre',
                         '2'=>'Apellido',
                        /* '3'=>'Teléfono',*/
                         '3'=>'RFC'
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
            $personal = Personal::model()->findAll('activo = 1');
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
            return $personal['id_rol'];
        }
        public function getUser($id)
        {
                    $user = Usuarios::model()->findByAttributes(array('tipo_usr'=>2,'id_usr'=>$id));
                    if(!isset($user->usuario)){
                    	return '--------';
                    }else{
                    return $user->usuario;
                }
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
                   'name' => 'Usuario',
                	'value' => 'Personal::model()->getUser($data->id)',
                ),
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
                    'template'=>'<div class="buttonsWraper">{update} {delete}</div>'
		)
            );
        }
        public function adminSearchVacios()
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
                    'template'=>'<div class="buttonsWraper">{reactivar}</div>',
                    'buttons' => array
                    (
                        'reactivar' => array
                        (
                            'imageUrl'=> Yii::app()->baseUrl . '/images/reactivar.svg',
                            'options'=>array('id'=>'_iglu','title'=>'', 'class' => 'iglu'),
                            'url' => 'Yii::app()->createUrl("personal/reactivar", array("id"=>$data->id))',
                        )
                    )
		)
            );
        }
}
