<?php

/**
 * This is the model class for table "TBL_ASIGNATURAS".
 *
 * The followings are the available columns in table 'TBL_ASIGNATURAS':
 * @property integer $ASIG_ID
 * @property string $ASIG_CODIGO
 * @property string $ASIG_NOMBRE
 * @property integer $ASIG_NUMERO_CREDITOS
 * @property integer $PROG_ID
 *
 * The followings are the available model relations:
 * @property PROGRAMAS $pROG
 * @property CARGARASIGNATURASDOCENTE[] $cARGARASIGNATURASDOCENTEs
 */
class Asignaturas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Asignaturas the static model class
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
		return 'TBL_ASIGNATURAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ASIG_CODIGO, ASIG_NOMBRE', 'required'),
			array('ASIG_NUMERO_CREDITOS, PROG_ID', 'numerical', 'integerOnly'=>true),
			array('ASIG_CODIGO', 'length', 'max'=>45),
			array('ASIG_NOMBRE', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ASIG_ID, ASIG_CODIGO, ASIG_NOMBRE, ASIG_NUMERO_CREDITOS, PROG_ID', 'safe', 'on'=>'search'),
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
			'pROG' => array(self::BELONGS_TO, 'PROGRAMAS', 'PROG_ID'),
			'cARGARASIGNATURASDOCENTEs' => array(self::HAS_MANY, 'CARGARASIGNATURASDOCENTE', 'ASIG_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ASIG_ID' => 'ID',
			'ASIG_CODIGO' => 'CODIGO ASIGNATURA',
			'ASIG_NOMBRE' => 'NOMBRE ASIGNATURA',
			'ASIG_NUMERO_CREDITOS' => 'NUMERO DE CREDITOS',
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

		$criteria->compare('ASIG_ID',$this->ASIG_ID);
		$criteria->compare('ASIG_CODIGO',$this->ASIG_CODIGO,true);
		$criteria->compare('ASIG_NOMBRE',$this->ASIG_NOMBRE,true);
		$criteria->compare('ASIG_NUMERO_CREDITOS',$this->ASIG_NUMERO_CREDITOS);
		$criteria->compare('PROG_ID',$this->PROG_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getProgramas()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.PROG_ID, t.PROG_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_PROGRAMAS c ON t.PROG_ID = c.PROG_ID';
	 $criteria->order = 't.PROG_NOMBRE ASC';
	 return  CHtml::listData(Programas::model()->findAll($criteria),'PROG_ID','PROG_NOMBRE'); 
	}
public function getAsignaturas(){
	  $sql="SELECT ASIG_ID, CONCAT(ASIG_CODIGO,' - ',ASIG_NOMBRE) as CODINOMBRE FROM TBL_ASIGNATURAS";
	   $connection = Yii::app()->db;
	 $data = $connection->createCommand($sql)->queryAll();
	  return	$data;
	  	  
	  }		
}