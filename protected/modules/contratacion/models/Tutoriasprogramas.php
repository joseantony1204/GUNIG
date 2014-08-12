<?php

/**
 * This is the model class for table "TBL_TUTORIASPROGRAMAS".
 *
 * The followings are the available columns in table 'TBL_TUTORIASPROGRAMAS':
 * @property integer $TUPR_ID
 * @property string $TUPR_NOMBRE
 * @property string $TUPR_SUPERVISOR
 */
class Tutoriasprogramas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tutoriasprogramas the static model class
	 */
	public $PERS_IDENTIFICACION, $PENA_NOMBRES, $PENA_APELLIDOS;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_TUTORIASPROGRAMAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TUPR_NOMBRE, PENA_ID', 'required'),
			array('TUPR_NOMBRE', 'length', 'max'=>200),
			array('TUPR_SUPERVISOR', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TUPR_ID, TUPR_NOMBRE, TUPR_SUPERVISOR, PENA_ID, PERS_IDENTIFICACION, PENA_NOMBRES, 
			PENA_APELLIDOS', 'safe', 'on'=>'search'),
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
		'rel_personas_naturales' => array(self::BELONGS_TO, 'Personasnaturales', 'PENA_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'TUPR_ID' => 'ID',
			'TUPR_NOMBRE' => 'NOMBRE PROGRAMA',
			'TUPR_SUPERVISOR' => 'DESCRIPCION SUPERVISOR',			
			'PENA_ID' => 'PERSONA',
			
			'PERS_IDENTIFICACION' => 'No. IDENTIDAD',
			'PENA_NOMBRES' => 'NOMBRES ',
			'PENA_APELLIDOS' => 'APELLIDOS',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$sort = new CSort();
		$sort->attributes = array(
			'defaultOrder'=>'t.PENC_ID ASC',
			'PERS_IDENTIFICACION'=>array(
				'asc'=>'p.PERS_IDENTIFICACION',
				'desc'=>'p.PERS_IDENTIFICACION desc',
			),
			
			'PENA_NOMBRES'=>array(
				'asc'=>'pn.PENA_NOMBRES',
				'desc'=>'pn.PENA_NOMBRES desc',
			),
			
			'PENA_APELLIDOS'=>array(
				'asc'=>'pn.PENA_APELLIDOS',
				'desc'=>'pn.PENA_APELLIDOS desc',
			),
			'TUPR_NOMBRE'=>array(
				'asc'=>'t.TUPR_NOMBRE',
				'desc'=>'t.TUPR_NOMBRE desc',
			),
			'TUPR_SUPERVISOR'=>array(
				'asc'=>'t.TUPR_SUPERVISOR',
				'desc'=>'t.TUPR_SUPERVISOR desc',
			),
		 );

		$criteria=new CDbCriteria;
		
		$criteria->select='t.*, p.PERS_IDENTIFICACION, pn.PENA_NOMBRES, pn.PENA_APELLIDOS';
		
		$criteria->join ='
		INNER JOIN TBL_PERSONASNATURALES  pn ON pn.PENA_ID = t.PENA_ID
		INNER JOIN TBL_PERSONAS  p ON p.PERS_ID = pn.PERS_ID';

		$criteria->compare('TUPR_ID',$this->TUPR_ID);
		$criteria->compare('TUPR_NOMBRE',$this->TUPR_NOMBRE,true);
		$criteria->compare('TUPR_SUPERVISOR',$this->TUPR_SUPERVISOR,true);
		
		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION, true);
		$criteria->compare('PENA_NOMBRES',$this->PENA_NOMBRES,true);
		$criteria->compare('PENA_APELLIDOS',$this->PENA_APELLIDOS,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 20,),
		));
	}
}