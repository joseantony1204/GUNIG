<?php

/**
 * This is the model class for table "TBL_USUARIOSVISTAS".
 *
 * The followings are the available columns in table 'TBL_USUARIOSVISTAS':
 * @property integer $USVI_ID
 * @property string $USVI_NOMBRE
 * @property string $USVI_URL
 * @property integer $USCO_ID
 *
 * The followings are the available model relations:
 * @property TblUsuarioscontroladores $uSCO
 */
class Usuariosvistas extends CActiveRecord
{

		public $UBICACION;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usuariosvistas the static model class
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
		return 'TBL_USUARIOSVISTAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('USVI_NOMBRE, USVI_URL, USCO_ID', 'required'),
			array('USCO_ID', 'numerical', 'integerOnly'=>true),
			array('USVI_NOMBRE', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('USVI_ID, USVI_NOMBRE, USVI_URL, USCO_ID', 'safe', 'on'=>'search'),
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
			'rel_usuarios_controladores' => array(self::BELONGS_TO, 'Usuarioscontroladores', 'USCO_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'USVI_ID' => 'ID',
			'USVI_NOMBRE' => 'NOMBRE VISTA',
			'USVI_URL' => 'URL VISTA',
			'USCO_ID' => 'CONTROLADOR',
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

		$criteria->compare('USVI_ID',$this->USVI_ID);
		$criteria->compare('USVI_NOMBRE',$this->USVI_NOMBRE,true);
		$criteria->compare('USVI_URL',$this->USVI_URL,true);
		$criteria->compare('USCO_ID',$this->USCO_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getUsuariosControladores()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.USCO_ID, t.USCO_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_USUARIOSVISTAS uv ON uv.USCO_ID = t.USCO_ID';	
	 $criteria->order = 't.USCO_NOMBRE ASC';
	 return  CHtml::listData(Usuarioscontroladores::model()->findAll($criteria),'USCO_ID','USCO_NOMBRE'); 
	}	
}