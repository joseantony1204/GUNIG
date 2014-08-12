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
			'SECU_FECHAINGRESO' => 'FECHA PROCESADA',
			'SECU_NUMORDENPAGO' => '# ORDEN PAGO',
			'SECU_VRORDENPAGO' => 'VR. ORDEN PAGO',
			'SECU_CODIGOCDP' => 'CODIGO',
			'SECU_NUMCHECQUE' => '# CHEQUE',
			'SECU_VALORCHEQUE' => 'VR. CHEQUE',
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
	public function getImagenEstado(){
		$imageUrl = '1.png';
	   if($this->SECU_ESTADO==='0'){
		$imageUrl = '0.png'; 
	   }
	   return Yii::app()->baseurl.'/images/financiero/'.$imageUrl;
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
	
	public function searchSeguimiento($CUEN_ID,$DEPE_ID)
	{
		
	 $connection = Yii::app()->db;
	 $sql = "SELECT  sc.SECU_ID
	 FROM TBL_SEGUIMIENTOCUENTAS sc, TBL_SEGUIMIENTOUSERDEPENDENCIAS sud, TBL_DEPENDENCIAS d
	 WHERE sc.SEUD_ID = sud.SEUD_ID AND sud.DEPE_ID = d.DEPE_ID AND sc.CUEN_ID = ".$CUEN_ID." AND d.DEPE_ID = ".$DEPE_ID."";
	 $data = $connection->createCommand($sql)->queryColumn();
	 return $data[0]; 
	}	  	
}