<?php

/**
 * This is the model class for table "TBL_TUTORIAS".
 *
 * The followings are the available columns in table 'TBL_TUTORIAS':
 * @property integer $TUTO_ID
 * @property integer $TUTO_INTENSIDAD
 * @property integer $TUTO_VALOR
 * @property string $TUTO_PLAZO
 * @property integer $TUSP_ID
 * @property integer $SEDE_ID
 * @property integer $TUPR_ID
 * @property integer $TUCO_ID
 *
 * The followings are the available model relations:
 * @property TblTutoriascontratos $cONT
 * @property TblTutoriassubprogramas $tUSP
 * @property TblTutoriaspresupuestos $pRES
 */
class Tutorias extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tutorias the static model class
	 */
	public $MODULOS; 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_TUTORIAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TUTO_INTENSIDAD, TUTO_VALOR, TUSP_ID, SEDE_ID, TUPR_ID, TUCO_ID', 'required'),
			array('TUTO_INTENSIDAD, TUTO_VALOR, TUSP_ID, SEDE_ID, TUPR_ID, TUCO_ID', 'numerical', 'integerOnly'=>true),
			array('TUTO_PLAZO', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TUTO_ID, TUTO_INTENSIDAD, TUTO_VALOR, TUTO_PLAZO, TUSP_ID, SEDE_ID, TUPR_ID, TUCO_ID, MODULOS', 'safe', 'on'=>'search'),
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
			'Presupuesto' => array(self::BELONGS_TO, 'Tutoriaspresupuestos', 'TUPR_ID'),
			'Contrato' => array(self::BELONGS_TO, 'Tutoriascontratos', 'CONT_ID'),
			'Subprograma' => array(self::BELONGS_TO, 'Tutoriassubprogramas', 'TUSP_ID'),
			'Sede' => array(self::BELONGS_TO, 'Sedes', 'SEDE_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'TUTO_ID' => 'ID',
			'TUTO_INTENSIDAD' => 'INTENSIDAD(Horas)',
			'TUTO_VALOR' => 'VALOR',
			'TUTO_PLAZO' => 'PLAZO',
			'TUSP_ID' => 'PROGRAMA',
			'SEDE_ID' => 'SEDE',
			'TUPR_ID' => 'CDP',
			'TUCO_ID' => 'ID CONTRATO',
			'MODULOS' => 'MODULOS', 
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
		
		$sort = new CSort();
		$sort->attributes = array(
			'defaultOrder'=>'t.TUTO_ID ASC',
			
			'TUTO_ID'=>array(
				'asc'=>'t.TUTO_ID',
				'desc'=>'t.TUTO_ID desc',
			),
			
			'TUTO_INTENSIDAD'=>array(
				'asc'=>'t.TUTO_INTENSIDAD',
				'desc'=>'t.TUTO_INTENSIDAD desc',
			),
			
			'TUTO_VALOR'=>array(
				'asc'=>'t.TUTO_VALOR',
				'desc'=>'t.TUTO_VALOR desc',
			),
			
			'TUTO_PLAZO'=>array(
				'asc'=>'t.TUTO_PLAZO',
				'desc'=>'t.TUTO_PLAZO desc',
			),
			
			'TUSP_ID'=>array(
				'asc'=>'t.TUSP_ID',
				'desc'=>'t.TUSP_ID desc',
			),
			
			'SEDE_ID'=>array(
				'asc'=>'t.SEDE_ID',
				'desc'=>'t.SEDE_ID desc',
			),
			
			'TUPR_ID'=>array(
				'asc'=>'t.TUPR_ID',
				'desc'=>'t.TUPR_ID desc',
			),
			
			'MODULOS'=>array(
				'asc'=>'(SELECT COUNT(mt.TUTO_ID) FROM TBL_TUTORIASMODULOSXTUTORIAS mt 
				WHERE t.TUTO_ID = mt.TUTO_ID AND mt.TUTO_ID = t.TUTO_ID)',
				'desc'=>'(SELECT COUNT(mt.TUTO_ID) FROM TBL_TUTORIASMODULOSXTUTORIAS mt 
				WHERE t.TUTO_ID = mt.TUTO_ID AND mt.TUTO_ID = t.TUTO_ID) desc',
			));

		$criteria=new CDbCriteria;
		
		$criteria->select='t.TUTO_ID, t.TUTO_INTENSIDAD, t.TUTO_VALOR, t.TUTO_PLAZO,
		t.TUSP_ID, t.SEDE_ID, t.TUPR_ID, t.TUCO_ID,
		(SELECT COUNT(mt.TUTO_ID) FROM TBL_TUTORIASMODULOSXTUTORIAS mt 
		WHERE t.TUTO_ID = mt.TUTO_ID AND mt.TUTO_ID = t.TUTO_ID) AS MODULOS';
		

		$criteria->compare('TUTO_ID',$this->TUTO_ID);
		$criteria->compare('TUTO_INTENSIDAD',$this->TUTO_INTENSIDAD);
		$criteria->compare('TUTO_VALOR',$this->TUTO_VALOR);
		$criteria->compare('TUTO_PLAZO',$this->TUTO_PLAZO,true);
		$criteria->compare('TUSP_ID',$this->TUSP_ID);
		$criteria->compare('SEDE_ID',$this->SEDE_ID);
		$criteria->compare('TUPR_ID',$this->TUPR_ID);
		$criteria->compare('TUCO_ID',$this->TUCO_ID);
		$criteria->compare('MODULOS',$this->MODULOS); 

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 5,),
		));
	}
	
	public function getSubProgramas($id)
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.TUSP_ID, t.TUSP_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_TUTORIAS  c ON t.TUSP_ID = c.TUSP_ID AND c.TUCO_ID = '.$id;	
	 $criteria->order = 't.TUSP_NOMBRE ASC';
	 return  CHtml::listData(Tutoriassubprogramas::model()->findAll($criteria),'TUSP_ID','TUSP_NOMBRE'); 
	}

	public function getSedes($id)
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.SEDE_ID, t.SEDE_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_TUTORIAS  c ON t.SEDE_ID = c.SEDE_ID AND c.TUCO_ID = '.$id;	
	 $criteria->order = 't.SEDE_NOMBRE ASC';
	 return  CHtml::listData(Sedes::model()->findAll($criteria),'SEDE_ID','SEDE_NOMBRE'); 
	}

	public function getPresupuesto($id)
	{
	 $criteria=new CDbCriteria;
     $criteria->select='*';
	 $criteria->join = 'INNER JOIN TBL_TUTORIASPRESUPUESTOS  c ON t.PRES_ID = c.PRES_ID 
	 INNER JOIN TBL_TUTORIAS  tt ON tt.TUPR_ID = c.TUPR_ID AND tt.TUCO_ID = '.$id;
	 $criteria->order = 't.PRES_NUM_CERTIFICADO ASC';
	 return  CHtml::listData(Presupuestos::model()->findAll($criteria),'PRES_ID','PRES_NUM_CERTIFICADO'); 
	}		
}