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
	public $SEGUIMIENTO, $CONT_NUMORDEN, $CONT_ANIO, $PERS_IDENTIFICACION, $NOMBRE_COMPLETO, $PERS_ID, $CLCO_ID, $DOCUMENTOS; 
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
			array('CUEN_NUMERO, CUEN_VALOR, CUEN_FECHAINGRESO, TIPA_ID, CONT_ID', 'required'),
			array('CUEN_NUMERO, TIPA_ID, CONT_ID', 'numerical', 'integerOnly'=>true),
			array('CUEN_VALOR', 'length', 'max'=>20),
			array('CUEN_FECHAINICIO, CUEN_FECHAFINAL', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CUEN_ID, CUEN_NUMERO, CUEN_VALOR, CUEN_FECHAINICIO, CUEN_FECHAFINAL, 
			CUEN_FECHAINGRESO, TIPA_ID, CONT_ID, CUEN_ESTADO', 'safe', 'on'=>'search'),
			
			array('CUEN_ID,CONT_ID, PERS_ID, CONT_NUMORDEN, CONT_ANIO, TIPA_ID, PERS_IDENTIFICACION', 
			'safe', 'on'=>'buscarCuentasNoTramitadas'),
			array('CUEN_ID, CONT_ID, PERS_ID, CONT_NUMORDEN, CONT_ANIO, TIPA_ID, PERS_IDENTIFICACION', 
			'safe', 'on'=>'buscarCuentasTramitadas'),
			
			
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
			'CUEN_NUMERO' => '# - CTA',
			'CUEN_VALOR' => 'VALOR',
			'CUEN_FECHAINGRESO' => 'FECHA REGISTRO',
			'TIPA_ID' => 'TIPO',
			'CONT_ID' => 'PERSONA',
			'CUEN_FECHAINICIO' => 'F. INICIO',
			'CUEN_FECHAFINAL' => 'F. FINAL',
			'SEGUIMIENTO' => ' ',
			'CUEN_ESTADO' => 'ESTADO',
			'CLCO_ID' => 'CONTRATO',			
			'CONT_NUMORDEN' => 'ORDEN',
			'CONT_ANIO' => 'AÑO',
			'PERS_IDENTIFICACION' => 'CC o NIT',
			'PERS_ID' => 'NOMBRE',
			'DOCUMENTOS' => '...',
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
	
	
	 public function consultarLiquidaciones($inicial, $final, $estado, $dependencia){
	       $sql = "
		SELECT 	p.PERS_IDENTIFICACION, CONCAT(pn.PENA_NOMBRES, ' ' , pn.PENA_APELLIDOS) AS NOMBRE, ct.CUEN_ID,
				ct.CUEN_FECHAINICIO, ct.CUEN_FECHAFINAL, ct.CUEN_VALOR, sc.SECU_FECHAINGRESO 
		FROM 	TBL_PERSONAS p, TBL_PERSONASNATURALES pn, TBL_CONTRATOS c, TBL_CUENTAS ct, TBL_SEGUIMIENTOCUENTAS sc, 
				TBL_SEGUIMIENTOUSERDEPENDENCIAS scud 		   
		WHERE 	p.PERS_ID = pn.PERS_ID AND p.PERS_ID = c.PERS_ID AND
				c.CONT_ID = ct.CONT_ID AND ct.CUEN_ESTADO = '$estado' AND  
				(sc.SECU_FECHAINGRESO BETWEEN '".$inicial.' 00:00:00.000'."' AND '".$final.' 23:59:59.999'."') AND ct.CUEN_ID = sc.CUEN_ID AND 
				sc.SEUD_ID = scud.SEUD_ID AND scud.DEPE_ID = $dependencia			
		UNION			
		SELECT 	p.PERS_IDENTIFICACION, CONCAT(pj.PEJU_NOMBRE, ' ' , pj.PEJU_OBJETOCOMERCIAL) AS NOMBRE, ct.CUEN_ID,
				ct.CUEN_FECHAINICIO, ct.CUEN_FECHAFINAL, ct.CUEN_VALOR, sc.SECU_FECHAINGRESO 
		FROM 	TBL_PERSONAS p, TBL_PERSONASJURIDICAS pj, TBL_CONTRATOS c, TBL_CUENTAS ct, TBL_SEGUIMIENTOCUENTAS sc, 
				TBL_SEGUIMIENTOUSERDEPENDENCIAS scud 		   
		WHERE 	p.PERS_ID = pj.PERS_ID AND p.PERS_ID = c.PERS_ID AND
				c.CONT_ID = ct.CONT_ID AND ct.CUEN_ESTADO = '$estado' AND  
				(sc.SECU_FECHAINGRESO BETWEEN '".$inicial.' 00:00:00.000'."' AND '".$final.' 23:59:59.999'."') AND ct.CUEN_ID = sc.CUEN_ID AND 
				sc.SEUD_ID = scud.SEUD_ID AND scud.DEPE_ID = $dependencia	
		UNION		   
		SELECT 	p.PERS_IDENTIFICACION, CONCAT(pn.PENA_NOMBRES, ' ' , pn.PENA_APELLIDOS) AS NOMBRE, ct.CUEN_ID, ct.CUEN_FECHAINICIO, 
				ct.CUEN_FECHAFINAL, ct.CUEN_VALOR, ct.CUEN_FECHAINGRESO
		FROM 	TBL_PERSONAS p, TBL_PERSONASNATURALES pn, TBL_CONTRATOS c, TBL_CUENTAS ct
		WHERE 	p.PERS_ID = pn.PERS_ID AND p.PERS_ID = c.PERS_ID AND c.CONT_ID = ct.CONT_ID AND ct.CUEN_ESTADO = '$estado' AND 
				(ct.CUEN_FECHAINGRESO BETWEEN '".$inicial.' 00:00:00.000'."' AND '".$final.' 23:59:59.999'."')
		UNION		   
		SELECT 	p.PERS_IDENTIFICACION, CONCAT(pj.PEJU_NOMBRE, ' ' , pj.PEJU_OBJETOCOMERCIAL) AS NOMBRE, ct.CUEN_ID, ct.CUEN_FECHAINICIO, 
				ct.CUEN_FECHAFINAL, ct.CUEN_VALOR, ct.CUEN_FECHAINGRESO
		FROM 	TBL_PERSONAS p, TBL_PERSONASJURIDICAS pj, TBL_CONTRATOS c, TBL_CUENTAS ct
		WHERE 	p.PERS_ID = pj.PERS_ID AND p.PERS_ID = c.PERS_ID AND c.CONT_ID = ct.CONT_ID AND ct.CUEN_ESTADO = '$estado' AND 
				(ct.CUEN_FECHAINGRESO BETWEEN '".$inicial.' 00:00:00.000'."' AND '".$final.' 23:59:59.999'."') 
					   
		   ";
	   $connection = Yii::app()->db;
	   return $connection->createCommand($sql)->queryAll();		
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
		if($this->CUEN_ESTADO==='0'){
		$imageUrl = '0.png'; 
	   }
		if($this->CUEN_ESTADO==='1'){
		$imageUrl = '1.png'; 
	   }		
	   if($this->CUEN_ESTADO==='2'){
		$imageUrl = '2.png'; 
	   }
	   return Yii::app()->baseurl.'/images/financiero/cuenta/'.$imageUrl;
	  }   
	  
	 public function getImagenOrden()
	 {
		
			if($this->CUEN_ESTADO >= '3'){
				$imageUrl = '3.png'; 
				return Yii::app()->baseurl.'/images/financiero/cuenta/'.$imageUrl;
		   }		
	  } 


	  
	public function buscarCuentasNoTramitadas()
	{
		
		$sort = new CSort();
		$sort->attributes = array(
			'defaultOrder'=>'t.CUEN_ID DESC',
			'CUEN_ID'=>array(
				'asc'=>'CUEN_ID',
				'desc'=>'CUEN_ID desc',
			),

			'CONT_NUMORDEN'=>array(
				'asc'=>'c.CONT_NUMORDEN',
				'desc'=>'c.CONT_NUMORDEN desc',
			),
			'CONT_ANIO'=>array(
				'asc'=>'c.CONT_ANIO',
				'desc'=>'c.CONT_ANIO desc',
			),
			'CUEN_VALOR'=>array(
				'asc'=>'CUEN_VALOR',
				'desc'=>'CUEN_VALOR desc',
			),
			'CUEN_FECHAINICIO'=>array(
				'asc'=>'CUEN_FECHAINICIO',
				'desc'=>'CUEN_FECHAINICIO desc',
			),
			'CUEN_FECHAFINAL'=>array(
				'asc'=>'CUEN_FECHAFINAL',
				'desc'=>'CUEN_FECHAFINAL desc',
			),
			'TIPA_ID'=>array(
				'asc'=>'t.TIPA_ID',
				'desc'=>'t.TIPA_ID desc',
			),
			'CUEN_NUMERO'=>array(
				'asc'=>'CUEN_NUMERO',
				'desc'=>'CUEN_NUMERO desc',
			),
			'CUEN_FECHAINGRESO'=>array(
				'asc'=>'CUEN_FECHAINGRESO',
				'desc'=>'CUEN_FECHAINGRESO desc',
			),
			
			'CUEN_ESTADO'=>array(
				'asc'=>'CUEN_ESTADO',
				'desc'=>'CUEN_ESTADO desc',
			),
			'PERS_ID'=>array(
				'asc'=>'p.PERS_ID',
				'desc'=>'p.PERS_ID desc',
			),
			
			'DOCUMENTOS'=>array(
				'asc'=>'(SELECT COUNT(ec.CONT_ID) FROM TBL_EXPEDIENTEDOCUMENTOS ec WHERE c.CONT_ID = ec.CONT_ID)',
				'desc'=>'(SELECT COUNT(ec.CONT_ID) FROM TBL_EXPEDIENTEDOCUMENTOS ec WHERE c.CONT_ID = ec.CONT_ID) desc',
			),
			
		);
        
		$Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);
		$Usuariodependencia = Seguimientouserdependencias::model()->findBySql("SELECT * FROM TBL_SEGUIMIENTOUSERDEPENDENCIAS 
		WHERE USUA_ID = ".$Usuarios->USUA_ID);		
		$Seguimientouserdependencias = Seguimientouserdependencias::model()->findByPk($Usuariodependencia->SEUD_ID);
		
		if($Seguimientouserdependencias->DEPE_ID==1 OR $Seguimientouserdependencias->DEPE_ID==14){
		$pendientes = 0; $devueltas = 2;
		}elseif($Seguimientouserdependencias->DEPE_ID==49){
		$pendientes = 1; $devueltas = 2;
		}elseif($Seguimientouserdependencias->DEPE_ID==17){
		$pendientes = 3; $devueltas = 2;
		}elseif($Seguimientouserdependencias->DEPE_ID==18){
		$pendientes = 4; $devueltas = 2;
		}elseif($Seguimientouserdependencias->DEPE_ID==8){
		$pendientes = 5; $devueltas = 2;
		}elseif($Seguimientouserdependencias->DEPE_ID==4){
		$pendientes = 6; $devueltas = 2;
		}
		
		$criteria=new CDbCriteria;
		$criteria->select = 't.*, c.*, p.*,
	(SELECT COUNT(ec.CONT_ID) FROM TBL_EXPEDIENTEDOCUMENTOS ec WHERE c.CONT_ID = ec.CONT_ID) AS DOCUMENTOS, t.CUEN_ID AS SEGUIMIENTO';
		$criteria->join = '
	    INNER JOIN TBL_CONTRATOS c ON c.CONT_ID = t.CONT_ID
		INNER JOIN TBL_PERSONAS p ON p.PERS_ID = c.PERS_ID
		AND (t.CUEN_ESTADO = '.$pendientes.' OR t.CUEN_ESTADO = '.$devueltas.')';

		$criteria->compare('t.CUEN_ID',$this->CUEN_ID);
		$criteria->compare('CUEN_NUMERO',$this->CUEN_NUMERO);
		$criteria->compare('CUEN_VALOR',$this->CUEN_VALOR,true);
		$criteria->compare('CUEN_FECHAINICIO',$this->CUEN_FECHAINICIO,true);
		$criteria->compare('CUEN_FECHAFINAL',$this->CUEN_FECHAFINAL,true);
		$criteria->compare('CUEN_FECHAINGRESO',$this->CUEN_FECHAINGRESO,true);
		$criteria->compare('t.TIPA_ID',$this->TIPA_ID);
		$criteria->compare('c.CONT_ID',$this->CONT_ID);
		$criteria->compare('t.CUEN_ESTADO',$this->CUEN_ESTADO);
		
		$criteria->compare('c.CONT_NUMORDEN',$this->CONT_NUMORDEN);
		$criteria->compare('c.CONT_ANIO',$this->CONT_ANIO); 
		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION);
		$criteria->compare('p.PERS_ID',$this->PERS_ID); 
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 30,),
		));
	}
	
	public function buscarCuentasTramitadas()
	{
		
		$sort = new CSort();
		$sort->attributes = array(
			'defaultOrder'=>'t.CUEN_ID DESC',
			'CUEN_ID'=>array(
				'asc'=>'CUEN_ID',
				'desc'=>'CUEN_ID desc',
			),
			
			'CONT_NUMORDEN'=>array(
				'asc'=>'c.CONT_NUMORDEN',
				'desc'=>'c.CONT_NUMORDEN desc',
			),
			'CONT_ANIO'=>array(
				'asc'=>'c.CONT_ANIO',
				'desc'=>'c.CONT_ANIO desc',
			),
			'CUEN_VALOR'=>array(
				'asc'=>'CUEN_VALOR',
				'desc'=>'CUEN_VALOR desc',
			),
			'CUEN_FECHAINICIO'=>array(
				'asc'=>'CUEN_FECHAINICIO',
				'desc'=>'CUEN_FECHAINICIO desc',
			),
			'CUEN_FECHAFINAL'=>array(
				'asc'=>'CUEN_FECHAFINAL',
				'desc'=>'CUEN_FECHAFINAL desc',
			),
			'TIPA_ID'=>array(
				'asc'=>'t.TIPA_ID',
				'desc'=>'t.TIPA_ID desc',
			),
			'CUEN_NUMERO'=>array(
				'asc'=>'CUEN_NUMERO',
				'desc'=>'CUEN_NUMERO desc',
			),
			'CUEN_FECHAINGRESO'=>array(
				'asc'=>'CUEN_FECHAINGRESO',
				'desc'=>'CUEN_FECHAINGRESO desc',
			),
			
			'CUEN_ESTADO'=>array(
				'asc'=>'CUEN_ESTADO',
				'desc'=>'CUEN_ESTADO desc',
			),
			'PERS_ID'=>array(
				'asc'=>'p.PERS_ID',
				'desc'=>'p.PERS_ID desc',
			),
			
			'DOCUMENTOS'=>array(
				'asc'=>'(SELECT COUNT(ec.CONT_ID) FROM TBL_EXPEDIENTEDOCUMENTOS ec WHERE c.CONT_ID = ec.CONT_ID)',
				'desc'=>'(SELECT COUNT(ec.CONT_ID) FROM TBL_EXPEDIENTEDOCUMENTOS ec WHERE c.CONT_ID = ec.CONT_ID) desc',
			),
			
		);
        
		$Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);
		$Usuariodependencia = Seguimientouserdependencias::model()->findBySql("SELECT * FROM TBL_SEGUIMIENTOUSERDEPENDENCIAS 
		WHERE USUA_ID = ".$Usuarios->USUA_ID);		
		$Seguimientouserdependencias = Seguimientouserdependencias::model()->findByPk($Usuariodependencia->SEUD_ID);
		
		if($Seguimientouserdependencias->DEPE_ID==1 OR $Seguimientouserdependencias->DEPE_ID==14){
		$tramitadas = 1; $sigteDependencia = 3; 
		}elseif($Seguimientouserdependencias->DEPE_ID==49){
		$tramitadas = 3; $sigteDependencia = 4; 
		}elseif($Seguimientouserdependencias->DEPE_ID==17){
		$tramitadas = 4; $sigteDependencia = 5; 
		}elseif($Seguimientouserdependencias->DEPE_ID==18){
		$tramitadas = 5; $sigteDependencia = 6; 
		}elseif($Seguimientouserdependencias->DEPE_ID==8){
		$tramitadas = 6; $sigteDependencia = 7; 
		}elseif($Seguimientouserdependencias->DEPE_ID==4){
		$tramitadas = 7; $sigteDependencia = 8; 
		}
		
		$criteria=new CDbCriteria;
		$criteria->select = 't.*, c.*, p.*,
	(SELECT COUNT(ec.CONT_ID) FROM TBL_EXPEDIENTEDOCUMENTOS ec WHERE c.CONT_ID = ec.CONT_ID) AS DOCUMENTOS, t.CUEN_ID AS SEGUIMIENTO';
		$criteria->join = '
	    INNER JOIN TBL_CONTRATOS c ON c.CONT_ID = t.CONT_ID
		INNER JOIN TBL_PERSONAS p ON p.PERS_ID = c.PERS_ID
		AND (t.CUEN_ESTADO = '.$tramitadas.' OR t.CUEN_ESTADO >= '.$sigteDependencia.')';
		
		 
		$criteria->compare('CUEN_ID',$this->CUEN_ID);
		$criteria->compare('CUEN_NUMERO',$this->CUEN_NUMERO);
		$criteria->compare('CUEN_VALOR',$this->CUEN_VALOR,true);
		$criteria->compare('CUEN_FECHAINICIO',$this->CUEN_FECHAINICIO,true);
		$criteria->compare('CUEN_FECHAFINAL',$this->CUEN_FECHAFINAL,true);
		$criteria->compare('CUEN_FECHAINGRESO',$this->CUEN_FECHAINGRESO,true);
		$criteria->compare('t.TIPA_ID',$this->TIPA_ID);
		$criteria->compare('c.CONT_ID',$this->CONT_ID);
		$criteria->compare('t.CUEN_ESTADO',$this->CUEN_ESTADO);
		
		$criteria->compare('c.CONT_NUMORDEN',$this->CONT_NUMORDEN);
		$criteria->compare('c.CONT_ANIO',$this->CONT_ANIO); 
		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION);
		$criteria->compare('p.PERS_ID',$this->PERS_ID); 
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 30,),
		));
	} 
	
