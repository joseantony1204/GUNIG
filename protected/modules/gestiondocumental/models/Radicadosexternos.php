<?php

/**
 * This is the model class for table "TBL_RADICADOSEXTERNOS".
 *
 * The followings are the available columns in table 'TBL_RADICADOSEXTERNOS':
 * @property integer $RAEX_ID
 * @property string $RAEX_FECHARECIBIDO
 * @property string $RAEX_GUIAENVIO
 * @property string $RAEX_NUMERODOCUMENTO
 * @property string $RAEX_FECHADOCUMENTO
 * @property string $RAEX_ASUNTO
 * @property integer $RAEX_NUMEROANEXOS
 * @property string $RAEX_ESCANEORUTA
 * @property integer $RAEX_ESTADO
 * @property integer $EMCO_ID
 *
 * The followings are the available model relations:
 * @property TBLENEXRAEX[] $tBLENEXRAEXes
 * @property TBLPENARAEX[] $tBLPENARAEXes
 * @property TblEmpresascorreos $eMCO
 */
class Radicadosexternos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Radicadosexternos the static model class
	 */
	public $DE, $PARA;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_RADICADOSEXTERNOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('RAEX_FECHARECIBIDO, RAEX_FECHADOCUMENTO, RAEX_ASUNTO, RAEX_ESTADO, EMCO_ID', 'required'),
			array('RAEX_ESTADO', 'numerical', 'integerOnly'=>true),
			array('RAEX_GUIAENVIO, RAEX_NUMERODOCUMENTO', 'length', 'max'=>45),
			array('RAEX_ASUNTO', 'length', 'max'=>400),
			array('RAEX_NUMEROANEXOS, RAEX_ESCANEORUTA', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('RAEX_ID, RAEX_FECHARECIBIDO, RAEX_GUIAENVIO, RAEX_NUMERODOCUMENTO, RAEX_FECHADOCUMENTO, RAEX_ASUNTO, RAEX_NUMEROANEXOS, RAEX_ESCANEORUTA, RAEX_ESTADO,            EMCO_ID', 'safe', 'on'=>'search'),
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
			'tBLENEXRAEXes' => array(self::HAS_MANY, 'Enexraex', 'RAEX_ID'),
			'tBLPENARAEXes' => array(self::HAS_MANY, 'Penaraex', 'RAEX_ID'),
			'eMCO' => array(self::BELONGS_TO, 'Empresascorreos', 'EMCO_ID'),
			//'mENS' => array(self::BELONGS_TO, 'Mensajeros', 'MENS_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'RAEX_ID' => 'CONSECUTIVO',
			'RAEX_FECHARECIBIDO' => 'FECHA / HORA',
			'RAEX_GUIAENVIO' => 'GUIA ENVIO',
			'RAEX_NUMERODOCUMENTO' => 'NUM. DOCUMENTO',
			'RAEX_FECHADOCUMENTO' => 'FECHA DOCUMENTO',
			'RAEX_ASUNTO' => 'ASUNTO',
			'RAEX_NUMEROANEXOS' => 'NUM. ANEXOS',
			'RAEX_ESCANEORUTA' => 'URL',
			'RAEX_ESTADO' => 'ESTADO',
			'EMCO_ID' => 'EMPRESA CORREO',
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
		$criteria->order='RAEX_ID DESC';
		
		$criteria->select='t.RAEX_ID, t.RAEX_FECHARECIBIDO,t.RAEX_GUIAENVIO, t.RAEX_NUMERODOCUMENTO,t.RAEX_FECHADOCUMENTO, t.RAEX_ASUNTO, t.RAEX_NUMEROANEXOS, 
		t.RAEX_ESCANEORUTA,t.RAEX_ESTADO, t.EMCO_ID,(SELECT COUNT(a.RAEX_ID) FROM TBL_ENEXRAEX a WHERE a.RAEX_ID = t.RAEX_ID) AS DE,(SELECT COUNT(b.RAEX_ID) FROM 
		TBL_PENARAEX b WHERE b.RAEX_ID = t.RAEX_ID) AS PARA';
		
		$criteria->compare('RAEX_ID',$this->RAEX_ID);
		//$criteria->compare('MENS_ID',$this->MENS_ID);
		$criteria->compare('RAEX_FECHARECIBIDO',$this->RAEX_FECHARECIBIDO,true);
		$criteria->compare('RAEX_GUIAENVIO',$this->RAEX_GUIAENVIO,true);
		$criteria->compare('RAEX_NUMERODOCUMENTO',$this->RAEX_NUMERODOCUMENTO,true);
		$criteria->compare('RAEX_FECHADOCUMENTO',$this->RAEX_FECHADOCUMENTO,true);
		$criteria->compare('RAEX_ASUNTO',$this->RAEX_ASUNTO,true);
		$criteria->compare('RAEX_NUMEROANEXOS',$this->RAEX_NUMEROANEXOS);
		$criteria->compare('RAEX_ESCANEORUTA',$this->RAEX_ESCANEORUTA,true);
		$criteria->compare('RAEX_ESTADO',$this->RAEX_ESTADO);
		$criteria->compare('EMCO_ID',$this->EMCO_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                     'sort'=>$sort,
			'pagination' => array('pageSize' => 30,),
		));
	}
	
	public function cambiarEstado($radicado, $nuevoEstado){
      
	 $connection = Yii::app()->db;
	   $string="UPDATE TBL_RADICADOSEXTERNOS SET RAEX_ESTADO = '$nuevoEstado' WHERE RAEX_ID = '$radicado'";
	   $criteria = $connection->createCommand($string)->execute();
	 }
		public function getImagenEstado(){
		$imageUrl = 'null1.png';
	   if($this->RAEX_ESTADO=='0'){
		$imageUrl = 'activo.png'; 
	   }
	   return Yii::app()->baseurl.'/images/archivo/'.$imageUrl;
	  }	
	  
	  public function getEmpresascorreos()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.EMCO_ID, t.EMCO_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_RADICADOSEXTERNOS  c ON t.EMCO_ID = c.EMCO_ID '; //AND t.ANAC_ESTADO = 0	
	 $criteria->order = 't.EMCO_NOMBRE ASC';
	 return  CHtml::listData(Empresascorreos::model()->findAll($criteria),'EMCO_ID','EMCO_NOMBRE'); 
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
		if($data->RAEX_ESCANEORUTA==null) $link=array("rcdarchivo/radicadosexternos/update", "id"=>$data["RAEX_ID"]);
		else $link=Yii::app()->baseUrl.$data->RAEX_ESCANEORUTA; 
		return $link;
	}
	
	/*public function personaMensajeros()
	{
     $connection = Yii::app()->db;
	 $sql = "SELECT me.MENS_ID, CONCAT(pn.PENA_NOMBRES, ' ' ,pn.PENA_APELLIDOS, '  (' ,MENS_DESCRIPCION, ') ') AS MENSAJERO
			FROM TBL_PERSONASNATURALES pn, TBL_MENSAJEROS me WHERE pn.PENA_ID = me.PENA_ID";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data; 
	}*/
}