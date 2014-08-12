<?php

/**
 * This is the model class for table "TBL_DEPARTAMENTOS".
 *
 * The followings are the available columns in table 'TBL_DEPARTAMENTOS':
 * @property integer $DEPA_ID
 * @property string $DEPA_NOMBRE
 * @property integer $PAIS_ID
 *
 * The followings are the available model relations:
 * @property TblPaises $pAIS
 */
class Departamentos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Departamentos the static model class
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
		return 'TBL_DEPARTAMENTOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DEPA_NOMBRE, PAIS_ID', 'required'),
			array('PAIS_ID', 'numerical', 'integerOnly'=>true),
			array('DEPA_NOMBRE', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('DEPA_ID, DEPA_NOMBRE, PAIS_ID', 'safe', 'on'=>'search'),
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
			'pAIS' => array(self::BELONGS_TO, 'TblPaises', 'PAIS_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'DEPA_ID' => 'Depa',
			'DEPA_NOMBRE' => 'Depa Nombre',
			'PAIS_ID' => 'Pais',
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

		$criteria->compare('DEPA_ID',$this->DEPA_ID);
		$criteria->compare('DEPA_NOMBRE',$this->DEPA_NOMBRE,true);
		$criteria->compare('PAIS_ID',$this->PAIS_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}