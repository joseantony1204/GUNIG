<?php

/**
 * This is the model class for table "TBL_USUARIOSPERFILESUSUARIOS".
 *
 * The followings are the available columns in table 'TBL_USUARIOSPERFILESUSUARIOS':
 * @property integer $USPU_ID
 * @property integer $USUA_ID
 * @property integer $USPE_ID
 * @property string $USPU_FECHAINGRESO
 *
 * The followings are the available model relations:
 * @property TblUsuariosperfiles $uSPE
 * @property TblUsuarios $uSUA
 */
class Usuariosperfilesusuarios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usuariosperfilesusuarios the static model class
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
		return 'TBL_USUARIOSPERFILESUSUARIOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('USUA_ID, USPE_ID, USPU_FECHAINGRESO', 'required'),
			array('USUA_ID, USPE_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('USPU_ID, USUA_ID, USPE_ID, USPU_FECHAINGRESO', 'safe', 'on'=>'search'),
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
			'uSPE' => array(self::BELONGS_TO, 'TblUsuariosperfiles', 'USPE_ID'),
			'uSUA' => array(self::BELONGS_TO, 'TblUsuarios', 'USUA_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'USPU_ID' => 'Uspu',
			'USUA_ID' => 'Usua',
			'USPE_ID' => 'Uspe',
			'USPU_FECHAINGRESO' => 'Uspu Fechaingreso',
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

		$criteria->compare('USPU_ID',$this->USPU_ID);
		$criteria->compare('USUA_ID',$this->USUA_ID);
		$criteria->compare('USPE_ID',$this->USPE_ID);
		$criteria->compare('USPU_FECHAINGRESO',$this->USPU_FECHAINGRESO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}