<?php

/**
 * This is the model class for table "TBL_RESOLUCIONES".
 *
 * The followings are the available columns in table 'TBL_RESOLUCIONES':
 * @property integer $RESO_ID
 * @property string $RESO_NUMERO
 * @property string $RESO_FECHASUSCRIPCION
 * @property string $RESO_CONCEPTO
 * @property string $RESO_FECHAPROCESO
 * @property integer $PERS_ID
 *
 * The followings are the available model relations:
 * @property TBLPRESUPUESTOSRESOLUCIONES[] $tBLPRESUPUESTOSRESOLUCIONESs
 * @property TBLPERSONAS $pERS
 * @property TBLRESOLUCIONESLIQUIDACIONES[] $tBLRESOLUCIONESLIQUIDACIONESs
 */
class Resoluciones extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Resoluciones the static model class
     */
	 public $RELI_VALOR, $CLRE_NOMBRE;
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'TBL_RESOLUCIONES';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('RESO_NUMERO, RESO_FECHASUSCRIPCION, RESO_CONCEPTO, RESO_FECHAPROCESO, PERS_ID', 'required'),
            array('PERS_ID', 'numerical', 'integerOnly'=>true),
            array('RESO_NUMERO', 'length', 'max'=>5),
            array('RESO_CONCEPTO', 'length', 'max'=>1000),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('RESO_ID, RESO_NUMERO, RESO_FECHASUSCRIPCION, RESO_CONCEPTO, RESO_FECHAPROCESO, PERS_ID, RELI_VALOR', 'safe', 'on'=>'search'),
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
            'pRRE' => array(self::HAS_MANY, 'Presupuestosresoluciones', 'RESO_ID'),
            'pERS' => array(self::BELONGS_TO, 'Personas', 'PERS_ID'),
            'rELI' => array(self::HAS_MANY, 'Resolucionesliquidaciones', 'RESO_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'RESO_ID' => 'Id',
            'RESO_NUMERO' => 'No. de Resolucion',
            'RESO_FECHASUSCRIPCION' => 'Suscripcion',
            'RESO_CONCEPTO' => 'Concepto',
            'RESO_FECHAPROCESO' => 'Fecha',
            'PERS_ID' => 'Persona',
			'RELI_VALOR' => 'Valor',
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
		$criteria->select = 't.*, rl.*, cr.*';
		$criteria->join = 'INNER JOIN TBL_RESOLUCIONESLIQUIDACIONES rl ON t.RESO_ID = rl.RESO_ID
						   INNER JOIN TBL_CLASESRESOLUCIONES cr ON cr.CLRE_ID = rl.CLRE_ID';

        $criteria->compare('RESO_ID',$this->RESO_ID);
        $criteria->compare('RESO_NUMERO',$this->RESO_NUMERO,true);
        $criteria->compare('RESO_FECHASUSCRIPCION',$this->RESO_FECHASUSCRIPCION,true);
        $criteria->compare('RESO_CONCEPTO',$this->RESO_CONCEPTO,true);
        $criteria->compare('RESO_FECHAPROCESO',$this->RESO_FECHAPROCESO,true);
        $criteria->compare('PERS_ID',$this->PERS_ID);
		$criteria->compare('cr.CLRE_NOMBRE',$this->CLRE_NOMBRE);
		$criteria->compare('rl.RELI_VALOR',$this->RELI_VALOR);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
			'pagination' => array('pageSize' => 30,),
        ));
    }


public function Personas()
	{
	 $connection = Yii::app()->db;
	 $sql = "SELECT (t.PERS_ID) AS PERS_ID, CONCAT(pn.PENA_NOMBRES, ' ' , pn.PENA_APELLIDOS) AS PERSONA
	 FROM TBL_PERSONAS t
	 INNER JOIN TBL_PERSONASNATURALES pn ON pn.PERS_ID = t.PERS_ID
	 	 UNION
	 SELECT (t.PERS_ID) AS PERS_ID, (pj.PEJU_NOMBRE) AS PERSONA
	 FROM TBL_PERSONAS t
	 INNER JOIN TBL_PERSONASJURIDICAS pj ON pj.PERS_ID = t.PERS_ID
	 ORDER BY  PERSONA";
	 $data = $connection->createCommand($sql)->queryAll();
	 return $data; 
	}
	
	
	public function presupuestoliquidacion($id){
	$sql = "SELECT MAX(PRRE_ID) FROM TBL_PRESUPUESTOSRESOLUCIONES WHERE RESO_ID = '$id'";
	 $connection = Yii::app()->db;
	 $query = $connection->createCommand($sql)->queryColumn();
	 $lastId = $query[0];
	 return $lastId;
	}
	
		
	public function loadLastDato($id){
	$sql = "SELECT MAX(RELI_ID) FROM TBL_RESOLUCIONESLIQUIDACIONES  WHERE RESO_ID = '$id'";
	 $connection = Yii::app()->db;
	 $query = $connection->createCommand($sql)->queryColumn();
	 $lastId = $query[0];
	 return $lastId;
	}
	
		
	public function loadLastData ($id){
	$sql = "SELECT MAX(RESO_ID) FROM TBL_RESOLUCIONES  WHERE RESO_ID = '$id'";
	 $connection = Yii::app()->db;
	 $query = $connection->createCommand($sql)->queryColumn();
	 $lastId = $query[0];
	 $Resoluciones = Resoluciones::model()->findByPk($lastId);
	 return $Resoluciones;
	}
	
	public function loadLastDatas(){
	$sql = "SELECT MAX(RESO_ID) FROM TBL_RESOLUCIONES";
	 $connection = Yii::app()->db;
	 $query = $connection->createCommand($sql)->queryColumn();
	 $lastId = $query[0];
	 //$Resoluciones = Resoluciones::model()->findByPk($lastId);
	 return $lastId;
	}



	public function eliminaPresupuesto($id){
      	$connection = Yii::app()->db;
	    $string="DELETE FROM TBL_PRESUPUESTOS WHERE PRES_ID IN (SELECT PRES_ID FROM TBL_PRESUPUESTOSRESOLUCIONES WHERE RESO_ID = '$id')";
	    $criteria = $connection->createCommand($string)->execute();	 
	}
	
	public function eliminaDescuentos($id){
      	$connection = Yii::app()->db;
	    $string="DELETE FROM TBL_RESOLUCIONESDESCUENTOS WHERE RELI_ID = '$id'";
	    $criteria = $connection->createCommand($string)->execute();	 
	}


	
	public function consultarPresupuesto($id){
	   $sql = "SELECT p.PRES_SECCION, p.PRES_CODIGO FROM TBL_PRESUPUESTOS p, TBL_PRESUPUESTOSRESOLUCIONES pr , TBL_RESOLUCIONES r WHERE p.PRES_ID=pr.PRES_ID AND pr.RESO_ID =r.RESO_ID AND pr.RESO_ID ='$id'
	   		
	   ";
		$connection = Yii::app()->db;
		return $connection->createCommand($sql)->queryAll();		
	}
	
	
	public function getResolucionesclases()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.CLRE_ID, t.CLRE_NOMBRE';
	 $criteria->join = ' 
	 INNER JOIN TBL_RESOLUCIONESLIQUIDACIONES rl ON rl.CLRE_ID = t.CLRE_ID
	 INNER JOIN TBL_RESOLUCIONES r ON r.RESO_ID = rl.RESO_ID '; 
	 $criteria->order = 't.CLRE_NOMBRE ASC';
	 return  CHtml::listData(Clasesresoluciones::model()->findAll($criteria),'CLRE_ID','CLRE_NOMBRE'); 
	}
	



}