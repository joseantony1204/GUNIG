<?php

/**
 * This is the model class for table "TBL_ESTADOSESTUDIO".
 *
 * The followings are the available columns in table 'TBL_ESTADOSESTUDIO':
 * @property integer $ESES_ID
 * @property string $ESES_NOMBRE
 */
class Estadosestudios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Estadosestudios the static model class
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
		return 'TBL_ESTADOSESTUDIO';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ESES_NOMBRE', 'required'),
			array('ESES_NOMBRE', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ESES_ID, ESES_NOMBRE', 'safe', 'on'=>'search'),
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
			'ESES_ID' => 'Eses',
			'ESES_NOMBRE' => 'Eses Nombre',
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

		$criteria->compare('ESES_ID',$this->ESES_ID);
		$criteria->compare('ESES_NOMBRE',$this->ESES_NOMBRE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getEstadosestudios()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.ESES_ID, t.ESES_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_PERSONASNATURALESESTUDIOS pne ON pne.ESES_ID = t.ESES_ID '; //AND t.ANAC_ESTADO = 0	
	 $criteria->order = 't.ESES_NOMBRE ASC';
	 return  CHtml::listData(Estadosestudios::model()->findAll($criteria),'ESES_ID','ESES_NOMBRE'); 
	}		
}