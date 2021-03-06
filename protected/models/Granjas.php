<?php

/**
 * This is the model class for table "granjas".
 *
 * The followings are the available columns in table 'granjas':
 * @property integer $id
 * @property string $direccion
 * @property string $responsable
 * @property integer $activo
 */
class Granjas extends SMActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'granjas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

            array('direccion','required','message'=>'Este campo es obligatorio'),
            array(
                'direccion',
                'length',
                'min'=>5,
                'tooShort'=>'M&iacutenimo 5 caracteres',
                'max'=>100,
                'tooLong'=>'M&aacuteximo 100 caracteres'),

            array('responsable','required','message'=>'Este campo es obligatorio'),
            array(
                'responsable',
                'length',
                'min'=>5,
                'tooShort'=>'M&iacutenimo 5 caracteres',
                'max'=>100,
                'tooLong'=>'M&aacuteximo 100 caracteres'),  


            array('nombre','required','message'=>'Este campo es obligatorio'),
            array(
                'nombre',
                'length',
                'min'=>5,
                'tooShort'=>'M&iacutenimo 5 caracteres',
                'max'=>100,
                'tooLong'=>'M&aacuteximo 100 caracteres'),

			array('activo', 'numerical', 'integerOnly'=>true),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, direccion, responsable, activo', 'safe', 'on'=>'search'),
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
			'direccion' => 'Direccion',
			'responsable' => 'Responsable',
			'activo' => 'Activo',
			'nombre' => 'Nombre',
		);
	}
        public function getSearchGranjas()
        {
            return array
            (
                '1'=>'Nombre',
                '2'=>'Dirección',
                '3'=>'Responsable'
            );
        }
    public function getNombreGranjas($id){
        $granja = Yii::app()->db->createCommand()
            ->select('nombre')
            ->from('granjas g')
            ->join('estacion e', 'e.id_granja = g.id')
            ->where('e.id = :id',array(':id'=>$id))
            ->queryRow();

        // $granja = Granjas::model()->findByPk($id);
        return $granja['nombre']; 
    }

   
        public function getnombregranja()
        {
            $personal = Granjas::model()->findAll('activo = 1');
            $return = array();
            foreach($personal as $data)
                $return[$data->id] = $data->nombre;
            return $return; 
        }
        public function getGranjaFromEstacion($id_estacion){
          $granjaestacion=Estacion::model()->findByPk($id_estacion);
          $granja = Granjas::model()->findByPk($granjaestacion->id_granja);
            return $granja->nombre;
        }
        public function getNombreGranjasConPlantas($id="")
        {
            
            $return = array();
            if($id == "") {
                $personal = Granjas::model()->findAll('activo = 1');
                foreach($personal as $data) {      
                    $crit = new CDbCriteria;
                        $crit->condition = "id_granja = '{$data->id}' AND disponible = 1";
                        $plantasDisponibles = Estacion::model()->findAll($crit);
                        $numero = count($plantasDisponibles);
                    $return[$data->id] = $data->nombre." -  ".$numero." plantas disponibles";
                }
            }
            else {
                  $personal = Granjas::model()->findByPk($id);  
                    $crit = new CDbCriteria;
                    $crit->condition = "id_granja = '{$personal->id}' AND disponible = 1";
                    $plantasDisponibles = Estacion::model()->findAll($crit);
                    $numero = count($plantasDisponibles);
                    $return[$personal->id] = $personal->nombre." -  ".$numero." plantas disponibles";
            }
            return $return; 
        }
        
        public function getGranjaFromPlanta($id_estacion) {
            $granja = Estacion::model()->findByPk($id_estacion);
            $estacion = $this->findByPk($granja->id_granja);
            $return = array();
            $return[$estacion->id] = $estacion->nombre;
            return $return;
        }
        public function getGranjaFromPlantaString($id_estacion) {
            $granja = Estacion::model()->findByPk($id_estacion);
            $estacion = $this->findByPk($granja->id_granja);
            $return = $estacion->nombre;
            return $return;
        }
        public function getGranjaResponsable($id_responsable) {
            $personal = Personal::model()->findByPk($id_responsable);
            $return = isset($personal)?$personal->nombre." ".$personal->apellido:"no name" ;
            return $return;
        }
        public function getPlantasofGranjaFromPlanta($id_estacion) {
            $granja = Estacion::model()->findByPk($id_estacion);
            $plantas = Estacion::model()->findAll("id_granja = '{$granja->id_granja}'");
            $return = array();
            foreach($plantas as $data) {
                $return[$data->id] = $data->identificador;
            }
            return $return;
        }public function getGranjaId($id_estacion) {
            $granja = Estacion::model()->findByPk($id_estacion);
           

            return $granja->id_granja;
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
fb($flag);
		$criteria = new CDbCriteria;
fb($criteria);
		$criteria->compare('id',$this->id);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('responsable',$this->responsable,true);
	//	$criteria->compare('activo',$this->activo);
        fb($criteria);
                $criteria->addCondition("activo=$flag");
		return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                            'pageSize'=>15,
                        )
		));
	}


    public function search1($flag)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('nombre',$this->nombre);
        $criteria->compare('direccion',$this->direccion,true);
        $criteria->compare('responsable',$this->responsable,true);
        $criteria->compare('activo',$this->activo);
                $criteria->addCondition("activo=$flag");
        return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                            'pageSize'=>15,
                        )
        ));
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Granjas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getNumofPlantas($id){
            $plantas = Estacion::model()->findAll("id_granja = '{$id}' AND activo=1");
            return count($plantas);
        }
        public function getTotalTanques($id){
            $plantas = Estacion::model()->findAll("id_granja = '{$id}' AND activo=1");
            $tot = 0;
            foreach($plantas as $data)
            {
                $tanques = Tanque::model()->findAll('id_estacion = '.$data->id.' AND activo=1');
                $tot += count($tanques);
            }
            return $tot;
        }
        public function adminSearch()
        {
            return array
            (
                'nombre',
                array('name'=>'Direcci&oacuten', 'value'=>'$data->direccion'),
                'responsable',
                array('name'=>'Total de Plantas de producci&oacuten', 'value'=>'Granjas::model()->getNumofPlantas($data->id)'),
                array('name'=>'Total de Tanques ', 'value'=>'Granjas::model()->getTotalTanques($data->id)'),
                array
                (
                    'class'=>'NCButtonColumn',
                    'header'=>'Acciones',
                    'template'=>'<div class="buttonsWraper">{update} {delete} {iglu}</div>',
                    'buttons' => array
                    (
                        'iglu' => array
                        (
                            'imageUrl'=> Yii::app()->baseUrl . '/images/plantas.svg',
                            'options'=>array('id'=>'_iglu','title'=>'', 'class' => 'iglu'),
                            'url' => 'Yii::app()->createUrl("granjas/plantaProduccion", array("id"=>$data->id))',
                        )
                    )
                )
            );
        }
        public function adminSearchBorrados()
        {
            return array
            (
                'nombre',
                array('name'=>'Direcci&oacuten', 'value'=>'$data->direccion'),
                'responsable',
                array('name'=>'Total de Plantas de producci&oacuten', 'value'=>'Granjas::model()->getNumofPlantas($data->id)'),
                array('name'=>'Total de Tanques ', 'value'=>'Granjas::model()->getTotalTanques($data->id)'),
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
                            'url' => 'Yii::app()->createUrl("granjas/reactivar", array("id"=>$data->id))',
                        )
                    )
                )
            );
        }
}
