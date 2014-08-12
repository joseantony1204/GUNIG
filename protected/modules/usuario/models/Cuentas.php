<?php

/**
 * This is the model class for table "TBL_CUENTAS".
 *
 * The followings are the available columns in table 'TBL_CUENTAS':
 * @property integer $CUEN_ID
 * @property integer $CUEN_NUMERO
 * @property string $CUEN_VALOR
 * @property string $CUEN_FECHAINICIO
 * @property string $CUEN_FECHAFINAL
 * @property string $CUEN_FECHAINGRESO
 * @property integer $TIPA_ID
 * @property integer $CONT_ID
 *
 * The followings are the available model relations:
 * @property TblContratos $cONT
 * @property TblTipospagos $tIPA
 */
class Cuentas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cuentas the static model class
	 */
	public $SEGUIMIENTO; 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_CUENTAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CUEN_NUMERO, CUEN_VALOR, CUEN_FECHAINICIO,CUEN_FECHAFINAL, CUEN_FECHAINGRESO, TIPA_ID, CONT_ID', 'required'),
			array('CUEN_NUMERO, TIPA_ID, CONT_ID', 'numerical', 'integerOnly'=>true),
			array('CUEN_VALOR', 'length', 'max'=>20),
			array('CUEN_FECHAINICIO, CUEN_FECHAFINAL', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CUEN_ID, CUEN_NUMERO, CUEN_VALOR, CUEN_FECHAINICIO, CUEN_FECHAFINAL, 
			CUEN_FECHAINGRESO, TIPA_ID, CONT_ID, CUEN_ESTADO', 'safe', 'on'=>'search'),
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
			'rel_contratos' => array(self::BELONGS_TO, 'Contratos', 'CONT_ID'),
			'rel_tipo_pago' => array(self::BELONGS_TO, 'Tipospagos', 'TIPA_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CUEN_ID' => 'ID',
			'CUEN_NUMERO' => '#. CUENTA',
			'CUEN_VALOR' => 'VLR CUENTA',
			'CUEN_FECHAINGRESO' => 'FECHA REGISTRO',
			'TIPA_ID' => 'TIPO PAGO',
			'CONT_ID' => 'ID CONTRATO',
			'CUEN_FECHAINICIO' => 'FECHA INICIO',
			'CUEN_FECHAFINAL' => 'FECHA FINAL',
			'SEGUIMIENTO' => 'SEGUIMIENTO',
			'CUEN_ESTADO' => 'ESTADO',
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
		$criteria->order = 'CUEN_ID DESC';

		$criteria->compare('CUEN_ID',$this->CUEN_ID);
		$criteria->compare('CUEN_NUMERO',$this->CUEN_NUMERO);
		$criteria->compare('CUEN_VALOR',$this->CUEN_VALOR,true);
		$criteria->compare('CUEN_FECHAINICIO',$this->CUEN_FECHAINICIO,true);
		$criteria->compare('CUEN_FECHAFINAL',$this->CUEN_FECHAFINAL,true);
		$criteria->compare('CUEN_FECHAINGRESO',$this->CUEN_FECHAINGRESO,true);
		$criteria->compare('TIPA_ID',$this->TIPA_ID);
		$criteria->compare('CONT_ID',$this->CONT_ID);
		$criteria->compare('CUEN_ESTADO',$this->CUEN_ESTADO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getTipospagos()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.TIPA_ID, t.TIPA_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_CUENTAS c ON c.TIPA_ID = t.TIPA_ID '; //AND t.ANAC_ESTADO = 0	
	 $criteria->order = 't.TIPA_NOMBRE ASC';
	 return  CHtml::listData(Tipospagos::model()->findAll($criteria),'TIPA_ID','TIPA_NOMBRE'); 
	}
	
	public function getImagenVer(){
	   $imageUrl = 'ver.png';
	   return Yii::app()->baseurl.'/images/'.$imageUrl;
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
	 $Liquidaciones = Liquidaciones::model()->findByPk($lastId);
	 return $Liquidaciones;
	}
	
	
	
	public function loadRegistro($id, $cod){
	 $sql = "SELECT MAX(SECU_ID) FROM TBL_SEGUIMIENTOCUENTAS WHERE CUEN_ID = '$id' AND SEUD_ID = '$cod' ";
	 $connection = Yii::app()->db;
	 $query = $connection->createCommand($sql)->queryColumn();
	 echo $lastI = $query[0];
	// $Liquidaciones = Liquidaciones::model()->findByPk($lastId);
	 return $lastI;
	}
	  
	
	
	public function cambiarEstado($id, $nuevoEstado){
      	$connection = Yii::app()->db;
	    $string="UPDATE TBL_CUENTAS SET CUEN_ESTADO = '$nuevoEstado' WHERE CUEN_ID = '$id'";
	    $criteria = $connection->createCommand($string)->execute();	 
	}
	
	  
	 public function getImagenEstado()
	 {
	   if($this->CUEN_ESTADO=='0'){
		$imageUrl = '0.png'; 
	   }
	   if(($this->CUEN_ESTADO==1) or ($this->CUEN_ESTADO==3) or ($this->CUEN_ESTADO==4) or ($this->CUEN_ESTADO==5) or
	   ($this->CUEN_ESTADO==6) or ($this->CUEN_ESTADO==7) or ($this->CUEN_ESTADO==8)){
	    $imageUrl = '5.png'; 
	   }		
	   if($this->CUEN_ESTADO==2){
		$imageUrl = '2.png'; 
	   }
	   return Yii::app()->baseurl.'/images/financiero/cuenta/'.$imageUrl;
	  }  
	  
	 public function getImagenOrden()
	 {
		
			if($this->CUEN_ESTADO==='1'){
				$imageUrl = '3.png'; 
				return Yii::app()->baseurl.'/images/financiero/cuenta/'.$imageUrl;
		   }		
	  }
	  
	public function verificarContrato($id)
	{

		$Usuario = Usuarios::model()->findByPk(Yii::app()->user->id);
		$Personasnaturales = Personasnaturales::model()->findByPk($Usuario->PENA_ID);
		$Personas = Personas::model()->findByPk($Personasnaturales->PERS_ID);

		$criteria=new CDbCriteria;		
		$criteria->select='t.CONT_ID';
        $criteria->condition = 't.PERS_ID = '.$Personas->PERS_ID. ' AND t.CONT_ID = '.$id;
		$criteria->order = 't.CONT_ID ASC';
		
		$Contratos = Contratos::model()->find($criteria);
		if($Contratos===null)
			throw new CHttpException(404,'La página que ha solicitado no se encuenta disponible :(');
		return $Contratos;
	}
	
	public function verificarCuenta($id)
	{

		$Usuario = Usuarios::model()->findByPk(Yii::app()->user->id);
		$Personasnaturales = Personasnaturales::model()->findByPk($Usuario->PENA_ID);
		$Personas = Personas::model()->findByPk($Personasnaturales->PERS_ID);

		$criteria=new CDbCriteria;		
		$criteria->select='t.CUEN_ID';
		$criteria->join = '
	    INNER JOIN TBL_CONTRATOS c ON c.CONT_ID = t.CONT_ID ';
        $criteria->condition = 'c.PERS_ID = '.$Personas->PERS_ID. ' AND t.CUEN_ID = '.$id;
		$criteria->order = 't.CUEN_ID ASC';
		
		$Cuentas = Cuentas::model()->find($criteria);
		if($Cuentas===null)
			throw new CHttpException(404,'La página que ha solicitado no se encuenta disponible :(');
		return $Cuentas;
	}  
	  	
}