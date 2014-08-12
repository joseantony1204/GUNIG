<?php

/**
 * This is the model class for table "TBL_PRESUPUESTOS".
 *
 * The followings are the available columns in table 'TBL_PRESUPUESTOS':
 * @property integer $PRES_ID
 * @property string $PRES_NUM_CERTIFICADO
 * @property string $PRES_DESCRIPCION
 * @property string $PRES_SECCION
 * @property string $PRES_CODIGO
 * @property integer $PRES_MONTO
 * @property string $PRES_FECHA_VIGENCIA
 * @property string $PRES_NOMBRE
 * @property string $PRES_FECHA_INGRESO
 */
class Presupuestos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Presupuestos the static model class
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
		return 'TBL_PRESUPUESTOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PRES_NUM_CERTIFICADO, PRES_DESCRIPCION, PRES_SECCION, PRES_CODIGO, PRES_MONTO, PRES_FECHA_VIGENCIA', 'required'),
			array('PRES_MONTO', 'numerical', 'integerOnly'=>true),
			array('PRES_NUM_CERTIFICADO, PRES_DESCRIPCION, PRES_SECCION, PRES_CODIGO', 'length', 'max'=>50),
			array('PRES_NOMBRE', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PRES_ID, PRES_NUM_CERTIFICADO, PRES_DESCRIPCION, PRES_SECCION, PRES_CODIGO, PRES_MONTO, PRES_FECHA_VIGENCIA, PRES_NOMBRE, PRES_FECHA_INGRESO', 'safe', 'on'=>'search'),
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
			'PRES_ID' => 'ID',
			'PRES_NUM_CERTIFICADO' => 'NUM. CERTIFICADO',
			'PRES_DESCRIPCION' => 'DESCRIPCION',
			'PRES_SECCION' => 'SECCION',
			'PRES_CODIGO' => 'CODIGO',
			'PRES_MONTO' => 'MONTO',
			'PRES_FECHA_VIGENCIA' => 'FECHA VIGENCIA',
			'PRES_NOMBRE' => 'NOMBRE',
			'PRES_FECHA_INGRESO' => 'FECHA INGRESO',
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

		$criteria->compare('PRES_ID',$this->PRES_ID);
		$criteria->compare('PRES_NUM_CERTIFICADO',$this->PRES_NUM_CERTIFICADO,true);
		$criteria->compare('PRES_DESCRIPCION',$this->PRES_DESCRIPCION,true);
		$criteria->compare('PRES_SECCION',$this->PRES_SECCION,true);
		$criteria->compare('PRES_CODIGO',$this->PRES_CODIGO,true);
		$criteria->compare('PRES_MONTO',$this->PRES_MONTO);
		$criteria->compare('PRES_FECHA_VIGENCIA',$this->PRES_FECHA_VIGENCIA,true);
		$criteria->compare('PRES_NOMBRE',$this->PRES_NOMBRE,true);
		$criteria->compare('PRES_FECHA_INGRESO',$this->PRES_FECHA_INGRESO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
    public function loadLastData (){
	 $sql = "SELECT MAX(PRES_ID) FROM TBL_PRESUPUESTOS";
	 $connection = Yii::app()->db;
	 $query = $connection->createCommand($sql)->queryColumn();
	 $lastId = $query[0];
	 $Presupuestos = Presupuestos::model()->findByPk($lastId);
	 return $Presupuestos;
	}
	
	public function loadLastData2 ($fechaingreso,$num,$seccion,$codigo){
	$sql = "SELECT MAX(PRES_ID) FROM TBL_PRESUPUESTOS 
	 WHERE PRES_FECHA_INGRESO = '$fechaingreso' AND PRES_NUM_CERTIFICADO='$num' AND PRES_SECCION='$seccion' AND PRES_CODIGO='$codigo'";
	 $connection = Yii::app()->db;
	 //sleep(3600);
	 $query = $connection->createCommand($sql)->queryColumn();
	 $lastId = $query[0];
	 $Presupuestos = Presupuestos::model()->findByPk($lastId);
	 return $Presupuestos;
	}
	
	
}