<?php

/**
 * This is the model class for table "especie".
 *
 * The followings are the available columns in table 'especie':
 * @property string $id
 * @property string $nombre
 */
class Especie extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'especie';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre', 'required','message'=>'Campo obligatorio'),
			array('nombre', 'length', 'max'=>100),
            array('nombre', 'unique', 'message'=>'Ya existe una especie con ese nombre'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre', 'safe', 'on'=>'search'),
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
			'nombre' => 'Nombre',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('nombre',$this->nombre,true);
                $criteria->addCondition("activo=$flag");
		return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination'=>array
                    (
                        'pageSize'=>15,
                    )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Especie the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}



        public function getAllEspeciesSolicitud()
        {
        	
            $especies = $this->findAll('activo = 1');
            $cepa = Cepa::model()->findAll('activo = 1');
            $return = array();
            foreach($especies as $data)
            {
                $i = 0;
                foreach($cepa as $info)
                {
                    if($info->id_especie == $data->id)
                        $i++;
                }
                if($i > 0)
                    $return[$data->id] = $data->nombre;
            }
            return $return;
        }




        public function getAllEspecies()
        {
            $especies =Especie::model()->findAllBySql('SELECT * FROM especie WHERE activo = 1');
            $return = array();
            foreach($especies as $data)
                $return[$data->id] = $data->nombre;
            return $return;
        }


        public function getEspecie($id)
        {
            $especie = Especie::model()->findByPk($id);
            return isset($especie->nombre)?$especie->nombre:'Nombre especie';

        }



        public function adminSearch()
        {
            return array
            (
                'nombre',
                array
                (
                    'class'=>'NCButtonColumn',
                    'header'=>'Acciones',
                    'template'=>'<div class="buttonsWraper">{update} {delete} {cepa}</div>',
                    'buttons' => array
                    (
                        'cepa' => array
                        (
                            'imageUrl'=> Yii::app()->baseUrl . '/images/IconoCepa.svg',
                            'options'=>array('id'=>'cepa','title'=>'', 'class' => 'cepa'),
                            'url' => 'Yii::app()->createUrl("cepa?id=$data->id")',
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
                            'url' => 'Yii::app()->createUrl("especie/reactivar", array("id"=>$data->id))',
                        )
                    )
                )
            );
        }
}
