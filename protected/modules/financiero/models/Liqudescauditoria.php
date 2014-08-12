<?php

/**
 * This is the model class for table "TBL_LIQUDESCAUDITORIA".
 *
 * The followings are the available columns in table 'TBL_LIQUDESCAUDITORIA':
 * @property integer $LDAU_ID
 * @property double $LDAU_TARIFA
 * @property string $LDAU_ACCION
 * @property string $LDAU_FECHAPROCESO
 * @property string $LIQU_ID
 * @property integer $DESC_ID
 * @property integer $USUA_ID
 *
 * The followings are the available model relations:
 * @property TBLUSUARIOS $uSUA
 * @property TBLLIQUIDACIONES $lIQU
 * @property TBLDESCUENTOS $dESC
 */
class Liqudescauditoria extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Liqudescauditoria the static model class
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
		return 'TBL_LIQUDESCAUDITORIA';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('LDAU_ACCION, LIQU_ID, USUA_ID', 'required'),
			array('DESC_ID, USUA_ID', 'numerical', 'integerOnly'=>true),
			array('LDAU_TARIFA', 'numerical'),
			array('LDAU_ACCION', 'length', 'max'=>50),
			array('LIQU_ID', 'length', 'max'=>7),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('LDAU_ID, LDAU_TARIFA, LDAU_ACCION, LDAU_FECHAPROCESO, LIQU_ID, DESC_ID, USUA_ID', 'safe', 'on'=>'search'),
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
			'uSUA' => array(self::BELONGS_TO, 'Usuarios', 'USUA_ID'),
			'lIQU' => array(self::BELONGS_TO, 'Liquidaciones', 'LIQU_ID'),
			'dESC' => array(self::BELONGS_TO, 'Descuentos', 'DESC_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'LDAU_ID' => 'Id',
			'LDAU_TARIFA' => '(%) de Decuento',
			'LDAU_ACCION' => 'Accion',
			'LDAU_FECHAPROCESO' => 'Fecha',
			'LIQU_ID' => 'Id',
			'DESC_ID' => 'Descuentos',
			'USUA_ID' => 'Usuario',
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

		$criteria->compare('LDAU_ID',$this->LDAU_ID);
		$criteria->compare('LDAU_TARIFA',$this->LDAU_TARIFA);
		$criteria->compare('LDAU_ACCION',$this->LDAU_ACCION,true);
		$criteria->compare('LDAU_FECHAPROCESO',$this->LDAU_FECHAPROCESO,true);
		$criteria->compare('LIQU_ID',$this->LIQU_ID,true);
		$criteria->compare('DESC_ID',$this->DESC_ID);
		$criteria->compare('USUA_ID',$this->USUA_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function Descuentos ($id){
	 $sql = "SELECT DESC_ID, LIDE_TARIFA FROM TBL_LIQUIDACIONESDESCUENTOS WHERE LIQU_ID = '$id'";
	 $connection = Yii::app()->db;
	 $query = $connection->createCommand($sql)->queryAll();	 
	 return $query ;
	}
	
	public function loadLiquidacion($id){
	$sql = "SELECT MAX(LIQU_ID) FROM TBL_LIQUIDACIONES WHERE CUEN_ID = '$id'";
	 $connection = Yii::app()->db;
	 $query = $connection->createCommand($sql)->queryColumn();
	 $lastId = $query[0];
	 return $lastId;
	}
	
}