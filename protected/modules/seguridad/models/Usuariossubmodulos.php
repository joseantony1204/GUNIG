<?php

/**
 * This is the model class for table "TBL_USUARIOSSUBMODULOS".
 *
 * The followings are the available columns in table 'TBL_USUARIOSSUBMODULOS':
 * @property integer $USSM_ID
 * @property string $USSM_NOMBRE
 * @property string $USSM_URL
 * @property integer $USMO_ID
 *
 * The followings are the available model relations:
 * @property TblUsuariosmodulos $uSMO
 */
class Usuariossubmodulos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usuariossubmodulos the static model class
	 */
	public $CONTROLADOR;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_USUARIOSSUBMODULOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('USSM_NOMBRE, USSM_URL, USMO_ID', 'required'),
			array('USMO_ID', 'numerical', 'integerOnly'=>true),
			array('USSM_NOMBRE', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('USSM_ID, USSM_NOMBRE, USSM_URL, USMO_ID', 'safe', 'on'=>'search'),
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
			'rel_usuarios_modulos' => array(self::BELONGS_TO, 'Usuariosmodulos', 'USMO_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'USSM_ID' => 'ID',
			'USSM_NOMBRE' => 'SUB MODULO',
			'USSM_URL' => 'URL SUB MODULO',
			'USMO_ID' => 'MODULO',
			'CONTROLADOR' => 'CONTROLADORES', 
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
		$criteria->select='t.*,
		(SELECT COUNT(uc.USSM_ID) FROM TBL_USUARIOSCONTROLADORES uc WHERE t.USSM_ID = uc.USSM_ID) AS CONTROLADOR';

		$criteria->compare('USSM_ID',$this->USSM_ID);
		$criteria->compare('USSM_NOMBRE',$this->USSM_NOMBRE,true);
		$criteria->compare('USSM_URL',$this->USSM_URL,true);
		$criteria->compare('USMO_ID',$this->USMO_ID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getUsuariosModulos()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.USMO_ID, t.USMO_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_USUARIOSSUBMODULOS  usm ON usm.USMO_ID = t.USMO_ID';	
	 $criteria->order = 't.USMO_NOMBRE ASC';
	 return  CHtml::listData(Usuariosmodulos::model()->findAll($criteria),'USMO_ID','USMO_NOMBRE'); 
	}	
}