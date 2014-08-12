<?php

/**
 * This is the model class for table "TBL_UNIVERSIDADES".
 *
 * The followings are the available columns in table 'TBL_UNIVERSIDADES':
 * @property integer $UNIV_ID
 * @property string $UNIV_NIT
 * @property string $UNIV_NOMBRE
 * @property string $UNIV_TELEFONO
 * @property string $UNIV_DIRECCION
 */
class Universidades extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Universidades the static model class
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
		return 'TBL_UNIVERSIDADES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UNIV_NIT', 'required'),
			array('UNIV_NOMBRE', 'length', 'max'=>100),
			array('UNIV_TELEFONO, UNIV_DIRECCION', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('UNIV_ID, UNIV_NIT, UNIV_NOMBRE, UNIV_TELEFONO, UNIV_DIRECCION', 'safe', 'on'=>'search'),
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
			'UNIV_ID' => 'ID',
			'UNIV_NIT' => 'NIT',
			'UNIV_NOMBRE' => 'NOMBRE UNIVERSIDAD',
			'UNIV_TELEFONO' => 'TELEFONO',
			'UNIV_DIRECCION' => 'DIRECCION',
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

		$criteria->compare('UNIV_ID',$this->UNIV_ID);
		$criteria->compare('UNIV_NIT',$this->UNIV_NIT,true);
		$criteria->compare('UNIV_NOMBRE',$this->UNIV_NOMBRE,true);
		$criteria->compare('UNIV_TELEFONO',$this->UNIV_TELEFONO,true);
		$criteria->compare('UNIV_DIRECCION',$this->UNIV_DIRECCION,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}