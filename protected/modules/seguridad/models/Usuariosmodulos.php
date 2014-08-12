<?php

/**
 * This is the model class for table "TBL_USUARIOSMODULOS".
 *
 * The followings are the available columns in table 'TBL_USUARIOSMODULOS':
 * @property integer $USMO_ID
 * @property string $USMO_NOMBRE
 * @property string $USMO_URL
 */
class Usuariosmodulos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usuariosmodulos the static model class
	 */
	public $SUBMODULOS;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_USUARIOSMODULOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('USMO_NOMBRE, USMO_URL', 'required'),
			array('USMO_NOMBRE', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('USMO_ID, USMO_NOMBRE, USMO_URL', 'safe', 'on'=>'search'),
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
			'USMO_ID' => 'ID',
			'USMO_NOMBRE' => 'NOMBRE MODULO',
			'USMO_URL' => 'URL DEL MODULO',
			'SUBMODULOS' => 'SUB MODULOS',
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
		$criteria->select='t.*,
		(SELECT COUNT(usm.USMO_ID) FROM TBL_USUARIOSSUBMODULOS usm WHERE t.USMO_ID = usm.USMO_ID) AS SUBMODULOS';

		$criteria->compare('USMO_ID',$this->USMO_ID);
		$criteria->compare('USMO_NOMBRE',$this->USMO_NOMBRE,true);
		$criteria->compare('USMO_URL',$this->USMO_URL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}