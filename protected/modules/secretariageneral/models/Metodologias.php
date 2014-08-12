<?php

/**
 * This is the model class for table "TBL_METODOLOGIAS".
 *
 * The followings are the available columns in table 'TBL_METODOLOGIAS':
 * @property integer $METO_ID
 * @property string $METO_NOMBRE
 *
 * The followings are the available model relations:
 * @property CODIGOSICFES[] $cODIGOSICFESs
 */
class Metodologias extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Metodologias the static model class
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
		return 'TBL_METODOLOGIAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('METO_NOMBRE', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('METO_ID, METO_NOMBRE', 'safe', 'on'=>'search'),
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
			'cODIGOSICFESs' => array(self::HAS_MANY, 'CODIGOSICFES', 'METO_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'METO_ID' => 'ID',
			'METO_NOMBRE' => 'METODOLOGIA',
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

		$criteria->compare('METO_ID',$this->METO_ID);
		$criteria->compare('METO_NOMBRE',$this->METO_NOMBRE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
		public function getListadoMetodologias(){
		 $criteria=new CDbCriteria;
     $criteria->select='METO_ID, METO_NOMBRE';
	 $criteria->order = 'METO_NOMBRE ASC';
	 
	 return  CHtml::listData(Metodologias::model()->findAll($criteria),'METO_ID','METO_NOMBRE');
		
		}
}