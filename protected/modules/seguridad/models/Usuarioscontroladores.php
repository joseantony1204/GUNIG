<?php

/**
 * This is the model class for table "TBL_USUARIOSCONTROLADORES".
 *
 * The followings are the available columns in table 'TBL_USUARIOSCONTROLADORES':
 * @property integer $USCO_ID
 * @property string $USCO_NOMBRE
 * @property string $USCO_URL
 * @property integer $USSM_ID
 *
 * The followings are the available model relations:
 * @property TblUsuariossubmodulos $uSSM
 */
class Usuarioscontroladores extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usuarioscontroladores the static model class
	 */
	public $VISTAS;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_USUARIOSCONTROLADORES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('USCO_NOMBRE, USCO_URL, USSM_ID', 'required'),
			array('USSM_ID', 'numerical', 'integerOnly'=>true),
			array('USCO_NOMBRE', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('USCO_ID, USCO_NOMBRE, USCO_URL, USSM_ID', 'safe', 'on'=>'search'),
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
			'rel_usuarios_submodulos' => array(self::BELONGS_TO, 'Usuariossubmodulos', 'USSM_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'USCO_ID' => 'ID',
			'USCO_NOMBRE' => 'NOMBRE CONTROLADOR',
			'USCO_URL' => 'URL CONTROLADOR',
			'USSM_ID' => 'SUB MODULO',
			'VISTAS' => 'VISTAS',
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
		(SELECT COUNT(uv.USCO_ID) FROM TBL_USUARIOSVISTAS uv WHERE t.USCO_ID = uv.USCO_ID) AS VISTAS';

		$criteria->compare('USCO_ID',$this->USCO_ID);
		$criteria->compare('USCO_NOMBRE',$this->USCO_NOMBRE,true);
		$criteria->compare('USCO_URL',$this->USCO_URL,true);
		$criteria->compare('USSM_ID',$this->USSM_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getUsuariosSubModulos()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.USSM_ID, t.USSM_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_USUARIOSCONTROLADORES uc ON uc.USSM_ID = t.USSM_ID';	
	 $criteria->order = 't.USSM_NOMBRE ASC';
	 return  CHtml::listData(Usuariossubmodulos::model()->findAll($criteria),'USSM_ID','USSM_NOMBRE'); 
	}	
}