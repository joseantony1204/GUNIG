<?php

/**
 * This is the model class for table "TBL_FORMDESCRIPCIONCLAUSULAS".
 *
 * The followings are the available columns in table 'TBL_FORMDESCRIPCIONCLAUSULAS':
 * @property integer $FDCL_ID
 * @property string $FDCL_NOMBRE
 * @property integer $FNCL_ID
 * @property integer $FCCO_ID
 *
 * The followings are the available model relations:
 * @property TblFormnombresclausulas $fNCL
 * @property TblFormclasescontratos $fCCO
 */
class Formdescripcionclausulas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Formdescripcionclausulas the static model class
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
		return 'TBL_FORMDESCRIPCIONCLAUSULAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FDCL_NOMBRE, FNCL_ID, FCCO_ID', 'required'),
			array('FNCL_ID, FCCO_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FDCL_ID, FDCL_NOMBRE, FNCL_ID, FCCO_ID', 'safe', 'on'=>'search'),
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
			'fNCL' => array(self::BELONGS_TO, 'TblFormnombresclausulas', 'FNCL_ID'),
			'fCCO' => array(self::BELONGS_TO, 'TblFormclasescontratos', 'FCCO_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'FDCL_ID' => 'Fdcl',
			'FDCL_NOMBRE' => 'Fdcl Nombre',
			'FNCL_ID' => 'Fncl',
			'FCCO_ID' => 'Fcco',
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

		$criteria->compare('FDCL_ID',$this->FDCL_ID);
		$criteria->compare('FDCL_NOMBRE',$this->FDCL_NOMBRE,true);
		$criteria->compare('FNCL_ID',$this->FNCL_ID);
		$criteria->compare('FCCO_ID',$this->FCCO_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}