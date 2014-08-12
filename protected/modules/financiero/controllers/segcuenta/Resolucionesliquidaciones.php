<?php

/**
 * This is the model class for table "TBL_RESOLUCIONESLIQUIDACIONES".
 *
 * The followings are the available columns in table 'TBL_RESOLUCIONESLIQUIDACIONES':
 * @property integer $RELI_ID
 * @property integer $RELI_VALOR
 * @property integer $DEAT_ID
 * @property integer $DEAT_IDD
 * @property integer $CLRE_ID
 * @property integer $ANAC_ID
 * @property integer $RESO_ID
 *
 * The followings are the available model relations:
 * @property TBLRESOLUCIONESDESCUENTOS[] $tBLRESOLUCIONESDESCUENTOSes
 * @property TBLRESOLUCIONES $rESO
 * @property TBLANIOSACADEMICOS $aNAC
 */
class Resolucionesliquidaciones extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Resolucionesliquidaciones the static model class
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
		return 'TBL_RESOLUCIONESLIQUIDACIONES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('RELI_VALOR, CLRE_ID, ANAC_ID, RELI_ID', 'required'),
			array('RELI_VALOR, DEAT_ID, DEAT_IDD, CLRE_ID, ANAC_ID, RELI_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('RELI_ID, RELI_VALOR, RELI_EJECUTADO, RELI_UTILIDAD, RELI_AMOTIZACION, RELI_IVA, DEAT_ID, DEAT_IDD, CLRE_ID, ANAC_ID, RELI_ID', 'safe', 'on'=>'search'),
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
			'rEDE' => array(self::HAS_MANY, 'Resolucionesdescuentos', 'RELI_ID'),
			'rESO' => array(self::BELONGS_TO, 'Resoluciones', 'RELI_ID'),
			'aNAC' => array(self::BELONGS_TO, 'Aniosacademicos', 'ANAC_ID'),
			'cLRE' => array(self::BELONGS_TO, 'Clasesresoluciones', 'CLRE_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'RELI_ID' => 'Reli',
			'RELI_VALOR' => 'Reso Valor',
			'RELI_EJECUTADO' => 'Reli Ejecutado',
            'RELI_UTILIDAD' => 'Reli Utilidad',
            'RELI_AMOTIZACION' => 'Reli Amotizacion',
            'RELI_IVA' => 'Reli Iva',
			'DEAT_ID' => 'Deat',
			'DEAT_IDD' => 'Deat Idd',
			'CLRE_ID' => 'Clre',
			'ANAC_ID' => 'Anac',
			'RELI_ID' => 'Reso',
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

		$criteria->compare('RELI_ID',$this->RELI_ID);
		$criteria->compare('RELI_VALOR',$this->RELI_VALOR);
		$criteria->compare('RELI_EJECUTADO',$this->RELI_EJECUTADO);
        $criteria->compare('RELI_UTILIDAD',$this->RELI_UTILIDAD);
        $criteria->compare('RELI_AMOTIZACION',$this->RELI_AMOTIZACION);
        $criteria->compare('RELI_IVA',$this->RELI_IVA);
		$criteria->compare('DEAT_ID',$this->DEAT_ID);
		$criteria->compare('DEAT_IDD',$this->DEAT_IDD);
		$criteria->compare('CLRE_ID',$this->CLRE_ID);
		$criteria->compare('ANAC_ID',$this->ANAC_ID);
		$criteria->compare('RELI_ID',$this->RELI_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	
	
		
	public function descuentoAtributo($id){
     $connection = Yii::app()->db;
	 $sql = "SELECT da.DEAT_ID, CONCAT(da.DEAT_CODIGO, ' ' , da.DEAT_DESCRIPCION, ' (' , da.DEAT_VALOR, '%). ' ) AS DESCRIPCION	 
	FROM TBL_RESOLUCIONESLIQUIDACIONES rl, TBL_CLASESRESOLUCIONES cr, TBL_CLASRESODESCUENTOS crd, TBL_DESCUENTOS d, TBL_DESCUENTOSATRIBUTOS  da
	WHERE (rl.CLRE_ID = cr.CLRE_ID AND cr.CLRE_ID = crd.CLRE_ID AND crd.DESC_ID = d.DESC_ID AND d.DESC_ID = da.DESC_ID 
	AND da.ANAC_ID = rl.ANAC_ID AND rl.RELI_ID ='$id' AND d.ESDE_ID = 1 AND d.TIDE_ID = 2 AND d.APDE_ID = 3)";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data; 
	}	
	
	public function descuentoAtributo1($id){
     $connection = Yii::app()->db;
	 $sql = "SELECT da.DEAT_ID, CONCAT(da.DEAT_CODIGO, ' ' , da.DEAT_DESCRIPCION, ' (' , da.DEAT_VALOR, '%). ' ) AS DESCRIPCION	 
	FROM  TBL_RESOLUCIONESLIQUIDACIONES rl, TBL_CLASESRESOLUCIONES cr, TBL_CLASRESODESCUENTOS crd, TBL_DESCUENTOS d, TBL_DESCUENTOSATRIBUTOS  da
	WHERE (rl.CLRE_ID = cr.CLRE_ID AND cr.CLRE_ID = crd.CLRE_ID AND crd.DESC_ID = d.DESC_ID AND d.DESC_ID = da.DESC_ID 
	AND da.ANAC_ID = rl.ANAC_ID AND rl.RELI_ID ='$id' AND d.ESDE_ID = 1 AND d.TIDE_ID = 2 AND d.APDE_ID = 4)";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data; 
	}
	
	public function Anio($id){
	echo $sql = "SELECT ANAC_ID FROM TBL_RESOLUCIONESLIQUIDACIONES WHERE RELI_ID = '$id'";
	$connection = Yii::app()->db;
	$query = $connection->createCommand($sql)->queryColumn();
    $lastId = $query[0];
	return $lastId;
	}

	
	public function SalarioMinimo($Anio){
	echo $sql = "SELECT SAMI_VALOR FROM TBL_SALARIOSMINIMOS WHERE SAMI_ANIO = '$Anio'";
	$connection = Yii::app()->db;
	$query = $connection->createCommand($sql)->queryColumn();
    $lastId = $query[0];
	return $lastId;
	}
	
	
	
	public function loadDescuentos ($Anio, $id, $Salario, $Dato, $Dato1){
	echo $sql = "SELECT da.DESC_ID, da.DEAT_VALOR 
	FROM TBL_RESOLUCIONESLIQUIDACIONES rl, TBL_CLASESRESOLUCIONES cr, TBL_CLASRESODESCUENTOS crd, TBL_DESCUENTOS d, TBL_DESCUENTOSATRIBUTOS  da
	
	WHERE  (rl.CLRE_ID = cr.CLRE_ID AND cr.CLRE_ID = crd.CLRE_ID AND crd.DESC_ID = d.DESC_ID AND d.DESC_ID = da.DESC_ID
	AND da.ANAC_ID = '$Anio' AND rl.RELI_ID ='$id' AND d.ESDE_ID = 1 AND d.TIDE_ID = 1 AND d.APDE_ID = 1) OR 

	(rl.CLRE_ID = cr.CLRE_ID AND cr.CLRE_ID = crd.CLRE_ID AND crd.DESC_ID = d.DESC_ID AND d.DESC_ID = da.DESC_ID 
	AND da.ANAC_ID = '$Anio' AND rl.RELI_ID ='$id' AND d.ESDE_ID = 1 AND d.TIDE_ID = 2 AND d.APDE_ID = 2 AND 
	rl.RELI_VALOR >= (da.DEAT_DESDE * '$Salario') AND rl.RELI_VALOR <= (da.DEAT_HASTA * '$Salario')) OR

	(rl.CLRE_ID = cr.CLRE_ID AND cr.CLRE_ID = crd.CLRE_ID AND crd.DESC_ID = d.DESC_ID AND d.DESC_ID = da.DESC_ID 
	AND da.ANAC_ID = '$Anio' AND rl.RELI_ID ='$id' AND d.ESDE_ID = 1 AND d.TIDE_ID = 2 AND d.APDE_ID = 3 AND da.DEAT_ID = '$Dato' AND rl.RELI_VALOR >= da.DEAT_DESDE) OR
	
	(rl.CLRE_ID = cr.CLRE_ID AND cr.CLRE_ID = crd.CLRE_ID AND crd.DESC_ID = d.DESC_ID AND d.DESC_ID = da.DESC_ID 
	AND da.ANAC_ID = '$Anio' AND rl.RELI_ID ='$id' AND d.ESDE_ID = 1 AND d.TIDE_ID = 2 AND d.APDE_ID = 4 AND da.DEAT_ID = '$Dato1')
	
	 ";
	 $connection = Yii::app()->db;
	 $query = $connection->createCommand($sql)->queryAll();
	 
	 return $query ;
	}
	
	public function aplicaDescuento($liqui, $base){
		$sql = "SELECT d.DESC_NOMBRE, CONCAT(d.DESC_NOMBRE, ' (' , rd.REDE_TARIFA, '%) ') AS DESC_NOMBRES, ROUND((rd.REDE_TARIFA / 100) * '$base') AS VALOR, 
		rd.REDE_TARIFA, ROUND((rd.REDE_TARIFA / 100), 3) AS PORCENTAJE, d.DESC_ID	
		FROM TBL_RESOLUCIONESLIQUIDACIONES rl, TBL_RESOLUCIONESDESCUENTOS rd, TBL_DESCUENTOS d
		WHERE rl.RELI_ID = rd.RELI_ID AND rd.DESC_ID = d.DESC_ID AND rl.RELI_ID = '$liqui'";
		$connection = Yii::app()->db;
		return $connection->createCommand($sql)->queryAll();		
	}
	
	public function aplicaIva($liqui, $salario){
		$sql = "SELECT (('$salario' / (rd.REDE_TARIFA + 100)) *	rd.REDE_TARIFA)			
		FROM TBL_RESOLUCIONESLIQUIDACIONES rl, TBL_RESOLUCIONESDESCUENTOS rd, TBL_DESCUENTOS d				
		WHERE rl.RELI_ID = rd.RELI_ID AND rd.DESC_ID = d.DESC_ID AND d.DESC_ID = 9 AND rl.RELI_ID = '$liqui'";
		$connection = Yii::app()->db;
		$query = $connection->createCommand($sql)->queryColumn();
		$last = $query[0];
		return $last;	
	}	
	
	
	public function aplicaRtfuente($liqui, $utilidad){
		$sql = "SELECT ('$utilidad' * (rd.REDE_TARIFA / 100))			
		FROM TBL_RESOLUCIONESLIQUIDACIONES rl, TBL_RESOLUCIONESDESCUENTOS rd				
		WHERE rl.RELI_ID = rd.RELI_ID AND rd.DESC_ID = 2 AND rl.RELI_ID = '$liqui'";
		$connection = Yii::app()->db;
		$query = $connection->createCommand($sql)->queryColumn();
		$last = $query[0];
		return $last;	
	}	
	
}