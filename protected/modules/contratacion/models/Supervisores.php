<?php

/**
 * This is the model class for table "TBL_SUPERVISORES".
 *
 * The followings are the available columns in table 'TBL_SUPERVISORES':
 * @property integer $SUPE_ID
 * @property integer $CONT_ID
 * @property integer $PERS_ID
 * @property integer $CARG_ID
 *
 * The followings are the available model relations:
 * @property TblCargos $cARG
 * @property TblPersonas $pERS
 * @property TblContratos $cONT
 */
class Supervisores extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Supervisores the static model class
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
		return 'TBL_SUPERVISORES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CONT_ID, PERS_ID, CARG_ID', 'required'),
			array('CONT_ID, PERS_ID, CARG_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SUPE_ID, CONT_ID, PERS_ID, CARG_ID', 'safe', 'on'=>'search'),
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
			'cARG' => array(self::BELONGS_TO, 'TblCargos', 'CARG_ID'),
			'pERS' => array(self::BELONGS_TO, 'TblPersonas', 'PERS_ID'),
			'cONT' => array(self::BELONGS_TO, 'TblContratos', 'CONT_ID'),
			'Cargo' => array(self::BELONGS_TO, 'Cargos', 'CARG_ID'),
			'rel_contratos' => array(self::HAS_ONE, 'Contratos', 'CONT_ID'),
			'rel_persona' => array(self::BELONGS_TO, 'Personas', 'PERS_ID'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'SUPE_ID' => 'SUPE ID',
			'CONT_ID' => 'CONTRATO',
			'PERS_ID' => 'SUPERVISOR',
			'CARG_ID' => 'CARGO',
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

		$criteria->compare('SUPE_ID',$this->SUPE_ID);
		$criteria->compare('CONT_ID',$this->CONT_ID);
		$criteria->compare('PERS_ID',$this->PERS_ID);
		$criteria->compare('CARG_ID',$this->CARG_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	  public function cargos()
	{
     $connection = Yii::app()->db;
	 $sql = "SELECT c.CARG_ID, c.CARG_NOMBRE 
	 FROM TBL_CARGOS c";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;  
	}
	
	
}