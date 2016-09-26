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


            array('tipo','required','message'=>'Este campo es obligatorio'),
            array(
                'tipo',
                'numerical',
                'integerOnly'=>true),


            array('identificador','required','message'=>'Este campo es obligatorio'),
            array(
                'identificador',
                'length',
                'max'=>50),

           array('no_personal','required','message'=>'Este campo es obligatorio'),
           array(
                'no_personal',
                'numerical',
                'integerOnly'=>true,
                'message'=>'Solo se aceptan numeros',
                'min'=>1,
                'tooSmall'=> 'Esta campo debe ser una capacidad mayor a cero ( 0 )'),


            array('marca','required','message'=>'Este campo es obligatorio'),
            array(
                'marca',
                'length',
                'max'=>150,
                'tooLong'=>'El tamaño maximo es de 150 caracteres'),
            array('marca','CRegularExpressionValidator', 'pattern'=>'/^[a-zA-Z ]{1,}$/','message'=>"Solo se aceptan letras"),
            array('color','required','message'=>'Este campo es obligatorio'),
            array(
                'color',
                'length',
                'max'=>50),
            array('color','CRegularExpressionValidator', 'pattern'=>'/^[a-zA-Z ]{1,}$/','message'=>"Solo se aceptan letras"),
            array('ubicacion','required','message'=>'Este campo es obligatorio'),
            array(
                'ubicacion',
                'length',
                'max'=>50),

             array('disponible','required','message'=>'Este campo es obligatorio'),

            array('id, disponible, activo, id_granja', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, id_granja, tipo, identificador, no_personal, marca, color, ubicacion, disponible, activo', 'safe', 'on'=>'search'),
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
			'id_granja' => 'ID granja',
			'tipo' => 'Tipo',
			'identificador' => 'Identificador',
			'no_personal' => 'Capacidad de pasajeros',
			'marca' => 'Marca',
			'color' => 'Color',
			'ubicacion' => 'Ubicaci&oacuten',
			'disponible' => 'Disponible',
			'activo' => 'Activo',
		);
	}
    public function getSearchEstaciones(){
            return array(//'1'=>'Tipo',
                         '1'=>'Identificador',
                         '2'=>'Capacidad',
                         '3'=>'Marca'
                         /*'5'=>'Color',
                         '6'=>'Ubicación',
                         '7'=>'Disponible'*/);
        }

        public function getSearchPlanta()
        {
            return array
            (
                '1'=>'Identificador',
                '2'=>'Ubicación',
            );
        }
    public function getNombreProduccion($id)
    {
        $Estacion = Estacion::model()->findByPk($id);
        return $Estacion->identificador; 
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
		$criteria->compare('id_granja',$this->id_granja);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('identificador',$this->identificador,true);
		$criteria->compare('no_personal',$this->no_personal);
		$criteria->compare('marca',$this->marca,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('ubicacion',$this->ubicacion,true);
		$criteria->compare('disponible',$this->disponible);
		$criteria->compare('activo',$this->activo);
                $criteria->addCondition("activo=1");
                $criteria->order = 'identificador ASC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                    'pagination'=>array(
                            'pageSize'=>15,
                        )
		));
	}
	public function searchTanqueGranja($id,$flag)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('id_granja',$this->id_granja);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('identificador',$this->identificador,true);
		$criteria->compare('marca',$this->marca,true);
		$criteria->compare('ubicacion',$this->ubicacion,true);
		$criteria->compare('disponible',$this->disponible);
		$criteria->compare('activo',$this->activo);
                $criteria->addCondition("activo=$flag");
                $criteria->addCondition("id_granja=$id");
                $criteria->order = 'identificador ASC';
		return new CActiveDataProvider($this, array
                (
                    'criteria'=>$criteria,
                    'pagination'=>array
                    (
                        'pageSize'=>15,
                    )
		));
	}
    public function search1($tipo,$act)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('id_granja',$this->id_granja);
        $criteria->compare('tipo',$this->tipo);
        $criteria->compare('identificador',$this->identificador,true);
        $criteria->compare('no_personal',$this->no_personal);
        $criteria->compare('marca',$this->marca,true);
        $criteria->compare('color',$this->color,true);
        $criteria->compare('ubicacion',$this->ubicacion,true);
        $criteria->compare('disponible',$this->disponible);
        $criteria->compare('activo',$this->activo);
        $criteria->addCondition("activo=$act");
        $criteria->addCondition("tipo=$tipo");
        return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>15,
                    ),
        ));
    }
    public function search2($id)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $datos = Yii::app()->db->createCommand()
                ->select('id,identificador')
                ->from('estacion')
                ->where("estacion.id=$id")
                ->limit(1)
                ->queryRow();
               /* $criteria->addcondition("(tipo LIKE '%".$this->tipo."%' OR identificador LIKE '%".$this->tipo.
                                "%' OR no_personal LIKE '%".$this->tipo."%' OR marca LIKE '%".$this->tipo.
                                "%' OR color LIKE '%".$this->tipo."%' OR ubicacion LIKE '%".$this->tipo."%' OR disponible LIKE '%".$this->tipo.
                                "%')");*/
        return $datos;
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
                '1' => 'Móvil',
                '2' => 'Fíja',
            );
        }
        public function getTipo($id)
        {
            switch ($id)
            {
                case 1: return 'Móvil'; break;
                case 2: return 'Fija'; break;
            }
        }
        public function getAllDisponible()
        {
            return array
            (
                '1' => 'Sí',
                '2' => 'No',
            );
        }
        public function getDisponible($id)
        {
            switch ($id)
            {
                case 1: return 'Sí'; break;
                case 2: return 'No'; break;
            }
        }
        public function getEstacionesDisponibles()
        {
            $estacion = Estacion::model()->findAll("tipo = 1 AND disponible = 1 AND activo = 1");
            $return = array();
            foreach($estacion as $data)
                $return[$data->id] = $data->identificador;
            return $return;
        }
        public function getEstacionesOcupadas()
        {
            $estacion = Estacion::model()->findAll("tipo = 1 AND disponible = 2 AND activo = 1");
            $return = array();
            foreach($estacion as $data)
                $return[$data->id] = $data->identificador;
            return $return;
        }
        public function getAllEstacionMovil()
        {
            $estacion = Estacion::model()->findAll('tipo = 1 AND activo = 1');
            $return = array();
            foreach($estacion as $data)
                $return[$data->id] = $data->identificador;
            return $return;
        }
        public function getAllEstacionFija()
        {
            $estacion = Estacion::model()->findAll('tipo = 2 AND activo = 1');
            $return = array();
            foreach($estacion as $data)
                $return[$data->id] = $data->identificador;
            return $return;
        }
        public function getAllEstacion()
        {
            $estacion = Estacion::model()->findAll('activo = 1');
            $return = array();
            foreach($estacion as $data)
                $return[$data->id] = $data->identificador;
            return $return;
        }
        public function getEstacion($id)
        {
            $estacion = Estacion::model()->findByPk($id);
            return $estacion->identificador;
        }
        public function getEstacionSolicitud()
        {
            $estacion = Estacion::model()->findAll('tipo = 1 AND disponible = 1 AND activo = 1');
            $return = array();
            foreach($estacion as $data)
            {
                $return[$data->id] = $data->identificador;
            }
            return $return;
        }
        public function getNombreEstacion($id) {
            $estacion = Estacion::model()->findByPk($id);
            $return = $estacion->identificador;
            return $return;
        }
        public function adminSearch()
        {
            return array
            (
                'identificador',
                'no_personal',
                array('name'=>'N&uacutemero de tanques', 'value'=>'Estacion::model()->getNumOfTanques($data->id)'),
                'marca',
                'color',
                'ubicacion',
                array
                (
                    'class'=>'NCButtonColumn',
                    'header'=>'Acciones',
//                    'template'=>'<div class="buttonsWraper">{update} {delete} {tanque}</div>',
                    'template'=>'<div class="buttonsWraper"> {update} {delete} {tanque}</div>',
                    'buttons' => array
                    (
                        'tanque' => array
                        (
                            'imageUrl'=> Yii::app()->baseUrl . '/images/tanque.svg',
                            'options'=>array('id'=>'_tanque','title'=>'', 'class' => 'tanque'),
                            'url' => 'Yii::app()->createUrl("tanque/create", array("id"=>$data->id))',
                        )
                    )
		)
            );
        }
        
        public function getNumOfTanques($id){
            $plantas = Tanque::model()->findAll("id_estacion = '{$id}' AND activo=1");
            return count($plantas);
        }
        public function adminSearchPlanta()
        {
            return array
            (
                'identificador',
                array('name'=>'Descripci&oacuten','value'=>'$data->marca'),
                'ubicacion',
                array('name'=>'N&uacutemero de tanques', 'value'=>'Estacion::model()->getNumOfTanques($data->id)'),
                array
                (
                    'class'=>'NCButtonColumn',
                    'header'=>'Acciones',
                    'template'=>'<div class="buttonsWraper"> {update} {delete} {tanque}</div>',
                    'buttons' => array
                    (
                        'tanque' => array
                        (
                            'imageUrl'=> Yii::app()->baseUrl . '/images/tanque.svg',
                            'options'=>array('id'=>'_tanque','title'=>'', 'class' => 'tanque'),
                            'url' => 'Yii::app()->createUrl("tanque/create", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'url' => 'Yii::app()->createUrl("estacion/delete", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'url' => 'Yii::app()->createUrl("granjas/editarPlanta", array("id"=>$data->id))',
                        )
                    )
		)
            );
        }
        public function adminSearchPlantaVacio()
        {
            return array
            (
                'identificador',
                array('name'=>'Descripci&oacuten','value'=>'$data->marca'),
                'ubicacion',
                array('name'=>'N&uacutemero de tanques', 'value'=>'Estacion::model()->getNumOfTanques($data->id)'),
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
                            'url' => 'Yii::app()->createUrl("estacion/reactivar", array("id"=>$data->id))',
                        )
                    )
                )
            );
        }
        public function adminSearch1()
        {
            return array
            (
                'identificador',
                'no_personal',
                array('name'=>'N&uacutemero de tanques', 'value'=>'Estacion::model()->getNumOfTanques($data->id)'),
                'marca',
                'color',
                'ubicacion',
                array
                (
                    'class'=>'NCButtonColumn',
                    'header'=>'Acciones',
                    'template'=>'<div class="buttonsWraper">{view} {update} {delete} {tanque}</div>',
                    'buttons' => array
                    (
                        'tanque' => array
                        (
                            'imageUrl'=> Yii::app()->baseUrl . '/images/tanque.svg',
                            'options'=>array('id'=>'_tanque','title'=>'', 'class' => 'tanque'),
                            'url' => 'Yii::app()->createUrl("tanque/create", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            
                            'url' => 'Yii::app()->createUrl("estacion/update", array("id"=>$data->id))',
                        )
                    )
                )
            );
        }
        public function adminSearchVacio()
        {
            return array
            (
                'identificador',
                'no_personal',
                array('name'=>'N&uacutemero de tanques', 'value'=>'Estacion::model()->getNumOfTanques($data->id)'),
                'marca',
                'color',
                'ubicacion',
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
                            'url' => 'Yii::app()->createUrl("estacion/reactivar", array("id"=>$data->id))',
                        )
                    )
                )
            );
        }
}
