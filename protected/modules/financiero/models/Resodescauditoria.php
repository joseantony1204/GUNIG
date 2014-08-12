<?php

/**
 * This is the model class for table "TBL_RESODESCAUDITORIA".
 *
 * The followings are the available columns in table 'TBL_RESODESCAUDITORIA':
 * @property integer $RDAU_ID
 * @property double $RDAU_TARIFA
 * @property string $RDAU_ACCION
 * @property string $RDAU_FECHAPROCESO
 * @property integer $RESO_ID
 * @property integer $DESC_ID
 * @property integer $USUA_ID
 *
 * The followings are the available model relations:
 * @property TBLRESOLUCIONES $rESO
 * @property TBLDESCUENTOS $dESC
 * @property TBLUSUARIOS $uSUA
 */
class Resodescauditoria extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Resodescauditoria the static model class
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
		return 'TBL_RESODESCAUDITORIA';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('RDAU_TARIFA, RDAU_ACCION, RDAU_FECHAPROCESO, RESO_ID, DESC_ID, USUA_ID', 'required'),
			array('RESO_ID, DESC_ID, USUA_ID', 'numerical', 'integerOnly'=>true),
			array('RDAU_TARIFA', 'numerical'),
			array('RDAU_ACCION', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('RDAU_ID, RDAU_TARIFA, RDAU_ACCION, RDAU_FECHAPROCESO, RESO_ID, DESC_ID, USUA_ID', 'safe', 'on'=>'search'),
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
			'rESO' => array(self::BELONGS_TO, 'TBLRESOLUCIONES', 'RESO_ID'),
			'dESC' => array(self::BELONGS_TO, 'TBLDESCUENTOS', 'DESC_ID'),
			'uSUA' => array(self::BELONGS_TO, 'TBLUSUARIOS', 'USUA_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'RDAU_ID' => 'Rdau',
			'RDAU_TARIFA' => 'Rdau Tarifa',
			'RDAU_ACCION' => 'Rdau Accion',
			'RDAU_FECHAPROCESO' => 'Rdau Fechaproceso',
			'RESO_ID' => 'Reso',
			'DESC_ID' => 'Desc',
			'USUA_ID' => 'Usua',
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

		$criteria->compare('RDAU_ID',$this->RDAU_ID);
		$criteria->compare('RDAU_TARIFA',$this->RDAU_TARIFA);
		$criteria->compare('RDAU_ACCION',$this->RDAU_ACCION,true);
		$criteria->compare('RDAU_FECHAPROCESO',$this->RDAU_FECHAPROCESO,true);
		$criteria->compare('RESO_ID',$this->RESO_ID);
		$criteria->compare('DESC_ID',$this->DESC_ID);
		$criteria->compare('USUA_ID',$this->USUA_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function Descuentos ($id){
	 $sql = "SELECT DESC_ID, REDE_TARIFA FROM TBL_RESOLUCIONESDESCUENTOS WHERE RELI_ID = '$id'";
	 $connection = Yii::app()->db;
	 $query = $connection->createCommand($sql)->queryAll();	 
	 return $query ;
	}
	
}