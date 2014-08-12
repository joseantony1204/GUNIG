<?php
class Liquidaciones extends CActiveRecord
{
	public $LIQU_ID, $DESC_ID, $ANAC_ID, $DEAT_VALOR, $CONT_FECHAINICIO;	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'TBL_LIQUIDACIONES';
	}

	public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('LIQU_FECHA, LIQU_CONCEPTO, CUEN_ID, ANAC_ID, LIQU_APLICAIVA', 'required'),
            array('LIQU_ANTICIPO, LIQU_EJECUTADO, LIQU_UTILIDAD, LIQU_AMOTIZACION, LIQU_IVA, DEAT_ID, DEAT_IDD, DEAT_IDDD, CUEN_ID, ANAC_ID, LIQU_APLICAIVA', 
			'numerical', 'integerOnly'=>true),
            array('LIQU_CONCEPTO', 'length', 'max'=>5000),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('LIQU_ID, LIQU_FECHA, LIQU_ANTICIPO, LIQU_CONCEPTO, LIQU_EJECUTADO, LIQU_UTILIDAD, LIQU_AMOTIZACION, LIQU_IVA, DEAT_ID, DEAT_IDD, DEAT_IDDD, CUEN_ID, ANAC_ID, LIQU_APLICAIVA', 'safe', 'on'=>'search'),
        );
    }

	public function relations()
	{
		return array(
			'aNAC' => array(self::BELONGS_TO, 'Aniosacademicos', 'ANAC_ID'),
			'cUEN' => array(self::BELONGS_TO, 'Cuentas', 'CUEN_ID'),
			'lIQUIDACIONESDESCUENTOSes' => array(self::HAS_MANY, 'Liquidacionesdescuentos', 'LIQU_ID'),
		);
	}


 public function attributeLabels()
    {
        return array(
            'LIQU_ID' => 'Liqu',
            'LIQU_FECHA' => 'Fecha de Liquidacion',
            'LIQU_ANTICIPO' => 'Liqu Anticipo',
            'LIQU_CONCEPTO' => 'Concepto',
            'LIQU_EJECUTADO' => 'Valor ejecutado',
            'LIQU_UTILIDAD' => 'Utilidad (AIU)',
            'LIQU_AMOTIZACION' => 'Amortizacion',
            'LIQU_IVA' => 'Iva',
            'DEAT_ID' => 'Concepto (RETENCION)',
            'DEAT_IDD' => 'Actividad desarrollada (ICA)',
            'DEAT_IDDD' => 'Actividad economica (CREE)',
            'CUEN_ID' => 'Cuen',
            'ANAC_ID' => 'Año',
			'LIQU_APLICAIVA' => 'Aplica IVA?'
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

        $criteria->compare('LIQU_ID',$this->LIQU_ID,true);
        $criteria->compare('LIQU_FECHA',$this->LIQU_FECHA,true);
        $criteria->compare('LIQU_ANTICIPO',$this->LIQU_ANTICIPO);
        $criteria->compare('LIQU_CONCEPTO',$this->LIQU_CONCEPTO,true);
        $criteria->compare('LIQU_EJECUTADO',$this->LIQU_EJECUTADO);
        $criteria->compare('LIQU_UTILIDAD',$this->LIQU_UTILIDAD);
        $criteria->compare('LIQU_AMOTIZACION',$this->LIQU_AMOTIZACION);
        $criteria->compare('LIQU_IVA',$this->LIQU_IVA);
        $criteria->compare('DEAT_ID',$this->DEAT_ID);
        $criteria->compare('DEAT_IDD',$this->DEAT_IDD);
        $criteria->compare('DEAT_IDDD',$this->DEAT_IDDD);
        $criteria->compare('CUEN_ID',$this->CUEN_ID);
        $criteria->compare('ANAC_ID',$this->ANAC_ID);
		$criteria->compare('LIQU_APLICAIVA',$this->LIQU_APLICAIVA);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

	
	public function loadLastData($id){
	$sql = "SELECT MAX(LIQU_ID) FROM TBL_LIQUIDACIONES WHERE CUEN_ID = '$id'";
	 $connection = Yii::app()->db;
	 $query = $connection->createCommand($sql)->queryColumn();
	 $lastId = $query[0];
	 $Liquidaciones = Liquidaciones::model()->findByPk($lastId);
	 return $Liquidaciones;
	}
	
	
	public function loadLiquidacion($id){
	$sql = "SELECT MAX(LIQU_ID) FROM TBL_LIQUIDACIONES WHERE CUEN_ID = '$id'";
	 $connection = Yii::app()->db;
	 $query = $connection->createCommand($sql)->queryColumn();
	 $lastId = $query[0];
	 return $lastId;
	}
	
	
		
	public function loadRegistro($id){
	$sql = "SELECT MAX(LIQU_ID) FROM TBL_LIQUIDACIONES WHERE CUEN_ID = '$id'";
	 $connection = Yii::app()->db;
	 $query = $connection->createCommand($sql)->queryColumn();
	 $lastId = $query[0];
	 $Liquidaciones = Liquidaciones::model()->findByPk($lastId);
	 return $Liquidaciones;
	}
	
	public function loadCuenta($id){
	$sql = "SELECT CUEN_ID FROM TBL_LIQUIDACIONES WHERE LIQU_ID = '$id'";
	$connection = Yii::app()->db;
	$query = $connection->createCommand($sql)->queryColumn();
	$last = $query[0];
	return $last;
	}	
	
	public function loadTipopago($id){
    $sql = "SELECT TIPA_ID FROM TBL_CUENTAS WHERE CUEN_ID = '$id'";
	$connection = Yii::app()->db;
	$query = $connection->createCommand($sql)->queryColumn();
	$last = $query[0];
	return $last;
	}
	
	public function loadContrato($id){
    $sql = "SELECT CONT_ID FROM TBL_CUENTAS WHERE CUEN_ID = '$id'";
	$connection = Yii::app()->db;
	$query = $connection->createCommand($sql)->queryColumn();
	$last = $query[0];
	return $last;
	}
	
	
	public function consultarPago($id){
   	   $sql = "SELECT (COUNT(ct.TIPA_ID)) AS CANTIDAD, (SUM(ct.CUEN_VALOR))TOTAL FROM TBL_CONTRATOS c, TBL_CUENTAS ct 
	   WHERE  ct.TIPA_ID=2 AND c.CONT_ID=ct.CONT_ID AND ct.CONT_ID='$id'";
		$connection = Yii::app()->db;
		return $connection->createCommand($sql)->queryAll();
	}
	
	public function consultarPagos($id){
   	   $sql = "SELECT (COUNT(ct.TIPA_ID)) AS CANTIDAD, (SUM(ct.CUEN_VALOR))TOTAL, (SUM(l.LIQU_AMOTIZACION))AMORTIZADO FROM TBL_CONTRATOS c, TBL_CUENTAS ct, TBL_LIQUIDACIONES l 
	   WHERE (ct.TIPA_ID <> 2) AND ct.CUEN_ID = l.CUEN_ID AND (c.CONT_ID=ct.CONT_ID) AND (ct.CONT_ID='$id')";
		$connection = Yii::app()->db;
		return $connection->createCommand($sql)->queryAll();
	}
			
	
	
/////////////////////////////////////////
	public function loadAnticipo($id){
    $sql = "SELECT COUNT(ct.TIPA_ID) FROM TBL_CONTRATOS c, TBL_CUENTAS ct, TBL_LIQUIDACIONES l 
	WHERE ct.CUEN_ID = l.CUEN_ID AND ct.TIPA_ID=2 AND c.CONT_ID=ct.CONT_ID AND ct.CONT_ID='$id'";
	$connection = Yii::app()->db;
	$query = $connection->createCommand($sql)->queryColumn();
	$last = $query[0];
	return $last;
	}
//////////////////////////////////////////
	public function loadPagos($id){
    $sql = "SELECT COUNT(TIPA_ID) FROM TBL_CUENTAS ct, TBL_LIQUIDACIONES l 
	WHERE ct.CUEN_ID = l.CUEN_ID AND ct.TIPA_ID <> 2 AND l.LIQU_ANTICIPO  = 1 AND CONT_ID = '$id'";
	$connection = Yii::app()->db;
	$query = $connection->createCommand($sql)->queryColumn();
	$last = $query[0];
	return $last;
	}

	public function SalarioMinimo($Anio){
	$sql = "SELECT SAMI_VALOR FROM TBL_SALARIOSMINIMOS WHERE SAMI_ANIO = '$Anio'";
	$connection = Yii::app()->db;
	$query = $connection->createCommand($sql)->queryColumn();
    $lastId = $query[0];
	return $lastId;
	}
	
	public function Seguimiento($id, $dp){
	$sql = "SELECT 	COUNT(sc.SECU_ID) 
			FROM 	TBL_CUENTAS ct, TBL_SEGUIMIENTOCUENTAS sc, TBL_SEGUIMIENTOUSERDEPENDENCIAS scud 
			WHERE 	(ct.CUEN_ID = sc.CUEN_ID AND sc.SEUD_ID = scud.SEUD_ID AND scud.DEPE_ID = 1 AND sc.SECU_ESTADO = 0 AND ct.CUEN_ID = '$id') OR 
		   			(ct.CUEN_ID = sc.CUEN_ID AND sc.SEUD_ID = scud.SEUD_ID AND scud.DEPE_ID = 14 AND sc.SECU_ESTADO = 0 AND ct.CUEN_ID = '$id')";
	$connection = Yii::app()->db;
	$query = $connection->createCommand($sql)->queryColumn();
    $lastId = $query[0];
	return $lastId;
	}
	
	
	public function loadDescuentos ($Anio, $id, $Salario, $Dato, $Dato1, $Dato2){
	$sql = "SELECT da.DESC_ID, da.DEAT_VALOR 
	FROM TBL_CUENTAS ct, TBL_CONTRATOS c, TBL_CLASESCONTRATOS cc, TBL_CLASESCONTRATOSDESCUENTOS ccd, TBL_DESCUENTOS d, TBL_DESCUENTOSATRIBUTOS  da
	WHERE 	(ct.CONT_ID = c.CONT_ID AND c.CLCO_ID = cc.CLCO_ID AND cc.CLCO_ID = ccd.CLCO_ID AND ccd.DESC_ID = d.DESC_ID AND d.DESC_ID = da.DESC_ID
	AND da.ANAC_ID = '$Anio' AND ct.CUEN_ID ='$id' AND d.ESDE_ID = 1 AND d.TIDE_ID = 1 AND d.APDE_ID = 1) OR 

	(ct.CONT_ID = c.CONT_ID AND c.CLCO_ID = cc.CLCO_ID AND cc.CLCO_ID = ccd.CLCO_ID AND ccd.DESC_ID = d.DESC_ID AND d.DESC_ID = da.DESC_ID 
	AND da.ANAC_ID = '$Anio' AND ct.CUEN_ID ='$id' AND d.ESDE_ID = 1 AND d.TIDE_ID = 2 AND d.APDE_ID = 2 AND 
	ct.CUEN_VALOR >= (da.DEAT_DESDE * '$Salario') AND ct.CUEN_VALOR <= (da.DEAT_HASTA * '$Salario')) OR

	(ct.CONT_ID = c.CONT_ID AND c.CLCO_ID = cc.CLCO_ID AND cc.CLCO_ID = ccd.CLCO_ID AND ccd.DESC_ID = d.DESC_ID AND d.DESC_ID = da.DESC_ID 
	AND da.ANAC_ID = '$Anio' AND ct.CUEN_ID ='$id' AND d.ESDE_ID = 1 AND d.TIDE_ID = 2 AND d.APDE_ID = 3 AND da.DEAT_ID = '$Dato' AND ct.CUEN_VALOR >= da.DEAT_DESDE) OR
	
	(ct.CONT_ID = c.CONT_ID AND c.CLCO_ID = cc.CLCO_ID AND cc.CLCO_ID = ccd.CLCO_ID AND ccd.DESC_ID = d.DESC_ID AND d.DESC_ID = da.DESC_ID 
	AND da.ANAC_ID = '$Anio' AND ct.CUEN_ID ='$id' AND d.ESDE_ID = 1 AND d.TIDE_ID = 2 AND d.APDE_ID = 4 AND da.DEAT_ID = '$Dato1') OR
	
	(ct.CONT_ID = c.CONT_ID AND c.CLCO_ID = cc.CLCO_ID AND cc.CLCO_ID = ccd.CLCO_ID AND ccd.DESC_ID = d.DESC_ID AND d.DESC_ID = da.DESC_ID 
	AND da.ANAC_ID = '$Anio' AND ct.CUEN_ID ='$id' AND d.ESDE_ID = 1 AND d.TIDE_ID = 2 AND d.APDE_ID = 1 AND da.DEAT_ID = '$Dato2')
	
	 ";
	 $connection = Yii::app()->db;
	 $query = $connection->createCommand($sql)->queryAll();
	 
	 return $query ;
	}
	
	public function loadDescuento ($Anio, $last, $Salario, $Dato, $Dato1, $Dato2){
   $sql = "SELECT da.DESC_ID, da.DEAT_VALOR 
	FROM TBL_CUENTAS ct, TBL_CONTRATOS c, TBL_CLASESCONTRATOS cc, TBL_CLASESCONTRATOSDESCUENTOS ccd, TBL_DESCUENTOS d, TBL_DESCUENTOSATRIBUTOS  da
	WHERE 	(ct.CONT_ID = c.CONT_ID AND c.CLCO_ID = cc.CLCO_ID AND cc.CLCO_ID = ccd.CLCO_ID AND ccd.DESC_ID = d.DESC_ID AND d.DESC_ID = da.DESC_ID 	AND da.ANAC_ID = '$Anio' AND ct.CUEN_ID ='$last' AND d.ESDE_ID = 1 AND d.TIDE_ID = 1 AND d.APDE_ID = 1) OR 

	(ct.CONT_ID = c.CONT_ID AND c.CLCO_ID = cc.CLCO_ID AND cc.CLCO_ID = ccd.CLCO_ID AND ccd.DESC_ID = d.DESC_ID AND d.DESC_ID = da.DESC_ID 
	AND da.ANAC_ID = '$Anio' AND ct.CUEN_ID ='$last' AND d.ESDE_ID = 1 AND d.TIDE_ID = 2 AND d.APDE_ID = 2 AND 
	ct.CUEN_VALOR >= (da.DEAT_DESDE * '$Salario') AND ct.CUEN_VALOR <= (da.DEAT_HASTA * '$Salario')) OR

	(ct.CONT_ID = c.CONT_ID AND c.CLCO_ID = cc.CLCO_ID AND cc.CLCO_ID = ccd.CLCO_ID AND ccd.DESC_ID = d.DESC_ID AND d.DESC_ID = da.DESC_ID 
	AND da.ANAC_ID = '$Anio' AND ct.CUEN_ID ='$last' AND d.ESDE_ID = 1 AND d.TIDE_ID = 2 AND d.APDE_ID = 3 AND da.DEAT_ID = '$Dato' AND ct.CUEN_VALOR >= da.DEAT_DESDE )  OR
	
	(ct.CONT_ID = c.CONT_ID AND c.CLCO_ID = cc.CLCO_ID AND cc.CLCO_ID = ccd.CLCO_ID AND ccd.DESC_ID = d.DESC_ID AND d.DESC_ID = da.DESC_ID 
	AND da.ANAC_ID = '$Anio' AND ct.CUEN_ID ='$last' AND d.ESDE_ID = 1 AND d.TIDE_ID = 2 AND d.APDE_ID = 4 AND da.DEAT_ID = '$Dato1')  OR
	
	(ct.CONT_ID = c.CONT_ID AND c.CLCO_ID = cc.CLCO_ID AND cc.CLCO_ID = ccd.CLCO_ID AND ccd.DESC_ID = d.DESC_ID AND d.DESC_ID = da.DESC_ID 
	AND da.ANAC_ID = '$Anio' AND ct.CUEN_ID ='$last' AND d.ESDE_ID = 1 AND d.TIDE_ID = 2 AND d.APDE_ID = 1 AND da.DEAT_ID = '$Dato2')
	
	 ";
	$connection = Yii::app()->db;
	$query = $connection->createCommand($sql)->queryAll();	 
	return $query ;
	}
		
		
		//DEAT_DESDE, DEAT_HASTA
		
	public function descuentoAtributo($id){
     $connection = Yii::app()->db;
	 $sql = "SELECT da.DEAT_ID, CONCAT(da.DEAT_CODIGO, ' ' , da.DEAT_DESCRIPCION, ' (' , da.DEAT_VALOR, '%). ' ) AS DESCRIPCION	 
	FROM TBL_CUENTAS ct, TBL_CONTRATOS c, TBL_CLASESCONTRATOS cc, TBL_CLASESCONTRATOSDESCUENTOS ccd, TBL_DESCUENTOS d, TBL_DESCUENTOSATRIBUTOS  da
	WHERE (ct.CONT_ID = c.CONT_ID AND c.CLCO_ID = cc.CLCO_ID AND cc.CLCO_ID = ccd.CLCO_ID AND ccd.DESC_ID = d.DESC_ID AND d.DESC_ID = da.DESC_ID 
	AND da.ANAC_ID = c.CONT_ANIO AND ct.CUEN_ID ='$id' AND d.ESDE_ID = 1 AND d.TIDE_ID = 2 AND d.APDE_ID = 3 AND ct.CUEN_VALOR > da.DEAT_DESDE AND ct.CUEN_VALOR < da.DEAT_HASTA AND (ct.CUEN_VALOR > da.DEAT_DESDE) AND (ct.CUEN_VALOR < da.DEAT_HASTA) )";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data; 
	}	
	
	public function descuentoAtributo1($id){
     $connection = Yii::app()->db;
	 $sql = "SELECT da.DEAT_ID, CONCAT(da.DEAT_CODIGO, ' ' , da.DEAT_DESCRIPCION, ' (' , da.DEAT_VALOR, '%). ' ) AS DESCRIPCION	 
	FROM TBL_CUENTAS ct, TBL_CONTRATOS c, TBL_CLASESCONTRATOS cc, TBL_CLASESCONTRATOSDESCUENTOS ccd, TBL_DESCUENTOS d, TBL_DESCUENTOSATRIBUTOS  da
	WHERE (ct.CONT_ID = c.CONT_ID AND c.CLCO_ID = cc.CLCO_ID AND cc.CLCO_ID = ccd.CLCO_ID AND ccd.DESC_ID = d.DESC_ID AND d.DESC_ID = da.DESC_ID 
	AND da.ANAC_ID = c.CONT_ANIO AND ct.CUEN_ID ='$id' AND d.ESDE_ID = 1 AND d.TIDE_ID = 2 AND d.APDE_ID = 4)";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data; 
	}
	
	public function descuentoAtributo2($id){
     $connection = Yii::app()->db;
	 $sql = "SELECT da.DEAT_ID, CONCAT(da.DEAT_CODIGO, ' ' , da.DEAT_DESCRIPCION, ' (' , da.DEAT_VALOR, '%). ' ) AS DESCRIPCION	 
	FROM TBL_CUENTAS ct, TBL_CONTRATOS c, TBL_CLASESCONTRATOS cc, TBL_CLASESCONTRATOSDESCUENTOS ccd, TBL_DESCUENTOS d, TBL_DESCUENTOSATRIBUTOS  da
	WHERE (ct.CONT_ID = c.CONT_ID AND c.CLCO_ID = cc.CLCO_ID AND cc.CLCO_ID = ccd.CLCO_ID AND ccd.DESC_ID = d.DESC_ID AND d.DESC_ID = da.DESC_ID 
	AND da.ANAC_ID = c.CONT_ANIO AND ct.CUEN_ID ='$id' AND d.ESDE_ID = 1 AND d.TIDE_ID = 2 AND d.APDE_ID = 1 AND da.DESC_ID = 12)";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data; 
	}
	
	public function eliminaDescuentos($id){
      	$connection = Yii::app()->db;
	    $string="DELETE FROM TBL_LIQUIDACIONESDESCUENTOS WHERE LIQU_ID='$id'";
	    $criteria = $connection->createCommand($string)->execute();	 
	}
		
	public function consultarPresupuesto($id){
	   $sql = "
	   SELECT p.PRES_SECCION, p.PRES_CODIGO, p.PRES_MONTO
	   FROM  TBL_CUENTAS ct, TBL_CONTRATOS c, TBL_OPSCONTRATOS op, TBL_OPSPRESUPUESTOS opp, TBL_PRESUPUESTOS p		
	   WHERE ct.CONT_ID = c.CONT_ID AND c.CONT_ID = op.CONT_ID AND op.OPPR_ID = opp.OPPR_ID AND opp.PRES_ID = p.PRES_ID AND ct.CUEN_ID = '$id'  	
	   
	   
		UNION	
		   
	   SELECT p.PRES_SECCION, p.PRES_CODIGO, p.PRES_MONTO
	   FROM TBL_CUENTAS ct, TBL_CONTRATOS c, TBL_TUTORIASCONTRATOS tc, TBL_TUTORIAS t, TBL_TUTORIASPRESUPUESTOS tp, TBL_PRESUPUESTOS p
	   WHERE ct.CONT_ID = c.CONT_ID AND c.CONT_ID = tc.CONT_ID AND tc.TUCO_ID = t.TUCO_ID AND t.TUPR_ID = tp.TUPR_ID AND tp.PRES_ID = p.PRES_ID 
	   AND ct.CUEN_ID = '$id'
	   
		   
		UNION	
		   
	   SELECT p.PRES_SECCION, p.PRES_CODIGO, p.PRES_MONTO
	   FROM TBL_CUENTAS ct, TBL_CONTRATOS c, TBL_MODELOORDENES mo, TBL_PRESUPUESTOSORDENES po, TBL_PRESUPUESTOS p	   
	   WHERE ct.CONT_ID = c.CONT_ID AND c.CONT_ID = mo.CONT_ID AND mo.MOOR_ID = po.MOOR_ID AND po.PRES_ID = p.PRES_ID 
	   AND ct.CUEN_ID = '$id'
	   
	   ORDER BY PRES_MONTO ASC		
	   ";
		$connection = Yii::app()->db;
		return $connection->createCommand($sql)->queryAll();		
	}
	

			
	public function aplicaDescuento($liqui, $salmin){
		$sql = "SELECT d.DESC_NOMBRE, CONCAT(d.DESC_NOMBRE, ' (' , ld.LIDE_TARIFA, '%) ') AS DESC_NOMBRES, (ROUND(((ld.LIDE_TARIFA / 100) * '$salmin'))) AS VALOR, 
		ld.LIDE_TARIFA, ROUND((ld.LIDE_TARIFA / 100), 3) AS PORCENTAJE, d.DESC_ID	
		FROM TBL_LIQUIDACIONES l, TBL_LIQUIDACIONESDESCUENTOS ld, TBL_DESCUENTOS d
		WHERE l.LIQU_ID = ld.LIQU_ID AND ld.DESC_ID = d.DESC_ID AND l.LIQU_ID = '$liqui'";
		$connection = Yii::app()->db;
		return $connection->createCommand($sql)->queryAll();		
	}
	
	
	public function aplicaIva($liqui, $salario){
		$sql = "SELECT (('$salario' / (ld.LIDE_TARIFA + 100)) *	ld.LIDE_TARIFA)			
		FROM TBL_LIQUIDACIONES l, TBL_LIQUIDACIONESDESCUENTOS ld, TBL_DESCUENTOS d				
		WHERE l.LIQU_ID = ld.LIQU_ID AND ld.DESC_ID = d.DESC_ID AND d.DESC_ID = 9 AND l.LIQU_ID = '$liqui'";
		$connection = Yii::app()->db;
		$query = $connection->createCommand($sql)->queryColumn();
		$last = $query[0];
		return $last;	
	}	
	
	
	public function aplicaRtfuente($liqui, $utilidad){
		$sql = "SELECT ('$utilidad' * (ld.LIDE_TARIFA / 100))			
		FROM TBL_LIQUIDACIONES l, TBL_LIQUIDACIONESDESCUENTOS ld				
		WHERE l.LIQU_ID = ld.LIQU_ID AND ld.DESC_ID = 2 AND l.LIQU_ID = '$liqui'";
		$connection = Yii::app()->db;
		$query = $connection->createCommand($sql)->queryColumn();
		$last = $query[0];
		return $last;	
	}	
	
	
	public function actualizarFecha($nuevoFecha, $id){
      	$connection = Yii::app()->db;
	    $string="UPDATE TBL_CONTRATOS SET CONT_FECHAINICIO = '$nuevoFecha' WHERE CONT_ID = '$id'";
	    $criteria = $connection->createCommand($string)->execute();	 
	}	
	
}