<?php

/**
 * This is the model class for table "TBL_PERSONASCONTRATANTES".
 *
 * The followings are the available columns in table 'TBL_PERSONASCONTRATANTES':
 * @property integer $PECO_ID
 * @property string $PECO_DESCRIPCION
 * @property string $PECO_FECHAINICIO
 * @property string $PECO_FECHAFINAL
 * @property integer $PENA_ID
 * @property integer $REAC_ID
 *
 * The followings are the available model relations:
 * @property TblPersonasnaturales $pENA
 * @property TblResolucionesacuerdos $rEAC
 */
class Contratantes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Contratantes the static model class
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
		return 'TBL_PERSONASCONTRATANTES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PECO_DESCRIPCION, PENA_ID, REAC_ID', 'required'),
			array('PENA_ID, REAC_ID', 'numerical', 'integerOnly'=>true),
			array('PECO_DESCRIPCION', 'length', 'max'=>100),
			array('PECO_FECHAINICIO, PECO_FECHAFINAL', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PECO_ID, PECO_DESCRIPCION, PECO_FECHAINICIO, PECO_FECHAFINAL, PENA_ID, REAC_ID', 'safe', 'on'=>'search'),
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
			'rel_personas_naturales' => array(self::BELONGS_TO, 'Personasnaturales', 'PENA_ID'),
			'rel_resoluciones' => array(self::BELONGS_TO, 'Resolucionesacuerdos', 'REAC_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PECO_ID' => 'ID',
			'PECO_DESCRIPCION' => 'DESCRIPCION',
			'PECO_FECHAINICIO' => 'FECHA INICIO',
			'PECO_FECHAFINAL' => 'FECHA FINAL',
			'PENA_ID' => 'PERSONA',
			'REAC_ID' => 'RESOLUCION',
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

		$criteria->compare('PECO_ID',$this->PECO_ID);
		$criteria->compare('PECO_DESCRIPCION',$this->PECO_DESCRIPCION,true);
		$criteria->compare('PECO_FECHAINICIO',$this->PECO_FECHAINICIO,true);
		$criteria->compare('PECO_FECHAFINAL',$this->PECO_FECHAFINAL,true);
		$criteria->compare('PENA_ID',$this->PENA_ID);
		$criteria->compare('REAC_ID',$this->REAC_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
    public function getPersonas()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.PENA_ID, t.PENA_NOMBRES, t.PENA_APELLIDOS';
	 $criteria->join = '
	 INNER JOIN TBL_PERSONASCONTRATANTES c ON t.PENA_ID = c.PENA_ID';	
	 $criteria->order = 't.PENA_NOMBRES ASC';
	 return  CHtml::listData(Personasnaturales::model()->findAll($criteria),'PENA_ID','nombreCompleto'); 
	}	
}