<?php

/**
 * This is the model class for table "TBL_OCASIONALESPRESUPUESTOS".
 *
 * The followings are the available columns in table 'TBL_OCASIONALESPRESUPUESTOS':
 * @property integer $OCPR_ID
 * @property integer $PRES_ID
 * @property integer $FACU_ID
 * @property string $OCPR_FECHAINGRESO
 *
 * The followings are the available model relations:
 * @property TblFacultades $fACU
 * @property TblPresupuestos $pRES
 */
class Ocasionalespresupuestos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ocasionalespresupuestos the static model class
	 */
	public $PRES_ID, $PRES_NUM_CERTIFICADO, $PRES_DESCRIPCION, $PRES_SECCION, $PRES_CODIGO, $PRES_MONTO, $PRES_FECHA_VIGENCIA, 
	$PRES_NOMBRE, $PRES_FECHA_INGRESO, $TOTALCONTRATADO;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_OCASIONALESPRESUPUESTOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PRES_ID, FACU_ID, OCPR_FECHAINGRESO', 'required'),
			array('PRES_ID, FACU_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('OCPR_ID, PRES_ID, FACU_ID, OCPR_FECHAINGRESO, PRES_NUM_CERTIFICADO, PRES_DESCRIPCION, 
			PRES_SECCION, PRES_CODIGO, PRES_MONTO, PRES_FECHA_VIGENCIA, PRES_NOMBRE, PRES_FECHA_INGRESO, 
			TOTALCONTRATADO', 'safe', 'on'=>'search'),
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
			'Presupuesto' => array(self::BELONGS_TO, 'Presupuestos', 'PRES_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'OCPR_ID' => 'IDOP',
			'PRES_ID' => 'IDP',
			'FACU_ID' => 'FACULTAD',
			'PRES_NUM_CERTIFICADO' => 'CERTIFICADO',
			'PRES_DESCRIPCION' => 'DESCRIPCION',
			'PRES_SECCION' => 'SECCION',
			'PRES_CODIGO' => 'CODIGO',
			'PRES_MONTO' => 'MONTO',
			'PRES_FECHA_VIGENCIA' => 'F.VIGENCIA',
			'PRES_NOMBRE' => 'NOMBRE',
			'OCPR_FECHAINGRESO' => 'FECHA INGRESO',
			'TOTALCONTRATADO' => 'DISPONIBLE',
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
			'defaultOrder'=>'t.PRES_ID ASC',
			
			'PRES_ID'=>array(
				'asc'=>'t.PRES_ID',
				'desc'=>'t.PRES_ID desc',
			),
			
			'PRES_NUM_CERTIFICADO'=>array(
				'asc'=>'p.PRES_NUM_CERTIFICADO',
				'desc'=>'p.PRES_NUM_CERTIFICADO desc',
			),
			
			'PRES_DESCRIPCION'=>array(
				'asc'=>'p.PRES_DESCRIPCION',
				'desc'=>'p.PRES_DESCRIPCION desc',
			),
			
			'PRES_SECCION'=>array(
				'asc'=>'p.PRES_SECCION',
				'desc'=>'p.PRES_SECCION desc',
			),
			
			'PRES_CODIGO'=>array(
				'asc'=>'p.PRES_CODIGO',
				'desc'=>'p.PRES_CODIGO desc',
			),
			
			'PRES_MONTO'=>array(
				'asc'=>'p.PRES_MONTO',
				'desc'=>'p.PRES_MONTO desc',
			),
			
			'PRES_NOMBRE'=>array(
				'asc'=>'p.PRES_NOMBRE',
				'desc'=>'p.PRES_NOMBRE desc',
			),
			
			'PRES_FECHA_VIGENCIA'=>array(
				'asc'=>'p.PRES_FECHA_VIGENCIA',
				'desc'=>'p.PRES_FECHA_VIGENCIA desc',
			),
			
			'FACU_ID'=>array(
				'asc'=>'t.FACU_ID',
				'desc'=>'t.FACU_ID desc',
			),
			
			'TOTALCONTRATADO'=>array(
				'asc'=>'(SELECT ROUND((SUM(((oc.OCCO_VALORMENSUAL)*(oc.OCCO_MESES))+((oc.OCCO_VALORMENSUAL/30)*(oc.OCCO_DIAS)))))
		FROM TBL_OCACSIONALESCONTRATOS oc WHERE t.OCPR_ID = oc.OCPR_ID)',
				'desc'=>'(SELECT ROUND((SUM(((oc.OCCO_VALORMENSUAL)*(oc.OCCO_MESES))+((oc.OCCO_VALORMENSUAL/30)*(oc.OCCO_DIAS)))))
		FROM TBL_OCACSIONALESCONTRATOS oc WHERE t.OCPR_ID = oc.OCPR_ID) desc',
			),
			
	);
        $criteria=new CDbCriteria;
		$criteria->select = 't.OCPR_ID, p.PRES_ID, p.PRES_NUM_CERTIFICADO, p.PRES_DESCRIPCION, p.PRES_SECCION, p.PRES_CODIGO, 
		p.PRES_MONTO, p.PRES_NOMBRE, t.OCPR_FECHAINGRESO, p.PRES_FECHA_VIGENCIA, t.FACU_ID,
	    (SELECT ROUND((SUM(((oc.OCCO_VALORMENSUAL)*(oc.OCCO_MESES))+((oc.OCCO_VALORMENSUAL/30)*(oc.OCCO_DIAS)))))
		FROM TBL_OCASIONALESCONTRATOS oc WHERE t.OCPR_ID = oc.OCPR_ID) AS TOTALCONTRATADO';
        $criteria->join = 'INNER JOIN TBL_PRESUPUESTOS p ON p.PRES_ID = t.PRES_ID';
        $criteria->order = 'p.PRES_ID DESC';

		$criteria->compare('OCPR_ID',$this->OCPR_ID);
		$criteria->compare('PRES_ID',$this->PRES_ID);
		$criteria->compare('FACU_ID',$this->FACU_ID);
		$criteria->compare('OCPR_FECHAINGRESO',$this->OCPR_FECHAINGRESO,true);
		
		$criteria->compare('PRES_NUM_CERTIFICADO',$this->PRES_NUM_CERTIFICADO);
		$criteria->compare('PRES_DESCRIPCION',$this->PRES_DESCRIPCION,true);
		$criteria->compare('PRES_SECCION',$this->PRES_SECCION);
		$criteria->compare('PRES_CODIGO',$this->PRES_CODIGO,true);
		$criteria->compare('PRES_MONTO',$this->PRES_MONTO);
		$criteria->compare('PRES_NOMBRE',$this->PRES_NOMBRE,true);
		$criteria->compare('PRES_FECHA_VIGENCIA',$this->PRES_FECHA_VIGENCIA,true);
		$criteria->compare('TOTALCONTRATADO',$this->TOTALCONTRATADO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 10,),
		));
	}
	
    public function getFacultades()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.FACU_ID, t.FACU_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_OCASIONALESPRESUPUESTOS  c ON t.FACU_ID = c.FACU_ID';	
	 $criteria->order = 't.FACU_NOMBRE ASC';
	 return  CHtml::listData(Facultades::model()->findAll($criteria),'FACU_ID','FACU_NOMBRE'); 
	}	
}