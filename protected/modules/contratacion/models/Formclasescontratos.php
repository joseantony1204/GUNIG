<?php

/**
 * This is the model class for table "TBL_FORMCLASESCONTRATOS".
 *
 * The followings are the available columns in table 'TBL_FORMCLASESCONTRATOS':
 * @property integer $FCCO_ID
 * @property string $FCCO_NOMBRE
 * @property integer $CLCO_ID
 * @property string $FCCO_DESCRIPCION
 *
 * The followings are the available model relations:
 * @property TblClasescontratos $cLCO
 */
class Formclasescontratos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Formclasescontratos the static model class
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
		return 'TBL_FORMCLASESCONTRATOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FCCO_NOMBRE, CLCO_ID', 'required'),
			array('CLCO_ID', 'numerical', 'integerOnly'=>true),
			array('FCCO_DESCRIPCION', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FCCO_ID, FCCO_NOMBRE, CLCO_ID, FCCO_DESCRIPCION', 'safe', 'on'=>'search'),
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
			'cLCO' => array(self::BELONGS_TO, 'TblClasescontratos', 'CLCO_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'FCCO_ID' => 'ID',
			'FCCO_NOMBRE' => 'FORMATO DEL CONTRATO',
			'CLCO_ID' => 'CLASE DE CONTRATO',
			'FCCO_DESCRIPCION' => 'DESCRIPCION DEL FORMATO',
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

		$criteria->compare('FCCO_ID',$this->FCCO_ID);
		$criteria->compare('FCCO_NOMBRE',$this->FCCO_NOMBRE,true);
		$criteria->compare('CLCO_ID',$this->CLCO_ID);
		$criteria->compare('FCCO_DESCRIPCION',$this->FCCO_DESCRIPCION,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}