<?php

/**
 * This is the model class for table "TBL_CATEDRATIASIGNATURASCATEDR".
 *
 * The followings are the available columns in table 'TBL_CATEDRATIASIGNATURASCATEDR':
 * @property integer $CAAC_ID
 * @property integer $CACA_ID
 * @property integer $ASIG_ID
 */
class Catedratiasignaturascatedr extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Catedratiasignaturascatedr the static model class
	 */
	//public $ASIG_CODIGO, $ASIG_NOMBRE;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_CATEDRATIASIGNATURASCATEDR';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CACA_ID, ASIG_ID', 'required'),
			array('CACA_ID, ASIG_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CAAC_ID, CACA_ID, ASIG_ID', 'safe', 'on'=>'search'),
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
		'rel_asignaturas' => array(self::BELONGS_TO, 'Asignaturas', 'ASIG_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CAAC_ID' => 'ID',
			'CACA_ID' => 'CATEDRA',
			'ASIG_ID' => 'ASIGNATURA',
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

		$criteria->compare('CAAC_ID',$this->CAAC_ID);
		$criteria->compare('CACA_ID',$this->CACA_ID);
		$criteria->compare('ASIG_ID',$this->ASIG_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}