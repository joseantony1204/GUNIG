<?php

/**
 * This is the model class for table "TBL_USUARIOSROLES".
 *
 * The followings are the available columns in table 'TBL_USUARIOSROLES':
 * @property integer $USRO_ID
 * @property string $USRO_NOMBRE
 * @property integer $USMO_ID
 * @property integer $USSM_ID
 * @property integer $USCO_ID
 * @property integer $USVI_ID
 * @property integer $USPE_ID
 *
 * The followings are the available model relations:
 * @property TblUsuariosmodulos $uSMO
 * @property TblUsuariossubmodulos $uSSM
 * @property TblUsuarioscontroladores $uSCO
 * @property TblUsuariosvistas $uSVI
 * @property TblUsuariosperfilesusuarios $uSPU
 */
class Usuariosroles extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usuariosroles the static model class
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
		return 'TBL_USUARIOSROLES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('USRO_NOMBRE, USMO_ID, USSM_ID, USCO_ID, USVI_ID, USPE_ID', 'required'),
			array('USMO_ID, USSM_ID, USCO_ID, USVI_ID, USPE_ID', 'numerical', 'integerOnly'=>true),
			array('USRO_NOMBRE', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('USRO_ID, USRO_NOMBRE, USMO_ID, USSM_ID, USCO_ID, USVI_ID, USPE_ID', 'safe', 'on'=>'search'),
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
			'rel_usuarios_submodulos' => array(self::BELONGS_TO, 'Usuariossubmodulos', 'USSM_ID'),
			'rel_usuarios_controladores' => array(self::BELONGS_TO, 'Usuarioscontroladores', 'USCO_ID'),
			'rel_usuarios_vistas' => array(self::BELONGS_TO, 'Usuariosvistas', 'USVI_ID'),
			'rel_usuarios_perfiles' => array(self::BELONGS_TO, 'Usuariosperfiles', 'USPE_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'USRO_ID' => 'ID',
			'USRO_NOMBRE' => 'NOMBRE',
			'USMO_ID' => 'MODULO',
			'USSM_ID' => 'SUB MODULO',
			'USCO_ID' => 'CONTROLADOR',
			'USVI_ID' => 'VISTAS',
			'USPE_ID' => 'PERFIL USUARIO',
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

		$criteria->compare('USRO_ID',$this->USRO_ID);
		$criteria->compare('USRO_NOMBRE',$this->USRO_NOMBRE,true);
		$criteria->compare('USMO_ID',$this->USMO_ID);
		$criteria->compare('USSM_ID',$this->USSM_ID);
		$criteria->compare('USCO_ID',$this->USCO_ID);
		$criteria->compare('USVI_ID',$this->USVI_ID);
		$criteria->compare('USPE_ID',$this->USPE_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getUsuariosModulos()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.USMO_ID, t.USMO_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_USUARIOSROLES ur ON ur.USMO_ID = t.USMO_ID';	
	 $criteria->order = 't.USMO_NOMBRE ASC';
	 return  CHtml::listData(Usuariosmodulos::model()->findAll($criteria),'USMO_ID','USMO_NOMBRE'); 
	}
	
	public function getUsuariosSubModulos($id=NULL)
	{
	 //if($id!=''){echo $sql = 'AND t.USMO_ID = '.$id; }else{ $sql = '';}
	 $criteria=new CDbCriteria;
     $criteria->select='t.USSM_ID, t.USSM_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_USUARIOSROLES ur ON ur.USSM_ID = t.USSM_ID ';//.$sql;	
	 $criteria->order = 't.USSM_NOMBRE ASC';
	 return  CHtml::listData(Usuariossubmodulos::model()->findAll($criteria),'USSM_ID','USSM_NOMBRE'); 
	}
	
	public function getUsuariosControladores()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.USCO_ID, t.USCO_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_USUARIOSROLES ur ON ur.USCO_ID = t.USCO_ID';
	 $criteria->order = 't.USCO_NOMBRE ASC';
	 return  CHtml::listData(Usuarioscontroladores::model()->findAll($criteria),'USCO_ID','USCO_NOMBRE'); 
	}
	
	public function getUsuariosVistas()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.USVI_ID, t.USVI_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_USUARIOSROLES ur ON ur.USVI_ID = t.USVI_ID';
	 $criteria->order = 't.USVI_NOMBRE ASC';
	 return  CHtml::listData(Usuariosvistas::model()->findAll($criteria),'USVI_ID','USVI_NOMBRE'); 
	}
	
	public function getUsuariosPerfiles()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.USPE_ID, t.USPE_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_USUARIOSROLES ur ON ur.USPE_ID = t.USPE_ID';
	 $criteria->order = 't.USPE_NOMBRE ASC';
	 return  CHtml::listData(Usuariosperfiles::model()->findAll($criteria),'USPE_ID','USPE_NOMBRE'); 
	}					
}