<?php

/**
 * This is the model class for table "TBL_FORMPARTESDESCRIPCIONCLAUS".
 *
 * The followings are the available columns in table 'TBL_FORMPARTESDESCRIPCIONCLAUS':
 * @property integer $FPDC_ID
 * @property string $FPDC_DESCRIPCION
 * @property integer $FDCL_ID
 *
 * The followings are the available model relations:
 * @property TblFormdescripcionclausulas $fDCL
 */
class Formpartesdescripcionclaus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Formpartesdescripcionclaus the static model class
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
		return 'TBL_FORMPARTESDESCRIPCIONCLAUS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FPDC_DESCRIPCION, FDCL_ID', 'required'),
			array('FDCL_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FPDC_ID, FPDC_DESCRIPCION, FDCL_ID', 'safe', 'on'=>'search'),
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
			'fDCL' => array(self::BELONGS_TO, 'TblFormdescripcionclausulas', 'FDCL_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'FPDC_ID' => 'Fpdc',
			'FPDC_DESCRIPCION' => 'Fpdc Descripcion',
			'FDCL_ID' => 'Fdcl',
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

		$criteria->compare('FPDC_ID',$this->FPDC_ID);
		$criteria->compare('FPDC_DESCRIPCION',$this->FPDC_DESCRIPCION,true);
		$criteria->compare('FDCL_ID',$this->FDCL_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}