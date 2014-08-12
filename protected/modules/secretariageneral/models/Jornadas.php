<?php

/**
 * This is the model class for table "TBL_JORNADAS".
 *
 * The followings are the available columns in table 'TBL_JORNADAS':
 * @property integer $JORN_ID
 * @property string $JORN_NOMBRE
 */
class Jornadas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return jornadas the static model class
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
		return 'TBL_JORNADAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('JORN_NOMBRE', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('JORN_ID, JORN_NOMBRE', 'safe', 'on'=>'search'),
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
			'JORN_ID' => 'ID',
			'JORN_NOMBRE' => 'JORNADA',
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

		$criteria->compare('JORN_ID',$this->JORN_ID);
		$criteria->compare('JORN_NOMBRE',$this->JORN_NOMBRE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
		public function getListadoJornadas(){
		 $criteria=new CDbCriteria;
     $criteria->select='JORN_ID, JORN_NOMBRE';
	 $criteria->order = 'JORN_NOMBRE ASC';
	 
	 return  CHtml::listData(Jornadas::model()->findAll($criteria),'JORN_ID','JORN_NOMBRE');
		
		}
 public function getNombreJornadas($JORN_ID){
		
	  $connection = Yii::app()->db;
		  $sql="SELECT JORN_NOMBRE FROM TBL_JORNADAS WHERE JORN_ID=".$JORN_ID."";
		   $dato=$connection->createCommand($sql)->queryScalar();
		return $dato;
		}
}