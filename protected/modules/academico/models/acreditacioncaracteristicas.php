<?php

/**
 * This is the model class for table "tbl_acreditacioncaracteristicas".
 *
 * The followings are the available columns in table 'tbl_acreditacioncaracteristicas':
 * @property integer $ACCA_ID
 * @property string $ACCA_NUMERO
 * @property string $ACCA_DESCRIPCION
 * @property integer $ACFA_ID
 */
class acreditacioncaracteristicas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return acreditacioncaracteristicas the static model class
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
		return 'TBL_ACREDITACIONCARACTERISTICAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ACCA_NUMERO, ACCA_DESCRIPCION, ACFA_ID', 'required'),
			array('ACFA_ID', 'numerical', 'integerOnly'=>true),
			array('ACCA_NUMERO', 'length', 'max'=>10),
			array('ACCA_DESCRIPCION', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ACCA_ID, ACCA_NUMERO, ACCA_DESCRIPCION, ACFA_ID', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		//'cUEN' => array(self::BELONGS_TO, 'Cuentas', 'CUEN_ID'),
		//	'lIQUIDACIONESDESCUENTOSes' => array(self::HAS_MANY, 'Liquidacionesdescuentos', 'LIQU_ID'),

		return array(
			'REL_FACT_CARA' => array(self::BELONGS_TO, 'acreditacionfactores', 'ACFA_ID'),
			//'RELACION_FACTOR' =>array(self::HAS_MANY, 'Acreditacionfactores', 'ACFA_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ACCA_ID' => 'ID',
			'ACCA_NUMERO' => 'NUMERO',
			'ACCA_DESCRIPCION' => 'DESCRIPCION',
			'ACFA_ID' => 'ID FACTOR',
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

		$criteria->compare('ACCA_ID',$this->ACCA_ID);
		$criteria->compare('ACCA_NUMERO',$this->ACCA_NUMERO,true);
		$criteria->compare('ACCA_DESCRIPCION',$this->ACCA_DESCRIPCION,true);
		$criteria->compare('ACFA_ID',$this->ACFA_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}