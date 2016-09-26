<?php

/**
 * This is the model class for table "roles".
 *
 * The followings are the available columns in table 'roles':
 * @property integer $id
 * @property string $nombre_rol
 * @property integer $activo
 *
 * The followings are the available model relations:
 * @property Personal[] $personals
 * @property RolesPermisos[] $rolesPermisoses
 */
class Roles extends SMActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'roles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(



         array('nombre_rol','required','message'=>'Debe especificar un nombre de rol'),

         array(
                'nombre_rol',
                'unique',
                'message'=>'Ya existe un Rol con ese nombre'),

         array(
                'nombre_rol',
                'length',
                'max'=>50),


			
			array('activo', 'numerical', 'integerOnly'=>true),
			
        
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre_rol, activo', 'safe', 'on'=>'search'),
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
			'personals' => array(self::HAS_MANY, 'Personal', 'id_rol'),
			'rolesPermisoses' => array(self::HAS_MANY, 'RolesPermisos', 'id_rol'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre_rol' => 'Rol',
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
	public function search($act)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('nombre_rol',$this->nombre_rol,true);
		$criteria->compare('activo',$this->activo);
                $criteria->addCondition("activo=$act");
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>15,
                    ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Roles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function getAllRoles()
        {
            $roles = Roles::model()->findAllBySql('SELECT * FROM roles WHERE activo = 1');
            $return = array();
            foreach($roles as $data)
                $return[$data->id] = $data->nombre_rol;
            return $return;
        }
        public function getRol($id)
        {
            $rol = $this->findByPk($id);
            if(isset($rol->nombre_rol))
                return $rol->nombre_rol;
            else
        	return 'sin rol';
        }
        public function getSeccion($id)
        {
            switch($id)
            {
                case 1: return 'Solicitudes'; break;
                case 2: return 'Viajes'; break;
                case 3: return 'Estacion'; break;
                case 4: return 'Siembra'; break;
                case 5: return 'Granja'; break;
                case 6: return 'Clientes'; break;
                case 7: return 'Usuarios'; break;
                case 8: return 'Personal'; break;
                case 9: return 'Roles'; break;
                case 10: return 'Especie'; break;
                case 11: return 'Cepa'; break;
                case 11: return 'Dashboard'; break;
            }
        }
        
        public function adminSearch()
        {
            return array
            (
                'nombre_rol',
                array
                (
                    'class'=>'NCButtonColumn',
                    'header'=>'Acciones',
                    'template'=>'<div class="buttonsWraper">{update} {delete}</div>'
		)
            );
        }
        public function adminSearchBorrados()
        {
            return array
            (
                'nombre_rol',
                array
                (
                    'class'=>'NCButtonColumn',
                    'header'=>'Acciones',
                    'template'=>'<div class="buttonsWraper">{reactivar}</div>',
                    'buttons' => array
                    (
                        'reactivar' => array
                        (
                            'imageUrl'=> Yii::app()->baseUrl . '/images/reactivar.svg',
                            'options'=>array('id'=>'_iglu','title'=>'', 'class' => 'iglu'),
                            'url' => 'Yii::app()->createUrl("roles/reactivar", array("id"=>$data->id))',
                        )
                    )
                )
            );
        }
}
