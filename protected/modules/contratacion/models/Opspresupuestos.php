<?php

/**
 * This is the model class for table "TBL_TUTORIASPRESUPUESTOS".
 *
 * The followings are the available columns in table 'TBL_TUTORIASPRESUPUESTOS':
 * @property integer $PRES_ID
 * @property string $OPPR_FECHA_INGRESO
 *
 * The followings are the available model relations:
 * @property TblPresupuestos $pRES
 */
class Opspresupuestos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tutoriaspresupuestos the static model class
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
		return 'TBL_OPSPRESUPUESTOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PRES_ID, OPPR_FECHA_INGRESO', 'required'),
			array('PRES_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PRES_ID, OPPR_FECHA_INGRESO, PRES_NUM_CERTIFICADO, PRES_DESCRIPCION, 
			PRES_SECCION, PRES_CODIGO, PRES_MONTO, PRES_FECHA_VIGENCIA, PRES_NOMBRE, PRES_FECHA_INGRESO, TOTALCONTRATADO', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PRES_ID' => 'ID',
			'PRES_NUM_CERTIFICADO' => 'No. CERTIFICADO',
			'PRES_DESCRIPCION' => 'DESCRIPCION',
			'PRES_SECCION' => 'SECCION',
			'PRES_CODIGO' => 'CODIGO',
			'PRES_MONTO' => 'MONTO',
			'PRES_FECHA_VIGENCIA' => 'F.VIGENCIA',
			'PRES_NOMBRE' => 'NOMBRE',
			'OPPR_FECHA_INGRESO' => 'FECHA RECIBIDO',
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
			
			'TOTALCONTRATADO'=>array(
				'asc'=>'(SELECT ROUND((SUM(((oc.OPCO_VALOR_MENSUAL)*(oc.OPCO_MESES))+((oc.OPCO_VALOR_MENSUAL/30)*(oc.OPCO_DIAS)))))
		FROM TBL_OPSCONTRATOS oc WHERE t.OPPR_ID = oc.OPPR_ID AND oc.OPPR_ID = t.OPPR_ID)',
				'desc'=>'(SELECT ROUND((SUM(((oc.OPCO_VALOR_MENSUAL)*(oc.OPCO_MESES))+((oc.OPCO_VALOR_MENSUAL/30)*(oc.OPCO_DIAS)))))
		FROM TBL_OPSCONTRATOS oc WHERE t.OPPR_ID = oc.OPPR_ID AND oc.OPPR_ID = t.OPPR_ID) desc',
			),
			
	);	
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		
		$criteria->select = 't.OPPR_ID, p.PRES_ID, p.PRES_NUM_CERTIFICADO, p.PRES_DESCRIPCION, p.PRES_SECCION, p.PRES_CODIGO, 
		p.PRES_MONTO, p.PRES_NOMBRE, t.OPPR_FECHA_INGRESO, p.PRES_FECHA_VIGENCIA,
	    (SELECT ROUND((SUM(((oc.OPCO_VALOR_MENSUAL)*(oc.OPCO_MESES))+((oc.OPCO_VALOR_MENSUAL/30)*(oc.OPCO_DIAS)))))
		FROM TBL_OPSCONTRATOS oc WHERE t.OPPR_ID = oc.OPPR_ID AND oc.OPPR_ID = t.OPPR_ID) AS TOTALCONTRATADO';
        $criteria->join = 'INNER JOIN TBL_PRESUPUESTOS p ON p.PRES_ID = t.PRES_ID';
        
		
		$criteria->compare('PRES_ID',$this->PRES_ID);
		$criteria->compare('OPPR_FECHA_INGRESO',$this->OPPR_FECHA_INGRESO,true);
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
}