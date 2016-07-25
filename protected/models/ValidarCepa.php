<?php
class ValidarCepa extends CFormModel{
	public $nombre_cepa;
	public $id_especie;
	public $temp_mi;
	public $temp_max;
	public $ph_min;
	public $ph_max;
	public $ox_min; 
	public $ox_max; 
	public $cantidad;
	public $cond_min;
	public $cond_max;
	public $orp_min;
	public $orp_max;
	public $temp_min;


	public function tableName()
	{
		return 'cepa';
	}
	public function rules (){
		return array(
			array('nombre_cepa','required')
			);
	}
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idEspecie' => array(self::BELONGS_TO, 'Especie', 'id_especie'),
			'solicitudTanques' => array(self::HAS_MANY, 'SolicitudTanques', 'id_cepas'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_especie' => 'Especie',
			'nombre_cepa' => 'Nombre Cepa',
			'temp_min' => 'Temp Min',
			'temp_max' => 'Temp Max',
			'ph_min' => 'Ph Min',
			'ph_max' => 'Ph Max',
			'ox_min' => 'Ox Min',
			'ox_max' => 'Ox Max',
			'cantidad' => 'Cantidad',
			'cond_min' => 'Cond Min',
			'cond_max' => 'Cond Max',
			'orp_min' => 'Orp Min',
			'orp_max' => 'Orp Max',
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
		$criteria->compare('id_especie',$this->id_especie);
		$criteria->compare('nombre_cepa',$this->nombre_cepa,true);
		$criteria->compare('temp_min',$this->temp_min);
		$criteria->compare('temp_max',$this->temp_max);
		$criteria->compare('ph_min',$this->ph_min);
		$criteria->compare('ph_max',$this->ph_max);
		$criteria->compare('ox_min',$this->ox_min);
		$criteria->compare('ox_max',$this->ox_max);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('cond_min',$this->cond_min);
		$criteria->compare('cond_max',$this->cond_max);
		$criteria->compare('orp_min',$this->orp_min);
		$criteria->compare('orp_max',$this->orp_max);
			/*$criteria->addcondition("(nombre_cepa LIKE '%".$this->nombre_cepa."%' OR id_especie LIKE '%".$this->nombre_cepa.
								"%' OR cantidad LIKE '%".$this->nombre_cepa."%')");*/

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getSearchCepa(){
			return array('1'=>'Especie',
				         '2'=>'Nombre Cepa',
				         '3'=>'Cantidad');
		}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cepa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function getCepasEspecie($id)
        {
            $cepas = Cepa::model()->findAll("id_especie = $id");
            $return = '';
            foreach($cepas as $data)
                $return = $return.<<<eof
                    <option value="$data->id" data-cnt="$data->cantidad">$data->nombre_cepa</option>
eof;
            
            return $return;
        }
        public function getCepa($id)
        {
            $cepa = Cepa::model()->findByPk($id);
            return $cepa->nombre_cepa;
        }
    public function adminSearch()
    {
        return array
        (
            array(
                'name'=>'id_especie',
                'value'=>'Especie::model()->getEspecie($data->id_especie)',
                'filter'=>  Especie::model()->getAllEspecies()
            ),
            'nombre_cepa',
         /*    array(
                'name' => 'temp_min',
                'value' => '$data->temp_min',
            ),
           array(
                'name' => 'temp_max',
                'value' => '$data->temp_max',
            ),
            array(
                'name' => 'ph_min',
                'value' => '$data->ph_min',
            ),
            array(
                'name' => 'ph_max',
                'value' => '$data->ph_max',
            ),
            array(
                'name' => 'ox_min',
                'value' => '$data->ox_min',
            ),
            array(
                'name' => 'ox_max',
                'value' => '$data->ox_max',
            ),*/
            array(
                'name' => 'cantidad',
                'value' => '$data->cantidad',
            ),/*
            array(
                'name' => 'cond_max',
                'value' => '$data->cond_max',
            ),
            array(
                'name' => 'cond_min',
                'value' => '$data->cond_min',
            ),
            array(
                'name' => 'orp_min',
                'value' => '$data->orp_min',
            ),
            array(
                'name' => 'orp_max',
                'value' => '$data->orp_max',
            ),*/
            array
            (
                'class'=>'NCButtonColumn',
                'header'=>'Acciones',
                'template'=>'<div class="buttonsWraper">{view} {update} {delete}</div>'
            )
        );
    }
}
?>