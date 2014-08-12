<?php

/**
 * This is the model class for table "TBL_EVAMODELOSCRITERIOS".
 *
 * The followings are the available columns in table 'TBL_EVAMODELOSCRITERIOS':
 * @property integer $EMCE_ID
 * @property integer $MOOR_ID
 * @property integer $EVCR_ID
 * @property integer $EVES_ID
 *
 * The followings are the available model relations:
 * @property TblEvaestados $eVES
 * @property TblModeloordenes $mOOR
 * @property TblEvacriterios $eVCR
 */
class Evamodeloscriterios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Evamodeloscriterios the static model class
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
		return 'TBL_EVAMODELOSCRITERIOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MOOR_ID, EVCR_ID, EVES_ID', 'required'),
			array('MOOR_ID, EVCR_ID, EVES_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('EMCE_ID, MOOR_ID, EVCR_ID, EVES_ID', 'safe', 'on'=>'search'),
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
			'eVES' => array(self::BELONGS_TO, 'TblEvaestados', 'EVES_ID'),
			'mOOR' => array(self::BELONGS_TO, 'TblModeloordenes', 'MOOR_ID'),
			'eVCR' => array(self::BELONGS_TO, 'TblEvacriterios', 'EVCR_ID'),
			'rel_criterios' => array(self::BELONGS_TO, 'Evacriterios', 'EVCR_ID'),
			'rel_estados' => array(self::BELONGS_TO, 'Evaestados', 'EVES_ID'),
					
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'EMCE_ID' => 'Emce',
			'MOOR_ID' => 'Moor',
			'EVCR_ID' => 'CRITERIO DE EVALUACIÓN',
			'EVES_ID' => '¿CUMPLE?',
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

		$criteria->compare('EMCE_ID',$this->EMCE_ID);
		$criteria->compare('MOOR_ID',$this->MOOR_ID);
		$criteria->compare('EVCR_ID',$this->EVCR_ID);
		$criteria->compare('EVES_ID',$this->EVES_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	

	public function agregarEvamodeloscriterios($ID,$FECHA,$MOD,$EVCR_ID,$ES)
	{		
	 $string = "INSERT INTO ".$this->tableName()." () VALUES ('NULL',0000-00-00,$MOD,$EVCR_ID,2)";
	 $criteria = Yii::app()->db->createCommand($string)->execute();		
	 return 1;	
	}
	
	
	
    public function obtenerEvamodeloscriterios($id){
	 $string = "SELECT * FROM `TBL_EVAMODELOSCRITERIOS ";
	 $criteria = Yii::app()->db->createCommand($string)->queryAll();		 
	 return $criteria;
    }			
	
	
	
}