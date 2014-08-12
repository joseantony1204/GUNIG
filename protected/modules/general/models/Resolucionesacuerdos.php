<?php

/**
 * This is the model class for table "TBL_RESOLUCIONESACUERDOS".
 *
 * The followings are the available columns in table 'TBL_RESOLUCIONESACUERDOS':
 * @property integer $REAC_ID
 * @property string $REAC_NUMERO
 * @property string $REAC_FECHA
 * @property string $REAC_DESCRIPCION
 */
class Resolucionesacuerdos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Resolucionesacuerdos the static model class
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
		return 'TBL_RESOLUCIONESACUERDOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('REAC_NUMERO, REAC_FECHA, REAC_DESCRIPCION', 'required'),
			array('REAC_NUMERO', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('REAC_ID, REAC_NUMERO, REAC_FECHA, REAC_DESCRIPCION', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'REAC_ID' => 'Reac',
			'REAC_NUMERO' => 'Reac Numero',
			'REAC_FECHA' => 'Reac Fecha',
			'REAC_DESCRIPCION' => 'Reac Descripcion',
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

		$criteria->compare('REAC_ID',$this->REAC_ID);
		$criteria->compare('REAC_NUMERO',$this->REAC_NUMERO,true);
		$criteria->compare('REAC_FECHA',$this->REAC_FECHA,true);
		$criteria->compare('REAC_DESCRIPCION',$this->REAC_DESCRIPCION,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getResolucionesacuerdos()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.REAC_ID, t.REAC_DESCRIPCION';
	 $criteria->join = '
	 INNER JOIN TBL_PERSONASCONTRATANTES pc ON pc.REAC_ID = t.REAC_ID '; //AND t.ANAC_ESTADO = 0	
	 $criteria->order = 't.REAC_NUMERO ASC';
	 return  CHtml::listData(Resolucionesacuerdos::model()->findAll($criteria),'REAC_ID','REAC_DESCRIPCION'); 
	}	
}