<?php

/**
 * This is the model class for table "TBL_SEDES".
 *
 * The followings are the available columns in table 'TBL_SEDES':
 * @property integer $SEDE_ID
 * @property string $SEDE_NOMBRE
 * @property integer $UNIV_ID
 *
 * The followings are the available model relations:
 * @property TblUniversidades $uNIV
 */
class Sedes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Sedes the static model class
	 */
	public $CONTRATOST, $CONTRATOSO;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_SEDES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SEDE_NOMBRE, UNIV_ID', 'required'),
			array('UNIV_ID', 'numerical', 'integerOnly'=>true),
			array('SEDE_NOMBRE', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SEDE_ID, SEDE_NOMBRE, UNIV_ID', 'safe', 'on'=>'search'),
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
			'rel_universidades' => array(self::BELONGS_TO, 'Universidades', 'UNIV_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'SEDE_ID' => 'ID',
			'SEDE_NOMBRE' => 'NOMBRE SEDE',
			'UNIV_ID' => 'UNIVERSIDAD',
			'CONTRATOST' => 'CONTRATOS ACTUALES',
			'CONTRATOSO' => 'CONTRATOS ACTUALES',
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
			'defaultOrder'=>'SEDE_NOMBRE ASC',
			'SEDE_ID'=>array(
				'asc'=>'SEDE_ID',
				'desc'=>'SEDE_ID desc',
			),
			'SEDE_NOMBRE'=>array(
				'asc'=>'SEDE_NOMBRE',
				'desc'=>'SEDE_NOMBRE desc',
			),
			'UNIV_ID'=>array(
				'asc'=>'UNIV_ID',
				'desc'=>'UNIV_ID desc',
			),
			'CONTRATOST'=>array(
				'asc'=>'(SELECT COUNT(tt.SEDE_ID) FROM TBL_TUTORIASCONTRATOS tc, TBL_PERIODOSACADEMICOS  pa, TBL_TUTORIAS tt
				WHERE tc.TUCO_ID = tt.TUCO_ID AND pa.PEAC_ID = tc.PEAC_ID AND pa.PEAC_ESTADO = 0 AND tt.SEDE_ID = t.SEDE_ID)',
				'desc'=>'(SELECT COUNT(tt.SEDE_ID) FROM TBL_TUTORIASCONTRATOS tc, TBL_PERIODOSACADEMICOS  pa, TBL_TUTORIAS tt 
				WHERE tc.TUCO_ID = tt.TUCO_ID AND pa.PEAC_ID = tc.PEAC_ID AND pa.PEAC_ESTADO = 0 AND tt.SEDE_ID = t.SEDE_ID) desc',
			),
			'CONTRATOSO'=>array(
				'asc'=>'(SELECT COUNT(d.DEPE_ID) FROM TBL_DEPENDENCIAS d, TBL_OPSCONTRATOS oc, TBL_ANIOSACADEMICOS  aa
				WHERE t.SEDE_ID = d.SEDE_ID AND aa.ANAC_ID = oc.ANAC_ID AND aa.ANAC_ESTADO = 0 AND d.DEPE_ID = oc.DEPE_ID)',
				'desc'=>'(SELECT COUNT(d.DEPE_ID) FROM TBL_DEPENDENCIAS d, TBL_OPSCONTRATOS oc, TBL_ANIOSACADEMICOS  aa
				WHERE t.SEDE_ID = d.SEDE_ID AND aa.ANAC_ID = oc.ANAC_ID AND aa.ANAC_ESTADO = 0 AND d.DEPE_ID = oc.DEPE_ID) desc',
			),
			);

		$criteria=new CDbCriteria;
        $criteria->select = "t.SEDE_ID, t.SEDE_NOMBRE, t.UNIV_ID, 
		(SELECT COUNT(tt.SEDE_ID) FROM TBL_TUTORIASCONTRATOS tc, TBL_PERIODOSACADEMICOS  pa, TBL_TUTORIAS tt 
		WHERE tc.TUCO_ID = tt.TUCO_ID AND pa.PEAC_ID = tc.PEAC_ID AND pa.PEAC_ESTADO = 0 AND tt.SEDE_ID = t.SEDE_ID) AS CONTRATOST,
		
		(SELECT COUNT(d.DEPE_ID) FROM TBL_DEPENDENCIAS d, TBL_OPSCONTRATOS oc, TBL_ANIOSACADEMICOS  aa 
		WHERE t.SEDE_ID = d.SEDE_ID AND aa.ANAC_ID = oc.ANAC_ID AND aa.ANAC_ESTADO = 0 AND d.DEPE_ID = oc.DEPE_ID) AS CONTRATOSO";
		
		$criteria->compare('SEDE_ID',$this->SEDE_ID);
		$criteria->compare('SEDE_NOMBRE',$this->SEDE_NOMBRE,true);
		$criteria->compare('UNIV_ID',$this->UNIV_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 10,),
		));
	}
	public function getUniversidades()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.UNIV_ID, t.UNIV_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_SEDES  c ON t.UNIV_ID = c.UNIV_ID';	
	 $criteria->order = 't.UNIV_NOMBRE ASC';
	 return  CHtml::listData(Universidades::model()->findAll($criteria),'UNIV_ID','UNIV_NOMBRE'); 
	}	
}