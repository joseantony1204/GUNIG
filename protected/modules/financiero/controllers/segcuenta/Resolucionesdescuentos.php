<?php

/**
 * This is the model class for table "TBL_RESOLUCIONESDESCUENTOS".
 *
 * The followings are the available columns in table 'TBL_RESOLUCIONESDESCUENTOS':
 * @property integer $REDE_ID
 * @property double $REDE_TARIFA
 * @property integer $DESC_ID
 * @property string $RELI_ID
 *
 * The followings are the available model relations:
 * @property TBLRESOLUCIONES $rESO
 * @property TBLDESCUENTOS $dESC
 */
class Resolucionesdescuentos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Resolucionesdescuentos the static model class
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
		return 'TBL_RESOLUCIONESDESCUENTOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('REDE_TARIFA, DESC_ID, RELI_ID', 'required'),
			array('DESC_ID', 'numerical', 'integerOnly'=>true),
			array('REDE_TARIFA', 'numerical'),
			array('RELI_ID', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('REDE_ID, REDE_TARIFA, DESC_ID, RELI_ID', 'safe', 'on'=>'search'),
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
			'rESO' => array(self::BELONGS_TO, 'TBLRESOLUCIONESLIQUIDACIONES', 'RELI_ID'),
			'dESC' => array(self::BELONGS_TO, 'TBLDESCUENTOS', 'DESC_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'REDE_ID' => 'Rede',
			'REDE_TARIFA' => 'Rede Tarifa',
			'DESC_ID' => 'Desc',
			'RELI_ID' => 'Reso',
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

		$criteria->compare('REDE_ID',$this->REDE_ID);
		$criteria->compare('REDE_TARIFA',$this->REDE_TARIFA);
		$criteria->compare('DESC_ID',$this->DESC_ID);
		$criteria->compare('RELI_ID',$this->RELI_ID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}