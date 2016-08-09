<?php

/**
 * This is the model class for table "alerts_temp".
 *
 * The followings are the available columns in table 'alerts_temp':
 * @property string $id
 * @property string $origen
 * @property string $valor
 * @property string $hora
 * @property string $fecha
 * @property string $ubicacion
 * @property integer $flecha
 */
class AlertsTemp extends SMActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'alerts_temp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('flecha', 'numerical', 'integerOnly'=>true),
			array('origen', 'length', 'max'=>20),
			array('valor', 'length', 'max'=>10),
			array('ubicacion', 'length', 'max'=>100),
			array('hora, fecha', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, origen, valor, hora, fecha, ubicacion, flecha', 'safe', 'on'=>'search'),
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
			'origen' => 'Origen',
			'valor' => 'Valor',
			'hora' => 'Hora',
			'fecha' => 'Fecha',
			'ubicacion' => 'Ubicacion',
			'flecha' => 'Flecha',
		);
	}

	public function getImageFlecha($data,$img){
		switch ($img) {
			case 0:
				# code...
				return '<div>'.$data.'<span class="flechaDown"></span></div>';
				break;
			case 1:
			return '<div>'.$data.'<span class="flechaUp"></span></div>';
			break;
			
		}
		
	}
	public function adminSearch()
        {
            return array
            (
                'origen',
                'valor',
                // array('name'=>'valor','data'=>'AlertsTemp::model()->getImageFlecha($data->valor,$data->flecha)','type'=>'raw'),
				'hora',
				'fecha',
				'ubicacion',
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

		$criteria->addCondition('id > 0');

		return new CActiveDataProvider($this, array(
		   'criteria'=>$criteria,
                'pagination'=>array(
                        'pageSize'=>5,
                    )
		  ));

		// $criteria->compare('id',$this->id,true);
		// $criteria->compare('origen',$this->origen,true);
		// $criteria->compare('valor',$this->valor,true);
		// $criteria->compare('hora',$this->hora,true);
		// $criteria->compare('fecha',$this->fecha,true);
		// $criteria->compare('ubicacion',$this->ubicacion,true);
		// $criteria->compare('flecha',$this->flecha);

		// return new CActiveDataProvider($this, array(
		// 	'criteria'=>$criteria,
		// ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AlertsTemp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
