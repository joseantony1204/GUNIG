<?php

/**
 * This is the model class for table "tbl_acreditaciones".
 *
 * The followings are the available columns in table 'tbl_acreditaciones':
 * @property integer $ACRE_ID
 * @property integer $ACPR_ID
 * @property integer $ACBI_ID
 * @property integer $ACFA_ID
 * @property integer $ACCA_ID
 * @property integer $ACAS_ID
 * @property integer $ACIN_ID
 * @property integer $ACSO_ID
 */
class acreditaciones extends CActiveRecord
{	
	public $val_prom;
	public $val_desv;
	public $val_vari;
	public $val_vobo;	
	
	public function promedio($Values)
	{
		$this->val_prom = array_sum($aValues) / count($aValues);		
		return $this->val_prom;
	}
		
	public function standard_deviation($aValues, $bSample = false)
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

	public function coeficiente_variacion($aValues)
	{		
		$this->val_vari = standard_deviation($aValues,false)/promedio($aValues);
		return $this->val_vari;
	}
	
	public function visto_bueno($aValues)
	{		
		$this->vobo = 20 - coeficiente_variacion($aValues);
		return $this->vobo;
	}


	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return acreditaciones the static model class
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
		return 'TBL_ACREDITACIONES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ACPR_ID, ACBI_ID, ACFA_ID, ACCA_ID, ACAS_ID, ACIN_ID, ACSO_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ACRE_ID, ACPR_ID, ACBI_ID, ACFA_ID, ACCA_ID, ACAS_ID, ACIN_ID, ACSO_ID', 'safe', 'on'=>'search'),
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
			        'relacion_programas' => array( self::BELONGS_TO, acreditacionprogramas, 'ACPR_ID'),
       

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ACRE_ID' => 'ID',
			'ACPR_ID' => 'PROGRAMA',
			'ACBI_ID' => 'BITACORA',
			'ACFA_ID' => 'FACTOR',
			'ACCA_ID' => 'CARACTERISTICA',
			'ACAS_ID' => 'ASPECTO',
			'ACIN_ID' => 'INDICADOR',
			'ACSO_ID' => 'SOPORTE',
	
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

		$criteria->compare('ACRE_ID',$this->ACRE_ID);
		$criteria->compare('ACPR_ID',$this->ACPR_ID);
		$criteria->compare('ACBI_ID',$this->ACBI_ID);
		$criteria->compare('ACFA_ID',$this->ACFA_ID);
		$criteria->compare('ACCA_ID',$this->ACCA_ID);
		$criteria->compare('ACAS_ID',$this->ACCA_ID);
		$criteria->compare('ACIN_ID',$this->ACIN_ID);
		$criteria->compare('ACSO_ID',$this->ACSO_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}