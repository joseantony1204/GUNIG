<?php

/**
 * This is the model class for table "TBL_SEGUIMIENTOCUENTAS".
 *
 * The followings are the available columns in table 'TBL_SEGUIMIENTOCUENTAS':
 * @property integer $SECU_ID
 * @property integer $SECU_ESTADO
 * @property string $SECU_FECHAINGRESO
 * @property string $SECU_NUMORDENPAGO
 * @property string $SECU_VRORDENPAGO
 * @property string $SECU_CODIGOCDP
 * @property string $SECU_NUMCHECQUE
 * @property string $SECU_VALORCHEQUE
 * @property string $SECU_FECHAPAGO
 * @property integer $SEUD_ID
 * @property integer $CUEN_ID
 *
 * The followings are the available model relations:
 * @property TblCuentas $cUEN
 * @property TblSeguimientouserdependencias $sEUD
 */
class Seguimientocuentas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Seguimientocuentas the static model class
	 */
	public $DEPENDENCIA;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_SEGUIMIENTOCUENTAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SECU_ESTADO, SECU_FECHAINGRESO, SEUD_ID, CUEN_ID', 'required'),
			array('SECU_ESTADO, SEUD_ID, CUEN_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SECU_ID, SECU_ESTADO, SECU_FECHAINGRESO, SECU_NUMORDENPAGO, SECU_VRORDENPAGO, 
			SECU_CODIGOCDP, SECU_NUMCHECQUE, SECU_VALORCHEQUE, SECU_FECHAPAGO, SEUD_ID, CUEN_ID', 'safe', 'on'=>'search'),
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
			'rel_cuentas' => array(self::BELONGS_TO, 'Cuentas', 'CUEN_ID'),
			'rel_users_dependencias' => array(self::BELONGS_TO, 'Seguimientouserdependencias', 'SEUD_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'SECU_ID' => 'ID',
			'SECU_ESTADO' => 'ESTADO',
			'SECU_FECHAINGRESO' => 'FECHA PROCESO',
			'SECU_NUMORDENPAGO' => '# ORDEN PAGO',
			'SECU_VRORDENPAGO' => 'VR. ORDEN',
			'SECU_CODIGOCDP' => 'CODIGO',
			'SECU_NUMCHECQUE' => '# CHEQUE',
			'SECU_VALORCHEQUE' => 'FORMA PAGO',
			'SECU_FECHAPAGO' => 'FECHA PAGO',
			'SEUD_ID' => 'DEPENDENCIA',
			'CUEN_ID' => 'ID CUENTA',
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
		$criteria->order = 'SECU_ID DESC';

		$criteria->compare('SECU_ID',$this->SECU_ID);
		$criteria->compare('SECU_ESTADO',$this->SECU_ESTADO);
		$criteria->compare('SECU_FECHAINGRESO',$this->SECU_FECHAINGRESO,true);
		$criteria->compare('SECU_NUMORDENPAGO',$this->SECU_NUMORDENPAGO,true);
		$criteria->compare('SECU_VRORDENPAGO',$this->SECU_VRORDENPAGO,true);
		$criteria->compare('SECU_CODIGOCDP',$this->SECU_CODIGOCDP,true);
		$criteria->compare('SECU_NUMCHECQUE',$this->SECU_NUMCHECQUE,true);
		$criteria->compare('SECU_VALORCHEQUE',$this->SECU_VALORCHEQUE,true);
		$criteria->compare('SECU_FECHAPAGO',$this->SECU_FECHAPAGO,true);
		$criteria->compare('SEUD_ID',$this->SEUD_ID);
		$criteria->compare('CUEN_ID',$this->CUEN_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
	

	public function eliminaSeguimiento($id, $dp){
      	$connection = Yii::app()->db;
	    $string="DELETE FROM TBL_SEGUIMIENTOCUENTAS 
				 WHERE CUEN_ID = '$id' AND SEUD_ID IN (SELECT SEUD_ID FROM TBL_SEGUIMIENTOUSERDEPENDENCIAS WHERE DEPE_ID = '$dp' )";
	    $criteria = $connection->createCommand($string)->execute();	 
	}


	public function aplicaIva($liqui, $salario){
		$sql = "SELECT COUNT(sc.CUEN_ID)  
				FROM TBL_CUENTAS c, TBL_SEGUIMIENTOCUENTAS sc 
				WHERE c.CUEN_ID = sc.CUEN_ID AND c.CUEN_ID = 1 AND c.CUEN_ESTADO >= 1 AND c.CUEN_ESTADO <= 3 AND sc.SEUD_ID IN 
			   (SELECT sc.SEUD_ID FROM TBL_SEGUIMIENTOCUENTAS sc, TBL_SEGUIMIENTOUSERDEPENDENCIAS WHERE DEPE_ID = 49 AND SECU_ESTADO<>2)";
		$connection = Yii::app()->db;
		$query = $connection->createCommand($sql)->queryColumn();
		$last = $query[0];
		return $last;	
	}	

	
	public function cambiarEstado($id, $nuevoEstado){
      	$connection = Yii::app()->db;
	    $string="UPDATE TBL_CUENTAS SET CUEN_ESTADO = '$nuevoEstado' WHERE CUEN_ID = '$id'";
	    $criteria = $connection->createCommand($string)->execute();	 
	}	
	
	public function getImagenEstado(){
		$imageUrl = '1.png';
	   if($this->SECU_ESTADO==='0'){
		$imageUrl = '0.png'; 
	   }
	   return Yii::app()->baseurl.'/images/financiero/'.$imageUrl;
	  }
	  
	public function enviarEmail($Cuenta, $Dependencia, $Estado){
	    		
		Yii::import('application.extensions.mail.');
		$phpExcelPath = Yii::getPathOfAlias('ext.mail');
        include($phpExcelPath . DIRECTORY_SEPARATOR . 'class.phpmailer.php');
		include($phpExcelPath . DIRECTORY_SEPARATOR . 'class.smtp.php');
		
		$phpNumToLetterPath = Yii::getPathOfAlias('ext');
        include($phpNumToLetterPath . DIRECTORY_SEPARATOR . 'CNumeroaLetra.php');
        $NumberToLetters = new EnLetras();
		
		$Cuentas = Cuentas::model()->findByPk($Cuenta);
		$Contratos = Contratos::model()->findByPk($Cuentas->CONT_ID);
		$Contratosclase = Contratosclase::model()->findByPk($Contratos->CLCO_ID);
		$Tiposcontratos = Tiposcontratos::model()->findByPk($Contratos->TICO_ID);
		$Personas = Personas::model()->findByPk($Contratos->PERS_ID);
		$Dependencias = Dependencias::model()->findByPk($Dependencia);

		
		if($Estado==1){
		 $color = '#FF4242'; 
		 $notificacion = 'PENDIENTE!!!'; 
		 $descripcion = ' tuvo inconvenientes y ha sido devuelta desde la oficina de:';
		}elseif($Estado==0){
		  $color = '#008000'; 
		  $notificacion = 'ENHORABUENA!!!'; 
		  $descripcion = ' ha sido tramitada exitosamente en:';       
	    }
		$mail = new PHPMailer();
		$mail->Host = 'localhost';
		$mail->Port = 465;
		$mail->Username = "gunig@uniguajira.edu.co";
		$mail->Password = "fase2gunig";
		$mail->SMTPAuth = true;
		$mail->From = "gunig@uniguajira.edu.co";
		$mail->FromName = "Universidad de La Guajira - GUNIG - Sistema de Seguimiento de Cuentas";
		$mail->Subject = "INFORME DE ESTADOS DE CUENTAS";
					
		$mail->AddAddress($Personas->PERS_EMAIL," GUNIG ");
		$mail -> IsHTML (true);
		$body= "<font color='".$color."'><strong>".$notificacion."</strong></font><br>";
		$body.= "<div align='justify'>La Cuenta No: 
		<strong>".strtoupper($NumberToLetters->ValorEnLetras($Cuentas->CUEN_NUMERO," "))." 
		(".$Cuentas->CUEN_NUMERO.")</strong> comprendida entre el periodo: ";
		$body.= "<strong>".$Cuentas->CUEN_FECHAINICIO."</strong> y <strong>".$Cuentas->CUEN_FECHAFINAL."</strong> ";
		$body.= "perteneciente a  la/el <strong>".$Tiposcontratos->TICO_NOMBRE."</strong> de 
		<strong>".$Contratosclase->CLCO_NOMBRE."</strong> No: <strong>".$Contratos->CONT_NUMORDEN."</strong> del año: 
		<strong>".$Contratos->CONT_ANIO."</strong> por valor de: 
		<strong>".strtoupper($NumberToLetters->ValorEnLetras($Cuentas->CUEN_VALOR,"PESOS"))."</strong>
		<strong>($".number_format($Cuentas->CUEN_VALOR).")</strong>, 
		<strong><font color='".$color."'> ".$descripcion." ".$Dependencias->DEPE_NOMBRE.".</strong></font>";
		$body.= "<br><br><br> Este correo es generado automáticamente, para mayor información favor dirigirse a la oficina
		de <strong>TALENTO HUMANO</strong> o <strong>DIRECCION DE SISTEMAS</strong>.</div>";
		$mail->Body = $body;		
		if($mail->Send()){
         Yii::app()->user->setFlash('success','Notificación enviada al correo del contratante...');
		}else{
			  Yii::app()->user->setFlash('error','No se ha podido enviar notificación al correo del contratante...');
			 }
	}   	
}