<?php

/**
 * This is the model class for table "TBL_OCASIONALESCONTRATOS".
 *
 * The followings are the available columns in table 'TBL_OCASIONALESCONTRATOS':
 * @property integer $OCCO_ID
 * @property integer $OCCO_RESOLUCION
 * @property integer $OCCO_MESES
 * @property integer $OCCO_DIAS
 * @property string $OCCO_FECHAPROCESO
 * @property integer $OCCO_VALORMENSUAL
 * @property integer $OCPR_ID
 * @property integer $PECO_ID
 * @property integer $PENO_ID
 *
 * The followings are the available model relations:
 * @property TblPersnaturalesocasionales $pENO
 * @property TblOcasionalespresupuestos $oCPR
 * @property TblPersonascontratantes $pECO
 */
class Ocasionalescontratos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ocasionalescontratos the static model class
	 */
	public $PERS_ID, $PERS_IDENTIFICACION, $PENA_NOMBRES, $PENA_APELLIDOS;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_OCASIONALESCONTRATOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OCCO_MESES, OCCO_DIAS, OCCO_FECHAPROCESO, OCCO_VALORMENSUAL, OCPR_ID, PECO_ID, PENO_ID', 'required'),
			array('OCCO_RESOLUCION, OCCO_MESES,OCCO_DIAS, OCCO_VALORMENSUAL, OCPR_ID, PECO_ID, PENO_ID', 'numerical','integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('OCCO_RESOLUCION, OCCO_MESES, OCCO_DIAS, OCCO_FECHAPROCESO, 
			OCCO_VALORMENSUAL, OCPR_ID, PECO_ID, PENO_ID, PERS_IDENTIFICACION, PENA_NOMBRES, PENA_APELLIDOS', 'safe', 'on'=>'search'),
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
			'rel_personas_naturales_ocasionales' => array(self::BELONGS_TO, 'Persnaturalesocasionales', 'PENO_ID'),
			'rel_oca_pesupuestos' => array(self::BELONGS_TO, 'Ocasionalespresupuestos', 'OCPR_ID'),
			'rel_contratanta' => array(self::BELONGS_TO, 'Contratantes', 'PECO_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'OCCO_ID' => 'ID',
			'OCCO_RESOLUCION' => 'RESOLUCION',
			'OCCO_MESES' => 'MESES',
			'OCCO_DIAS' => 'DIAS',
			'OCCO_FECHAPROCESO' => 'F.PROCESO',
			'OCCO_VALORMENSUAL' => 'VALOR MENSUAL',
			'OCPR_ID' => 'PRESUPUESTO',
			'PECO_ID' => 'CONTRATANTE',
			'PENO_ID' => 'PERSONA',
			
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
			'OCCO_RESOLUCION'=>array(
				'asc'=>'t.OCCO_RESOLUCION',
				'desc'=>'t.OCCO_RESOLUCION desc',
			),
			'OCCO_MESES'=>array(
				'asc'=>'t.OCCO_MESES',
				'desc'=>'t.OCCO_MESES desc',
			),
			'OCCO_DIAS'=>array(
				'asc'=>'t.OCCO_DIAS',
				'desc'=>'t.OCCO_DIAS desc',
			),
			'OCCO_VALORMENSUAL'=>array(
				'asc'=>'t.OCCO_VALORMENSUAL',
				'desc'=>'t.OCCO_VALORMENSUAL desc',
			),
		 );

		$criteria=new CDbCriteria;
		
		$criteria->select='t.*,pn.*,p.*';
		
		$criteria->join ='
		INNER JOIN TBL_PERSNATURALESOCASIONALES  pno ON pno.PENO_ID = t.PENO_ID
		INNER JOIN TBL_PERSONASNATURALES  pn ON pn.PENA_ID = pno.PENA_ID
		INNER JOIN TBL_PERSONAS  p ON p.PERS_ID = pn.PERS_ID
		INNER JOIN TBL_PERIODOSACADEMICOS  pa ON pa.PEAC_ID = pno.PEAC_ID AND pa.PEAC_ESTADO = 0';

		$criteria->compare('OCCO_ID',$this->OCCO_ID);
		$criteria->compare('OCCO_RESOLUCION',$this->OCCO_RESOLUCION);
		$criteria->compare('OCCO_MESES',$this->OCCO_MESES);
		$criteria->compare('OCCO_DIAS',$this->OCCO_DIAS);
		$criteria->compare('OCCO_FECHAPROCESO',$this->OCCO_FECHAPROCESO,true);
		$criteria->compare('OCCO_VALORMENSUAL',$this->OCCO_VALORMENSUAL);
		$criteria->compare('OCPR_ID',$this->OCPR_ID);
		$criteria->compare('PECO_ID',$this->PECO_ID);
		$criteria->compare('pno.PENO_ID',$this->PENO_ID);
		
		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION, true);
		$criteria->compare('PENA_NOMBRES',$this->PENA_NOMBRES,true);
		$criteria->compare('PENA_APELLIDOS',$this->PENA_APELLIDOS,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 10,),
		));
	}
	
	public	function downloadContratos($id=NULL,$facultad=NULL){
	 $connection = Yii::app()->db;
	 if($id!=""){
	  $condicion = " AND oc.OCCO_ID = ".$id;
	 }
	 if($facultad!=""){
	  $condicion = " AND f.FACU_ID = ".$facultad;
	 }	 
	 
	 $sql = "SELECT oc.OCCO_ID
	 FROM TBL_PERSNATURALESOCASIONALES pno, TBL_FACULTADES f, TBL_OCASIONALESCONTRATOS oc, TBL_PERIODOSACADEMICOS pa
	 WHERE pno.PENO_ID = oc.PENO_ID AND f.FACU_ID = pno.FACU_ID AND pa.PEAC_ID = pno.PEAC_ID AND pa.PEAC_ESTADO = 0  
	 $condicion GROUP BY (oc.OCCO_ID) ORDER BY (oc.OCCO_ID) ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
}