<?php

/**
 * This is the model class for table "TBL_FORMASPAGOS".
 *
 * The followings are the available columns in table 'TBL_FORMASPAGOS':
 * @property integer $FOPA_ID
 * @property string $FOPA_DESCRIPCION
 * @property integer $MOOR_ID
 *
 * The followings are the available model relations:
 * @property TblModeloordenes $mOOR
 */
class Formaspagos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Formaspagos the static model class
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
		return 'TBL_FORMASPAGOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FOPA_DESCRIPCION, MOOR_ID', 'required'),
			array('MOOR_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FOPA_ID, FOPA_DESCRIPCION, MOOR_ID', 'safe', 'on'=>'search'),
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
			'mOOR' => array(self::BELONGS_TO, 'TblModeloordenes', 'MOOR_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'FOPA_ID' => 'Fopa',
			'FOPA_DESCRIPCION' => 'DESCRIPCIÓN DE LA FORMA DE PAGO DE LA ORDEN',
			'MOOR_ID' => 'Moor',
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

		$criteria->compare('FOPA_ID',$this->FOPA_ID);
		$criteria->compare('FOPA_DESCRIPCION',$this->FOPA_DESCRIPCION,true);
		$criteria->compare('MOOR_ID',$this->MOOR_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}