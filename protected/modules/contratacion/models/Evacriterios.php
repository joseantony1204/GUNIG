<?php

/**
 * This is the model class for table "TBL_EVACRITERIOS".
 *
 * The followings are the available columns in table 'TBL_EVACRITERIOS':
 * @property integer $EVCR_ID
 * @property string $EVCR_NOMBRE
 * @property integer $EVCR_PUNTO
 * @property integer $ETCR_ID
 * @property integer $EVTC_ID
 *
 * The followings are the available model relations:
 * @property TblEvatipocontrato $eVTC
 * @property TblEvatiposcriterios $eTCR
 */
class Evacriterios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Evacriterios the static model class
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
		return 'TBL_EVACRITERIOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('EVCR_NOMBRE, EVCR_PUNTO, ETCR_ID, EVTC_ID', 'required'),
			array('EVCR_PUNTO, ETCR_ID, EVTC_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('EVCR_ID, EVCR_NOMBRE, EVCR_PUNTO, ETCR_ID, EVTC_ID', 'safe', 'on'=>'search'),
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
			'eVTC' => array(self::BELONGS_TO, 'TblEvatipocontrato', 'EVTC_ID'),
			'eTCR' => array(self::BELONGS_TO, 'TblEvatiposcriterios', 'ETCR_ID'),
			'rel_tiposcriterios' => array(self::BELONGS_TO, 'Evatiposcriterios', 'ETCR_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'EVCR_ID' => 'Evcr',
			'EVCR_NOMBRE' => 'Evcr Nombre',
			'EVCR_PUNTO' => 'VALOR',
			'ETCR_ID' => 'Etcr',
			'EVTC_ID' => 'Evtc',
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

		$criteria->compare('EVCR_ID',$this->EVCR_ID);
		$criteria->compare('EVCR_NOMBRE',$this->EVCR_NOMBRE,true);
		$criteria->compare('EVCR_PUNTO',$this->EVCR_PUNTO);
		$criteria->compare('ETCR_ID',$this->ETCR_ID);
		$criteria->compare('EVTC_ID',$this->EVTC_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function AllEvacriteriosWWWW($id=NULL)
	{
	//CLCR: 1 CALIDAD, 2 ENTREGA, 3 CANTIDAD, 4 POSVENTA
	//CLCO - ORDENES: 20 PRESTACION DE SERVICIO, 30 SUMINISTRO, 40 COMPRAVENTA, 50 TRABAJO
	//CLCO - CONTRATOS: 80 PRESTACION DE SERVICIOS, 90 SUMINISTRO, 140 OBRA
	 $string = "SELECT * FROM TBL_EVACRITERIOS eva ORDER BY (eva.EVCR_ID) ASC";
	 $criteria = Yii::app()->db->createCommand($string)->queryAll();
	 return $criteria;
	}
	
	
	public function AllEvacriterios($clase)
	{
	 if($clase!=""){
	  $condicion = " WHERE eva.EVTC_ID = ".$clase;
	 }
	 $string = "SELECT * FROM TBL_EVACRITERIOS eva  $condicion ORDER BY (eva.EVCR_ID) ASC";
	 $criteria = Yii::app()->db->createCommand($string)->queryAll();
	 return $criteria;
	}
	
	
	
	public	function cdp($id=NULL){
	 $connection = Yii::app()->db;
	 if($id!=""){
	  $condicion = " AND mo.MOOR_ID = ".$id;
	 }
	 $sql = "SELECT p.PRES_ID
	 FROM TBL_PRESUPUESTOS p, TBL_PRESUPUESTOSORDENES po, TBL_MODELOORDENES mo
 	 WHERE po.MOOR_ID = mo.MOOR_ID AND p.PRES_ID = po.PRES_ID 
	 $condicion ORDER BY (mo.MOOR_ID) ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data; 
	}
	
	
	
}