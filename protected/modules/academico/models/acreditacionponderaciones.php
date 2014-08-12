<?php

/**
 * This is the model class for table "tbl_acreditacionponderaciones".
 *
 * The followings are the available columns in table 'tbl_acreditacionponderaciones':
 * @property integer $ACPO_ID
 * @property double $ACPO_GRUPO1
 * @property double $ACPO_GRUPO2
 * @property double $ACPO_GRUPO3
 * @property double $ACPO_GRUPO4
 * @property double $ACPO_GRUPO5
 * @property integer $ACCA_ID
 * @property string $ACPO_FECHA
 * @property integer $USUA_ID
 */
class acreditacionponderaciones extends CActiveRecord
{
	public $val_prom;
	public $val_desv;
	public $val_vari;
	public $val_vobo;	

	public function sumatoria($data)
	{	$sum =  ($data->ACPO_GRUPO1+$data->ACPO_GRUPO2+$data->ACPO_GRUPO3+$data->ACPO_GRUPO4+$data->ACPO_GRUPO5);
		return $sum;
	}
	
	public function promedio($data)
	{	//$fMean = array_sum($aValues) / count($aValues);		
		$prom =acreditacionponderaciones::sumatoria($data)/5;
		return $prom;
	}
		
	/* public function standard_deviation(, $aValues, $bSample = false)
	{	
	
		$fMean = array_sum($aValues) / count($aValues);
		
		$fVariance = 0.0;
		
	
		
		foreach ($aValues as $i)
		{
			$fVariance += pow($i - $fMean, 2);
		}
		$fVariance /= ( $bSample ? count($aValues) - 1 : count($aValues) );

		$this->val_desv=(float) sqrt($fVariance);
		
		return $this->val_desv;
	}
		 */
		
	public function standard_deviation($data, $bSample = false)
	{		
		$prom = acreditacionponderaciones::promedio($data);
		$fVariance = 0.0;		
		$fVariance += pow($data->ACPO_GRUPO1 - $prom, 2);
		$fVariance += pow($data->ACPO_GRUPO2 - $prom, 2);
		$fVariance += pow($data->ACPO_GRUPO3 - $prom, 2); 
		$fVariance += pow($data->ACPO_GRUPO4 - $prom, 2);
		$fVariance += pow($data->ACPO_GRUPO5 - $prom, 2);		
		$fVariance /= ( $bSample ? 4 : 5 );
		$desv=(float) sqrt($fVariance);		
		return $desv;
	}

	public function coeficiente_variacion($data)
	{		
		$vari = acreditacionponderaciones::standard_deviation($data,false)/acreditacionponderaciones::promedio($data);
		return $vari;
	}
	
	public function visto_bueno($data)
	{		
		$vobo = 20 - acreditacionponderaciones::coeficiente_variacion($data);
		return $vobo;
	}


/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return acreditacioncaracteristicaspond the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_ACREDITACIONPONDERACIONES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ACPO_GRUPO1, ACPO_GRUPO2, ACPO_GRUPO3, ACPO_GRUPO4, ACPO_GRUPO5, ACCA_ID, ACPO_FECHA, USUA_ID', 'required'),
			array('ACCA_ID, USUA_ID', 'numerical', 'integerOnly'=>true),
			array('ACPO_GRUPO1, ACPO_GRUPO2, ACPO_GRUPO3, ACPO_GRUPO4, ACPO_GRUPO5', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ACPO_ID, ACPO_GRUPO1, ACPO_GRUPO2, ACPO_GRUPO3, ACPO_GRUPO4, ACPO_GRUPO5, ACCA_ID, ACPO_FECHA, USUA_ID', 'safe', 'on'=>'search'),
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
			'ACPO_ID' => 'ID',
			'ACPO_GRUPO1' => 'Grupo1',
			'ACPO_GRUPO2' => 'Grupo2',
			'ACPO_GRUPO3' => 'Grupo3',
			'ACPO_GRUPO4' => 'Grupo4',
			'ACPO_GRUPO5' => 'Grupo5',
			'ACCA_ID' => 'CARACTERISTICA',
			'ACPO_FECHA' => 'Fecha',
			'USUA_ID' => 'Usuario',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ACPO_ID',$this->ACPO_ID);
		$criteria->compare('ACPO_GRUPO1',$this->ACPO_GRUPO1);
		$criteria->compare('ACPO_GRUPO2',$this->ACPO_GRUPO2);
		$criteria->compare('ACPO_GRUPO3',$this->ACPO_GRUPO3);
		$criteria->compare('ACPO_GRUPO4',$this->ACPO_GRUPO4);
		$criteria->compare('ACPO_GRUPO5',$this->ACPO_GRUPO5);
		$criteria->compare('ACCA_ID',$this->ACCA_ID);
		$criteria->compare('ACPO_FECHA',$this->ACPO_FECHA,true);
		$criteria->compare('USUA_ID',$this->USUA_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}