<?php

/**
 * This is the model class for table "TBL_VALORPUNTOS".
 *
 * The followings are the available columns in table 'TBL_VALORPUNTOS':
 * @property integer $VAPU_ID
 * @property integer $VAPU_VALOR
 * @property string $VAPU_VALORENLETRAS
 * @property integer $VAPU_ANIO
 */
class Valorpuntos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Valorpuntos the static model class
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
		return 'TBL_VALORPUNTOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('VAPU_VALOR, VAPU_VALORENLETRAS, VAPU_ANIO', 'required'),
			array('VAPU_VALOR, VAPU_ANIO', 'numerical', 'integerOnly'=>true),
			array('VAPU_VALORENLETRAS', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('VAPU_ID, VAPU_VALOR, VAPU_VALORENLETRAS, VAPU_ANIO', 'safe', 'on'=>'search'),
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
			'VAPU_ID' => 'ID',
			'VAPU_VALOR' => 'VALOR DEL PUNTO',
			'VAPU_VALORENLETRAS' => 'VALOR DEL PUNTO EN LETRAS',
			'VAPU_ANIO' => 'AÑO',
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

		$criteria->compare('VAPU_ID',$this->VAPU_ID);
		$criteria->compare('VAPU_VALOR',$this->VAPU_VALOR);
		$criteria->compare('VAPU_VALORENLETRAS',$this->VAPU_VALORENLETRAS,true);
		$criteria->compare('VAPU_ANIO',$this->VAPU_ANIO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}