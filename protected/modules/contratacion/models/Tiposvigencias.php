<?php

/**
 * This is the model class for table "TBL_TIPOSVIGENCIAS".
 *
 * The followings are the available columns in table 'TBL_TIPOSVIGENCIAS':
 * @property integer $TIVI_ID
 * @property string $TIVI_NOMBRE
 */
class Tiposvigencias extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tiposvigencias the static model class
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
		return 'TBL_TIPOSVIGENCIAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TIVI_NOMBRE', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TIVI_ID, TIVI_NOMBRE', 'safe', 'on'=>'search'),
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
			'TIVI_ID' => 'Tivi',
			'TIVI_NOMBRE' => 'Tivi Nombre',
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

		$criteria->compare('TIVI_ID',$this->TIVI_ID);
		$criteria->compare('TIVI_NOMBRE',$this->TIVI_NOMBRE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}