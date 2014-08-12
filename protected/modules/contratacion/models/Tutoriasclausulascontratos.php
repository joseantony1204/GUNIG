<?php

/**
 * This is the model class for table "TBL_TUTORIASCLAUSULASCONTRATOS".
 *
 * The followings are the available columns in table 'TBL_TUTORIASCLAUSULASCONTRATOS':
 * @property integer $TUCC_ID
 * @property string $TUCC_NOMBRE
 * @property string $TUCC_DESCRIPCION
 * @property integer $TUFC_ID
 */
class Tutoriasclausulascontratos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tutoriasclausulascontratos the static model class
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
		return 'TBL_TUTORIASCLAUSULASCONTRATOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TUCC_NOMBRE, TUCC_DESCRIPCION, TUFC_ID', 'required'),
			array('TUFC_ID', 'numerical', 'integerOnly'=>true),
			array('TUCC_NOMBRE, TUCC_DESCRIPCION', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TUCC_ID, TUCC_NOMBRE, TUCC_DESCRIPCION, TUFC_ID', 'safe', 'on'=>'search'),
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
			'TUCC_ID' => 'Tucc',
			'TUCC_NOMBRE' => 'Tucc Nombre',
			'TUCC_DESCRIPCION' => 'Tucc Descripcion',
			'TUFC_ID' => 'Tufc',
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
         
		$criteria->compare('TUCC_ID',$this->TUCC_ID);
		$criteria->compare('TUCC_NOMBRE',$this->TUCC_NOMBRE,true);
		$criteria->compare('TUCC_DESCRIPCION',$this->TUCC_DESCRIPCION,true);
		$criteria->compare('TUFC_ID',$this->TUFC_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}