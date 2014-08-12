<?php

/**
 * This is the model class for table "TBL_TIPOSESTUDIOS".
 *
 * The followings are the available columns in table 'TBL_TIPOSESTUDIOS':
 * @property integer $TIES_ID
 * @property string $TIES_NOMBRE
 */
class Tiposestudios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tiposestudios the static model class
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
		return 'TBL_TIPOSESTUDIOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TIES_NOMBRE', 'required'),
			array('TIES_NOMBRE', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TIES_ID, TIES_NOMBRE', 'safe', 'on'=>'search'),
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
			'TIES_ID' => 'Ties',
			'TIES_NOMBRE' => 'Ties Nombre',
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

		$criteria->compare('TIES_ID',$this->TIES_ID);
		$criteria->compare('TIES_NOMBRE',$this->TIES_NOMBRE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getTiposestudios()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.TIES_ID, t.TIES_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_ESTUDIOS e ON e.TIES_ID = t.TIES_ID '; //AND t.ANAC_ESTADO = 0	
	 $criteria->order = 't.TIES_NOMBRE ASC';
	 return  CHtml::listData(Tiposestudios::model()->findAll($criteria),'TIES_ID','TIES_NOMBRE'); 
	}	
}