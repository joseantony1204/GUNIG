<?php

/**
 * This is the model class for table "TBL_TITULOSTRABAJOSGRADOS".
 *
 * The followings are the available columns in table 'TBL_TITULOSTRABAJOSGRADOS':
 * @property integer $TITG_ID
 * @property string $TITG_NOMBRE
 */
class Titulostrabajosgrados extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Titulostrabajosgrados the static model class
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
		return 'TBL_TITULOSTRABAJOSGRADOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TITG_NOMBRE', 'length', 'max'=>600),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TITG_ID, TITG_NOMBRE', 'safe', 'on'=>'search'),
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
			'TITG_ID' => 'ID',
			'TITG_NOMBRE' => 'TITULO TRABAJO DE GRADO',
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

		$criteria->compare('TITG_ID',$this->TITG_ID);
		$criteria->compare('TITG_NOMBRE',$this->TITG_NOMBRE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function listadoTitulosTrabajosGrados(){
		 $criteria=new CDbCriteria;
     $criteria->select='TITG_ID, TITG_NOMBRE';
	 $criteria->order = 'TITG_NOMBRE ASC';
	 return  CHtml::listData(TitulosTrabajosGrados::model()->findAll($criteria),'TITG_ID','TITG_NOMBRE');
		
	}
	
		public function getTitulotrabajogrado($TITG_ID){
		
	  $connection = Yii::app()->db;
		  $sql="SELECT TITG_NOMBRE FROM TBL_TITULOSTRABAJOSGRADOS WHERE TITG_ID=".$TITG_ID;
		   $dato=$connection->createCommand($sql)->queryScalar();
		return $dato;
		}
		
		public function titulogradoExiste($TITG_NOMBRE){
    
	$connection = Yii::app()->db;
    $string = "SELECT * FROM TBL_TITULOSTRABAJOSGRADOS WHERE TITG_NOMBRE = '".$TITG_NOMBRE."'";
	$num_rows = $connection->createCommand($string)->queryRow();
	if($num_rows==0){  
     return 1; 
    }else{
		return 0; 
		}
   
   } 
}