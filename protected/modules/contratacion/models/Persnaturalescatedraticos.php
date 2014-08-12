<?php

/**
 * This is the model class for table "TBL_PERSNATURALESCATEDRATICOS".
 *
 * The followings are the available columns in table 'TBL_PERSNATURALESCATEDRATICOS':
 * @property integer $PENC_ID
 * @property string $PENC_FECHAINGRESO
 * @property string $PENC_CATEGORIA
 * @property integer $PENC_VALORCATEGORIA
 * @property integer $CATE_ID
 * @property integer $PENA_ID
 * @property integer $PEAC_ID
 *
 * The followings are the available model relations:
 * @property TblCategorias $cATE
 * @property TblPersonasnaturales $pENA
 * @property TblPeriodosacademicos $pEAC
 */
class Persnaturalescatedraticos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Persnaturalescatedraticos the static model class
	 */
	public $NOMBREPERSONA, $PERS_IDENTIFICACION, $PENA_NOMBRES, $PENA_APELLIDOS;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_PERSNATURALESCATEDRATICOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PENC_FECHAINGRESO, PENC_CATEGORIA, PENC_VALORCATEGORIA, CATE_ID, PENA_ID, PEAC_ID', 'required'),
			array('PENC_VALORCATEGORIA, CATE_ID, PENA_ID, PEAC_ID', 'numerical', 'integerOnly'=>true),
			array('PENC_CATEGORIA', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PENC_ID, PENC_FECHAINGRESO, PENC_CATEGORIA, PENC_VALORCATEGORIA, CATE_ID, 
			PERS_IDENTIFICACION, PENA_NOMBRES, PENA_APELLIDOS, PENA_ID, PEAC_ID', 'safe', 'on'=>'search'),
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
			'cATE' => array(self::BELONGS_TO, 'TblCategorias', 'CATE_ID'),
			'rel_personas_naturales' => array(self::BELONGS_TO, 'Personasnaturales', 'PENA_ID'),
			'rel_repiodos_academicos' => array(self::BELONGS_TO, 'Periodosacademicos', 'PEAC_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PENC_ID' => 'Penc',
			'PENC_FECHAINGRESO' => 'FECHA INGRESO',
			'PENC_CATEGORIA' => 'CATEGORÍA',
			'PENC_VALORCATEGORIA' => 'VALOR CATEGORIA',
			'CATE_ID' => 'CATEGORÍA',
			'PENA_ID' => 'PERSONA',
			'PEAC_ID' => 'PERIODO ACADEMICO',
			
			'PERS_IDENTIFICACION' => 'No. IDENTIDAD',
			'PENA_NOMBRES' => 'NOMBRES ',
			'PENA_APELLIDOS' => 'APELLIDOS',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$sort = new CSort();
		$sort->attributes = array(
			'defaultOrder'=>'t.PENC_ID ASC',
			'PERS_IDENTIFICACION'=>array(
				'asc'=>'p.PERS_IDENTIFICACION',
				'desc'=>'p.PERS_IDENTIFICACION desc',
			),
			
			'PENA_NOMBRES'=>array(
				'asc'=>'pn.PENA_NOMBRES',
				'desc'=>'pn.PENA_NOMBRES desc',
			),
			
			'PENA_APELLIDOS'=>array(
				'asc'=>'pn.PENA_APELLIDOS',
				'desc'=>'pn.PENA_APELLIDOS desc',
			),
			'PENC_CATEGORIA'=>array(
				'asc'=>'t.PENC_CATEGORIA',
				'desc'=>'t.PENC_CATEGORIA desc',
			),
			'PENC_VALORCATEGORIA'=>array(
				'asc'=>'t.PENC_VALORCATEGORIA',
				'desc'=>'t.PENC_VALORCATEGORIA desc',
			),
			'PENC_FECHAINGRESO'=>array(
				'asc'=>'t.PENC_FECHAINGRESO',
				'desc'=>'t.PENC_FECHAINGRESO desc',
			),
			'PEAC_ID'=>array(
				'asc'=>'t.PEAC_ID',
				'desc'=>'t.PEAC_ID desc',
			),
		 );

		$criteria=new CDbCriteria;
		
		$criteria->select='t.*, p.PERS_IDENTIFICACION, pn.PENA_NOMBRES, pn.PENA_APELLIDOS';
		
		$criteria->join ='
		INNER JOIN TBL_PERSONASNATURALES  pn ON pn.PENA_ID = t.PENA_ID
		INNER JOIN TBL_PERSONAS  p ON p.PERS_ID = pn.PERS_ID
		INNER JOIN TBL_PERIODOSACADEMICOS  pa ON pa.PEAC_ID = t.PEAC_ID';

		$criteria->compare('PENC_ID',$this->PENC_ID);
		$criteria->compare('PENC_FECHAINGRESO',$this->PENC_FECHAINGRESO,true);
		$criteria->compare('PENC_CATEGORIA',$this->PENC_CATEGORIA,true);
		$criteria->compare('PENC_VALORCATEGORIA',$this->PENC_VALORCATEGORIA);
		$criteria->compare('CATE_ID',$this->CATE_ID);
		$criteria->compare('PENA_ID',$this->PENA_ID);
		$criteria->compare('t.PEAC_ID',$this->PEAC_ID);
		
		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION, true);
		$criteria->compare('PENA_NOMBRES',$this->PENA_NOMBRES,true);
		$criteria->compare('PENA_APELLIDOS',$this->PENA_APELLIDOS,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 30,),
		));
	}
	
	public function getPeriodosacademicos()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.PEAC_ID, t.PEAC_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_PERSNATURALESCATEDRATICOS  c ON t.PEAC_ID = c.PEAC_ID';
	 $criteria->order = 't.PEAC_NOMBRE ASC';
	 return  CHtml::listData(Periodosacademicos::model()->findAll($criteria),'PEAC_ID','PEAC_NOMBRE'); 
	}
	
	public function validarDocenteEnPeriodo($periodo,$persona){
    
	$connection = Yii::app()->db;
    $string = "SELECT * FROM TBL_PERSNATURALESCATEDRATICOS WHERE PEAC_ID = ".$periodo." AND PENA_ID = ".$persona.";";
	$num_rows = $connection->createCommand($string)->queryRow();
	if($num_rows==0){  
	 return 0; 
    }else{
		  return 1;
		 } 
   }
}