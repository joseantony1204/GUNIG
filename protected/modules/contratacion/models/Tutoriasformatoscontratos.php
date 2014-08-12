<?php

/**
 * This is the model class for table "TBL_TUTORIASFORMATOSCONTRATOS".
 *
 * The followings are the available columns in table 'TBL_TUTORIASFORMATOSCONTRATOS':
 * @property integer $TUFC_ID
 * @property string $TUFC_NOMBRE
 * @property string $TUFC_DESCRIPCION
 */
class Tutoriasformatoscontratos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tutoriasformatos the static model class
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
		return 'TBL_TUTORIASFORMATOSCONTRATOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TUFC_NOMBRE, TUFC_DESCRIPCION', 'required'),
			array('TUFC_NOMBRE', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TUFC_ID, TUFC_NOMBRE, TUFC_DESCRIPCION', 'safe', 'on'=>'search'),
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
			'TUFC_ID' => 'Tufc',
			'TUFC_NOMBRE' => 'Tufc Nombre',
			'TUFC_DESCRIPCION' => 'Tufc Descripcion',
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

		$criteria->compare('TUFC_ID',$this->TUFC_ID);
		$criteria->compare('TUFC_NOMBRE',$this->TUFC_NOMBRE,true);
		$criteria->compare('TUFC_DESCRIPCION',$this->TUFC_DESCRIPCION,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}