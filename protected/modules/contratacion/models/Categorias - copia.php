<?php

/**
 * This is the model class for table "TBL_CATEGORIAS".
 *
 * The followings are the available columns in table 'TBL_CATEGORIAS':
 * @property integer $CATE_ID
 * @property string $CATE_NOMBRE
 * @property integer $CATE_VALOR
 * @property string $CATE_VALORENLETRAS
 */
class Categorias extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Categorias the static model class
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
		return 'TBL_CATEGORIAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CATE_NOMBRE, CATE_VALOR, CATE_VALORENLETRAS', 'required'),
			array('CATE_VALOR', 'numerical', 'integerOnly'=>true),
			array('CATE_NOMBRE', 'length', 'max'=>45),
			array('CATE_VALORENLETRAS', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CATE_ID, CATE_NOMBRE, CATE_VALOR, CATE_VALORENLETRAS', 'safe', 'on'=>'search'),
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
			'CATE_ID' => 'ID',
			'CATE_NOMBRE' => 'NOMBRE DE CATEGORIAS',
			'CATE_VALOR' => 'VALOR',
			'CATE_VALORENLETRAS' => 'VALOR EN LETRAS',
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

		$criteria->compare('CATE_ID',$this->CATE_ID);
		$criteria->compare('CATE_NOMBRE',$this->CATE_NOMBRE,true);
		$criteria->compare('CATE_VALOR',$this->CATE_VALOR);
		$criteria->compare('CATE_VALORENLETRAS',$this->CATE_VALORENLETRAS,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}