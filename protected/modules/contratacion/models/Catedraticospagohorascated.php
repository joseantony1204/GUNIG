<?php

/**
 * This is the model class for table "TBL_CATEDRATICOSPAGOHORASCATED".
 *
 * The followings are the available columns in table 'TBL_CATEDRATICOSPAGOHORASCATED':
 * @property integer $CPHC_ID
 * @property string $CPHC_HORASPAGADAS
 * @property string $CPHC_HORASRESTANTES
 * @property string $CPHC_HORASXPAGAR
 * @property string $CPHC_PORCPAGADO
 * @property integer $CACA_ID
 */
class Catedraticospagohorascated extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Catedraticospagohorascated the static model class
	 */
	public $CACA_INTENSIDAD, $CACA_NOMBRE;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_CATEDRATICOSPAGOHORASCATED';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CPHC_ID, CPHC_HORASPAGADAS, CPHC_HORASRESTANTES, CPHC_HORASXPAGAR, CPHC_PORCPAGADO, CACA_ID', 'required'),
			array('CPHC_ID, CACA_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CPHC_ID, CPHC_HORASPAGADAS, CPHC_HORASRESTANTES, CPHC_HORASXPAGAR, CPHC_PORCPAGADO, CACA_ID', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CPHC_ID' => 'ID',
			'CPHC_HORASPAGADAS' => 'HORAS PAGADAS',
			'CPHC_HORASRESTANTES' => 'HORAS RESTANTES',
			'CPHC_HORASXPAGAR' => 'HORAS A PAGAR',
			'CPHC_PORCPAGADO' => '% PAGADO',
			'CACA_ID' => 'CATEDRA',
			
			'CACA_INTENSIDAD' => 'INTENSIDAD',
			'CACA_NOMBRE' => 'DICTADA EN :',  
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($Cform)
	{
        $sort = new CSort();
		$sort->attributes = array(
			'defaultOrder'=>'cca.CACA_ID ASC',
			'CACA_INTENSIDAD'=>array(
				'asc'=>'cca.CACA_INTENSIDAD',
				'desc'=>'cca.CACA_INTENSIDAD desc',
			),
			'CACA_NOMBRE'=>array(
				'asc'=>'cca.CACA_NOMBRE',
				'desc'=>'cca.CACA_NOMBRE desc',
			),
			
			'CPHC_HORASPAGADAS'=>array(
				'asc'=>'t.CPHC_HORASPAGADAS',
				'desc'=>'t.CPHC_HORASPAGADAS desc',
			),
			
			'CPHC_HORASRESTANTES'=>array(
				'asc'=>'t.CPHC_HORASRESTANTES',
				'desc'=>'t.CPHC_HORASRESTANTES desc',
			),
			
			'CPHC_HORASXPAGAR'=>array(
				'asc'=>'t.CPHC_HORASXPAGAR',
				'desc'=>'t.CPHC_HORASXPAGAR desc',
			),
			'CPHC_PORCPAGADO'=>array(
				'asc'=>'t.CPHC_PORCPAGADO',
				'desc'=>'t.CPHC_PORCPAGADO desc',
			),
		);
		
		$criteria=new CDbCriteria;
		
		$totalPorc = $Cform->CPHC_PORCENTAJE;
		if($totalPorc!=''){ 
		$porc = $this->obtenerPorcPagado();
		$totPorc = ($porc + $totalPorc);
		 if($totPorc>100){
	      Yii::app()->user->setFlash('error','<strong>Oppss!. </strong> El valor del 
	      <strong>PORCENTAJE DE HORAS A PAGAR INGRESADO</strong> se supera el <strong>100%</strong> de las <strong>HORAS PAGADAS</strong>
	      esto podria generar malos calculos en esta pagina.<br> Revise el valor ingresado e intentelo nuevamente...');
	     } 
		$criteria->select='cca.*, t.*, 
		CEIL(cca.CACA_INTENSIDAD*'.$totPorc.'/100) AS CPHC_HORASPAGADAS, 
		FLOOR(cca.CACA_INTENSIDAD-(cca.CACA_INTENSIDAD*'.$totPorc.'/100)) AS CPHC_HORASRESTANTES, 
		(CEIL(cca.CACA_INTENSIDAD*'.$totPorc.'/100)-(t.CPHC_HORASPAGADAS)) AS CPHC_HORASXPAGAR, 
		'.$totPorc.' AS CPHC_PORCPAGADO ';		
		}else{ 			  
			  $criteria->select='cca.*, t.*';
			 }
		
		$criteria->join ='
		INNER JOIN TBL_CATEDRATICOSCATEDRAS  cca ON cca.CACA_ID = t.CACA_ID
		 INNER JOIN TBL_CATEDRATICOSCONTRATOS  cc ON cca.CACO_ID = cc.CACO_ID
		 INNER JOIN TBL_PERSNATURALESCATEDRATICOS  pnc ON pnc.PENC_ID = cc.PENC_ID
		 INNER JOIN TBL_PERSONASNATURALES  pn ON pn.PENA_ID = pnc.PENA_ID
		 INNER JOIN TBL_PERIODOSACADEMICOS  pa ON pa.PEAC_ID = pnc.PEAC_ID AND pa.PEAC_ESTADO = 0';

		$criteria->compare('CPHC_ID',$this->CPHC_ID);
		$criteria->compare('CPHC_HORASPAGADAS',$this->CPHC_HORASPAGADAS,true);
		$criteria->compare('CPHC_HORASRESTANTES',$this->CPHC_HORASRESTANTES,true);
		$criteria->compare('CPHC_HORASXPAGAR',$this->CPHC_HORASXPAGAR,true);
		$criteria->compare('CPHC_PORCPAGADO',$this->CPHC_PORCPAGADO,true);
		$criteria->compare('CACA_ID',$this->CACA_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 2000,),
		));
	}
	
	public function obtenerPorcPagado()
	{
	 $connection = Yii::app()->db;
	 $string = "SELECT t.CPHC_PORCPAGADO
	 FROM TBL_CATEDRATICOSPAGOHORASCATED t
	 INNER JOIN TBL_CATEDRATICOSCATEDRAS  cca ON cca.CACA_ID = t.CACA_ID
	 INNER JOIN TBL_CATEDRATICOSCONTRATOS  cc ON cca.CACO_ID = cc.CACO_ID
	 INNER JOIN TBL_PERSNATURALESCATEDRATICOS  pnc ON pnc.PENC_ID = cc.PENC_ID
	 INNER JOIN TBL_PERSONASNATURALES  pn ON pn.PENA_ID = pnc.PENA_ID
	 INNER JOIN TBL_PERIODOSACADEMICOS  pa ON pa.PEAC_ID = pnc.PEAC_ID AND pa.PEAC_ESTADO = 0
	 GROUP BY t.CPHC_PORCPAGADO ORDER BY(t.CPHC_PORCPAGADO) DESC LIMIT 1";
	 $resultado = $connection->createCommand($string)->queryColumn();
	 return $resultado[0];
	}
	
	public function actualizarPorcHorasPagadas($Cform)
	{
	 $connection = Yii::app()->db;
	 $totPorc = $Cform->CPHC_PORCENTAJE;
	 $string = 'UPDATE TBL_CATEDRATICOSPAGOHORASCATED cphc,
	 (
	 SELECT cca.CACA_ID,
	 CEIL(cca.CACA_INTENSIDAD*(t.CPHC_PORCPAGADO+'.$totPorc.')/100) AS CPHC_HORASPAGADAS,
	 FLOOR(cca.CACA_INTENSIDAD-(cca.CACA_INTENSIDAD*(t.CPHC_PORCPAGADO+'.$totPorc.')/100)) AS CPHC_HORASRESTANTES,
	 (CEIL(cca.CACA_INTENSIDAD*(t.CPHC_PORCPAGADO+'.$totPorc.')/100)-(t.CPHC_HORASPAGADAS)) AS CPHC_HORASXPAGAR,
	 (t.CPHC_PORCPAGADO+'.$totPorc.') AS CPHC_PORCPAGADO
	 FROM TBL_CATEDRATICOSPAGOHORASCATED t, TBL_CATEDRATICOSCATEDRAS cca, TBL_CATEDRATICOSCONTRATOS cc, 
	 TBL_PERSNATURALESCATEDRATICOS pnc, TBL_PERIODOSACADEMICOS pac 
	 WHERE pac.PEAC_ID = pnc.PEAC_ID AND pac.PEAC_ESTADO = 0 AND pnc.PENC_ID = cc.PENC_ID AND cc.CACO_ID = cca.CACO_ID 
	 AND cca.CACA_ID = t.CACA_ID ORDER BY cca.CACA_ID ASC
	 ) AS tp
	 SET cphc.CPHC_HORASPAGADAS = tp.CPHC_HORASPAGADAS, cphc.CPHC_HORASRESTANTES = tp.CPHC_HORASRESTANTES,
	 cphc.CPHC_HORASXPAGAR = tp.CPHC_HORASXPAGAR, cphc.CPHC_PORCPAGADO = tp.CPHC_PORCPAGADO WHERE cphc.CACA_ID = tp.CACA_ID  ';
	 $connection->createCommand($string)->execute();
	}
}