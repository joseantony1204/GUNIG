<?php

/**
 * This is the model class for table "TBL_SEGUIMIENTOUSERDEPENDENCIAS".
 *
 * The followings are the available columns in table 'TBL_SEGUIMIENTOUSERDEPENDENCIAS':
 * @property integer $SEUD_ID
 * @property integer $USUA_ID
 * @property integer $DEPE_ID
 *
 * The followings are the available model relations:
 * @property TblUsuarios $uSUA
 * @property TblDependencias $dEPE
 */
class Seguimientouserdependencias extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Seguimientouserdependencias the static model class
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
		return 'TBL_SEGUIMIENTOUSERDEPENDENCIAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('USUA_ID, DEPE_ID', 'required'),
			array('USUA_ID, DEPE_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SEUD_ID, USUA_ID, DEPE_ID', 'safe', 'on'=>'search'),
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
			'rel_usuarios' => array(self::BELONGS_TO, 'Usuarios', 'USUA_ID'),
			'rel_dependencias' => array(self::BELONGS_TO, 'Dependencias', 'DEPE_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'SEUD_ID' => 'ID',
			'USUA_ID' => 'USUARIO',
			'DEPE_ID' => 'DEPENDENCIA',
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

		$criteria->compare('SEUD_ID',$this->SEUD_ID);
		$criteria->compare('USUA_ID',$this->USUA_ID);
		$criteria->compare('DEPE_ID',$this->DEPE_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}