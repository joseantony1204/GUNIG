<?php

/**
 * This is the model class for table "TBL_NIVELESESTUDIOS".
 *
 * The followings are the available columns in table 'TBL_NIVELESESTUDIOS':
 * @property integer $NIES_ID
 * @property string $NIES_NOMBRE
 */
class Nivelesestudios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Nivelesestudios the static model class
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
		return 'TBL_NIVELESESTUDIOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NIES_NOMBRE', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('NIES_ID, NIES_NOMBRE', 'safe', 'on'=>'search'),
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
			'NIES_ID' => 'ID',
			'NIES_NOMBRE' => 'NIVLES',
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

		$criteria->compare('NIES_ID',$this->NIES_ID);
		$criteria->compare('NIES_NOMBRE',$this->NIES_NOMBRE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

public function getNombreNivel($NIES_ID){
		
	  $connection = Yii::app()->db;
		  $sql="SELECT NIES_NOMBRE FROM TBL_NIVELESESTUDIOS WHERE NIES_ID=".$NIES_ID;
		   $dato=$connection->createCommand($sql)->queryScalar();
		return $dato;
		}
}