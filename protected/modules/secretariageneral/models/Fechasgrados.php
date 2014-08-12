<?php

/**
 * This is the model class for table "TBL_FECHASGRADOS".
 *
 * The followings are the available columns in table 'TBL_FECHASGRADOS':
 * @property integer $FEGR_ID
 * @property string $FEGR_FECHA
 * @property integer $SEDE_ID
 * @property integer $FEGR_ESTADO
 */
class Fechasgrados extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Fechasgrados the static model class
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
		return 'TBL_FECHASGRADOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SEDE_ID, FEGR_ESTADO', 'numerical', 'integerOnly'=>true),
			array('FEGR_FECHA', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SEDE_ID, FEGR_ID, FEGR_FECHA, FEGR_ESTADO', 'safe', 'on'=>'search'),
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
		'rel_sedes' => array(self::BELONGS_TO, 'SEDES', 'SEDE_ID'),
             

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'FEGR_ID' => 'ID',
			'FEGR_FECHA' => 'FECHA GRADO',
			'SEDE_ID' => 'SEDE',
			'FEGR_ESTADO' => 'ESTADO',
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

		$criteria->compare('FEGR_ID',$this->FEGR_ID);
		$criteria->compare('FEGR_FECHA',$this->FEGR_FECHA,true);
		$criteria->compare('SEDE_ID',$this->SEDE_ID,true);
		$criteria->compare('FEGR_ESTADO',$this->FEGR_ESTADO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function cambiarEstado($id,$estado){
      $connection = Yii::app()->db;
	   $string="UPDATE TBL_FECHASGRADOS SET FEGR_ESTADO=".$estado." WHERE FEGR_ID=".$id;
	   $criteria = $connection->createCommand($string)->execute();
	  }

	public function getImagenEstado(){
		//$imageUrl = '1.png';
	   if($this->FEGR_ESTADO==='1'){
		$imageUrl = '0.png'; 
	   }else{
		$imageUrl = '1.png'; 
	   }
	   return Yii::app()->baseurl.'/images/'.$imageUrl;
	  }	
	  
	  public function listadoFechasGrados(){
	 $connection = Yii::app()->db;
	$string='SELECT t.FEGR_ID, CONCAT(t.FEGR_FECHA," - ",s.SEDE_NOMBRE," ") AS DETALLE
			FROM TBL_FECHASGRADOS t 
			INNER JOIN TBL_SEDES s ON t.SEDE_ID=s.SEDE_ID
			WHERE FEGR_ESTADO=1 
			ORDER BY FEGR_FECHA DESC';
	$data = $connection->createCommand($string)->queryAll();
	 return CHtml::listData($data,'FEGR_ID','DETALLE');
	
	 
  }
		  
		   public function FechaGrado($FEGR_ID){
		 $connection = Yii::app()->db;
		  $sql="SELECT FEGR_FECHA  FROM TBL_FECHASGRADOS WHERE FEGR_ID=".$FEGR_ID."";
		   $dato=$connection->createCommand($sql)->queryScalar();
		 return  $dato;  
		  }
		  
		  public function getNombreMes($m){
	 switch ($m){
    case 1: return "Enero";
    case 2: return "Febrero";
    case 3: return "Marzo";
    case 4: return "Abril";
    case 5: return "Mayo";
    case 6: return "Junio";
    case 7: return "Julio";
    case 8: return "Agosto";
    case 9: return "Septiembre";
    case 10: return "Octubre";
    case 11: return "Noviembre";
    case 12: return "Diciembre";
   }
  }
  
   	  public function getNombreSedeCeremonia($FEGR_ID){
	  	  $connection = Yii::app()->db;
		  $sql="SELECT SEDE_NOMBRE FROM TBL_FECHASGRADOS F INNER JOIN TBL_SEDES S ON F.SEDE_ID=S.SEDE_ID WHERE FEGR_ID=".$FEGR_ID."";
		   $dato=$connection->createCommand($sql)->queryScalar();
	 return  $dato;  
	    }
	   public function getIdSedeCeremonia($FEGR_ID){
	  	  $connection = Yii::app()->db;
		  $sql="SELECT F.SEDE_ID FROM TBL_FECHASGRADOS F INNER JOIN TBL_SEDES S ON F.SEDE_ID=S.SEDE_ID WHERE FEGR_ID=".$FEGR_ID."";
		   $dato=$connection->createCommand($sql)->queryScalar();
		 return  $dato;  
	  
	  }	  			  
}