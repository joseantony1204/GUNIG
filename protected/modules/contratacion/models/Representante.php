<?php

/**
 * This is the model class for table "TBL_REPRESENTANTESLEGAL".
 *
 * The followings are the available columns in table 'TBL_REPRESENTANTESLEGAL':
 * @property integer $RELE_ID
 * @property integer $PERS_ID
 * @property integer $PEJU_ID
 *
 * The followings are the available model relations:
 * @property TblPersonas $pERS
 * @property TblPersonasjuridicas $pEJU
 */
class Representante extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Representante the static model class
	 */
	public $A_ID,$B_ID,$C_ID,$D_ID,$E_ID,$F_ID;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_REPRESENTANTESLEGAL';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PERS_ID, PEJU_ID', 'required'),
			array('PERS_ID, PEJU_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('RELE_ID, PERS_ID, PEJU_ID', 'safe', 'on'=>'search'),
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
			'pERS' => array(self::BELONGS_TO, 'TblPersonas', 'PERS_ID'),
			'pEJU' => array(self::BELONGS_TO, 'TblPersonasjuridicas', 'PEJU_ID'),
			'rel_personas_naturales' => array(self::BELONGS_TO, 'Personasnaturales', 'PERS_ID'),
			'rel_personas' => array(self::BELONGS_TO, 'Personas', 'PERS_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'RELE_ID' => 'Rele',
			'PERS_ID' => 'Pers',
			'PEJU_ID' => 'Peju',
			'PERS_ID' => 'Pers',
			
			'A_ID' => 'NOMBRE DEL REPRESENTANTE',
			'B_ID' => 'TIPO DE IDENTIFICACIÓN',
			'C_ID' => 'No. DE DOCUMENTO',
			'D_ID' => 'MUNICIPIO',
			'E_ID' => 'DEPARTAMENTO',
			'F_ID' => 'PAIS',
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

		$criteria->compare('RELE_ID',$this->RELE_ID);
		$criteria->compare('PERS_ID',$this->PERS_ID);
		$criteria->compare('PEJU_ID',$this->PEJU_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}