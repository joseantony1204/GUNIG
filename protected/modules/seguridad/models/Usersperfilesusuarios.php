<?php

/**
 * This is the model class for table "TBL_USUARIOSPERFILESUSUARIOS".
 *
 * The followings are the available columns in table 'TBL_USUARIOSPERFILESUSUARIOS':
 * @property integer $USPU_ID
 * @property integer $USUA_ID
 * @property integer $USPE_ID
 * @property string $USPU_FECHAINGRESO
 *
 * The followings are the available model relations:
 * @property TblUsuariosperfiles $uSPE
 * @property TblUsuarios $uSUA
 */
class Usersperfilesusuarios extends Users
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usersperfilesusuarios the static model class
	 */
	public $USUA_USUARIO, $PENA_ID, $USES_ID, $USUA_FECHAALTA, $USUA_FECHABAJA, $USUA_ULTIMOACCESO, $ROLES,
	$PERS_IDENTIFICACION, $PENA_NOMBRES, $PENA_APELLIDOS;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_USUARIOSPERFILESUSUARIOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('USUA_ID, USPE_ID, USPU_FECHAINGRESO', 'required'),
			array('USUA_ID, USPE_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
		array('USPU_ID, USUA_ID, USPE_ID, USPU_FECHAINGRESO, PERS_IDENTIFICACION, PENA_NOMBRES, PENA_APELLIDOS,
		USUA_USUARIO, USUA_ULTIMOACCESO', 'safe', 'on'=>'search'),
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
			'rel_usuarios_perfiles' => array(self::BELONGS_TO, 'Usuariosperfiles', 'USPE_ID'),
			'rel_users' => array(self::BELONGS_TO, 'Users', 'USUA_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'USPU_ID' => 'ID',
			'USUA_ID' => 'USUARIO',
			'USPE_ID' => 'PERFIL',
			'USPU_FECHAINGRESO' => 'FECHA CREADO',
			
			'USUA_USUARIO' => 'USUARIO',
			'PENA_ID' => 'PERSONA',
			'USES_ID' => 'ESTADO',
			'USUA_FECHAALTA' => 'FECHA CREACION',
			'USUA_FECHABAJA' => 'FECHA SUSPENSION',
			'USUA_ULTIMOACCESO' => 'ULTIMA VISITA',
			
			'PERS_IDENTIFICACION' => 'IDENTIFICACION',
			'PENA_NOMBRES' => 'NOMBRES',
			'PENA_APELLIDOS' => 'APELLIDOS',
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
			'defaultOrder'=>'t.CONT_ID ASC',
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
			
			'USPE_ID'=>array(
				'asc'=>'t.USPE_ID',
				'desc'=>'t.USPE_ID desc',
			),
			
			'USUA_USUARIO'=>array(
				'asc'=>'u.USUA_USUARIO',
				'desc'=>'u.USUA_USUARIO desc',
			),
			
			'USUA_ULTIMOACCESO'=>array(
				'asc'=>'u.USUA_ULTIMOACCESO',
				'desc'=>'u.USUA_ULTIMOACCESO desc',
			),
			
			'USES_ID'=>array(
				'asc'=>'u.USES_ID',
				'desc'=>'u.USES_ID desc',
			),
		);

		$criteria=new CDbCriteria;
		$criteria->select='t.*, u.*, pn.*, p.*';
		$criteria->join ='
		INNER JOIN TBL_USUARIOS  u ON u.USUA_ID = t.USUA_ID
		INNER JOIN TBL_PERSONASNATURALES  pn ON pn.PENA_ID = u.PENA_ID
		INNER JOIN TBL_PERSONAS  p ON pn.PERS_ID = p.PERS_ID';

		$criteria->compare('USPU_ID',$this->USPU_ID);
		$criteria->compare('USUA_ID',$this->USUA_ID);
		$criteria->compare('USPE_ID',$this->USPE_ID);
		$criteria->compare('USUA_USUARIO',$this->USUA_USUARIO,true);
		$criteria->compare('USPU_FECHAINGRESO',$this->USPU_FECHAINGRESO,true);
		
		$criteria->compare('PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION,true);
		$criteria->compare('PENA_NOMBRES',$this->PENA_NOMBRES,true);
		$criteria->compare('PENA_APELLIDOS',$this->PENA_APELLIDOS,true);
		$criteria->compare('USUA_ULTIMOACCESO',$this->USUA_ULTIMOACCESO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 30,),
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
	 INNER JOIN TBL_USUARIOSPERFILESUSUARIOS upu ON upu.USPE_ID = t.USPE_ID';	
	 $criteria->order = 't.USPE_NOMBRE ASC';
	 return  CHtml::listData(Usuariosperfiles::model()->findAll($criteria),'USPE_ID','USPE_NOMBRE'); 
	}	  
}