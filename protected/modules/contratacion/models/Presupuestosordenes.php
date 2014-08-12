<?php

/**
 * This is the model class for table "TBL_PRESUPUESTOSORDENES".
 *
 * The followings are the available columns in table 'TBL_PRESUPUESTOSORDENES':
 * @property integer $PROR_ID
 * @property integer $MOOR_ID
 * @property integer $PRES_ID
 *
 * The followings are the available model relations:
 * @property TblModeloordenes $mOOR
 * @property TblPresupuestos $pRES
 */
class Presupuestosordenes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Presupuestosordenes the static model class
	 */
	 
	public $PRES_NUM_CERTIFICADO,$PRES_SECCION,$PRES_CODIGO,$PRES_MONTO,$PRES_DESCRIPCION,$PRES_FECHA_VIGENCIA;  
	 

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_PRESUPUESTOSORDENES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MOOR_ID, PRES_ID', 'required'),
			array('MOOR_ID, PRES_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PROR_ID, MOOR_ID, PRES_ID', 'safe', 'on'=>'search'),
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
			'mOOR' => array(self::BELONGS_TO, 'TblModeloordenes', 'MOOR_ID'),
			'pRES' => array(self::BELONGS_TO, 'TblPresupuestos', 'PRES_ID'),
			'Presupuestoordenes' => array(self::BELONGS_TO, 'Presupuestos', 'PRES_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PROR_ID' => 'Pror',
			'MOOR_ID' => 'ID ORDEN',
			'PRES_ID' => 'ID PRESUPUESTO',
			'PRES_NUM_CERTIFICADO' => 'No. CDP',
			'PRES_SECCION' => 'SECCION',
			'PRES_CODIGO' => 'CODIGO',
			'PRES_MONTO' => 'MONTO',
			'PRES_DESCRIPCION' => 'DESCRIPCIÓN',
			'PRES_FECHA_VIGENCIA' => 'FECHA DE VIGENCIA',
			
			
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

		$criteria->compare('PROR_ID',$this->PROR_ID);
		$criteria->compare('MOOR_ID',$this->MOOR_ID);
		$criteria->compare('PRES_ID',$this->PRES_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}