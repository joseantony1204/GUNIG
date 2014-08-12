<?php

/**
 * This is the model class for table "TBL_HDVTIPOSDOCUMENTOS".
 *
 * The followings are the available columns in table 'TBL_HDVTIPOSDOCUMENTOS':
 * @property integer $HTDO_ID
 * @property string $HTDO_NOMBRE
 */
class Hdvtiposdocumentos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Hdvtiposdocumentos the static model class
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
		return 'TBL_HDVTIPOSDOCUMENTOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('HTDO_NOMBRE', 'required'),
			array('HTDO_NOMBRE', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('HTDO_ID, HTDO_NOMBRE', 'safe', 'on'=>'search'),
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
			'HTDO_ID' => 'ID',
			'HTDO_NOMBRE' => 'NOMBRE DEL TIPO DE DOCUMENTO',
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

		$criteria->compare('HTDO_ID',$this->HTDO_ID);
		$criteria->compare('HTDO_NOMBRE',$this->HTDO_NOMBRE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}