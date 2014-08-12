<?php

/**
 * This is the model class for table "TBL_CLASESRESOLUCIONES".
 *
 * The followings are the available columns in table 'TBL_CLASESRESOLUCIONES':
 * @property integer $CLRE_ID
 * @property string $CLRE_NOMBRE
 *
 * The followings are the available model relations:
 * @property TBLRESOLUCIONES[] $tBLRESOLUCIONESs
 */
class Clasesresoluciones extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Clasesresoluciones the static model class
	 */
	 public $DESCUENTOS; 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_CLASESRESOLUCIONES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CLRE_NOMBRE', 'required'),
			array('CLRE_NOMBRE', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CLRE_ID, CLRE_NOMBRE, DESCUENTOS', 'safe', 'on'=>'search'),
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
			'rELI' => array(self::HAS_MANY, 'Resolucionesliquidaciones', 'CLRE_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CLRE_ID' => 'Clre',
			'CLRE_NOMBRE' => 'Clre Nombre',
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
		
		
		$criteria->select='t.*,(SELECT COUNT(a.CLRE_ID) FROM TBL_CLASRESODESCUENTOS a 
		WHERE a.CLRE_ID = t.CLRE_ID) AS DESCUENTOS';


		

		$criteria->compare('CLRE_ID',$this->CLRE_ID);
		$criteria->compare('CLRE_NOMBRE',$this->CLRE_NOMBRE,true);
		$criteria->compare('DESCUENTOS',$this->DESCUENTOS);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}