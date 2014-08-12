<?php

/**
 * This is the model class for table "TBL_EVAOBSERVACIONES".
 *
 * The followings are the available columns in table 'TBL_EVAOBSERVACIONES':
 * @property integer $EVOB_ID
 * @property integer $MOOR_ID
 * @property string $EVOB_NOMBRE
 */
class Evaobservaciones extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Evaobservaciones the static model class
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
		return 'TBL_EVAOBSERVACIONES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MOOR_ID, EVOB_NOMBRE', 'required'),
			array('MOOR_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('EVOB_ID, MOOR_ID, EVOB_NOMBRE', 'safe', 'on'=>'search'),
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
			'EVOB_ID' => 'Evob',
			'MOOR_ID' => 'Moor',
			'EVOB_NOMBRE' => 'DESCRIPCION DE OBSERVACION DE EVALUACION',
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

		$criteria->compare('EVOB_ID',$this->EVOB_ID);
		$criteria->compare('MOOR_ID',$this->MOOR_ID);
		$criteria->compare('EVOB_NOMBRE',$this->EVOB_NOMBRE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}