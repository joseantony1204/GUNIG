<?php

/**
 * This is the model class for table "TBL_TIPOSDESCUENTOS".
 *
 * The followings are the available columns in table 'TBL_TIPOSDESCUENTOS':
 * @property integer $TIDE_ID
 * @property string $TIDE_NOMBRE
 *
 * The followings are the available model relations:
 * @property TBLDESCUENTOS[] $tBLDESCUENTOSes
 */
class Tiposdescuentos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tiposdescuentos the static model class
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
		return 'TBL_TIPOSDESCUENTOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TIDE_NOMBRE', 'required'),
			array('TIDE_NOMBRE', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TIDE_ID, TIDE_NOMBRE', 'safe', 'on'=>'search'),
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
			'tBLDESCUENTOSes' => array(self::HAS_MANY, 'Descuentos', 'TIDE_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'TIDE_ID' => 'Tide',
			'TIDE_NOMBRE' => 'Tide Nombre',
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

		$criteria->compare('TIDE_ID',$this->TIDE_ID);
		$criteria->compare('TIDE_NOMBRE',$this->TIDE_NOMBRE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}