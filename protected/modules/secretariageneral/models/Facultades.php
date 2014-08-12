<?php

/**
 * This is the model class for table "TBL_FACULTADES".
 *
 * The followings are the available columns in table 'TBL_FACULTADES':
 * @property integer $FACU_ID
 * @property string $FACU_NOMBRE
 *
 * The followings are the available model relations:
 * @property DECANOS[] $dECANOSes
 * @property PRECARGASACADEMICAS[] $pRECARGASACADEMICASes
 */
class Facultades extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Facultades the static model class
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
		return 'TBL_FACULTADES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FACU_NOMBRE', 'required'),
			array('FACU_NOMBRE', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FACU_ID, FACU_NOMBRE', 'safe', 'on'=>'search'),
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
			'dECANOSes' => array(self::HAS_MANY, 'DECANOS', 'FACU_ID'),
			'rel_programas' => array(self::HAS_MANY, 'PROGRAMAS', 'PROG_ID'),
			'pRECARGASACADEMICASes' => array(self::HAS_MANY, 'PRECARGASACADEMICAS', 'FACU_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'FACU_ID' => 'ID',
			'FACU_NOMBRE' => 'NOMBRE FACULTAD',
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

		$criteria->compare('FACU_ID',$this->FACU_ID);
		$criteria->compare('FACU_NOMBRE',$this->FACU_NOMBRE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public static function getListadoFacultades(){
		return CHtml::listData(Facultades::model()->findAll(),'FACU_ID', 'FACU_NOMBRE');
		}
		
		public function getNombreFacultad($FACU_ID){
		
	  $connection = Yii::app()->db;
		  $sql="SELECT FACU_NOMBRE FROM TBL_FACULTADES WHERE FACU_ID=".$FACU_ID."";
		   $dato=$connection->createCommand($sql)->queryScalar();
		return $dato;
		}
}