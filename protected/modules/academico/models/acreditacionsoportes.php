<?php

/**
 * This is the model class for table "tbl_acreditacionsoportes".
 *
 * The followings are the available columns in table 'tbl_acreditacionsoportes':
 * @property integer $ACSO_ID
 * @property integer $ACSO_NUMERO
 * @property string $ACSO_DESCRIPCION
 * @property string $ACSO_URL
 * @property string $ACSO_RESPUESTA
 * @property string $ACSO_FUENTE
 * @property string $ACSO_ESTADOPM
 * @property integer $ACIN_ID
 */
class acreditacionsoportes extends CActiveRecord
{
	public function getEstadoRuta($ruta)
	{
		if($ruta==null)	return "Pendiente";		
					return "Cargado";				
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return acreditacionsoportes the static model class
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
		return 'TBL_ACREDITACIONSOPORTES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ACSO_NUMERO, ACIN_ID', 'numerical', 'integerOnly'=>true),
			array('ACSO_DESCRIPCION, ACSO_URL', 'length', 'max'=>500),
			array('ACSO_RESPUESTA', 'length', 'max'=>2000),
			array('ACSO_FUENTE, ACSO_ESTADOPM', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ACSO_ID, ACSO_NUMERO, ACSO_DESCRIPCION, ACSO_URL, ACSO_RESPUESTA, ACSO_FUENTE, ACSO_ESTADOPM, ACIN_ID', 'safe', 'on'=>'search'),
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
		'REL_INDI_SOPO' => array( self::BELONGS_TO, acreditacionindicadores, 'ACIN_ID'),
    		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ACSO_ID' => 'ID',
			'ACSO_NUMERO' => '#',
			'ACSO_DESCRIPCION' => 'DESCRIPCION',
			'ACSO_URL' => 'URL',
			'ACSO_RESPUESTA' => 'RESPUESTA',
			'ACSO_FUENTE' => 'FUENTE',
			'ACSO_ESTADOPM' => 'ESTADO PM',
			'ACIN_ID' => 'ID INDICADOR',
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

		$criteria->compare('ACSO_ID',$this->ACSO_ID);
		$criteria->compare('ACSO_NUMERO',$this->ACSO_NUMERO);
		$criteria->compare('ACSO_DESCRIPCION',$this->ACSO_DESCRIPCION,true);
		$criteria->compare('ACSO_URL',$this->ACSO_URL,true);
		$criteria->compare('ACSO_RESPUESTA',$this->ACSO_RESPUESTA,true);
		$criteria->compare('ACSO_FUENTE',$this->ACSO_FUENTE,true);
		$criteria->compare('ACSO_ESTADOPM',$this->ACSO_ESTADOPM,true);
		$criteria->compare('ACIN_ID',$this->ACIN_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}