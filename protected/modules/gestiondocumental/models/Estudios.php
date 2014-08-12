<?php

/**
 * This is the model class for table "TBL_ESTUDIOS".
 *
 * The followings are the available columns in table 'TBL_ESTUDIOS':
 * @property integer $ESTU_ID
 * @property string $ESTU_NOMBRE
 */
class Estudios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Estudios the static model class
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
		return 'TBL_ESTUDIOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ESTU_ID, TIES_ID', 'numerical', 'integerOnly'=>true),
			array('ESTU_NOMBRE', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ESTU_ID, ESTU_NOMBRE', 'safe', 'on'=>'search'),
			array('ESTU_NOMBRE, TIES_ID', 'required'),
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
		'rel_tipos_estudios' => array(self::BELONGS_TO, 'Tiposestudios', 'TIES_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ESTU_ID' => 'ID',
			'ESTU_NOMBRE' => 'NOMBRE DEL ESTUDIO',
			'TIES_ID' => 'TIPO DE ESTUDIO',
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

		$criteria->compare('ESTU_ID',$this->ESTU_ID);
		$criteria->compare('ESTU_NOMBRE',$this->ESTU_NOMBRE,true);
		$criteria->compare('TIES_ID',$this->TIES_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}