<?php

/**
 * This is the model class for table "TBL_SEXOS".
 *
 * The followings are the available columns in table 'TBL_SEXOS':
 * @property integer $SEXO_ID
 * @property string $SEXO_NOMBRE
 * @property string $SEXO_DESCRIPCION
 *
 * The followings are the available model relations:
 * @property GRADUADOS[] $gRADUADOSes
 */
class Sexos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Sexos the static model class
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
		return 'TBL_SEXOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SEXO_NOMBRE', 'required'),
			array('SEXO_NOMBRE', 'length', 'max'=>15),
			array('SEXO_DESCRIPCION', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SEXO_ID, SEXO_NOMBRE, SEXO_DESCRIPCION', 'safe', 'on'=>'search'),
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
			'gRADUADOSes' => array(self::HAS_MANY, 'GRADUADOS', 'SEXO_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'SEXO_ID' => 'Sexo',
			'SEXO_NOMBRE' => 'Sexo Nombre',
			'SEXO_DESCRIPCION' => 'Sexo Descripcion',
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

		$criteria->compare('SEXO_ID',$this->SEXO_ID);
		$criteria->compare('SEXO_NOMBRE',$this->SEXO_NOMBRE,true);
		$criteria->compare('SEXO_DESCRIPCION',$this->SEXO_DESCRIPCION,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getSexos()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.SEXO_ID, t.SEXO_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_PERSONASNATURALES pn ON pn.SEXO_ID = t.SEXO_ID '; //AND t.ANAC_ESTADO = 0	
	 $criteria->order = 't.SEXO_NOMBRE ASC';
	 return  CHtml::listData(Sexos::model()->findAll($criteria),'SEXO_ID','SEXO_NOMBRE'); 
	}	
}