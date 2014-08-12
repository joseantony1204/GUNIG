<?php

/**
 * This is the model class for table "TBL_LIBROS".
 *
 * The followings are the available columns in table 'TBL_LIBROS':
 * @property integer $LIBR_ID
 * @property integer $LIBR_ESTADO
 */
class Libros extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Libros the static model class
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
		return 'TBL_LIBROS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('LIBR_ID', 'required'),
			array('LIBR_ID, LIBR_ESTADO', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('LIBR_ID, LIBR_ESTADO', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'LIBR_ID' => 'LIBRO',
			'LIBR_ESTADO' => 'ESTADO',
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

		$criteria->compare('LIBR_ID',$this->LIBR_ID);
		$criteria->compare('LIBR_ESTADO',$this->LIBR_ESTADO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
/*public function cambiarEstado($id,$estado){
      $connection = Yii::app()->db;
	   $string="UPDATE TBL_LIBROS SET LIBR_ESTADO=".$estado." WHERE LIBR_ID=".$id;
	   $criteria = $connection->createCommand($string)->execute();
	  }*/

	public function cambiarEstado($id,$estado){
		     
	 $connection = Yii::app()->db;
	 $sql = "SELECT * FROM TBL_LIBROS WHERE LIBR_ESTADO=1 ORDER BY LIBR_ID DESC";
	  $num_rows = $connection->createCommand($sql)->queryRow();
	 $registro = $connection->createCommand($sql)->queryAll();
	 if($num_rows>0){
	  foreach($registro as $data){
       $string="UPDATE TBL_LIBROS SET LIBR_ESTADO= 0";
	   $criteria = $connection->createCommand($string)->execute();
	  }
	  $string="UPDATE TBL_LIBROS SET LIBR_ESTADO=".$estado." WHERE LIBR_ID =".$id."";
	  $criteria = $connection->createCommand($string)->execute();
	 }
	}
	public function desactivarLibros(){
		     
	 $connection = Yii::app()->db;
	 $sql = "SELECT * FROM TBL_LIBROS WHERE LIBR_ESTADO=1 ORDER BY LIBR_ID DESC";
	  $num_rows = $connection->createCommand($sql)->queryRow();
	 $registro = $connection->createCommand($sql)->queryAll();
	 if($num_rows>0){
	  foreach($registro as $data){
       $string="UPDATE TBL_LIBROS SET LIBR_ESTADO= 0";
	   $criteria = $connection->createCommand($string)->execute();
	  }
	  $criteria = $connection->createCommand($string)->execute();
	 }
	}
	
	public function getImagenEstado(){
		$model= new Libros;
					//$imageUrl = '1.png';
	   if($this->LIBR_ESTADO==='1'){
		$imageUrl = '0.png'; 
	   }else{
		$imageUrl = '1.png'; 
	   }
	   return Yii::app()->baseurl.'/images/'.$imageUrl;
	  }	
	  
	  public function getLibroActivo(){
		  
		  $connection = Yii::app()->db;
		  $sql='SELECT LIBR_ID FROM TBL_LIBROS WHERE  TBL_LIBROS.LIBR_ESTADO=1';
		   $dato=$connection->createCommand($sql)->queryScalar();
		  	return $dato;
		
		}
		
		public function setLibro(){
			$libros=new Libros;
			$libros->LIBR_ESTADO=1;
			$libros->save();
			$LIBR_ID=$libros->getPrimaryKey();
			exit(var_dump($LIBR_ID));
			$libros->cambiarEstado($LIBR_ID, $libros->LIBR_ESTADO);
			}
			
		public function getNumeroFoliosDeLibro($LIBR_ID){
			$connection = Yii::app()->db;
		  $sql='SELECT COUNT(TBL_FOLIOS.FOLI_NOMBRE) FROM TBL_LIBROS 
INNER JOIN TBL_FOLIOS ON TBL_FOLIOS.LIBR_ID=TBL_LIBROS.LIBR_ID WHERE  TBL_LIBROS.LIBR_ESTADO=1;';
		   $NumeroFolios=$connection->createCommand($sql)->queryScalar();
		   	if($NumeroFolios==400){
			   $libros=new Libros;
			   $libros->setLibro();
			   }
		   	return $dato;
		}
		
				  
}