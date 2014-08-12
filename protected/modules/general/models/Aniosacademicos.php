<?php

/**
 * This is the model class for table "TBL_ANIOSACADEMICOS".
 *
 * The followings are the available columns in table 'TBL_ANIOSACADEMICOS':
 * @property integer $ANAC_ID
 * @property string $ANAC_NOMBRE
 * @property string $ANAC_FECHA_INICIO
 * @property string $ANAC_FECHA_FINAL
 * @property integer $ANAC_ESTADO
 */
class Aniosacademicos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Anualesp the static model class
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
		return 'TBL_ANIOSACADEMICOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ANAC_ID, ANAC_NOMBRE, ANAC_FECHA_INICIO, ANAC_FECHA_FINAL, ANAC_ESTADO', 'required'),
			array('ANAC_ID, ANAC_ESTADO', 'numerical', 'integerOnly'=>true),
			array('ANAC_NOMBRE', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ANAC_ID, ANAC_NOMBRE, ANAC_FECHA_INICIO, ANAC_FECHA_FINAL, ANAC_ESTADO', 'safe', 'on'=>'search'),
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
			'ANAC_ID' => 'ID',
			'ANAC_NOMBRE' => 'NOMBRE',
			'ANAC_FECHA_INICIO' => 'FECHA INICIO',
			'ANAC_FECHA_FINAL' => 'FECHA FINAL',
			'ANAC_ESTADO' => 'ESTADO',
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

		$criteria->compare('ANAC_ID',$this->ANAC_ID);
		$criteria->compare('ANAC_NOMBRE',$this->ANAC_NOMBRE,true);
		$criteria->compare('ANAC_FECHA_INICIO',$this->ANAC_FECHA_INICIO,true);
		$criteria->compare('ANAC_FECHA_FINAL',$this->ANAC_FECHA_FINAL,true);
		$criteria->compare('ANAC_ESTADO',$this->ANAC_ESTADO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function cambiarEstado($periodo,$estado){
      
	 $connection = Yii::app()->db;
	 $sql = "SELECT * FROM TBL_ANIOSACADEMICOS WHERE ANAC_ESTADO = 0 ORDER BY ANAC_ID DESC";
	 $num_rows = $connection->createCommand($sql)->queryRow();
	 $registro = $connection->createCommand($sql)->queryAll();
	 if($num_rows>0){
	  foreach($registro as $data){
       $string="UPDATE TBL_ANIOSACADEMICOS  SET ANAC_ESTADO = 1";
	   $criteria = $connection->createCommand($string)->execute();
	  }
	  $string="UPDATE TBL_ANIOSACADEMICOS  SET ANAC_ESTADO = $estado WHERE ANAC_ID = $periodo";
	  $criteria = $connection->createCommand($string)->execute();
	 }
	}	
	
	public function getImagenEstado(){
		$imageUrl = '1.png';
	   if($this->ANAC_ESTADO==='0'){
		$imageUrl = '0.png'; 
	   }
	   return Yii::app()->baseurl.'/images/'.$imageUrl;
	  }	
}