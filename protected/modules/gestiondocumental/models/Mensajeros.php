<?php

/**
 * This is the model class for table "TBL_MENSAJEROS".
 *
 * The followings are the available columns in table 'TBL_MENSAJEROS':
 * @property integer $MENS_ID
 * @property integer $PENA_ID
 * @property string $MENS_DESCRIPCION
 *
 * The followings are the available model relations:
 * @property TBLPERSONASNATURALES $pEND
 */
class Mensajeros extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Mensajeros the static model class
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
		return 'TBL_MENSAJEROS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PENA_ID, MENS_DESCRIPCION', 'required'),
			array('PENA_ID', 'numerical', 'integerOnly'=>true),
			array('MENS_DESCRIPCION', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('MENS_ID, PENA_ID, MENS_DESCRIPCION', 'safe', 'on'=>'search'),
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
			'rel_personasnaturales' => array(self::BELONGS_TO, 'Personasnaturales', 'PENA_ID'),
			//'tBLRADICADOSINTERNOSes' => array(self::HAS_MANY, 'Radicadosinternos', 'MENS_ID'),
			//'tBLRADICADOSEXTERNOSes' => array(self::HAS_MANY, 'Radicadosexternos', 'MENS_ID'),
			'tBLPENARAINDESTINOs' => array(self::HAS_MANY, 'Penaraindestino', 'MENS_ID'),
			'tBLRAINENEXes' => array(self::HAS_MANY, 'Rainenex', 'MENS_ID'),
			'tBLPENARAEXes' => array(self::HAS_MANY, 'Penaraex', 'MENS_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'MENS_ID' => 'ID',
			'PENA_ID' => 'MENSAJERO',
			'MENS_DESCRIPCION' => 'DESCRIPCION',
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

		$criteria->compare('MENS_ID',$this->MENS_ID);
		$criteria->compare('PENA_ID',$this->PENA_ID);
		$criteria->compare('MENS_DESCRIPCION',$this->MENS_DESCRIPCION,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	 public function personasNaturales()
	{
     $connection = Yii::app()->db;
	 $sql = "SELECT pn.PENA_ID, CONCAT(pn.PENA_NOMBRES, ' ' ,pn.PENA_APELLIDOS) AS PERSONA
			FROM TBL_PERSONASNATURALES pn";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data; 
	}
}