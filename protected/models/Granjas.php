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
			array('direccion, responsable, nombre', 'required'),
			array('activo', 'numerical', 'integerOnly'=>true),
			array('direccion, responsable, nombre', 'length', 'max'=>100),
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
                '2'=>'Direccion',
                '3'=>'Responsable'
            );
        }
        public function getnombregranja()
        {
            $personal = Granjas::model()->findAll('activo = 1');
            $return = array();
            foreach($personal as $data)
                $return[$data->id] = $data->nombre;
            return $return; 
        }
        public function getNombreGranjasConPlantas()
        {
            $personal = Granjas::model()->findAll('activo = 1');
            $return = array();
            foreach($personal as $data) {      
            	$crit = new CDbCriteria;
	            $crit->condition = "id_granja = '{$data->id}' AND disponible = 1";
	            $plantasDisponibles = Estacion::model()->findAll($crit);
	            $numero = count($plantasDisponibles);
                $return[$data->id] = $data->nombre." -  ".$numero." plantas disponibles";
            }
            return $return; 
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
        public function adminSearch()
        {
            return array
            (
                'nombre',
                'direccion',
                'responsable',
                array
                (
                    'class'=>'NCButtonColumn',
                    'header'=>'Acciones',
                    'template'=>'<div class="buttonsWraper">{view} {update} {delete} {iglu}</div>',
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
                'direccion',
                'responsable',
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
