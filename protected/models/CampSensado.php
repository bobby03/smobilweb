<?php

/**
 * This is the model class for table "camp_sensado".
 *
 * The followings are the available columns in table 'camp_sensado':
 * @property integer $id
 * @property integer $id_viaje
 * @property integer $id_responsable
 * @property integer $id_estacion
 * @property string $nombre_camp
 * @property string $fecha_inicio
 * @property string $hora_inicio
 * @property string $fecha_fin
 * @property string $hora_fin
 * @property integer $activo
 *
 * The followings are the available model relations:
 * @property Estacion $idEstacion
 * @property Personal $idResponsable
 * @property CampTanque[] $campTanques
 * @property RegistroCamp[] $registroCamps
 */
class CampSensado extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'camp_sensado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_responsable, id_estacion','required','message'=>'Este campo es obligatorio'),
			array('nombre_camp','required','message'=>'Este campo es obligatorio'),
			array('id_responsable, id_estacion, status, activo', 'numerical', 'integerOnly'=>true),
			array('nombre_camp', 'length', 'max'=>45),
			//array('fecha_inicio,fecha_fin', 'safe'),

			array('fecha_inicio','required','message'=>'Debe especificar una fecha'),
			array('fecha_fin','required','message'=>'Debe especificar una fecha'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.

			array('id, id_responsable, id_estacion, nombre_camp, fecha_inicio, , fecha_fin, status, activo', 'safe', 'on'=>'search'),

     		array('hora_fin','required','message'=>'Este campo es obligatorio'),
 			array(
                'hora_fin',
                'match',
                'pattern'=>"/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/",
                'message'=>'Formato de Hora no valido'),
    		 array('hora_inicio','required','message'=>'Este campo es obligatorio'),
 			array(
                'hora_inicio',
                'match',
                'pattern'=>"/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/",
                'message'=>'Formato de Hora no valido'),

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
			'idEstacion' => array(self::BELONGS_TO, 'Estacion', 'id_estacion'),
			'idResponsable' => array(self::BELONGS_TO, 'Personal', 'id_responsable'),
			'campTanques' => array(self::HAS_MANY, 'CampTanque', 'id_camp_sensado'),
			'registroCamps' => array(self::HAS_MANY, 'RegistroCamp', 'id_camp_sensado'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Granja',
			'id_responsable' => 'Responsable',
			'id_estacion' => 'Planta de producción',
			'nombre_camp' => 'Nombre de la siembra',
			'fecha_inicio' => 'Fecha de inicio',
			'hora_inicio' => 'Hora de inicio (24 horas)',
			'fecha_fin' => 'Fecha de terminación',
			'hora_fin' => 'Hora de terminación (24 horas)',
                        'granja_nombre' => 'Granja'
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
		$criteria->compare('id_responsable',$this->id_responsable);
		$criteria->compare('id_estacion',$this->id_estacion);
		$criteria->compare('nombre_camp',$this->nombre_camp,true);
		$criteria->compare('fecha_inicio',$this->fecha_inicio,true);
		$criteria->compare('hora_inicio',$this->hora_inicio,true);
		$criteria->compare('fecha_fin',$this->fecha_fin,true);
		$criteria->compare('hora_fin',$this->hora_fin,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('activo',$this->activo);
		$criteria->addCondition("status=$flag");
		$criteria->addCondition("activo=1");

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CampSensado the static model class
	 */
	public static function model($className=__CLASS__)
	{
            return parent::model($className);
	}
	public function getResp($id)
        {
            $resp = Personal::model()->findByPk($id);
            return $resp->nombre.' '.$resp->apellido;
        }
        public function getEstacion($id)
        {
            $nombre = Estacion::model()->findByPk($id);
            return $nombre->identificador;
        }
        public function getGranja($id)
        {
            $camp = CampSensado::model()->findByPk($id);
            $estacion = Estacion::model()->findByPk($camp->id_estacion);
            $granja = Granjas::model()->findByPk($estacion->id_granja);
            return $granja->nombre;
        }
        public function getGranjaDatos($id)
        {
            $camp = CampSensado::model()->findByPk($id);
            $estacion = Estacion::model()->findByPk($camp->id_estacion);
            $granja = Granjas::model()->findByPk($estacion->id_granja);
            return $granja;
        }
	public function adminSearchEnEspera()
        {
            return array
            (
                array
                (
                    'name' => 'id',
                    'value' => 'CampSensado::model()->getGranja($data->id)',
                ),
                'nombre_camp',
                array
                (
                   'name' => 'id_estacion',
                    'value' => 'CampSensado::model()->getEstacion($data->id_estacion)',
                ),
                array
                (
                   'name' => 'id_responsable',
                    'value' => 'CampSensado::model()->getResp($data->id_responsable)',
                ),
                'fecha_inicio',
                'hora_inicio',
                'fecha_fin',
                'hora_fin',
                array
                (
                    'class'=>'NCButtonColumn',
                    'header'=>'Acciones',
                    'template'=>'<div class="buttonsWraper">{view} {update} {delete}</div>',
                    'buttons' => array
                    (
                       'delete'=> array 
                       (
                            'url' => 'Yii::app()->createUrl("CampSensado/borrar/$data->id")',
                       	) 
                    ),
                    'deleteButtonImageUrl'=> Yii::app()->baseUrl . '/images/borrar.svg',
		)
            );
        }
        public function adminSearch()
        {
            return array
            (
                array
                (
                    'name' => 'Granja',
                    'value' => 'CampSensado::model()->getGranja($data->id)',
                ),
                'nombre_camp',
                array
                (
                   'name' => 'id_estacion',
                    'value' => 'CampSensado::model()->getEstacion($data->id_estacion)',
                ),
                array
                (
                   'name' => 'id_responsable',
                    'value' => 'CampSensado::model()->getResp($data->id_responsable)',
                ),
                'fecha_inicio',
                'hora_inicio',
                'fecha_fin',
                'hora_fin',
                array
                (
                    'class'=>'NCButtonColumn',
                    'header'=>'Acciones',
                    'template'=>'<div class="buttonsWraper">{view} {update} {delete}</div>',
                    'buttons' => array
                    (
                       'view'=> array 
                       (
                       	'url' => 'Yii::app()->createUrl("monitoreo/$data->id")',
                       	),
                       'delete'=> array 
                       (
                       	'url' => 'Yii::app()->createUrl("campsensado/delete1/$data->id")',
                       	) 
                    )
		)
            );
        }
	public function adminSearchBorrados()
        {
            return array
            (
                array
                (
                    'name' => 'id',
                    'value' => 'CampSensado::model()->getGranja($data->id)',
                ),
                'nombre_camp',
                array
	            (
	               'name' => 'id_estacion',
                	'value' => 'CampSensado::model()->getEstacion($data->id_estacion)',
	            ),
	            array
	            (
	               'name' => 'id_responsable',
                	'value' => 'CampSensado::model()->getResp($data->id_responsable)',
	            ),
                'fecha_inicio',
                'hora_inicio',
                'fecha_fin',
                'hora_fin',
                array
                (
                    'class'=>'NCButtonColumn',
                    'header'=>'Acciones',
                    'template'=>'<div class="buttonsWraper">{view}</div>',
                    'buttons' => array
                    (
                        'view' => array
                        (
//                            'imageUrl'=> Yii::app()->baseUrl . '/images/reactivar.svg',
//                            'options'=>array('id'=>'_iglu','title'=>'', 'class' => 'iglu'),
                            'url' => 'Yii::app()->createUrl("monitoreo/".$data->id)',
                        )
                    )
                )
            );
        }
    public function getSearchViajes()
    {
        return array
        (
//            '1' => 'Granja',
            '2' => 'Nombre de la siembra',
            '3' => 'Planta producción',
            '4' => 'Responsable',
            '5' => 'Fecha inicio',
        );
    }

    public function getGranjasName($status)
    {
    	$camp = CampSensado::model()->findAll("activo = 1 and status = $status");
    	$Granja = new Granjas();
    	$returnData = array();
        foreach ($camp as $data)
            $returnData[$data->id] = $Granja->getNombreGranjas($data->id_estacion); 
        return $returnData;
    }
    
    public function getProduccionName($status)
    {
    	$camp = CampSensado::model()->findAll("activo = 1 and status = $status");
    	$returnData = array();
        foreach ($camp as $data)
            $returnData[$data->id_estacion] = Estacion::model()->getNombreProduccion($data->id_estacion);
        return $returnData;
    }
    public function getResponsableName($status)
    {
    	$camp = CampSensado::model()->findAll("activo = 1 and status = $status");
    	$personal = new Personal();
    	$returnData = array();
        foreach ($camp as $data)
            $returnData[$data->id_responsable] =  $personal->getPersonal($data->id_responsable); 
        return $returnData;
    }
    // getNombreProduccion
}
