<?php

/**
 * This is the model class for table "TBL_DESCUENTOS".
 *
 * The followings are the available columns in table 'TBL_DESCUENTOS':
 * @property integer $DESC_ID
 * @property string $DESC_NOMBRE
 * @property integer $TIDE_ID
 * @property integer $APDE_ID
 * @property integer $ESDE_ID
 *
 * The followings are the available model relations:
 * @property TBLCLASESCONTRATOSDESCUENTOS[] $tBLCLASESCONTRATOSDESCUENTOSes
 * @property TBLESTADODESCUENTOS $eSDE
 * @property TBLTIPOSDESCUENTOS $tIDE
 * @property TBLAPLICADESCUENTOS $aPDE
 * @property TBLDESCUENTOSATRIBUTOS[] $tBLDESCUENTOSATRIBUTOSes
 * @property TBLLIQUIDACIONESDESCUENTOS[] $tBLLIQUIDACIONESDESCUENTOSes
 */
class Descuentos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Descuentos the static model class
	 */
	  public $AGREGAR, $TIDE_NOMBRE, $APDE_NOMBRE, $ESDE_NOMBRE; 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_DESCUENTOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TIDE_ID, APDE_ID, ESDE_ID, DESC_NOMBRE', 'required'),
			array('TIDE_ID, APDE_ID, ESDE_ID', 'numerical', 'integerOnly'=>true),
			array('DESC_NOMBRE', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('DESC_ID, DESC_NOMBRE, TIDE_ID, APDE_ID, ESDE_ID, TIDE_NOMBRE, APDE_NOMBRE, ESDE_NOMBRE, AGREGAR', 'safe', 'on'=>'search'),
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
			'tBLCLASESCONTRATOSDESCUENTOSes' => array(self::HAS_MANY, 'Clasescontratosdescuentos', 'DESC_ID'),
			'eSDE' => array(self::BELONGS_TO, 'Estadodescuentos', 'ESDE_ID'),
			'tIDE' => array(self::BELONGS_TO, 'Tiposdescuentos', 'TIDE_ID'),
			'aPDE' => array(self::BELONGS_TO, 'Aplicadescuentos', 'APDE_ID'),
			'tBLDESCUENTOSATRIBUTOSes' => array(self::HAS_MANY, 'Descuentosatributos', 'DESC_ID'),
			'tBLLIQUIDACIONESDESCUENTOSes' => array(self::HAS_MANY, 'Liquidacionesdescuentos', 'DESC_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'DESC_ID' => 'Id',
			'DESC_NOMBRE' => 'Nombre del Descuento',
			'TIDE_ID' => 'Tipo de Descuento',
			'APDE_ID' => 'Aplica segun',
			'ESDE_ID' => 'Estado',
			'AGREGAR' => 'AGREGAR',
			'TIDE_NOMBRE' => 'TIPO DE DESCUENTO',
			'APDE_NOMBRE' => 'APLICA SEGUN',
			'ESDE_NOMBRE' => 'ESTADO',
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
		
		$criteria->select='t.DESC_ID, t.DESC_NOMBRE, t.TIDE_ID, t.APDE_ID, ESDE_ID,
		(SELECT b.TIDE_NOMBRE FROM TBL_TIPOSDESCUENTOS b WHERE t.TIDE_ID = b.TIDE_ID) AS TIDE_NOMBRE,
		(SELECT c.APDE_NOMBRE FROM TBL_APLICADESCUENTOS c WHERE t.APDE_ID = c.APDE_ID) AS APDE_NOMBRE,
		(SELECT d.ESDE_NOMBRE FROM TBL_ESTADODESCUENTOS  d WHERE t.ESDE_ID = d.ESDE_ID) AS ESDE_NOMBRE,
		(SELECT COUNT(a.DEAT_ID) FROM TBL_DESCUENTOSATRIBUTOS a WHERE a.DESC_ID = t.DESC_ID) AS AGREGAR';

		$criteria->compare('DESC_ID',$this->DESC_ID);
		$criteria->compare('DESC_NOMBRE',$this->DESC_NOMBRE,true);
		$criteria->compare('TIDE_ID',$this->TIDE_ID);
		$criteria->compare('APDE_ID',$this->APDE_ID);
		$criteria->compare('ESDE_ID',$this->ESDE_ID);
		$criteria->compare('TIDE_NOMBRE',$this->TIDE_NOMBRE);
		$criteria->compare('APDE_NOMBRE',$this->APDE_NOMBRE);
		$criteria->compare('ESDE_NOMBRE',$this->TIDE_NOMBRE);
		$criteria->compare('AGREGAR',$this->AGREGAR);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}