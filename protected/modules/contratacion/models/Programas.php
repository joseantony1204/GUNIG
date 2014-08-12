<?php

/**
 * This is the model class for table "TBL_PROGRAMAS".
 *
 * The followings are the available columns in table 'TBL_PROGRAMAS':
 * @property integer $PROG_ID
 * @property string $PROG_NOMBRE
 * @property integer $FACU_ID
 * @property integer $NIES_ID 
 *
 * The followings are the available model relations:
 * @property ASIGNATURAS[] $aSIGNATURASes
 * @property DIRECTORESPROGRAMAS[] $dIRECTORESPROGRAMASes
 * @property FACULTADES $fACU
 */
class Programas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Programas the static model class
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
		return 'TBL_PROGRAMAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PROG_NOMBRE, FACU_ID, NIES_ID', 'required'),
			array('FACU_ID, NIES_ID', 'numerical', 'integerOnly'=>true),
			array('PROG_NOMBRE', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PROG_ID, PROG_NOMBRE, FACU_ID, NIES_ID', 'safe', 'on'=>'search'),
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
			'rel_facultades' => array(self::BELONGS_TO, 'Facultades', 'FACU_ID'),
			'rel_niveles_estudios' => array(self::BELONGS_TO, 'Nivelesestudios', 'NIES_ID'), 
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PROG_ID' => 'ID',
			'PROG_NOMBRE' => 'NOMBRE PROGRAMA',
			'FACU_ID' => 'FACULTAD',
			'NIES_ID' => 'NIVEL ESTUDIO',
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

		$criteria->compare('PROG_ID',$this->PROG_ID);
		$criteria->compare('PROG_NOMBRE',$this->PROG_NOMBRE,true);
		$criteria->compare('FACU_ID',$this->FACU_ID);
		$criteria->compare('NIES_ID',$this->NIES_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getFacultades()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.FACU_ID, t.FACU_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_PROGRAMAS  c ON t.FACU_ID = c.FACU_ID';	
	 $criteria->order = 't.FACU_NOMBRE ASC';
	 return  CHtml::listData(Facultades::model()->findAll($criteria),'FACU_ID','FACU_NOMBRE'); 
	}
	
	public function getNivelesestudios()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.NIES_ID, t.NIES_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_PROGRAMAS  c ON t.NIES_ID = c.NIES_ID';	
	 $criteria->order = 't.NIES_NOMBRE ASC';
	 return  CHtml::listData(Nivelesestudios::model()->findAll($criteria),'NIES_ID','NIES_NOMBRE'); 
	}
}