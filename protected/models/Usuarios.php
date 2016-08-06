<?php

/**
 * This is the model class for table "usuarios".
 *
 * The followings are the available columns in table 'usuarios':
 * @property integer $id
 * @property string $usuario
 * @property string $pwd
 * @property integer $tipo_usr
 * @property integer $id_usr
 */
class Usuarios extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuarios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usuario, pwd, tipo_usr,id_usr', 'required','message'=>'Campo obligatorio'),
                        array('usuario','unique','message'=>'Ya existe un usuario registrado con este nombre'),
                        array('id_usr','unique','message'=>'Este usuario ya tiene una cuenta creada'),
			array('id, tipo_usr, id_usr', 'numerical', 'integerOnly'=>true),
			array('usuario', 'length', 'max'=>10),
			array('pwd', 'length', 'max'=>35),
			//array('id_usr','message'=>'Campo obligatorio'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, usuario, pwd, tipo_usr, id_usr', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{ 
		return array(
			'id' => 'ID',
			'usuario' => 'Nombre de usuario',
			'pwd' => 'Clave',
			'tipo_usr' => 'Tipo de usuario',
			'id_usr' => 'Empleado/cliente',
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
		$criteria->compare('pwd',$this->pwd,true);
		$criteria->compare('usuario',$this->usuario,true);
		/*criteria->compare('tipo_usr',$this->tipo_usr);
		$criteria->compare('id_usr',$this->id_usr);*/

		$criteria->addcondition("(usuario LIKE '%".$this->usuario.
								"%' OR tipo_usr LIKE '%".$this->usuario.
                                "%' OR id_usr LIKE '%".$this->usuario.
                                "%')");

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}



	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuarios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function getAllTipoUsuario()
        {
            return array
            (
                '1' => 'Cliente',
                '2' => 'Personal'
            );
        }
        public function getSearchUsuarios(){
			return array('1'=>'Nombre Usuario',
				         '2'=>'Tipo de Usuario');
		}
        public function getTipoUsuario($id)
        {
            switch ($id)
            {
                case 1 : return 'Cliente'; break;
                case 2 : return 'Personal'; break;
            }
        }
        public function getUsuario($flag, $id)
        {
            switch ($flag)
            {
                case 1: 
                    $usuario = Clientes::model()->findByPk($id);
                    return $usuario->nombre_empresa;
                break;
                case 2:
                    $usuario = Personal::model()->findByPk($id);
                    return $usuario->nombre.' '.$usuario->apellido;
                break;
            }
        }
    public function adminSearch()
    {
    	
        return array
        (
            'usuario',
            array
            (
                'name' => 'tipo_usr',
                'value' => 'Usuarios::model()->getTipoUsuario($data->tipo_usr)',
                'filter' => Usuarios::model()->getAllTipoUsuario()
            ),
            array
            (
                'name' => 'id_usr',
                'value' => 'Usuarios::model()->getUsuario($data->tipo_usr, $data->id_usr)',
                //'filter' => ''
            ),
            array
            (
                'class'=>'NCButtonColumn',
                'header'=>'Acciones',
                'template'=>'<div class="buttonsWraper">{view} {update} {delete}</div>'
            )
        );
    }
}
