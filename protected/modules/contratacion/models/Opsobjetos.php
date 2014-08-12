<?php

/**
 * This is the model class for table "TBL_OPSOBJETOS".
 *
 * The followings are the available columns in table 'TBL_OPSOBJETOS':
 * @property integer $OBJE_ID
 * @property string $OPOB_FECHA_INGRESO
 *
 * The followings are the available model relations:
 * @property TblObjetos $oBJE
 */
class Opsobjetos extends Objetos
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Opsobjetos the static model class
	 */
	public $OBJE_NOMBRE;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_OPSOBJETOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OPOB_FECHA_INGRESO', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('OBJE_ID, OPOB_FECHA_INGRESO, OBJE_NOMBRE', 'safe', 'on'=>'search'),
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
			'rel_objetos' => array(self::BELONGS_TO, 'Objetos', 'OBJE_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'OBJE_ID' => 'ID',
			'OBJE_NOMBRE' => 'NOMBRE DEL OBJETO',
			'OPOB_FECHA_INGRESO' => 'Opob Fecha Ingreso',
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
			'defaultOrder'=>'t.OBJE_ID ASC',
			'OBJE_ID'=>array(
				'asc'=>'t.OBJE_ID',
				'desc'=>'t.OBJE_ID desc',
			),
			'OBJE_NOMBRE'=>array(
				'asc'=>'o.OBJE_NOMBRE',
				'desc'=>'o.OBJE_NOMBRE desc',
			),
		);
		$criteria=new CDbCriteria;	
        $criteria->select = "t.OPOB_ID, o.OBJE_ID, o.OBJE_NOMBRE";
		$criteria->join = "INNER JOIN TBL_OBJETOS o ON o.OBJE_ID = t.OBJE_ID";
		
		$criteria->compare('o.OBJE_ID',$this->OBJE_ID);
		$criteria->compare('OBJE_NOMBRE',$this->OBJE_NOMBRE,true);
		$criteria->compare('OPOB_FECHA_INGRESO',$this->OPOB_FECHA_INGRESO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
		));
	}
}