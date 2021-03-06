<?php

/**
 * This is the model class for table "clientes".
 *
 * The followings are the available columns in table 'clientes':
 * @property integer $id
 * @property string $nombre_empresa
 * @property string $nombre_contacto
 * @property string $apellido_contacto
 * @property string $correo
 * @property string $rfc
 * @property string $tel
 *
 * The followings are the available model relations:
 * @property ClientesDomicilio[] $clientesDomicilios
 * @property Solicitudes[] $solicitudes
 * @property Viajes[] $viajes
 */
class Clientes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'clientes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			array('nombre_empresa','required','message'=>'Este campo es obligatorio'),
			array(
				'nombre_empresa',
				'length',
				'min'=>5,
				'tooShort'=>'Minimo 5 caracteres',
				'max'=>150,
				'tooLong'=>'Maximo 150 caracteres'),

			array('nombre_contacto','required','message'=>'Este campo es obligatorio'),
			array(
				'nombre_contacto',
				'length',
				'min'=>3,
				'tooShort'=>'Minimo 3 caracteres',
				'max'=>50,
				'tooLong'=>'maximo 50'),


			array('apellido_contacto','required','message'=>'Este campo es obligatorio'),
			array(
				'apellido_contacto',
				'length',
				'min'=>3,
				'tooShort'=>'Minimo 3 caracteres',
				'max'=>50,
				'tooLong'=>'maximo 50'),


			array('correo','required','message'=>'Este campo es obligatorio'),
			array(
				'correo',
			  	'match',
                'pattern'=>"/^[A-z0-9_.\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z.]{1,3}$/",
				'message'=>'El correo no es valido'),
			array('correo', 'unique', 'message'=>'Ya existe ese correo registrado'),

			array('rfc','required','message'=>'RFC No Valido'),
			array('rfc',
                  	'match',
			    	'pattern'=>"/^(([A-Za-z]){3})([0-9]{6})(([A-Z]|[a-z]|[0-9]){3})$/",
                    'message'=>'RFC No Valido'),
            array('rfc', 'unique', 'message'=>'Ya existe ese RFC'),
			array('tel','required','message'=>'Este campo es obligatorio'),
			array(
				'tel',
				'length',
				'min'=>13,
				'tooShort'=>'Mínimo 10 dígitos',
				'message'=>'El telefono no es valido'),
			array('ext','required','message'=>'Este campo es obligatorio'),
			array(
				'ext',
				'length',
				'max'=>3,
				'message'=>'La ext no es v&aacute;lida'),
			array('cel','required','message'=>'Este campo es obligatorio'),
			array(
				'cel',
				'length',
				'min'=>10,
				'tooShort'=>'Minimo 10 dígitos',
				'message'=>'El telefono celular no es valido'),
                    
			array('id, ext', 'numerical', 'integerOnly'=>true, 'message'=> 'Solo se aceptan números'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre_empresa, nombre_contacto, apellido_contacto, correo, rfc, tel, cel', 'safe', 'on'=>'search'),
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
			'clientesDomicilios' => array(self::HAS_MANY, 'ClientesDomicilio', 'id_cliente'),
			'solicitudes' => array(self::HAS_MANY, 'Solicitudes', 'id_clientes'),
			'viajes' => array(self::HAS_MANY, 'Viajes', 'id_clientes'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Usuario',
			'nombre_empresa' => 'Nombre de la empresa',
			'nombre_contacto' => 'Nombre(s) de contacto',
			'apellido_contacto' => 'Apellido(s) de contacto',
			'correo' => 'Correo',
			'rfc' => 'RFC',
			'tel' => 'Teléfono',
			'ext'=>'Extensi&oacute;n',
			'cel'=>'Tel&eacute;fono celular',
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
		$criteria->compare('nombre_empresa',$this->nombre_empresa,true);
		$criteria->compare('nombre_contacto',$this->nombre_contacto,true);
		$criteria->compare('apellido_contacto',$this->apellido_contacto,true);
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('rfc',$this->rfc,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('ext',$this->ext,true);
		$criteria->compare('cel',$this->cel,true);
		$criteria->compare('id',$this->id, true);
        $criteria->addcondition('activo = '.$flag);
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
	 * @return Clientes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function getAllClientes()
        {
            $clientes = Clientes::model()->findAll();
            $return = array();
            foreach($clientes as $data)
                $return[$data->id] = $data->nombre_empresa;
            return $return;
        }
        public function getAllClientesNoUser()
        {
            $clientes = Clientes::model()->findAll('activo = 1');
            $usuarios = Usuarios::model()->findAll('tipo_usr = 1');
            $return = array();
            foreach($clientes as $data)
            {
                $flag = true;
                foreach ($usuarios as $data2)
                {
                    if($data['id'] == $data2['id_usr'])
                        $flag = false;
                }
                if($flag)
                   $return[$data->id] = $data->nombre_empresa; 
            }
            return $return;
        }
        public function getAllClientesViajes()
        {
            $clientes = Clientes::model()->findAll();
            $solicitudes = Solicitudes::model()->findAllBySql('SELECT DISTINCT id, id_clientes, codigo FROM solicitudes');
            $return = array();
            foreach($solicitudes as $info)
                foreach($clientes as $data)
                {
                    if($info->id_clientes == $data->id)
                        $return[$info->id] = $data->nombre_empresa.' ('.$info->codigo.')';
                }
            return $return;
        }
        public function getSearchClientes()
        {
			return array('1'=>'Nombre Empresa',
				         '2'=>'Nombre Contacto',
				         '3'=>'Apellido Contacto',
				     //   '4'=>'Correo',
				         '4'=>'RFC'
				     //  '6'=>'Teléfono'
				         );
		}
        public function getClienteViajes($id)
        {
            $solicitudes = Solicitudes::model()->findByPk($id);
            $cliente = Clientes::model()->findByPk($solicitudes->id_clientes);
            return '<b>'.$cliente->nombre_empresa.'</b> ('.$solicitudes->codigo.')';
        }
        public function getCliente($id)
        {
            $cliente = Clientes::model()->findByPk($id);
            return $cliente->nombre_empresa;
        }
        public function getUserName($id)
        {
        	$usrName = Usuarios::model()->findAll("tipo_usr = 1 and id_usr = $id");

        	return isset($usrName[0]->usuario)?$usrName[0]->usuario:"--------";

        }
        public function adminSearch()
        {
            return array
            (
                'nombre_empresa',
                'nombre_contacto',
                'apellido_contacto',
                array('name'=>'id', 'value'=>'Clientes::model()->getUserName($data->id)'),
                'correo',
                'rfc',
                'tel',
                'ext',
                array
                (
                    'class'=>'NCButtonColumn',
                    'header'=>'Acciones',
                    'template'=>'<div class="buttonsWraper">{view} {update} {delete}</div>'
                )
            );
        }
        public function adminSearchVacios()
        {
            return array
            (
                'nombre_empresa',
				'nombre_contacto',
				'apellido_contacto',
				'correo',
				'rfc',
                'tel',
                'ext',
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
                            'url' => 'Yii::app()->createUrl("clientes/reactivar", array("id"=>$data->id))',
                        )
                    )
                )
            );
        }
}
