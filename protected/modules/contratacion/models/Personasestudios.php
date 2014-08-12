<?php

/**
 * This is the model class for table "TBL_PERSONASESTUDIOS".
 *
 * The followings are the available columns in table 'TBL_PERSONASESTUDIOS':
 * @property integer $PEES_ID
 * @property integer $ESTU_ID
 * @property integer $PERS_IDENTIFICACION
 * @property string $PEES_LUGAR
 * @property string $PEES_FECHA
 *
 * The followings are the available model relations:
 * @property TblPersonas $pERSIDENTIFICACION
 * @property TblEstudios $eSTU
 */
class Personasestudios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Personasestudios the static model class
	 */
	public $ESTU_NOMBRE;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_PERSONASESTUDIOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ESTU_ID, PERS_IDENTIFICACION', 'numerical', 'integerOnly'=>true),
			array('PEES_LUGAR', 'length', 'max'=>100),
			array('PEES_FECHA', 'safe'),
			array('ESTU_ID, PEES_LUGAR', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PEES_ID, ESTU_ID, PERS_IDENTIFICACION, PEES_LUGAR, PEES_FECHA', 'safe', 'on'=>'search'),
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
			'rel_persona' => array(self::BELONGS_TO, 'Personas', 'PERS_IDENTIFICACION'),
			'rel_estudio' => array(self::BELONGS_TO, 'Estudios', 'ESTU_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PEES_ID' => 'ID',
			'ESTU_ID' => 'ESTUDIO',
			'PERS_IDENTIFICACION' => 'PERSONA',
			'PEES_LUGAR' => 'LUGAR DONDE CULMINÓ EL ESTUDIO',
			'PEES_FECHA' => 'FECHA DE CULMINACIÓN',
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

		$criteria->compare('PEES_ID',$this->PEES_ID);
		$criteria->compare('ESTU_ID',$this->ESTU_ID);
		$criteria->compare('PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION);
		$criteria->compare('PEES_LUGAR',$this->PEES_LUGAR,true);
		$criteria->compare('PEES_FECHA',$this->PEES_FECHA,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}