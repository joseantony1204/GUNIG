<?php

/**
 * This is the model class for table "TBL_CODIGOSICFES".
 *
 * The followings are the available columns in table 'TBL_CODIGOSICFES':
 * @property integer $COIC_ID
 * @property string $COIC_CODIGO
 * @property string $COIC_NORMA_APROBACION_UNIGUAJIRA
 * @property string $COIC_NORMA_APROBACION_ICFES
 * @property string $COIC_FECHA_VENCIMIENTO
 * @property integer $COIC_ESTADO
 * @property integer $JORN_ID
 * @property integer $METO_ID
 * @property integer $TITU_ID
 * @property integer $PROG_ID
 * @property integer $SEDE_ID
 *
 * The followings are the available model relations:
 * @property JORNADAS $jORN
 * @property METODOLOGIAS $mETO
 * @property PROGRAMAS $pROG
 * @property SEDES $sEDE
 * @property TITULOS $tITU
 */
class Codigosicfes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Codigosicfes the static model class
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
		return 'TBL_CODIGOSICFES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('COIC_ESTADO, JORN_ID, METO_ID, TITU_ID, PROG_ID, SEDE_ID', 'numerical', 'integerOnly'=>true),
			array('COIC_CODIGO', 'length', 'max'=>200),
			array('COIC_NORMA_APROBACION_UNIGUAJIRA, COIC_NORMA_APROBACION_ICFES, COIC_FECHA_VENCIMIENTO', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('COIC_ID, COIC_CODIGO, COIC_NORMA_APROBACION_UNIGUAJIRA, COIC_NORMA_APROBACION_ICFES, COIC_FECHA_VENCIMIENTO, COIC_ESTADO, JORN_ID, METO_ID, TITU_ID, PROG_ID, SEDE_ID', 'safe', 'on'=>'search'),
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
			'rel_jornadas' => array(self::BELONGS_TO, 'JORNADAS', 'JORN_ID'),
			'rel_metodologias' => array(self::BELONGS_TO, 'METODOLOGIAS', 'METO_ID'),
			'rel_programas' => array(self::BELONGS_TO, 'PROGRAMAS', 'PROG_ID'),
			'rel_sedes' => array(self::BELONGS_TO, 'SEDES', 'SEDE_ID'),
			'rel_titulos' => array(self::BELONGS_TO, 'TITULOS', 'TITU_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'COIC_ID' => 'ITEM',
			'COIC_CODIGO' => 'CODIGO ICFES',
			'COIC_NORMA_APROBACION_UNIGUAJIRA' => 'NORMA CONSEJO SUPERIOR',
			'COIC_NORMA_APROBACION_ICFES' => 'NORMA MINISTERIO EDUCACION NACIONAL',
			'COIC_FECHA_VENCIMIENTO' => 'FECHA DE VENCIMIENTO',
			'JORN_ID' => 'JORNADA',
			'METO_ID' => 'METODOLOGÍA',
			'TITU_ID' => 'TITULO',
			'PROG_ID' => 'PROGRAMA',
			'SEDE_ID' => 'SEDE',
			'COIC_ESTADO' => 'ESTADO',
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

		$criteria->compare('COIC_ID',$this->COIC_ID);
		$criteria->compare('COIC_CODIGO',$this->COIC_CODIGO,true);
		$criteria->compare('COIC_NORMA_APROBACION_UNIGUAJIRA',$this->COIC_NORMA_APROBACION_UNIGUAJIRA,true);
		$criteria->compare('COIC_NORMA_APROBACION_ICFES',$this->COIC_NORMA_APROBACION_ICFES,true);
		$criteria->compare('COIC_FECHA_VENCIMIENTO',$this->COIC_FECHA_VENCIMIENTO,true);
		$criteria->compare('COIC_ESTADO',$this->COIC_ESTADO);
		$criteria->compare('JORN_ID',$this->JORN_ID);
		$criteria->compare('METO_ID',$this->METO_ID);
		$criteria->compare('TITU_ID',$this->TITU_ID);
		$criteria->compare('PROG_ID',$this->PROG_ID);
		$criteria->compare('SEDE_ID',$this->SEDE_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

public function  getListadoCodigosicfes(){
$connection = Yii::app()->db;
$string="SELECT C.COIC_ID, CONCAT(T.TITU_NOMBRE,' - ',S.SEDE_NOMBRE,' - ',J.JORN_NOMBRE,' - ',M.METO_NOMBRE,'  ') AS DETALLE
FROM TBL_CODIGOSICFES C
INNER JOIN TBL_TITULOS T ON C.TITU_ID=T.TITU_ID
INNER JOIN TBL_SEDES S ON C.SEDE_ID=S.SEDE_ID
INNER JOIN TBL_METODOLOGIAS M ON C.METO_ID=M.METO_ID
INNER JOIN TBL_JORNADAS J ON C.JORN_ID=J.JORN_ID";
 $data=$connection->createCommand($string)->queryAll();
 return CHtml::listData($data,'COIC_ID','DETALLE');
 
}

public function getTituloApartirCodigoicfes($id){
		
		 $connection = Yii::app()->db;
		 $sql="SELECT TITU_ID FROM TBL_CODIGOSICFES WHERE COIC_ID=".$id;;
		 $dato=$connection->createCommand($sql)->queryScalar();
		return  $dato;
		
		}
		
		public function getSedeApartirCodigoicfes($id){
		
		 $connection = Yii::app()->db;
		 $sql="SELECT SEDE_ID FROM TBL_CODIGOSICFES WHERE COIC_ID=".$id;;
		 $dato=$connection->createCommand($sql)->queryScalar();
		return  $dato;
		
		}
		public function getJornadaApartirCodigoicfes($id){
		
		 $connection = Yii::app()->db;
		 $sql="SELECT JORN_ID FROM TBL_CODIGOSICFES WHERE COIC_ID=".$id;;
		 $dato=$connection->createCommand($sql)->queryScalar();
		return  $dato;
		
		}
		public function getMetodlogiaApartirCodigoicfes($id){
		
		 $connection = Yii::app()->db;
		 $sql="SELECT METO_ID FROM TBL_CODIGOSICFES WHERE COIC_ID=".$id;;
		 $dato=$connection->createCommand($sql)->queryScalar();
		return  $dato;
		
		}
		public function getImagenEstado(){
		//$imageUrl = '1.png';
	   if($this->COIC_ESTADO==='1'){
		$imageUrl = '0.png'; 
	   }else{
		$imageUrl = '1.png'; 
	   }
	   return Yii::app()->baseurl.'/images/'.$imageUrl;
	  }	
	  
	  public function cambiarEstado($id,$estado){
      $connection = Yii::app()->db;
	   $string="UPDATE TBL_CODIGOSICFES SET COIC_ESTADO=".$estado." WHERE COIC_ID=".$id;
	   $criteria = $connection->createCommand($string)->execute();
	  }
	  
	  public function getCodigoicfes($COIC_ID){
		
	  $connection = Yii::app()->db;
		  $sql="SELECT COIC_CODIGO FROM TBL_CODIGOSICFES WHERE COIC_ID=".$COIC_ID;
		   $dato=$connection->createCommand($sql)->queryScalar();
		return $dato;
		}
		
		 public function getResolucionU($COIC_ID){
		
	  $connection = Yii::app()->db;
		  $sql="SELECT COIC_NORMA_APROBACION_UNIGUAJIRA FROM TBL_CODIGOSICFES WHERE COIC_ID=".$COIC_ID;
		   $dato=$connection->createCommand($sql)->queryScalar();
		return $dato;
		}
		
		 public function getResolucionIcfes($COIC_ID){
		
	  $connection = Yii::app()->db;
		  $sql="SELECT COIC_NORMA_APROBACION_ICFES FROM TBL_CODIGOSICFES WHERE COIC_ID=".$COIC_ID;
		   $dato=$connection->createCommand($sql)->queryScalar();
		return $dato;
		}

}

