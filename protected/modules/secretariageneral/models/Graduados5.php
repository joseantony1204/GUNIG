<?php

/**
 * This is the model class for table "TBL_GRADUADOS".
 *
 * The followings are the available columns in table 'TBL_GRADUADOS':
 * @property integer $GRAD_ID
 * @property string $GRAD_CEDULA
 * @property string $GRAD_FECHA_EXPEDICION
 * @property string $GRAD_LUGAR_EXPEDICION
 * @property string $GRAD_NOMBRES
 * @property string $GRAD_PRIMER_APELLIDO
 * @property string $GRAD_SEGUNDO_APELLIDO
 * @property string $GRAD_FECHA_NACIMIENTO
 * @property integer $SEXO_ID
 *
 * The followings are the available model relations:
 * @property SEXOS $sEXO
 * @property REGISTROGRADUADOS[] $rEGISTROGRADUADOSes
 */
class Graduados extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Graduados the static model class
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
		return 'TBL_GRADUADOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SEXO_ID', 'numerical', 'integerOnly'=>true),
			array('GRAD_CEDULA', 'length', 'max'=>11),
			array('GRAD_LUGAR_EXPEDICION, GRAD_NOMBRES, GRAD_PRIMER_APELLIDO', 'length', 'max'=>200),
			array('GRAD_SEGUNDO_APELLIDO', 'length', 'max'=>50),
			array('GRAD_FECHA_EXPEDICION, GRAD_FECHA_NACIMIENTO', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('GRAD_ID, GRAD_CEDULA, GRAD_FECHA_EXPEDICION, GRAD_LUGAR_EXPEDICION, GRAD_NOMBRES, GRAD_PRIMER_APELLIDO, GRAD_SEGUNDO_APELLIDO, GRAD_FECHA_NACIMIENTO, SEXO_ID', 'safe', 'on'=>'search'),
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
			'sEXO' => array(self::BELONGS_TO, 'SEXOS', 'SEXO_ID'),
			'rEGISTROGRADUADOSes' => array(self::HAS_MANY, 'REGISTROGRADUADOS', 'GRAD_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'GRAD_ID' => 'Grad',
			'GRAD_CEDULA' => 'Grad Cedula',
			'GRAD_FECHA_EXPEDICION' => 'Grad Fecha Expedicion',
			'GRAD_LUGAR_EXPEDICION' => 'Grad Lugar Expedicion',
			'GRAD_NOMBRES' => 'Grad Nombres',
			'GRAD_PRIMER_APELLIDO' => 'Grad Primer Apellido',
			'GRAD_SEGUNDO_APELLIDO' => 'Grad Segundo Apellido',
			'GRAD_FECHA_NACIMIENTO' => 'Grad Fecha Nacimiento',
			'SEXO_ID' => 'Sexo',
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

		$criteria->compare('GRAD_ID',$this->GRAD_ID);
		$criteria->compare('GRAD_CEDULA',$this->GRAD_CEDULA,true);
		$criteria->compare('GRAD_FECHA_EXPEDICION',$this->GRAD_FECHA_EXPEDICION,true);
		$criteria->compare('GRAD_LUGAR_EXPEDICION',$this->GRAD_LUGAR_EXPEDICION,true);
		$criteria->compare('GRAD_NOMBRES',$this->GRAD_NOMBRES,true);
		$criteria->compare('GRAD_PRIMER_APELLIDO',$this->GRAD_PRIMER_APELLIDO,true);
		$criteria->compare('GRAD_SEGUNDO_APELLIDO',$this->GRAD_SEGUNDO_APELLIDO,true);
		$criteria->compare('GRAD_FECHA_NACIMIENTO',$this->GRAD_FECHA_NACIMIENTO,true);
		$criteria->compare('SEXO_ID',$this->SEXO_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
		public function listadoGraduados(){
  $connection = Yii::app()->db;
	$string="SELECT GRAD_ID, CONCAT(GRAD_CEDULA,' - ',GRAD_NOMBRES,' - ',GRAD_PRIMER_APELLIDO,' - ',GRAD_SEGUNDO_APELLIDO) AS DETALLE FROM TBL_GRADUADOS 	ORDER BY GRAD_NOMBRES ASC";
	$data = $connection->createCommand($string)->queryAll();
	 return CHtml::listData($data,'GRAD_ID','DETALLE');
		
		}

	public function getNombreGraduado($GRAD_ID){
	  $connection = Yii::app()->db;
	 $sql="SELECT CONCAT(GRAD_NOMBRES,' ',GRAD_PRIMER_APELLIDO,' ',GRAD_SEGUNDO_APELLIDO) AS DETALLE FROM TBL_GRADUADOS WHERE GRAD_ID='".$GRAD_ID."'";

		   $dato=$connection->createCommand($sql)->queryScalar();
		return $dato;
		}
		
		public function getNombresGraduados($GRAD_ID){
	  $connection = Yii::app()->db;
	 $sql="SELECT CONCAT(GRAD_NOMBRES,' ',GRAD_PRIMER_APELLIDO,' ',GRAD_SEGUNDO_APELLIDO) AS DETALLE FROM TBL_GRADUADOS WHERE GRAD_ID='".$GRAD_ID."'";
		   $dato=$connection->createCommand($sql)->queryScalar();
		return $dato;
		}

public function getCedulaGraduado($GRAD_ID){
		  $connection = Yii::app()->db;
		  $sql="SELECT GRAD_CEDULA FROM TBL_GRADUADOS WHERE GRAD_ID='".$GRAD_ID."'";
		   $dato=$connection->createCommand($sql)->queryScalar();
		return $dato;
		}

	public function getListadoCedulas(){
	 $criteria=new CDbCriteria;
     $criteria->select='GRAD_ID, GRAD_CEDULA';
	return  CHtml::listData(Graduados::model()->findAll($criteria),'GRAD_ID','GRAD_CEDULA');
		
		}
		public function getListadoNombres(){
	 $criteria=new CDbCriteria;
     $criteria->select='GRAD_ID, GRAD_NOMBRES';
	return  CHtml::listData(Graduados::model()->findAll($criteria),'GRAD_ID','GRAD_NOMBRES');
		
		}
		public function getListadoPrimerApellidos(){
	 $criteria=new CDbCriteria;
     $criteria->select='GRAD_ID, GRAD_PRIMER_APELLIDO';
	return  CHtml::listData(Graduados::model()->findAll($criteria),'GRAD_ID','GRAD_PRIMER_APELLIDO');
		
		}
			public function getListadoSegundoApellido(){
	 $criteria=new CDbCriteria;
     $criteria->select='GRAD_ID, GRAD_SEGUNDO_APELLIDO';
	return  CHtml::listData(Graduados::model()->findAll($criteria),'GRAD_ID','GRAD_SEGUNDO_APELLIDO');
		
		}

public function getNombreSexoGraduado($GRAD_ID){
	$connection = Yii::app()->db;
		  $sql="SELECT S.SEXO_NOMBRE FROM TBL_GRADUADOS G INNER JOIN TBL_SEXOS S ON G.SEXO_ID=S.SEXO_ID WHERE GRAD_ID='".$GRAD_ID."'";
		   $dato=$connection->createCommand($sql)->queryScalar();
		return $dato;
		
		}

			public function getLugarExpedicionCedula($GRAD_ID){
	$connection = Yii::app()->db;
			  $sql="SELECT GRAD_LUGAR_EXPEDICION FROM TBL_GRADUADOS WHERE GRAD_ID='".$GRAD_ID."'";
		   $dato=$connection->createCommand($sql)->queryScalar();
		return $dato;
		
		}

	public function cedulaGraduadoExiste($GRAD_CEDULA){
    $connection = Yii::app()->db;
    $string = "SELECT * FROM TBL_GRADUADOS WHERE GRAD_CEDULA ='".$GRAD_CEDULA.'"";
	$num_rows = $connection->createCommand($string)->queryRow();
	if($num_rows==0){  
     return 1; 
    }else{
		return 0; 
		}
   
   } 
   
   public function getNombresGraduado($GRAD_ID){
	$connection = Yii::app()->db;
			  $sql="SELECT GRAD_NOMBRES FROM TBL_GRADUADOS WHERE GRAD_ID='".$GRAD_ID."'";
		   $dato=$connection->createCommand($sql)->queryScalar();
		return $dato;
		
		}
		 public function getApellidosGraduados($GRAD_ID){
	$connection = Yii::app()->db;
			   $sql="SELECT CONCAT(GRAD_PRIMER_APELLIDO,' ',GRAD_SEGUNDO_APELLIDO) AS DETALLE FROM TBL_GRADUADOS WHERE GRAD_ID='".$GRAD_ID."'";
		   $dato=$connection->createCommand($sql)->queryScalar();
		return $dato;
		
		}
}