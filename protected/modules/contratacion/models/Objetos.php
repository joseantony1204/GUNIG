<?php

/**
 * This is the model class for table "TBL_OBJETOS".
 *
 * The followings are the available columns in table 'TBL_OBJETOS':
 * @property integer $OBJE_ID
 * @property string $OBJE_NOMBRE
 */
class Objetos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Objetos the static model class
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
		return 'TBL_OBJETOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OBJE_NOMBRE', 'required'),
			array('OBJE_ID', 'numerical', 'integerOnly'=>true),
			array('OBJE_NOMBRE', 'length', 'max'=>2000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('OBJE_ID, OBJE_NOMBRE, OBJE_FECHA_INGRESO', 'safe', 'on'=>'search'),
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
			'OBJE_ID' => 'ID',
			'OBJE_NOMBRE' => 'DESCRIPCION DEL OBJETO',
			'OBJE_FECHA_INGRESO'=>'FECHA INGRESO',
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

		$criteria->compare('OBJE_ID',$this->OBJE_ID);
		$criteria->compare('OBJE_NOMBRE',$this->OBJE_NOMBRE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function loadLastData ($nombre, $fecha){
	 $sql = "SELECT MAX(OBJE_ID) FROM TBL_OBJETOS WHERE OBJE_NOMBRE = '$nombre' AND OBJE_FECHA_INGRESO = '$fecha'";
	 $connection = Yii::app()->db;
	 $query = $connection->createCommand($sql)->queryColumn();
	 $lastId = $query[0];
	 $Objetos = Objetos::model()->findByPk($lastId);
	 return $Objetos;
	}	
}