<?php

/**
 * This is the model class for table "TBL_PERSONASJURIDICAS".
 *
 * The followings are the available columns in table 'TBL_PERSONASJURIDICAS':
 * @property integer $PEJU_ID
 * @property string $PEJU_NOMBRE
 * @property string $PEJU_OBJETOCOMERCIAL
 * @property integer $PERS_ID
 *
 * The followings are the available model relations:
 * @property TblPersonas $pERS
 */
class Personasjuridicas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Personasjuridicas the static model class
	 */
	public $PERS_IDENTIFICACION, $TIID_ID, $TIRE_ID;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_PERSONASJURIDICAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PEJU_NOMBRE, PEJU_OBJETOCOMERCIAL, PERS_ID', 'required'),
			array('PERS_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TIID_ID,	TIRE_ID, PERS_IDENTIFICACION, PEJU_ID, PEJU_NOMBRE, PEJU_OBJETOCOMERCIAL, PERS_ID', 'safe', 'on'=>'search'),
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
			'rel_personas' => array(self::BELONGS_TO, 'Personas', 'PERS_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PEJU_ID' => 'ID',
			'PEJU_NOMBRE' => 'NOMBRE EMPRESA',
			'PEJU_OBJETOCOMERCIAL' => 'OBJETO COMERCIAL',
			'PERS_ID' => 'ID PERSONA',
			'PERS_IDENTIFICACION' => 'NUM. IDENTIFICACION',
			'TIID_ID' => 'TIPO DOCUMENTO',
			'TIRE_ID' => 'TIPO REGIMEN',
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
			'defaultOrder'=>'t.PEJU_NOMBRE ASC',
			'TIID_ID'=>array(
				'asc'=>'p.TIID_ID',
				'desc'=>'p.TIID_ID desc',
			),
			'PERS_IDENTIFICACION'=>array(
				'asc'=>'p.PERS_IDENTIFICACION',
				'desc'=>'p.PERS_IDENTIFICACION desc',
			),
			'PEJU_OBJETOCOMERCIAL'=>array(
				'asc'=>'t.PEJU_OBJETOCOMERCIAL',
				'desc'=>'t.PEJU_OBJETOCOMERCIAL desc',
			),
			'PEJU_NOMBRE'=>array(
				'asc'=>'t.PEJU_NOMBRE',
				'desc'=>'t.PEJU_NOMBRE desc',
			),
			'TIRE_ID'=>array(
				'asc'=>'p.TIRE_ID',
				'desc'=>'p.TIRE_ID desc',
			),
		
		);

		$criteria=new CDbCriteria;
		$criteria->select='t.PERS_ID, p.TIID_ID, p.PERS_IDENTIFICACION, t.PEJU_ID, t.PEJU_NOMBRE, t.PEJU_OBJETOCOMERCIAL,  
		p.MUNI_ID, p.TIRE_ID ';
	    $criteria->join = '
	    INNER JOIN TBL_PERSONAS p ON t.PERS_ID = p.PERS_ID';

		$criteria->compare('PEJU_ID',$this->PEJU_ID);
		$criteria->compare('PEJU_NOMBRE',$this->PEJU_NOMBRE,true);
		$criteria->compare('PEJU_OBJETOCOMERCIAL',$this->PEJU_OBJETOCOMERCIAL,true);
		$criteria->compare('PERS_ID',$this->PERS_ID);
		$criteria->compare('p.TIID_ID',$this->TIID_ID);
		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION,true);
		$criteria->compare('p.TIRE_ID',$this->TIRE_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
		));
	}

	public function getTiposregimen()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.TIRE_ID, t.TIRE_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_PERSONAS p ON t.TIRE_ID = p.TIRE_ID 
	 INNER JOIN TBL_PERSONASJURIDICAS pj ON pj.PERS_ID = p.PERS_ID '; //AND t.ANAC_ESTADO = 0	
	 $criteria->order = 't.TIRE_NOMBRE ASC';
	 return  CHtml::listData(Tiposregimen::model()->findAll($criteria),'TIRE_ID','TIRE_NOMBRE'); 
	}	
}