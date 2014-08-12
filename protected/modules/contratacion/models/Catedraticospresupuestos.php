<?php

/**
 * This is the model class for table "TBL_CATEDRATICOSPRESUPUESTOS".
 *
 * The followings are the available columns in table 'TBL_CATEDRATICOSPRESUPUESTOS':
 * @property integer $CAPR_ID
 * @property integer $PRES_ID
 * @property integer $FACU_ID
 * @property string $CAPR_FECHAINGRESO
 *
 * The followings are the available model relations:
 * @property TblPresupuestos $pRES
 */
class Catedraticospresupuestos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Catedraticospresupuestos the static model class
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
		return 'TBL_CATEDRATICOSPRESUPUESTOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PRES_ID, FACU_ID, CAPR_FECHAINGRESO', 'required'),
			array('PRES_ID, FACU_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			
			array('PRES_ID, FACU_ID, CAPR_FECHAINGRESO, PRES_NUM_CERTIFICADO, PRES_DESCRIPCION, PRES_SECCION, PRES_CODIGO, PRES_MONTO, 
			PRES_FECHA_VIGENCIA, PRES_NOMBRE, PRES_FECHA_INGRESO, TOTALCONTRATADO', 'safe', 'on'=>'search'),
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
			'Presupuesto' => array(self::BELONGS_TO, 'Presupuestos', 'PRES_ID'),
			'rel_facultades' => array(self::BELONGS_TO, 'Facultades', 'FACU_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(			
			'PRES_ID' => 'ID',
			'PRES_NUM_CERTIFICADO' => 'CERTIFICADO',
			'PRES_DESCRIPCION' => 'DESCRIPCION',
			'PRES_SECCION' => 'SECCION',
			'PRES_CODIGO' => 'CODIGO',
			'PRES_MONTO' => 'MONTO',
			'PRES_FECHA_VIGENCIA' => 'F.VIGENCIA',
			'PRES_NOMBRE' => 'NOMBRE',
			'CAPR_FECHAINGRESO' => 'FECHA RECIBIDO',
			'FACU_ID' => 'FACULTAD',
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
			'defaultOrder'=>'p.PRES_FECHA_VIGENCIA DESC',
			
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
			
			
	);	

		$criteria=new CDbCriteria;
		
		$criteria->select = 't.CAPR_ID, p.PRES_ID, p.PRES_NUM_CERTIFICADO, p.PRES_DESCRIPCION, p.PRES_SECCION, p.PRES_CODIGO, 
		p.PRES_MONTO, p.PRES_NOMBRE, t.CAPR_FECHAINGRESO, p.PRES_FECHA_VIGENCIA, t.FACU_ID';
		
        $criteria->join = 'INNER JOIN TBL_PRESUPUESTOS p ON p.PRES_ID = t.PRES_ID';
	
		$criteria->compare('PRES_ID',$this->PRES_ID);
		$criteria->compare('CAPR_FECHAINGRESO',$this->CAPR_FECHAINGRESO,true);
		$criteria->compare('FACU_ID',$this->FACU_ID);
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
	 $criteria->join = 'INNER JOIN TBL_CATEDRATICOSPRESUPUESTOS  c ON t.FACU_ID = c.FACU_ID';	
	 $criteria->order = 't.FACU_NOMBRE ASC';
	 return  CHtml::listData(Facultades::model()->findAll($criteria),'FACU_ID','FACU_NOMBRE'); 
	}
}