<?php

/**
 * This is the model class for table "TBL_DIRECTORESPROGRAMAS".
 *
 * The followings are the available columns in table 'TBL_DIRECTORESPROGRAMAS':
 * @property integer $DIPR_ID
 * @property integer $PROG_ID
 * @property integer $SEDE_ID
 * @property integer $PENA_ID
 * @property string $DIRP_FECHA_INICIO
 * @property string $DIRP_FECHA_FIN
 * @property integer $DIPR_ESTADO
 *
 * The followings are the available model relations:
 * @property PERSONASNATURALES $pENA
 * @property PROGRAMAS $pROG
 * @property SEDES $sEDE
 * @property USUARIOSDIRECTORESPROGRAMAS[] $uSUARIOSDIRECTORESPROGRAMASes
 */
class Directoresprogramas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Directoresprogramas the static model class
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
		return 'TBL_DIRECTORESPROGRAMAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PROG_ID, SEDE_ID, PENA_ID, DIPR_ESTADO', 'numerical', 'integerOnly'=>true),
			array('DIRP_FECHA_INICIO, DIRP_FECHA_FIN', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('DIPR_ID, PROG_ID, SEDE_ID, PENA_ID, DIRP_FECHA_INICIO, DIRP_FECHA_FIN, DIPR_ESTADO', 'safe', 'on'=>'search'),
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
			'rel_personasnaturales' => array(self::BELONGS_TO, 'PERSONASNATURALES', 'PENA_ID'),
			'rel_programas' => array(self::BELONGS_TO, 'PROGRAMAS', 'PROG_ID'),
			'rel_sedes' => array(self::BELONGS_TO, 'SEDES', 'SEDE_ID'),
			'uSUARIOSDIRECTORESPROGRAMASes' => array(self::HAS_MANY, 'USUARIOSDIRECTORESPROGRAMAS', 'DIPR_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'DIPR_ID' => 'ID',
			'PROG_ID' => 'PROGRAMA',
			'SEDE_ID' => 'SEDE',
			'PENA_ID' => 'COORDINADOR DE PROGRAMA',
			'DIRP_FECHA_INICIO' => 'FECHA INICIO',
			'DIRP_FECHA_FIN' => 'FECHA TERMINACIÓN',
			'DIPR_ESTADO' => 'ESTADO',
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

		$criteria->compare('DIPR_ID',$this->DIPR_ID);
		$criteria->compare('PROG_ID',$this->PROG_ID);
		$criteria->compare('SEDE_ID',$this->SEDE_ID);
		$criteria->compare('PENA_ID',$this->PENA_ID);
		$criteria->compare('DIRP_FECHA_INICIO',$this->DIRP_FECHA_INICIO,true);
		$criteria->compare('DIRP_FECHA_FIN',$this->DIRP_FECHA_FIN,true);
		$criteria->compare('DIPR_ESTADO',$this->DIPR_ESTADO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function cambiarEstado($id,$estado){
      $connection = Yii::app()->db;
	   $string="UPDATE TBL_DIRECTORESPROGRAMAS SET DIPR_ESTADO=".$estado." WHERE DIPR_ID=".$id;
	   $criteria = $connection->createCommand($string)->execute();
	  }
	  
	  public function getPersonasnaturales()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.PENA_ID, t.PENA_NOMBRES, t.PENA_APELLIDOS';
	 $criteria->join = 'INNER JOIN TBL_PERSONASNATURALES  c ON t.PENA_ID = c.PENA_ID';	
	 $criteria->order = 't.PENA_NOMBRES ASC';
	 return  CHtml::listData(Personasnaturales::model()->findAll($criteria),'PENA_ID','nombreCompleto'); 
	}	
	
	public function getImagenEstado(){
		//$imageUrl = '1.png';
	   if($this->DIPR_ESTADO==='1'){
		$imageUrl = '0.png'; 
	   }else{
		$imageUrl = '1.png'; 
	   }
	   return Yii::app()->baseurl.'/images/'.$imageUrl;
	  }	
	  public function getSedes()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.SEDE_ID, t.SEDE_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_SEDES  c ON t.SEDE_ID = c.SEDE_ID';	
	 $criteria->order = 't.SEDE_NOMBRE ASC';
	 return  CHtml::listData(Sedes::model()->findAll($criteria),'SEDE_ID','SEDE_NOMBRE'); 
	}	
	  public function getProgramas()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.PROG_ID, t.PROG_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_DIRECTORESPROGRAMAS  c ON t.PROG_ID = c.PROG_ID';	
	 $criteria->order = 't.PROG_NOMBRE ASC';
	 return  CHtml::listData(Programas::model()->findAll($criteria),'PROG_ID','PROG_NOMBRE'); 
	}	
}