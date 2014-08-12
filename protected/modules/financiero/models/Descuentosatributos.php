<?php

/**
 * This is the model class for table "TBL_DESCUENTOSATRIBUTOS".
 *
 * The followings are the available columns in table 'TBL_DESCUENTOSATRIBUTOS':
 * @property string $DEAT_ID
 * @property string $DEAT_DESCRIPCION
 * @property string $DEAT_DESDE
 * @property string $DEAT_HASTA
 * @property double $DEAT_VALOR
 * @property string $DESC_ID
 * @property integer $ANAC_ID
 *
 * The followings are the available model relations:
 * @property ANIOSACADEMICOS $aNAC
 * @property DESCUENTOS $dESC
 */
class Descuentosatributos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Descuentosatributos the static model class
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
		return 'TBL_DESCUENTOSATRIBUTOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DEAT_DESCRIPCION, ANAC_ID', 'required'),
			array('ANAC_ID', 'numerical', 'integerOnly'=>true),
			array('DEAT_VALOR', 'numerical'),
			array('DEAT_DESCRIPCION', 'length', 'max'=>200),
			array('DEAT_CODIGO, DEAT_DESDE, DEAT_HASTA, DESC_ID', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('DEAT_ID,DEAT_CODIGO, DEAT_DESCRIPCION, DEAT_DESDE, DEAT_HASTA, DEAT_VALOR, DESC_ID, ANAC_ID', 'safe', 'on'=>'search'),
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
			'aNAC' => array(self::BELONGS_TO, 'Aniosacademicos', 'ANAC_ID'),
			'dESC' => array(self::BELONGS_TO, 'Descuentos', 'DESC_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'DEAT_ID' => 'Id',
			 'DEAT_CODIGO' => 'Codigo',
			'DEAT_DESCRIPCION' => 'Descripcion',
			'DEAT_DESDE' => 'Desde',
			'DEAT_HASTA' => 'Hasta',
			'DEAT_VALOR' => 'Tarifa',
			'DESC_ID' => 'Descuento',
			'ANAC_ID' => 'Vigencia',
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

		$criteria->compare('DEAT_ID',$this->DEAT_ID,true);
		$criteria->compare('DEAT_CODIGO',$this->DEAT_CODIGO,true);
		$criteria->compare('DEAT_DESCRIPCION',$this->DEAT_DESCRIPCION,true);
		$criteria->compare('DEAT_DESDE',$this->DEAT_DESDE,true);
		$criteria->compare('DEAT_HASTA',$this->DEAT_HASTA,true);
		$criteria->compare('DEAT_VALOR',$this->DEAT_VALOR);
		$criteria->compare('DESC_ID',$this->DESC_ID);
		$criteria->compare('ANAC_ID',$this->ANAC_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getDescuentos($id)
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.DESC_ID, t.DESC_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_DESCUENTOSATRIBUTOS  c ON c.DESC_ID = t.DESC_ID AND c.DESC_ID = '.$id;	
	 $criteria->order = 't.DESC_NOMBRE ASC';
	 return  CHtml::listData(Descuentos::model()->findAll($criteria),'DESC_ID','DESC_NOMBRE'); 
	}		
	
}