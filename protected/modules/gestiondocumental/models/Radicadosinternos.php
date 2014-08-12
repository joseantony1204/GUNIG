<?php

/**
 * This is the model class for table "TBL_RADICADOSINTERNOS".
 *
 * The followings are the available columns in table 'TBL_RADICADOSINTERNOS':
 * @property integer $RAIN_ID
 * @property string $RAIN_FECHA
 * @property string $RAIN_ASUNTO
 * @property string $RAIN_ESCANEORUTA
 * @property integer $RAIN_NUMEROANEXOS
 * @property integer $RAIN_ESTADO
 * @property string $RAIN_TIPO
 *
 * The followings are the available model relations:
 * @property TBLPENARAINDESTINO[] $tBLPENARAINDESTINOs
 * @property TBLPENARAINENVIA[] $tBLPENARAINENVIAs
 * @property TBLRAINENEX[] $tBLRAINENEXes
 * @property TBLRECIBIDOS[] $tBLRECIBIDOSes
 */
class Radicadosinternos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Radicadosinternos the static model class
	 */
	public $ENVIA, $DESTINOINTERNO, $DESTINOEXTERNO, $RECIBIDO;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_RADICADOSINTERNOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('RAIN_FECHA, RAIN_ASUNTO, RAIN_ESTADO, RAIN_TIPO, RAIN_UBICACION', 'required'),
			array('RAIN_ESTADO', 'numerical', 'integerOnly'=>true),
			array('RAIN_ASUNTO', 'length', 'max'=>400),
			array('RAIN_NUMEROANEXOS, RAIN_ESCANEORUTA', 'length', 'max'=>100),
			array('RAIN_TIPO', 'length', 'max'=>20),
			array('RAIN_UBICACION', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('RAIN_ID, RAIN_FECHA, RAIN_ASUNTO, RAIN_ESCANEORUTA, RAIN_NUMEROANEXOS, RAIN_ESTADO, RAIN_TIPO, RAIN_UBICACION', 'safe', 'on'=>'search'),
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
			'tBLPENARAINDESTINOs' => array(self::HAS_MANY, 'Penaraindestino', 'RAIN_ID'),
			'tBLPENARAINENVIAs' => array(self::HAS_MANY, 'Penarainenvia', 'RAIN_ID'),
			'tBLRAINENEXes' => array(self::HAS_MANY, 'Rainenex', 'RAIN_ID'),
			//'tBLRECIBIDOSes' => array(self::HAS_MANY, 'Recibidos', 'RAIN_ID'),
			//'mENS' => array(self::BELONGS_TO, 'Mensajeros', 'MENS_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'RAIN_ID' => 'CONSECUTIVO',
			'RAIN_FECHA' => 'FECHA / HORA',			
			'RAIN_ASUNTO' => 'ASUNTO',
			'RAIN_ESCANEORUTA' => 'URL',
			'RAIN_NUMEROANEXOS' => 'NUM. ANEXOS',
			'RAIN_TIPO' => 'TIPO',
			'RAIN_ESTADO' => 'ESTADO',
			'RAIN_UBICACION' => 'UBICACION',
            //'MENS_ID' => 'MENSAJERO',		
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
		$criteria->order='RAIN_ID DESC';
		
		
		$criteria->select='t.RAIN_ID, t.RAIN_FECHA,t.RAIN_ASUNTO, t.RAIN_ESCANEORUTA,t.RAIN_NUMEROANEXOS, t.RAIN_ESTADO, t.RAIN_UBICACION, t.RAIN_TIPO,(SELECT COUNT(a.RAIN_ID) FROM TBL_PENARAINENVIA a WHERE a.RAIN_ID = t.RAIN_ID) AS ENVIA,(SELECT COUNT(b.RAIN_ID) FROM TBL_PENARAINDESTINO b WHERE b.RAIN_ID = t.RAIN_ID) AS DESTINOINTERNO,(SELECT COUNT(c.RAIN_ID) FROM TBL_RAINENEX c WHERE c.RAIN_ID = t.RAIN_ID) AS DESTINOEXTERNO';
		
		$criteria->compare('RAIN_ID',$this->RAIN_ID);
        //$criteria->compare('MENS_ID',$this->MENS_ID);
		$criteria->compare('RAIN_FECHA',$this->RAIN_FECHA,true);
		$criteria->compare('RAIN_ASUNTO',$this->RAIN_ASUNTO,true);
		$criteria->compare('RAIN_ESCANEORUTA',$this->RAIN_ESCANEORUTA,true);
		$criteria->compare('RAIN_NUMEROANEXOS',$this->RAIN_NUMEROANEXOS);
		$criteria->compare('RAIN_ESTADO',$this->RAIN_ESTADO);
		$criteria->compare('RAIN_TIPO',$this->RAIN_TIPO,true);
		$criteria->compare('RAIN_UBICACION',$this->RAIN_UBICACION);
		$criteria->compare('ENVIA',$this->ENVIA,true);
		$criteria->compare('DESTINOINTERNO',$this->DESTINOINTERNO,true);
		$criteria->compare('DESTINOEXTERNO',$this->DESTINOEXTERNO,true);
		$criteria->compare('RECIBIDO',$this->RECIBIDO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                     'sort'=>$sort,
			'pagination' => array('pageSize' => 30,),
		));
	}
	
	public function cambiarEstado($radicado, $nuevoEstado){
      
	 $connection = Yii::app()->db;
	   $string="UPDATE TBL_RADICADOSINTERNOS SET RAIN_ESTADO = '$nuevoEstado' WHERE RAIN_ID = '$radicado'";
	   $criteria = $connection->createCommand($string)->execute();
	 }
		public function getImagenEstado(){
		$imageUrl = 'null1.png';
	   if($this->RAIN_ESTADO==='0'){
		$imageUrl = 'activo.png'; 
	   }
	   return Yii::app()->baseurl.'/images/archivo/'.$imageUrl;
	  }	
	  
	  public function getImagenRecibidos(){
	   $imageUrl = 'recibido1.png';
	   return Yii::app()->baseurl.'/images/archivo/'.$imageUrl;
	  }	
	  
	  public function getImagenDocumentos(){
	   $imageUrl = 'ver.png';
	   return Yii::app()->baseurl.'/images/archivo/'.$imageUrl;
	  }	
	  
	  public function getverArchivo($ruta){
	      if ($ruta==null){
	          return "---";
	      }
	  return "Ver";
	  }
	  
	  public function getLinkValue($data){
		$link=null;
		if($data->RAIN_ESCANEORUTA==null) $link=array("rcdarchivo/radicadosinternos/update", "id"=>$data["RAIN_ID"]);
		else $link=Yii::app()->baseUrl.$data->RAIN_ESCANEORUTA; 
		return $link;
	}
	
	/* public function personaMensajeros()
	{
     $connection = Yii::app()->db;
	 $sql = "SELECT me.MENS_ID, CONCAT(pn.PENA_NOMBRES, ' ' ,pn.PENA_APELLIDOS, '  (' ,MENS_DESCRIPCION, ') ') AS MENSAJERO
			FROM TBL_PERSONASNATURALES pn, TBL_MENSAJEROS me WHERE pn.PENA_ID = me.PENA_ID";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data; 
	}*/
}