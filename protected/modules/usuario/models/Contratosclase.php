<?php

/**
 * This is the model class for table "TBL_CLASESCONTRATOS".
 *
 * The followings are the available columns in table 'TBL_CLASESCONTRATOS':
 * @property integer $CLCO_ID
 * @property string $CLCO_NOMBRE
 * @property string $CLCO_DESCRIPCION
 * @property integer $TICO_ID
 *
 * The followings are the available model relations:
 * @property TblTiposcontratos $tICO
 */
class Contratosclase extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Contratosclase the static model class
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
		return 'TBL_CLASESCONTRATOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CLCO_NOMBRE, TICO_ID', 'required'),
			array('TICO_ID', 'numerical', 'integerOnly'=>true),
			array('CLCO_NOMBRE', 'length', 'max'=>50),
			array('CLCO_DESCRIPCION', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CLCO_ID, CLCO_NOMBRE, CLCO_DESCRIPCION, TICO_ID', 'safe', 'on'=>'search'),
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
			'tICO' => array(self::BELONGS_TO, 'TblTiposcontratos', 'TICO_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CLCO_ID' => 'ID',
			'CLCO_NOMBRE' => 'CLASE DE CONTRATO',
			'CLCO_DESCRIPCION' => 'DESCRIPCION',
			'TICO_ID' => 'TIPO DE CONTRATO',
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

		$criteria->compare('CLCO_ID',$this->CLCO_ID);
		$criteria->compare('CLCO_NOMBRE',$this->CLCO_NOMBRE,true);
		$criteria->compare('CLCO_DESCRIPCION',$this->CLCO_DESCRIPCION,true);
		$criteria->compare('TICO_ID',$this->TICO_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}