<?php

/**
 * This is the model class for table "tbl_acreditacionfactores".
 *
 * The followings are the available columns in table 'tbl_acreditacionfactores':
 * @property integer $ACFA_ID
 * @property string $ACFA_NUMERO
 * @property string $ACFA_DESCRIPCION
 * @property integer $ACBI_ID
 */
class acreditacionfactores extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return acreditacionfactores the static model class
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
		return 'TBL_ACREDITACIONFACTORES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ACFA_NUMERO, ACFA_DESCRIPCION, ACBI_ID', 'required'),
			array('ACBI_ID', 'numerical', 'integerOnly'=>true),
			array('ACFA_NUMERO', 'length', 'max'=>10),
			array('ACFA_DESCRIPCION', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ACFA_ID, ACFA_NUMERO, ACFA_DESCRIPCION, ACBI_ID', 'safe', 'on'=>'search'),
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
			'REL_BITA_FACT' => array( self::BELONGS_TO, acreditacionbitacoras, 'ACBI_ID'),
    		//'RELACION_CARACTERISTICAS' => array(self::BELONGS_TO, 'acreditacioncaracteristicas', 'ACFA_ID'),
			//'RELACION_FACTORES' => array(self::BELONGS_TO, 'acreditacioncaracteristicas', 'ACFA_ID'),
			//'aSIGNATURASes' => array(self::HAS_MANY, 'ASIGNATURAS', 'PROG_ID'),
			//'dIRECTORESPROGRAMASes' => array(self::HAS_MANY, 'DIRECTORESPROGRAMAS', 'PROG_ID'),//parece relacion muchos a muchos
			//'rel_niveles' => array(self::HAS_MANY, 'NIVELESESTUDIOS', 'NIES_ID'),
			//'rel_facultades' => array(self::BELONGS_TO, 'FACULTADES', 'FACU_ID'),

		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ACFA_ID' => 'ID',
			'ACFA_NUMERO' => 'NUMERO',
			'ACFA_DESCRIPCION' => 'DESCRIPCION',
			'ACBI_ID' => 'ID BITACORA',
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

		$criteria->compare('ACFA_ID',$this->ACFA_ID);
		$criteria->compare('ACFA_NUMERO',$this->ACFA_NUMERO,true);
		$criteria->compare('ACFA_DESCRIPCION',$this->ACFA_DESCRIPCION,true);
		$criteria->compare('ACBI_ID',$this->ACBI_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}