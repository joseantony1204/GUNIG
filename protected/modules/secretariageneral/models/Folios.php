<?php

/**
 * This is the model class for table "TBL_FOLIOS".
 *
 * The followings are the available columns in table 'TBL_FOLIOS':
 * @property integer $FOLI_ID
 * @property integer $FOLI_NOMBRE
 * @property integer $LIBR_ID
 *
 * The followings are the available model relations:
 * @property LIBROS $lIBR
 */
class Folios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Folios the static model class
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
		return 'TBL_FOLIOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FOLI_NOMBRE, LIBR_ID', 'required'),
			array('FOLI_NOMBRE, LIBR_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FOLI_ID, FOLI_NOMBRE, LIBR_ID', 'safe', 'on'=>'search'),
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
			'lIBR' => array(self::BELONGS_TO, 'LIBROS', 'LIBR_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'FOLI_ID' => 'ID',
			'FOLI_NOMBRE' => 'FOLIO',
			'LIBR_ID' => 'LIBRO',
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

		$criteria->compare('FOLI_ID',$this->FOLI_ID);
		$criteria->compare('FOLI_NOMBRE',$this->FOLI_NOMBRE);
		$criteria->compare('LIBR_ID',$this->LIBR_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getNextFolio(){
		 $connection = Yii::app()->db;
		  $sql='SELECT MAX(FOLI_NOMBRE)+1 FROM TBL_LIBROS INNER JOIN TBL_FOLIOS ON TBL_FOLIOS.LIBR_ID=TBL_LIBROS.LIBR_ID WHERE  TBL_LIBROS.LIBR_ESTADO=1;';
		   $dato=$connection->createCommand($sql)->queryScalar();
		  	   
		  	return $dato;
		
		}
		
		public function setFolios($LIBR_ID){
			$folios=new Folios;
			$nextFolio= $folios->getNextFolio();
			$folios->FOLI_NOMBRE=$folios->getNextFolio();
			$folios->LIBR_ID=$LIBR_ID;
			$folios->save();
			$insert_id=$folios->getPrimaryKey();
			return $insert_id;
						
			}
			
			public function getFolio($FOLI_ID){
			
		
	  $connection = Yii::app()->db;
		  $sql="SELECT FOLI_NOMBRE FROM TBL_FOLIOS WHERE FOLI_ID=".$FOLI_ID;
		   $dato=$connection->createCommand($sql)->queryScalar();
		return $dato;
		}
			
						
		public function getListadoFolios(){
	 $criteria=new CDbCriteria;
     $criteria->select='FOLI_ID, FOLI_NOMBRE';
	return  CHtml::listData(Folios::model()->findAll($criteria),'FOLI_ID','FOLI_NOMBRE');
		
		}



	
			
		
}