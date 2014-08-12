<?php

/**
 * This is the model class for table "TBL_TITULOS".
 *
 * The followings are the available columns in table 'TBL_TITULOS':
 * @property integer $TITU_ID
 * @property string $TITU_NOMBRE
 */
class Titulos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Titulos the static model class
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
		return 'TBL_TITULOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TITU_NOMBRE', 'length', 'max'=>300),
			array('PROG_ID', 'numerical', 'integerOnly'=>true),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TITU_ID, TITU_NOMBRE, PROG_ID', 'safe', 'on'=>'search'),
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
			'rel_programas' => array(self::BELONGS_TO, 'PROGRAMAS', 'PROG_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'TITU_ID' => 'ID',
			'TITU_NOMBRE' => 'TITULO',
			'PROG_ID' => 'PROGRAMA',
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

		$criteria->compare('TITU_ID',$this->TITU_ID);
		$criteria->compare('TITU_NOMBRE',$this->TITU_NOMBRE,true);
		$criteria->compare('PROG_ID',$this->TITU_NOMBRE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function listadoTitulosPorPrograma($PROG_ID){
		 $criteria=new CDbCriteria;
     $criteria->select='TITU_ID, TITU_NOMBRE';
	   $criteria->condition='PROG_ID="$PROG_ID"'; 
	 $criteria->order = 'TITU_NOMBRE ASC';
	 
	 return  CHtml::listData(Titulos::model()->findAll($criteria),'TITU_ID','TITU_NOMBRE');
		
		}
		
		public function getListadoTitulos(){
		 $criteria=new CDbCriteria;
     $criteria->select='TITU_ID, TITU_NOMBRE';
	 $criteria->order = 'TITU_NOMBRE ASC';
	 
	 return  CHtml::listData(Titulos::model()->findAll($criteria),'TITU_ID','TITU_NOMBRE');
		
		}
		
		public function getProgramaTitulo($TITU_ID){
		  $connection = Yii::app()->db;
		  $sql="SELECT PROG_ID  FROM TBL_TITULOS WHERE TITU_ID=".$TITU_ID."";
		   $dato=$connection->createCommand($sql)->queryScalar();
	 
	 return  $dato;
		
		}
		public function getJornadaTitulo($TITU_ID){
		  $connection = Yii::app()->db;
		  $sql="SELECT JORN_ID  FROM TBL_TITULOS WHERE TITU_ID=".$TITU_ID."";
		   $dato=$connection->createCommand($sql)->queryScalar();
	 
	 return  $dato;
		
		}
		
			public function getNombreTitulo($TITU_ID){
		
	  $connection = Yii::app()->db;
		  $sql="SELECT TITU_NOMBRE FROM TBL_TITULOS WHERE TITU_ID=".$TITU_ID;
		   $dato=$connection->createCommand($sql)->queryScalar();
		return $dato;
		}
}