<?php

/**
 * This is the model class for table "TBL_GRUPOSINVESTIGACION".
 *
 * The followings are the available columns in table 'TBL_GRUPOSINVESTIGACION':
 * @property integer $GRIN_ID
 * @property string $GRIN_NOMBRE
 * @property integer $CAGI_ID
 * @property string $GRIN_ANIO_CALIFICACION
 * @property string $GRIN_GRUPLAC
 * @property integer $PENA_ID
 *
 * The followings are the available model relations:
 * @property ACTIVIDADESINVESTIGATIVAS[] $aCTIVIDADESINVESTIGATIVASes
 * @property CATEGRUPOSINVESTIGACION $cAGI
 */
class Gruposinvestigacion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Gruposinvestigacion the static model class
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
		return 'TBL_GRUPOSINVESTIGACION';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		   array('GRIN_NOMBRE, CAGI_ID, GRIN_ANIO_CALIFICACION, GRIN_GRUPLAC, PENA_ID', 'required'),
			array('CAGI_ID, PENA_ID', 'numerical', 'integerOnly'=>true),
			array('GRIN_NOMBRE, GRIN_GRUPLAC', 'length', 'max'=>200),
			array('GRIN_ANIO_CALIFICACION', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('GRIN_ID, GRIN_NOMBRE, CAGI_ID, GRIN_ANIO_CALIFICACION, GRIN_GRUPLAC, PENA_ID', 'safe', 'on'=>'search'),
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
			'aCTIVIDADESINVESTIGATIVASes' => array(self::HAS_MANY, 'ACTIVIDADESINVESTIGATIVAS', 'GRIN_ID'),
			'rel_categoriagrupos' => array(self::BELONGS_TO, 'CATEGRUPOSINVESTIGACION', 'CAGI_ID'),
			'rel_personasnaturales' => array(self::BELONGS_TO, 'PERSONASNATURALES', 'PENA_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'GRIN_ID' => 'ID',
			'GRIN_NOMBRE' => 'NOMBRE',
			'CAGI_ID' => 'CATEGORIA GRUPO',
			'GRIN_ANIO_CALIFICACION' => 'AÑO DE CLASIFICACIÓN',
			'GRIN_GRUPLAC' => 'GRUPLAC',
			'PENA_ID' => 'INVESTIGADOR PRINCIPAL',
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

		$criteria->compare('GRIN_ID',$this->GRIN_ID);
		$criteria->compare('GRIN_NOMBRE',$this->GRIN_NOMBRE,true);
		$criteria->compare('CAGI_ID',$this->CAGI_ID);
		$criteria->compare('GRIN_ANIO_CALIFICACION',$this->GRIN_ANIO_CALIFICACION,true);
		$criteria->compare('GRIN_GRUPLAC',$this->GRIN_GRUPLAC,true);
		$criteria->compare('PENA_ID',$this->PENA_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getCategoriaGrupos()
	{
     $criteria=new CDbCriteria;
     $criteria->select='t.CAGI_ID, t.CAGI_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_CATEGRUPOSINVESTIGACION  c ON t.CAGI_ID = c.CAGI_ID '; 
	 $criteria->order = 't.CAGI_NOMBRE ASC';
	 return  CHtml::listData(Categruposinvestigacion::model()->findAll($criteria),'CAGI_ID','CAGI_NOMBRE');	}
	
	public function getPersonas()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.PENA_ID, t.PENA_NOMBRES, t.PENA_APELLIDOS';
	 $criteria->join = 'INNER JOIN TBL_PERSONASNATURALES c ON t.PENA_ID = c.PENA_ID';	
	 $criteria->order = 't.PENA_NOMBRES ASC';
	 return  CHtml::listData(Personasnaturales::model()->findAll($criteria),'PENA_ID','nombreCompleto'); 
	}
	
	public function getIdgrupoNombres()
	{
		 $criteria=new CDbCriteria;
     $criteria->select='t.GRIN_ID, t.GRIN_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_GRUPOSINVESTIGACION c ON t.GRIN_ID = c.GRIN_ID';
	 $criteria->order = 't.GRIN_NOMBRE ASC';
	 $data=Gruposinvestigacion::model()->findAll($criteria);
		
	 return $data;
	}
	
}