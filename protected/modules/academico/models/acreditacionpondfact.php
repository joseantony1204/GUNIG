<?php

/**
 * This is the model class for table "tbl_acreditacionpondfact".
 *
 * The followings are the available columns in table 'tbl_acreditacionpondfact':
 * @property integer $ACPO_ID
 * @property double $ACPO_GRUPO1
 * @property double $ACPO_GRUPO2
 * @property double $ACPO_GRUPO3
 * @property double $ACPO_GRUPO4
 * @property double $ACPO_GRUPO5
 * @property integer $ACFA_ID
 * @property string $ACPO_FECHA
 * @property integer $USUA_ID
 */
class acreditacionpondfact extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return acreditacionpondfact the static model class
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
		return 'tbl_acreditacionpondfact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ACFA_ID, USUA_ID', 'numerical', 'integerOnly'=>true),
			array('ACPO_GRUPO1, ACPO_GRUPO2, ACPO_GRUPO3, ACPO_GRUPO4, ACPO_GRUPO5', 'numerical'),
			array('ACPO_FECHA', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ACPO_ID, ACPO_GRUPO1, ACPO_GRUPO2, ACPO_GRUPO3, ACPO_GRUPO4, ACPO_GRUPO5, ACFA_ID, ACPO_FECHA, USUA_ID', 'safe', 'on'=>'search'),
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
			'ACPO_ID' => 'Acpo',
			'ACPO_GRUPO1' => 'Acpo Grupo1',
			'ACPO_GRUPO2' => 'Acpo Grupo2',
			'ACPO_GRUPO3' => 'Acpo Grupo3',
			'ACPO_GRUPO4' => 'Acpo Grupo4',
			'ACPO_GRUPO5' => 'Acpo Grupo5',
			'ACFA_ID' => 'Acfa',
			'ACPO_FECHA' => 'Acpo Fecha',
			'USUA_ID' => 'Usua',
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

		$criteria->compare('ACPO_ID',$this->ACPO_ID);
		$criteria->compare('ACPO_GRUPO1',$this->ACPO_GRUPO1);
		$criteria->compare('ACPO_GRUPO2',$this->ACPO_GRUPO2);
		$criteria->compare('ACPO_GRUPO3',$this->ACPO_GRUPO3);
		$criteria->compare('ACPO_GRUPO4',$this->ACPO_GRUPO4);
		$criteria->compare('ACPO_GRUPO5',$this->ACPO_GRUPO5);
		$criteria->compare('ACFA_ID',$this->ACFA_ID);
		$criteria->compare('ACPO_FECHA',$this->ACPO_FECHA,true);
		$criteria->compare('USUA_ID',$this->USUA_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}