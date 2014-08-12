<?php

/**
 * This is the model class for table "TBL_DEPENDENCIAS".
 *
 * The followings are the available columns in table 'TBL_DEPENDENCIAS':
 * @property integer $DEPE_ID
 * @property string $DEPE_NOMBRE
 * @property integer $SEDE_ID
 *
 * The followings are the available model relations:
 * @property TblSedes $sEDE
 */
class Dependencias extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Dependencias the static model class
	 */
	public $CONTRATOS;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_DEPENDENCIAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DEPE_NOMBRE, SEDE_ID', 'required'),
			array('SEDE_ID', 'numerical', 'integerOnly'=>true),
			array('DEPE_NOMBRE', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('DEPE_ID, DEPE_NOMBRE, SEDE_ID, CONTRATOS', 'safe', 'on'=>'search'),
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
			'rel_sedes' => array(self::BELONGS_TO, 'Sedes', 'SEDE_ID'),
			'rel_jefes_dependencias' => array(self::HAS_ONE, 'Jefesdependencias', 'DEPE_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'DEPE_ID' => 'ID',
			'DEPE_NOMBRE' => 'NOMBRE DEPENDENCIA',
			'SEDE_ID' => 'SEDE',
			'CONTRATOS' => 'CONTRATOS ACTUALES',
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
		$sort = new CSort();
		$sort->attributes = array(
			'defaultOrder'=>'DEPE_NOMBRE ASC',
			'DEPE_NOMBRE'=>array(
				'asc'=>'DEPE_NOMBRE',
				'desc'=>'DEPE_NOMBRE desc',
			),
			'SEDE_ID'=>array(
				'asc'=>'s.SEDE_ID',
				'desc'=>'s.SEDE_ID desc',
			),
			'CONTRATOS'=>array(
				'asc'=>'(SELECT COUNT(DEPE_ID) FROM TBL_OPSCONTRATOS c WHERE t.DEPE_ID = c.DEPE_ID)',
				'desc'=>'(SELECT COUNT(DEPE_ID) FROM TBL_OPSCONTRATOS c WHERE t.DEPE_ID = c.DEPE_ID) desc',
			),
			);
		
		$criteria=new CDbCriteria;
		
		$criteria->select='t.DEPE_ID, t.DEPE_NOMBRE, s.SEDE_ID, 
		(SELECT COUNT(DEPE_ID) FROM TBL_OPSCONTRATOS c WHERE t.DEPE_ID = c.DEPE_ID) AS CONTRATOS';
	    $criteria->join = 'INNER JOIN TBL_SEDES  s ON t.SEDE_ID = s.SEDE_ID';	

		$criteria->compare('DEPE_ID',$this->DEPE_ID);
		$criteria->compare('DEPE_NOMBRE',$this->DEPE_NOMBRE,true);
		$criteria->compare('s.SEDE_ID',$this->SEDE_ID);
		$criteria->compare('CONTRATOS',$this->CONTRATOS); 

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 10,),
		));
	}
	
	public function getSedes()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.SEDE_ID, t.SEDE_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_DEPENDENCIAS  c ON t.SEDE_ID = c.SEDE_ID '; //AND t.ANAC_ESTADO = 0	
	 $criteria->order = 't.SEDE_NOMBRE ASC';
	 return  CHtml::listData(Sedes::model()->findAll($criteria),'SEDE_ID','SEDE_NOMBRE'); 
	}	
}