<?php

/**
 * This is the model class for table "tbl_acreditacionbitacoras".
 *
 * The followings are the available columns in table 'tbl_acreditacionbitacoras':
 * @property integer $ACBI_ID
 * @property integer $ACBI_NUMERO
 * @property string $ACBI_FECHA
 * @property integer $ACPR_ID
 */
class acreditacionbitacoras extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return acreditacionbitacoras the static model class
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
		return 'TBL_ACREDITACIONBITACORAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ACBI_NUMERO, ACBI_FECHA, ACPR_ID', 'required'),
			array('ACBI_NUMERO, ACPR_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ACBI_ID, ACBI_NUMERO, ACBI_FECHA, ACPR_ID', 'safe', 'on'=>'search'),
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
			'REL_PROG_BITA' => array( self::BELONGS_TO, acreditacionprogramas, 'ACPR_ID'),
    		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ACBI_ID' => 'ID',
			'ACBI_NUMERO' => 'NUMERO',
			'ACBI_FECHA' => 'FECHA',
			'ACPR_ID' => 'ID PROGRAMA',
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

		$criteria->compare('ACBI_ID',$this->ACBI_ID);
		$criteria->compare('ACBI_NUMERO',$this->ACBI_NUMERO);
		$criteria->compare('ACBI_FECHA',$this->ACBI_FECHA,true);
		$criteria->compare('ACPR_ID',$this->ACPR_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'keyAttribute'=>'ACBI_ID',
		));
	}
	
	
}