/////////////////////////////////////////////////////////////////////////////////////	
	
	
	
	
	
	public function buscarCuentas()
	{
		
		$sort = new CSort();
		$sort->attributes = array(
			'defaultOrder'=>'t.CUEN_ID DESC',
			'CUEN_ID'=>array(
				'asc'=>'CUEN_ID',
				'desc'=>'CUEN_ID desc',
			),
			
			'CONT_NUMORDEN'=>array(
				'asc'=>'c.CONT_NUMORDEN',
				'desc'=>'c.CONT_NUMORDEN desc',
			),
			'CONT_ANIO'=>array(
				'asc'=>'c.CONT_ANIO',
				'desc'=>'c.CONT_ANIO desc',
			),
			'CUEN_VALOR'=>array(
				'asc'=>'CUEN_VALOR',
				'desc'=>'CUEN_VALOR desc',
			),
			'CUEN_FECHAINICIO'=>array(
				'asc'=>'CUEN_FECHAINICIO',
				'desc'=>'CUEN_FECHAINICIO desc',
			),
			'CUEN_FECHAFINAL'=>array(
				'asc'=>'CUEN_FECHAFINAL',
				'desc'=>'CUEN_FECHAFINAL desc',
			),
			'TIPA_ID'=>array(
				'asc'=>'t.TIPA_ID',
				'desc'=>'t.TIPA_ID desc',
			),
			'CUEN_NUMERO'=>array(
				'asc'=>'CUEN_NUMERO',
				'desc'=>'CUEN_NUMERO desc',
			),
			'CUEN_FECHAINGRESO'=>array(
				'asc'=>'CUEN_FECHAINGRESO',
				'desc'=>'CUEN_FECHAINGRESO desc',
			),
			
			'CUEN_ESTADO'=>array(
				'asc'=>'CUEN_ESTADO',
				'desc'=>'CUEN_ESTADO desc',
			),
			'PERS_ID'=>array(
				'asc'=>'p.PERS_ID',
				'desc'=>'p.PERS_ID desc',
			),
			
			'DOCUMENTOS'=>array(
				'asc'=>'(SELECT COUNT(ec.CONT_ID) FROM TBL_EXPEDIENTEDOCUMENTOS ec WHERE c.CONT_ID = ec.CONT_ID)',
				'desc'=>'(SELECT COUNT(ec.CONT_ID) FROM TBL_EXPEDIENTEDOCUMENTOS ec WHERE c.CONT_ID = ec.CONT_ID) desc',
			),
			
		);
        
		$Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);
		$Usuariodependencia = Seguimientouserdependencias::model()->findBySql("SELECT * FROM TBL_SEGUIMIENTOUSERDEPENDENCIAS 
		WHERE USUA_ID = ".$Usuarios->USUA_ID);		
		$Seguimientouserdependencias = Seguimientouserdependencias::model()->findByPk($Usuariodependencia->SEUD_ID);
		
		if($Seguimientouserdependencias->DEPE_ID==1 OR $Seguimientouserdependencias->DEPE_ID==14){
		$tramitadas = 1; $devueltas = 2; $pendientes = 0;
		}elseif($Seguimientouserdependencias->DEPE_ID==49){
		$tramitadas = 3; $devueltas = 2; $pendientes = 1; 
		}elseif($Seguimientouserdependencias->DEPE_ID==17){
		$tramitadas = 4; $devueltas = 2; $pendientes = 3;
		}elseif($Seguimientouserdependencias->DEPE_ID==18){
		
		$tramitadas = 5; $devueltas = 2; $pendientes = 4;
		}elseif($Seguimientouserdependencias->DEPE_ID==8){
		
		$tramitadas = 6; $devueltas = 2; $pendientes = 5;
		}elseif($Seguimientouserdependencias->DEPE_ID==4){
		
		$tramitadas = 7; $devueltas = 2; $pendientes = 6;
		}
		
		$criteria=new CDbCriteria;
		$criteria->select = 't.*, c.*, p.*,
		(SELECT COUNT(ec.CONT_ID) FROM TBL_EXPEDIENTEDOCUMENTOS ec WHERE c.CONT_ID = ec.CONT_ID) AS DOCUMENTOS';
		$criteria->join = '
	    INNER JOIN TBL_CONTRATOS c ON c.CONT_ID = t.CONT_ID
		INNER JOIN TBL_PERSONAS p ON p.PERS_ID = c.PERS_ID
		AND (t.CUEN_ESTADO >= '.$tramitadas.' OR t.CUEN_ESTADO = '.$devueltas.' OR t.CUEN_ESTADO = '.$pendientes.')';
		 
		$criteria->compare('CUEN_ID',$this->CUEN_ID);
		$criteria->compare('CUEN_NUMERO',$this->CUEN_NUMERO);
		$criteria->compare('CUEN_VALOR',$this->CUEN_VALOR,true);
		$criteria->compare('CUEN_FECHAINICIO',$this->CUEN_FECHAINICIO,true);
		$criteria->compare('CUEN_FECHAFINAL',$this->CUEN_FECHAFINAL,true);
		$criteria->compare('CUEN_FECHAINGRESO',$this->CUEN_FECHAINGRESO,true);
		$criteria->compare('t.TIPA_ID',$this->TIPA_ID);
		$criteria->compare('c.CONT_ID',$this->CONT_ID);
		$criteria->compare('t.CUEN_ESTADO',$this->CUEN_ESTADO);
		
		$criteria->compare('c.CONT_NUMORDEN',$this->CONT_NUMORDEN);
		$criteria->compare('c.CONT_ANIO',$this->CONT_ANIO); 
		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION);
		$criteria->compare('p.PERS_ID',$this->PERS_ID); 
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 30,),
		));
	} 
	
	
	public function getEstadoCuenta()
	 {
		$Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);
		$Usuariodependencia = Seguimientouserdependencias::model()->findBySql("SELECT * FROM TBL_SEGUIMIENTOUSERDEPENDENCIAS 
		WHERE USUA_ID = ".$Usuarios->USUA_ID);		
		$Seguimientouserdependencias = Seguimientouserdependencias::model()->findByPk($Usuariodependencia->SEUD_ID);
		if($Seguimientouserdependencias->DEPE_ID==1 OR $Seguimientouserdependencias->DEPE_ID==14){
		 /*estados para talento humano y contratacion*/
	     if($this->CUEN_ESTADO==0){$imageUrl = '0.png'; }	   
	     if($this->CUEN_ESTADO==1){$imageUrl = '4.png'; }
		 if($this->CUEN_ESTADO>=3){$imageUrl = '4.png'; }
		   
		}elseif($Seguimientouserdependencias->DEPE_ID==49){
		 /*estados para tramite de cuentas*/
	     if($this->CUEN_ESTADO==1){$imageUrl = '0.png'; }	   
	     if($this->CUEN_ESTADO==3){$imageUrl = '1.png'; }
		 if($this->CUEN_ESTADO>=4){$imageUrl = '1.png'; }
		}elseif($Seguimientouserdependencias->DEPE_ID==17){
		/*estados para contabilidad*/
	     if($this->CUEN_ESTADO==3){$imageUrl = '0.png'; }	   
	     if($this->CUEN_ESTADO==4){$imageUrl = '4.png'; }
		 if($this->CUEN_ESTADO>=5){$imageUrl = '4.png'; }
		}elseif($Seguimientouserdependencias->DEPE_ID==18){
		 /*estados para presupuesto*/
	     if($this->CUEN_ESTADO==4){$imageUrl = '0.png'; }	   
	     if($this->CUEN_ESTADO==5){$imageUrl = '4.png'; }
		 if($this->CUEN_ESTADO>=6){$imageUrl = '4.png'; } 
		}elseif($Seguimientouserdependencias->DEPE_ID==8){
		 /*estados para vicerectoria admin y financiera*/
	     if($this->CUEN_ESTADO==5){$imageUrl = '0.png'; }	   
	     if($this->CUEN_ESTADO==6){$imageUrl = '4.png'; } 
		 if($this->CUEN_ESTADO>=7){$imageUrl = '4.png'; }
		}elseif($Seguimientouserdependencias->DEPE_ID==4){
		 /*estados para talento humano y contratacion*/
	     if($this->CUEN_ESTADO==6){$imageUrl = '0.png'; }	   
	     if($this->CUEN_ESTADO==7){$imageUrl = '4.png'; }
		 if($this->CUEN_ESTADO>=8){$imageUrl = '4.png'; }
		}			
	   
	   if($this->CUEN_ESTADO=='2'){
		$imageUrl = '2.png'; 
	   }	   
	   return Yii::app()->baseurl.'/images/financiero/cuenta/'.$imageUrl;
	  }
	  
	 public function getEstadoCuentas()
	 {
		$Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);
		$Usuariodependencia = Seguimientouserdependencias::model()->findBySql("SELECT * FROM TBL_SEGUIMIENTOUSERDEPENDENCIAS 
		WHERE USUA_ID = ".$Usuarios->USUA_ID);
		
		$Seguimientouserdependencias = Seguimientouserdependencias::model()->findByPk($Usuariodependencia->SEUD_ID);
		
	   if($this->CUEN_ESTADO==''){
		$imageUrl = '0.png'; 
	   }
	   
	  
	   		
	   if($this->CUEN_ESTADO==='2'){
		$imageUrl = '2.png'; 
	   }
	   
	   if($this->CUEN_ESTADO==='3'){
		$imageUrl = '1.png'; 
	   }
	   
	   return Yii::app()->baseurl.'/images/financiero/cuenta/'.$imageUrl;
	  }
	  
	 public function getEstadoExpediente()
	 {
		
	   if($this->DOCUMENTOS==0){
		$imageUrl = 'icon_nodoc.png'; 
	   }
	   
	  if($this->DOCUMENTOS>0){
		$imageUrl = 'icon_sidoc.png'; 
	  }
	   return Yii::app()->baseurl.'/images/financiero/'.$imageUrl;
	  }
	  
	 public function getSeguimiento()
	 {
		$imageUrl = 'icon_view.png'; 
		return Yii::app()->baseurl.'/images/'.$imageUrl;
	 }
	  
	public function getPersonas()
	{
	 $connection = Yii::app()->db;
	 $sql = "SELECT t.PERS_ID, CONCAT(pn.PENA_NOMBRES, ' ' , pn.PENA_APELLIDOS) AS NOMBRE
	 FROM TBL_PERSONAS t
	 INNER JOIN TBL_PERSONASNATURALES pn ON pn.PERS_ID = t.PERS_ID
	 INNER JOIN TBL_CONTRATOS c ON t.PERS_ID = c.PERS_ID
     INNER JOIN TBL_CUENTAS  ct ON ct.CONT_ID = c.CONT_ID
	 UNION
	 SELECT t.PERS_ID, pj.PEJU_NOMBRE AS NOMBRE
	 FROM TBL_PERSONAS t
	 INNER JOIN TBL_PERSONASJURIDICAS pj ON pj.PERS_ID = t.PERS_ID
	 INNER JOIN TBL_CONTRATOS c ON t.PERS_ID = c.PERS_ID
     INNER JOIN TBL_CUENTAS  ct ON ct.CONT_ID = c.CONT_ID ORDER BY NOMBRE";
	 $data = $connection->createCommand($sql)->queryAll();
	 return CHtml::listData($data,'PERS_ID', 'NOMBRE'); 
	}
	
	
	
	
	public function ctaTramitadas($Cuentas){
	 $Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);
	 $Usuariodependencia = Seguimientouserdependencias::model()->findBySql("SELECT * FROM TBL_SEGUIMIENTOUSERDEPENDENCIAS 
	 WHERE USUA_ID = ".$Usuarios->USUA_ID);		
	 $Seguimientouserdependencias = Seguimientouserdependencias::model()->findByPk($Usuariodependencia->SEUD_ID);
	 if($Cuentas->CUEN_ESTADO==1){
		 $estado = "TRAMITADA"; $include = " IN ";
	    if($Seguimientouserdependencias->DEPE_ID==1 OR $Seguimientouserdependencias->DEPE_ID==14){
		$estadoCta = 1;  $otro = 1;
		}elseif($Seguimientouserdependencias->DEPE_ID==49){
		$estadoCta = 3;  $otro = 3;
		}elseif($Seguimientouserdependencias->DEPE_ID==17){
		$estadoCta = 4;  $otro = 4;
		}elseif($Seguimientouserdependencias->DEPE_ID==18){
		$estadoCta = 5;  $otro = 5;
		}elseif($Seguimientouserdependencias->DEPE_ID==8){
		$estadoCta = 6; $otro = 6;
		}elseif($Seguimientouserdependencias->DEPE_ID==4){
		$estadoCta = 7; $otro = 7;
		}
	 }else{
		   $estado = "SIN TRAMITAR"; $include = " NOT IN ";
		   if($Seguimientouserdependencias->DEPE_ID==1 OR $Seguimientouserdependencias->DEPE_ID==14){
			$estadoCta = 0; $otro = 0; 
			}elseif($Seguimientouserdependencias->DEPE_ID==49){
			$estadoCta = 1; $otro = 2; 
			}elseif($Seguimientouserdependencias->DEPE_ID==17){
			$estadoCta = 3; $otro = 3; 
			}elseif($Seguimientouserdependencias->DEPE_ID==18){
			$estadoCta = 4; $otro = 4; 
			}elseif($Seguimientouserdependencias->DEPE_ID==8){
			$estadoCta = 5; $otro = 5; 
			}elseif($Seguimientouserdependencias->DEPE_ID==4){
			$estadoCta = 6; $otro = 6; 
			}
		  
		  }
	  $sql = "SELECT p.*,CONCAT(pn.PENA_NOMBRES, ' ' , pn.PENA_APELLIDOS) AS PENA_NOMBRES,c.*, ct.*,tp.*, '$estado' AS CUEN_ESTADO
	  FROM TBL_PERSONAS p, TBL_PERSONASNATURALES pn, TBL_CONTRATOS c, TBL_CUENTAS ct,  TBL_TIPOSPAGOS tp
	  WHERE p.PERS_ID = pn.PERS_ID AND p.PERS_ID = c.PERS_ID AND c.CONT_ID = ct.CONT_ID AND tp.TIPA_ID = ct.TIPA_ID
	  AND ct.CUEN_ESTADO >= ".$estadoCta."  AND ct.CUEN_ID ".$include."
      (SELECT sc.CUEN_ID FROM TBL_SEGUIMIENTOCUENTAS sc, TBL_SEGUIMIENTOUSERDEPENDENCIAS sud WHERE
	  sc.SEUD_ID = sud.SEUD_ID AND sud.DEPE_ID = ".$Seguimientouserdependencias->DEPE_ID." AND 
	  sc.SECU_FECHAINGRESO >= '".$Cuentas->CUEN_FECHAINICIO.'% 00:00:00'."' 
	  AND sc.SECU_FECHAINGRESO <=  '".$Cuentas->CUEN_FECHAFINAL.'% 23:59:59'."'
      )
	  UNION
	  
	  SELECT p.*,CONCAT(pj.PEJU_NOMBRE, ' ' , pj.PEJU_OBJETOCOMERCIAL) AS PENA_NOMBRES, c.*, ct.*,tp.*, '$estado' AS CUEN_ESTADO
	  FROM TBL_PERSONAS p, TBL_PERSONASJURIDICAS pj, TBL_CONTRATOS c, TBL_CUENTAS ct,  TBL_TIPOSPAGOS tp
	  WHERE p.PERS_ID = pj.PERS_ID AND p.PERS_ID = c.PERS_ID AND c.CONT_ID = ct.CONT_ID AND tp.TIPA_ID = ct.TIPA_ID
	  AND ct.CUEN_ESTADO >= ".$estadoCta."  AND ct.CUEN_ID ".$include."
      (SELECT sc.CUEN_ID FROM TBL_SEGUIMIENTOCUENTAS sc, TBL_SEGUIMIENTOUSERDEPENDENCIAS sud WHERE
	  sc.SEUD_ID = sud.SEUD_ID AND sud.DEPE_ID = ".$Seguimientouserdependencias->DEPE_ID." AND 
	  sc.SECU_FECHAINGRESO >= '".$Cuentas->CUEN_FECHAINICIO.'% 00:00:00'."' 
	  AND sc.SECU_FECHAINGRESO <=  '".$Cuentas->CUEN_FECHAFINAL.'% 23:59:59'."'
      )
	  
	  
      ORDER BY PENA_NOMBRES ASC";
	 $connection = Yii::app()->db;
	 return $connection->createCommand($sql)->queryAll();		
	} 
	
	public function ctaTramitada($Cuentas){
	 $Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);
	 $Usuariodependencia = Seguimientouserdependencias::model()->findBySql("SELECT * FROM TBL_SEGUIMIENTOUSERDEPENDENCIAS 
	 WHERE USUA_ID = ".$Usuarios->USUA_ID);
		
	 $Seguimientouserdependencias = Seguimientouserdependencias::model()->findByPk($Usuariodependencia->SEUD_ID);
	 if($Cuentas->CUEN_ESTADO==1){$estadocta = 'TRAMITADA';$estado = '1'; $include = ' IN ';}else{ $estadocta = 'SIN TRAMITAR';$estado = '0'; $include = ' NOT IN ';}
	  
	  $sql = "SELECT p.*,CONCAT(pn.PENA_NOMBRES, ' ' , pn.PENA_APELLIDOS) AS PENA_NOMBRES,c.*, ct.*,tp.*, '$estadocta' AS CUEN_ESTADO
	  FROM TBL_PERSONAS p, TBL_PERSONASNATURALES pn, TBL_CONTRATOS c, TBL_CUENTAS ct,  TBL_TIPOSPAGOS tp
	  WHERE p.PERS_ID = pn.PERS_ID AND p.PERS_ID = c.PERS_ID AND c.CONT_ID = ct.CONT_ID AND tp.TIPA_ID = ct.TIPA_ID AND ct.CUEN_ESTADO='$estado'
	  AND ct.CUEN_ID
      $include
      (SELECT sc.CUEN_ID FROM TBL_SEGUIMIENTOCUENTAS sc WHERE
      sc.SEUD_ID = ".$Seguimientouserdependencias->SEUD_ID."
	  AND sc.SECU_FECHAINGRESO >= '".$Cuentas->CUEN_FECHAINICIO.'% 00:00:00'."' 
	  AND sc.SECU_FECHAINGRESO <=  '".$Cuentas->CUEN_FECHAFINAL.'% 23:59:59'."'
      )
	  
	  UNION
	  
	  SELECT p.*,CONCAT(pj.PEJU_NOMBRE, ' ' , pj.PEJU_OBJETOCOMERCIAL) AS PENA_NOMBRES,c.*, ct.*,tp.*, '$estadocta' AS CUEN_ESTADO
	  FROM TBL_PERSONAS p, TBL_PERSONASJURIDICAS pj, TBL_CONTRATOS c, TBL_CUENTAS ct,  TBL_TIPOSPAGOS tp
	  WHERE p.PERS_ID = pj.PERS_ID AND p.PERS_ID = c.PERS_ID AND c.CONT_ID = ct.CONT_ID AND tp.TIPA_ID = ct.TIPA_ID AND ct.CUEN_ESTADO='$estado'
	  AND ct.CUEN_ID
      $include
      (SELECT sc.CUEN_ID FROM TBL_SEGUIMIENTOCUENTAS sc WHERE ct.CUEN_ESTADO=1 AND 
      sc.SEUD_ID = ".$Seguimientouserdependencias->SEUD_ID."
	  AND sc.SECU_FECHAINGRESO >= '".$Cuentas->CUEN_FECHAINICIO.'% 00:00:00'."' 
	  AND sc.SECU_FECHAINGRESO <=  '".$Cuentas->CUEN_FECHAFINAL.'% 23:59:59'."'
      )
	  
      ORDER BY PENA_NOMBRES ASC;";
	 $connection = Yii::app()->db;
	 return $connection->createCommand($sql)->queryAll();		
	} 
	
	public function getContratosclase()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.CLCO_ID, t.CLCO_NOMBRE';
	 $criteria->join = ' 
	 INNER JOIN TBL_CONTRATOS c ON c.CLCO_ID = t.CLCO_ID
	 INNER JOIN TBL_CUENTAS ct ON ct.CONT_ID = c.CONT_ID '; //AND t.ANAC_ESTADO = 0	
	 $criteria->order = 't.CLCO_NOMBRE ASC';
	 return  CHtml::listData(Clasescontratos::model()->findAll($criteria),'CLCO_ID','CLCO_NOMBRE'); 
	}
	
	
	  	
}