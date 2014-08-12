<?php

/**
 * This is the model class for table "TBL_TUTORIASPARTESCONTRATOS".
 *
 * The followings are the available columns in table 'TBL_TUTORIASPARTESCONTRATOS':
 * @property integer $TUPC_ID
 * @property string $TUPC_DESCRIPCION
 * @property integer $TUCC_ID
 */
class Tutoriaspartescontratos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tutoriaspartescontratos the static model class
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
		return 'TBL_TUTORIASPARTESCONTRATOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TUPC_DESCRIPCION, TUCC_ID', 'required'),
			array('TUCC_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TUPC_ID, TUPC_DESCRIPCION, TUCC_ID', 'safe', 'on'=>'search'),
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
			'TUPC_ID' => 'Tupc',
			'TUPC_DESCRIPCION' => 'Tupc Descripcion',
			'TUCC_ID' => 'Tucc',
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

		$criteria->compare('TUPC_ID',$this->TUPC_ID);
		$criteria->compare('TUPC_DESCRIPCION',$this->TUPC_DESCRIPCION,true);
		$criteria->compare('TUCC_ID',$this->TUCC_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}