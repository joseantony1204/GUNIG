<?php

/**
 * This is the model class for table "TBL_LIQUIDACIONESDESCUENTOS".
 *
 * The followings are the available columns in table 'TBL_LIQUIDACIONESDESCUENTOS':
 * @property integer $LIDE_ID
 * @property double $LIDE_TARIFA
 * @property integer $LIQU_ID
 * @property integer $DESC_ID
 *
 * The followings are the available model relations:
 * @property TBLDESCUENTOS $dESC
 * @property TBLLIQUIDACIONES $lIQU
 */
class Liquidacionesdescuentos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Liquidacionesdescuentos the static model class
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
		return 'TBL_LIQUIDACIONESDESCUENTOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('LIQU_ID', 'required'),
			array('LIQU_ID, DESC_ID', 'numerical', 'integerOnly'=>true),
			array('LIDE_TARIFA', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('LIDE_ID, LIDE_TARIFA, LIQU_ID, DESC_ID', 'safe', 'on'=>'search'),
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
			'dESC' => array(self::BELONGS_TO, 'Descuentos', 'DESC_ID'),
			'lIQU' => array(self::BELONGS_TO, 'Liquidaciones', 'LIQU_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'LIDE_ID' => 'Lide',
			'LIDE_TARIFA' => 'Lide Tarifa',
			'LIQU_ID' => 'Liqu',
			'DESC_ID' => 'Desc',
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

		$criteria->compare('LIDE_ID',$this->LIDE_ID);
		$criteria->compare('LIDE_TARIFA',$this->LIDE_TARIFA);
		$criteria->compare('LIQU_ID',$this->LIQU_ID);
		$criteria->compare('DESC_ID',$this->DESC_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}