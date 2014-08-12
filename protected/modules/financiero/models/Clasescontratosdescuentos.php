<?php

/**
 * This is the model class for table "TBL_CLASESCONTRATOSDESCUENTOS".
 *
 * The followings are the available columns in table 'TBL_CLASESCONTRATOSDESCUENTOS':
 * @property string $CCDE_ID
 * @property string $DESC_ID
 * @property integer $CLCO_ID
 *
 * The followings are the available model relations:
 * @property CLASESCONTRATOS $cLCO
 * @property DESCUENTOS $dESC
 */
class Clasescontratosdescuentos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Clasescontratosdescuentos the static model class
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
		return 'TBL_CLASESCONTRATOSDESCUENTOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DESC_ID, CLCO_ID', 'required'),
			array('CLCO_ID', 'numerical', 'integerOnly'=>true),
			array('DESC_ID', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CCDE_ID, DESC_ID, CLCO_ID', 'safe', 'on'=>'search'),
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
			'cLCO' => array(self::BELONGS_TO, 'Clasescontratos', 'CLCO_ID'),
			'dESC' => array(self::BELONGS_TO, 'Descuentos', 'DESC_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CCDE_ID' => 'Id',
			'DESC_ID' => 'Descuentos',
			'CLCO_ID' => 'Clases de contratos',
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

		$criteria->compare('CCDE_ID',$this->CCDE_ID,true);
		$criteria->compare('DESC_ID',$this->DESC_ID,true);
		$criteria->compare('CLCO_ID',$this->CLCO_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getClasescontratos()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.CLCO_ID, t.CLCO_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_CLASESCONTRATOSDESCUENTOS  c ON c.CLCO_ID = t.CLCO_ID';	
	 $criteria->order = 't.CLCO_NOMBRE ASC';
	 return  CHtml::listData(Clasescontratos::model()->findAll($criteria),'CLCO_ID','CLCO_NOMBRE'); 
	}	
	
	public function getDescuentos()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.DESC_ID, t.DESC_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_CLASESCONTRATOSDESCUENTOS  c ON c.DESC_ID = t.DESC_ID';	
	 $criteria->order = 't.DESC_NOMBRE ASC';
	 return  CHtml::listData(Descuentos::model()->findAll($criteria),'DESC_ID','DESC_NOMBRE'); 
	}
	
	
	 public function descuento($id)
	{
     $connection = Yii::app()->db;
	 $sql = "SELECT DESC_ID, DESC_NOMBRE FROM TBL_DESCUENTOS WHERE DESC_ID NOT IN (SELECT DESC_ID FROM TBL_CLASESCONTRATOSDESCUENTOS WHERE CLCO_ID='$id')";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data; 
	}	
	
}