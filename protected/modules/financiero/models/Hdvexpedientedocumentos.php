<?php

/**
 * This is the model class for table "TBL_HDVEXPEDIENTEDOCUMENTOS".
 *
 * The followings are the available columns in table 'TBL_HDVEXPEDIENTEDOCUMENTOS':
 * @property integer $HEXD_ID
 * @property string $HEXD_RUTA
 * @property string $HEXD_FECHAINGRESO
 * @property integer $PERS_ID
 * @property integer $HTDO_ID
 *
 * The followings are the available model relations:
 * @property TblHdvtiposdocumentos $hTDO
 * @property TblPersonas $pERS
 */
class Hdvexpedientedocumentos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Hdvexpedientedocumentos the static model class
	 */
	public $ARCHIVO;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_HDVEXPEDIENTEDOCUMENTOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('HEXD_RUTA, HEXD_FECHAINGRESO, PERS_ID, HTDO_ID, ARCHIVO', 'required'),
			array('PERS_ID, HTDO_ID', 'numerical', 'integerOnly'=>true),
			array('ARCHIVO', 'file', 'types'=>'pdf'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('HEXD_ID, HEXD_RUTA, HEXD_FECHAINGRESO, PERS_ID, HTDO_ID, ARCHIVO', 'safe', 'on'=>'search'),
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
			'rel_hdv_tipos_documentos' => array(self::BELONGS_TO, 'Hdvtiposdocumentos', 'HTDO_ID'),
			'pERS' => array(self::BELONGS_TO, 'TblPersonas', 'PERS_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'HEXD_ID' => 'ID',
			'HEXD_RUTA' => 'URL',
			'HEXD_FECHAINGRESO' => 'FECHA INGRESO',
			'PERS_ID' => 'PERSONA',
			'HTDO_ID' => 'TIPO DE DOCUMENTO',
			'ARCHIVO' => 'ARCHIVO A SUBIR',
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

		$criteria->compare('HEXD_ID',$this->HEXD_ID);
		$criteria->compare('HEXD_RUTA',$this->HEXD_RUTA,true);
		$criteria->compare('HEXD_FECHAINGRESO',$this->HEXD_FECHAINGRESO,true);
		$criteria->compare('PERS_ID',$this->PERS_ID);
		$criteria->compare('HTDO_ID',$this->HTDO_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getHdvtiposdocumentos($id)
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.HTDO_ID, t.HTDO_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_HDVEXPEDIENTEDOCUMENTOS ed ON ed.HTDO_ID = t.HTDO_ID AND ed.PERS_ID = '.$id; 
	 $criteria->order = 't.HTDO_NOMBRE ASC';
	 return  CHtml::listData(Hdvtiposdocumentos::model()->findAll($criteria),'HTDO_ID','HTDO_NOMBRE'); 
	}	
}