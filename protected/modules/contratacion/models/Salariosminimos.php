<?php

/**
 * This is the model class for table "TBL_SALARIOSMINIMOS".
 *
 * The followings are the available columns in table 'TBL_SALARIOSMINIMOS':
 * @property integer $SAMI_ID
 * @property double $SAMI_VALOR
 * @property string $SAMI_ANIO
 * @property double $SAMI_VALORX30
 * @property string $SAMI_FECGA_INGRESO
 */
class Salariosminimos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Salariosminimos the static model class
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
		return 'TBL_SALARIOSMINIMOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SAMI_VALOR, SAMI_VALORX30', 'numerical'),
			array('SAMI_ANIO', 'length', 'max'=>4),
			array('SAMI_FECGA_INGRESO', 'safe'),
			array('SAMI_VALOR, SAMI_ANIO', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SAMI_ID, SAMI_VALOR, SAMI_ANIO, SAMI_VALORX30, SAMI_FECGA_INGRESO', 'safe', 'on'=>'search'),
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
			'SAMI_ID' => 'ID',
			'SAMI_VALOR' => 'VALOR SMMLV',
			'SAMI_ANIO' => 'AÑO',
			'SAMI_VALORX30' => 'VALOR DE 30 SMMLV',
			'SAMI_FECGA_INGRESO' => 'FECHA INGRESO',
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

		$criteria->compare('SAMI_ID',$this->SAMI_ID);
		$criteria->compare('SAMI_VALOR',$this->SAMI_VALOR);
		$criteria->compare('SAMI_ANIO',$this->SAMI_ANIO,true);
		$criteria->compare('SAMI_VALORX30',$this->SAMI_VALORX30);
		$criteria->compare('SAMI_FECGA_INGRESO',$this->SAMI_FECGA_INGRESO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function verificarVrHora($anio){
	 
	 $sql = "SELECT SAMI_ANIO FROM TBL_SALARIOSMINIMOS WHERE SAMI_ANIO = ".$anio." LIMIT 1";
	 $connection = Yii::app()->db;
	 $column = $connection->createCommand($sql)->queryColumn();
	 return $column_valor = $column[0];
	}	
	
	public function obtenerSalarioMinimoActual(){
		
	  $string = "SELECT SAMI_VALORX30 FROM  TBL_SALARIOSMINIMOS WHERE SAMI_ANIO = ".date("Y")."";	  
	  $connection = Yii::app()->db;
	  $column = $connection->createCommand($string)->queryColumn();
	  return $column_valor = $column[0];
	 }	
}