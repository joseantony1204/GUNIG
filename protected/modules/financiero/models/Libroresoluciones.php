<?php

/**
 * This is the model class for table "tbl_resoluciones".
 *
 * The followings are the available columns in table 'tbl_resoluciones':
 * @property integer $LIRE_ID
 * @property string $LIRE_NUMERO
 * @property string $LIRE_CONCEPTO
 * @property double $LIRE_VALOR
 * @property string $LIRE_FECHA
 * @property integer $PERS_ID
  */
class Libroresoluciones extends CActiveRecord
{	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return libroresoluciones the static model class
	 */
	
	public function Personas()
	{
        $connection = Yii::app()->db;
	 $sql = "SELECT t.PERS_ID, CONCAT(pn.PENA_NOMBRES, ' ' , pn.PENA_APELLIDOS) AS NOMBRE
	 FROM TBL_PERSONAS t
	 INNER JOIN TBL_PERSONASNATURALES pn ON pn.PERS_ID = t.PERS_ID
	 UNION
	 SELECT t.PERS_ID, pj.PEJU_NOMBRE
	 FROM TBL_PERSONAS t
	 INNER JOIN TBL_PERSONASJURIDICAS pj ON pj.PERS_ID = t.PERS_ID";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data; 
	}

	public function getPersonas()
	{
	 $connection = Yii::app()->db;
	 $sql = "SELECT t.PERS_ID, CONCAT(pn.PENA_NOMBRES, ' ' , pn.PENA_APELLIDOS) AS NOMBRE
	 FROM TBL_PERSONAS t
	 INNER JOIN TBL_PERSONASNATURALES pn ON pn.PERS_ID = t.PERS_ID
	UNION
	 SELECT t.PERS_ID, pj.PEJU_NOMBRE AS NOMBRE
	 FROM TBL_PERSONAS t
	 INNER JOIN TBL_PERSONASJURIDICAS pj ON pj.PERS_ID = t.PERS_ID
	ORDER BY NOMBRE";
	 $data = $connection->createCommand($sql)->queryAll();
	 return CHtml::listData($data,'PERS_ID', 'NOMBRE'); 
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_LIBRORESOLUCIONES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('LIRE_NUMERO, LIRE_VALOR', 'numerical'),
			array('LIRE_CONCEPTO', 'length', 'max'=>200),
			array('LIRE_FECHA', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('LIRE_ID, PERS_ID, LIRE_NUMERO, LIRE_CONCEPTO, LIRE_VALOR, LIRE_FECHA', 'safe', 'on'=>'search'),
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
			'pERS' => array(self::BELONGS_TO, 'Personas', 'PERS_ID'),			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'LIRE_ID' => 'ID',
			'LIRE_NUMERO' => 'NUMERO',
			'PERS_ID' => 'PERSONA',
			'LIRE_CONCEPTO' => 'Concepto',
			'LIRE_VALOR' => 'Valor',
			'LIRE_FECHA' => 'Fecha',
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

		$criteria->compare('LIRE_ID',$this->LIRE_ID);
		$criteria->compare('LIRE_NUMERO',$this->LIRE_NUMERO);
		$criteria->compare('LIRE_CONCEPTO',$this->LIRE_CONCEPTO,true);
		$criteria->compare('LIRE_VALOR',$this->LIRE_VALOR);
		$criteria->compare('LIRE_FECHA',$this->LIRE_FECHA,true);
		$criteria->compare('PERS_ID',$this->PERS_ID);		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}