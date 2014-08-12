<?php

/**
 * This is the model class for table "TBL_FACULTADES".
 *
 * The followings are the available columns in table 'TBL_FACULTADES':
 * @property integer $FACU_ID
 * @property string $FACU_NOMBRE
 * @property integer $SEDE_ID
 */
class Facultades extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Facultades the static model class
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
		return 'TBL_FACULTADES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FACU_ID, FACU_NOMBRE, SEDE_ID', 'required'),
			array('SEDE_ID', 'numerical', 'integerOnly'=>true),
			array('FACU_NOMBRE', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FACU_ID, FACU_NOMBRE, SEDE_ID', 'safe', 'on'=>'search'),
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
		'rel_sedes' => array(self::BELONGS_TO, 'Sedes', 'SEDE_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'FACU_ID' => 'FACULTAD',
			'FACU_NOMBRE' => 'NOMBRE DE LA FACULTAD',
			'SEDE_ID' => 'SEDE',
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

		$criteria->compare('FACU_ID',$this->FACU_ID);
		$criteria->compare('FACU_NOMBRE',$this->FACU_NOMBRE,true);
		$criteria->compare('SEDE_ID',$this->SEDE_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
    public function getSedes()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.SEDE_ID, t.SEDE_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_FACULTADES  c ON t.SEDE_ID = c.SEDE_ID '; //AND t.ANAC_ESTADO = 0	
	 $criteria->order = 't.SEDE_NOMBRE ASC';
	 return  CHtml::listData(Sedes::model()->findAll($criteria),'SEDE_ID','SEDE_NOMBRE'); 
	}	
}