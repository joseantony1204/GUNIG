<?php

/**
 * This is the model class for table "TBL_TIPOSDOCUMENTOS".
 *
 * The followings are the available columns in table 'TBL_TIPOSDOCUMENTOS':
 * @property integer $TIDO_ID
 * @property string $TIDO_NOMBRE
  * @property string $TIDO_ORDEN
 */
class Tiposdocumentos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tiposdocumentos the static model class
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
		return 'TBL_TIPOSDOCUMENTOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TIDO_NOMBRE', 'required'),
			array('TIDO_NOMBRE, TIDO_ORDEN', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TIDO_ID, TIDO_NOMBRE, TIDO_ORDEN', 'safe', 'on'=>'search'),
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
			'TIDO_ID' => 'ID',
			'TIDO_NOMBRE' => 'TIPO DE DOCUMENTO',
			'TIDO_ORDEN'=>'ORDEN',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		
		$criteria=new CDbCriteria;
         
		$criteria->select='t.*';
		$criteria->compare('TIDO_ID',$this->TIDO_ID);
		$criteria->compare('TIDO_NOMBRE',$this->TIDO_NOMBRE,true);
		$criteria->compare('TIDO_ORDEN',$this->TIDO_NOMBRE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 100,),
			'sort'=>array(
                          'defaultOrder'=>'TIDO_ORDEN ASC',
                          ),
		));
	}
}