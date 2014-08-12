<?php

/**
 * This is the model class for table "TBL_CLASRESODESCUENTOS".
 *
 * The followings are the available columns in table 'TBL_CLASRESODESCUENTOS':
 * @property integer $CRDE_ID
 * @property integer $CLRE_ID
 * @property integer $DESC_ID
 */
class Clasresodescuentos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Clasresodescuentos the static model class
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
		return 'TBL_CLASRESODESCUENTOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CLRE_ID, DESC_ID', 'required'),
			array('CLRE_ID, DESC_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CRDE_ID, CLRE_ID, DESC_ID', 'safe', 'on'=>'search'),
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
		'cLRE' => array(self::BELONGS_TO, 'Clasesresoluciones', 'CLRE_ID'),
			'dESC' => array(self::BELONGS_TO, 'Descuentos', 'DESC_ID'),
		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CRDE_ID' => 'Crde',
			'CLRE_ID' => 'Clre',
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

		$criteria->compare('CRDE_ID',$this->CRDE_ID);
		$criteria->compare('CLRE_ID',$this->CLRE_ID);
		$criteria->compare('DESC_ID',$this->DESC_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	 public function descuento($id)
	{
     $connection = Yii::app()->db;
	 $sql = "SELECT DESC_ID, DESC_NOMBRE FROM TBL_DESCUENTOS WHERE DESC_ID NOT IN (SELECT DESC_ID FROM TBL_CLASRESODESCUENTOS WHERE CLRE_ID='$id')";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data; 
	}	
	
	public function getClasesresoluciones()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.CLRE_ID, t.CLRE_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_CLASRESODESCUENTOS  c ON c.CLRE_ID = t.CLRE_ID';	
	 $criteria->order = 't.CLRE_NOMBRE ASC';
	 return  CHtml::listData(Clasesresoluciones::model()->findAll($criteria),'CLRE_ID','CLRE_NOMBRE'); 
	}	
	
	public function getDescuentos()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.DESC_ID, t.DESC_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_CLASRESODESCUENTOS  c ON c.DESC_ID = t.DESC_ID';	
	 $criteria->order = 't.DESC_NOMBRE ASC';
	 return  CHtml::listData(Descuentos::model()->findAll($criteria),'DESC_ID','DESC_NOMBRE'); 
	}
	
}