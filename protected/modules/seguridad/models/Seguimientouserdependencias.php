<?php

/**
 * This is the model class for table "TBL_SEGUIMIENTOUSERDEPENDENCIAS".
 *
 * The followings are the available columns in table 'TBL_SEGUIMIENTOUSERDEPENDENCIAS':
 * @property integer $SEUD_ID
 * @property integer $USUA_ID
 * @property integer $DEPE_ID
 *
 * The followings are the available model relations:
 * @property TblDependencias $dEPE
 * @property TblUsuarios $uSUA
 */
class Seguimientouserdependencias extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Seguimientouserdependencias the static model class
	 */
	public $USUA_USUARIO, $USPE_ID, $PENA_ID, $USES_ID, $USUA_FECHAALTA, $USUA_FECHABAJA, $USUA_ULTIMOACCESO, $ROLES; 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_SEGUIMIENTOUSERDEPENDENCIAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('USUA_ID, DEPE_ID', 'required'),
			array('USUA_ID, DEPE_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SEUD_ID, USUA_ID, DEPE_ID', 'safe', 'on'=>'search'),
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
			'rel_dependencias' => array(self::BELONGS_TO, 'Dependencias', 'DEPE_ID'),
			'rel_usuarios' => array(self::BELONGS_TO, 'Users', 'USUA_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'SEUD_ID' => 'ID',
			'USUA_ID' => 'USUARIO',
			'DEPE_ID' => 'DEPENDENCIA',
			
			'USUA_USUARIO' => 'USUARIO',
			'PENA_ID' => 'PERSONA',
			'USES_ID' => 'ESTADO',
			'USUA_FECHAALTA' => 'FECHA CREACION',
			'USUA_FECHABAJA' => 'FECHA SUSPENSION',
			'USUA_ULTIMOACCESO' => 'ULTIMA VISITA',
			'USPE_ID' => 'PERFIL',
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
		$criteria->select='t.*, u.*, d.*';
		$criteria->join ='
		INNER JOIN TBL_USUARIOS  u ON u.USUA_ID = t.USUA_ID
		INNER JOIN TBL_DEPENDENCIAS  d ON d.DEPE_ID = t.DEPE_ID';

		$criteria->compare('SEUD_ID',$this->SEUD_ID);
		$criteria->compare('USUA_ID',$this->USUA_ID);
		$criteria->compare('t.DEPE_ID',$this->DEPE_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getImagenVer(){
	   $imageUrl = 'ver.png';
	   return Yii::app()->baseurl.'/images/'.$imageUrl;
	  }	
	  
	public function getUsuariosPerfiles()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.USPE_ID, t.USPE_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_USUARIOSPERFILESUSUARIOS upu ON upu.USPE_ID = t.USPE_ID
	 INNER JOIN TBL_USUARIOS u ON u.USUA_ID = upu.USUA_ID';	
	 $criteria->order = 't.USPE_NOMBRE ASC';
	 return  CHtml::listData(Usuariosperfiles::model()->findAll($criteria),'USPE_ID','USPE_NOMBRE'); 
	}

	public function getDependencias()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.DEPE_ID, t.DEPE_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_SEGUIMIENTOUSERDEPENDENCIAS sud ON sud.DEPE_ID = t.DEPE_ID';	
	 $criteria->order = 't.DEPE_NOMBRE ASC';
	 return  CHtml::listData(Dependencias::model()->findAll($criteria),'DEPE_ID','DEPE_NOMBRE'); 
	}			
	
}