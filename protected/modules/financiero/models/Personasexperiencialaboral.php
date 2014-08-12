<?php

/**
 * This is the model class for table "TBL_PERSONASEXPERIENCIALABORAL".
 *
 * The followings are the available columns in table 'TBL_PERSONASEXPERIENCIALABORAL':
 * @property integer $PEEL_ID
 * @property string $PEEL_EMPRESA
 * @property string $PEEL_TELEFONOEMPRESA
 * @property string $PEEL_CARGO
 * @property string $PEEL_FECHAINICIO
 * @property string $PEEL_FECHAFINAL
 * @property integer $PEEL_ACTUALMENTE
 * @property integer $PERS_ID
 *
 * The followings are the available model relations:
 * @property TblPersonas $pERS
 */
class Personasexperiencialaboral extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Personasexperiencialaboral the static model class
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
		return 'TBL_PERSONASEXPERIENCIALABORAL';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PEEL_EMPRESA, PEEL_TELEFONOEMPRESA, PEEL_CARGO, PEEL_FECHAINICIO, PEEL_FECHAFINAL', 'required'),
			array('PERS_ID', 'numerical', 'integerOnly'=>true),
                     array('PEEL_ACTUALMENTE', 'length', 'max'=>2),
			array('PEEL_EMPRESA, PEEL_CARGO', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PEEL_ID, PEEL_EMPRESA, PEEL_TELEFONOEMPRESA, PEEL_CARGO, PEEL_FECHAINICIO, PEEL_FECHAFINAL, PEEL_ACTUALMENTE, PERS_ID', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PEEL_ID' => 'ID',
			'PEEL_EMPRESA' => 'EMPRESA',
			'PEEL_TELEFONOEMPRESA' => 'No. DE TELEFONO',
			'PEEL_CARGO' => 'CARGO',
			'PEEL_FECHAINICIO' => 'FECHA INICIO',
			'PEEL_FECHAFINAL' => 'FECHA FINAL',
			'PEEL_ACTUALMENTE' => '¿ LABORA ACTUALMENTE ?',
			'PERS_ID' => 'PERSONA',
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

		$criteria->compare('PEEL_ID',$this->PEEL_ID);
		$criteria->compare('PEEL_EMPRESA',$this->PEEL_EMPRESA,true);
		$criteria->compare('PEEL_TELEFONOEMPRESA',$this->PEEL_TELEFONOEMPRESA,true);
		$criteria->compare('PEEL_CARGO',$this->PEEL_CARGO,true);
		$criteria->compare('PEEL_FECHAINICIO',$this->PEEL_FECHAINICIO,true);
		$criteria->compare('PEEL_FECHAFINAL',$this->PEEL_FECHAFINAL,true);
		$criteria->compare('PEEL_ACTUALMENTE',$this->PEEL_ACTUALMENTE);
		$criteria->compare('PERS_ID',$this->PERS_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}