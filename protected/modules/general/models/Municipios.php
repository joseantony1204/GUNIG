<?php

/**
 * This is the model class for table "TBL_MUNICIPIOS".
 *
 * The followings are the available columns in table 'TBL_MUNICIPIOS':
 * @property integer $MUNI_ID
 * @property string $MUNI_NOMBRE
 * @property integer $DEPA_ID
 *
 * The followings are the available model relations:
 * @property TblDepartamentos $dEPA
 */
class Municipios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Municipios the static model class
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
		return 'TBL_MUNICIPIOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MUNI_NOMBRE, DEPA_ID', 'required'),
			array('DEPA_ID', 'numerical', 'integerOnly'=>true),
			array('MUNI_NOMBRE', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('MUNI_ID, MUNI_NOMBRE, DEPA_ID', 'safe', 'on'=>'search'),
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
			'rel_departamentos' => array(self::BELONGS_TO, 'Departamentos', 'DEPA_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'MUNI_ID' => 'ID',
			'MUNI_NOMBRE' => 'MUNICIPIO',
			'DEPA_ID' => 'DEPARTAMENTO',
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

		$criteria->compare('MUNI_ID',$this->MUNI_ID);
		$criteria->compare('MUNI_NOMBRE',$this->MUNI_NOMBRE,true);
		$criteria->compare('DEPA_ID',$this->DEPA_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getMunicipios()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.MUNI_ID, t.MUNI_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_PERSONASNATURALES pn ON pn.MUNI_ID = t.MUNI_ID '; //AND t.ANAC_ESTADO = 0	
	 $criteria->order = 't.MUNI_NOMBRE ASC';
	 return  CHtml::listData(Municipios::model()->findAll($criteria),'MUNI_ID','MUNI_NOMBRE'); 
	}	
}