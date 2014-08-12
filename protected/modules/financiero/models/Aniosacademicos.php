<?php

/**
 * This is the model class for table "TBL_ANIOSACADEMICOS".
 *
 * The followings are the available columns in table 'TBL_ANIOSACADEMICOS':
 * @property integer $ANAC_ID
 * @property string $ANAC_NOMBRE
 * @property string $ANAC_FECHA_INICIO
 * @property string $ANAC_FECHA_FINAL
 * @property integer $ANAC_ESTADO
 *
 * The followings are the available model relations:
 * @property DESCUENTOSATRIBUTOS[] $dESCUENTOSATRIBUTOSes
 * @property LIQUIDACIONES[] $lIQUIDACIONESs
 */
class Aniosacademicos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Aniosacademicos the static model class
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
		return 'TBL_ANIOSACADEMICOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ANAC_ID, ANAC_NOMBRE, ANAC_FECHA_INICIO, ANAC_FECHA_FINAL, ANAC_ESTADO', 'required'),
			array('ANAC_ID, ANAC_ESTADO', 'numerical', 'integerOnly'=>true),
			array('ANAC_NOMBRE', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ANAC_ID, ANAC_NOMBRE, ANAC_FECHA_INICIO, ANAC_FECHA_FINAL, ANAC_ESTADO', 'safe', 'on'=>'search'),
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
			'dESCUENTOSATRIBUTOSes' => array(self::HAS_MANY, 'DESCUENTOSATRIBUTOS', 'ANAC_ID'),
			'lIQUIDACIONESs' => array(self::HAS_MANY, 'LIQUIDACIONES', 'ANAC_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ANAC_ID' => 'Anac',
			'ANAC_NOMBRE' => 'Anac Nombre',
			'ANAC_FECHA_INICIO' => 'Anac Fecha Inicio',
			'ANAC_FECHA_FINAL' => 'Anac Fecha Final',
			'ANAC_ESTADO' => 'Anac Estado',
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

		$criteria->compare('ANAC_ID',$this->ANAC_ID);
		$criteria->compare('ANAC_NOMBRE',$this->ANAC_NOMBRE,true);
		$criteria->compare('ANAC_FECHA_INICIO',$this->ANAC_FECHA_INICIO,true);
		$criteria->compare('ANAC_FECHA_FINAL',$this->ANAC_FECHA_FINAL,true);
		$criteria->compare('ANAC_ESTADO',$this->ANAC_ESTADO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}