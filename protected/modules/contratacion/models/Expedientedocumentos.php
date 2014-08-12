<?php

/**
 * This is the model class for table "TBL_EXPEDIENTEDOCUMENTOS".
 *
 * The followings are the available columns in table 'TBL_EXPEDIENTEDOCUMENTOS':
 * @property integer $EXDO_ID
 * @property string $EXDO_RUTA
 * @property string $EXDO_FECHAINGRESO
 * @property string $EXDO_FECHAVENCIMIENTO
 * @property integer $CONT_ID
 * @property integer $TIDO_ID
 *
 * The followings are the available model relations:
 * @property TblTiposdocumentos $tIDO
 * @property TblContratos $cONT
 */
class Expedientedocumentos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Expedientedocumentos the static model class
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
		return 'TBL_EXPEDIENTEDOCUMENTOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('EXDO_FECHAINGRESO, CONT_ID, TIDO_ID', 'required'),
			array('ARCHIVO', 'file', 'types'=>'pdf'),
			array('CONT_ID, TIDO_ID', 'numerical', 'integerOnly'=>true),
			
			array('EXDO_FECHAVENCIMIENTO', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('EXDO_ID, EXDO_RUTA, EXDO_FECHAINGRESO, EXDO_FECHAVENCIMIENTO, CONT_ID, TIDO_ID, ARCHIVO', 'safe', 'on'=>'search'),
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
			'rel_tipos_documentos' => array(self::BELONGS_TO, 'Tiposdocumentos', 'TIDO_ID'),
			'cONT' => array(self::BELONGS_TO, 'TblContratos', 'CONT_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'EXDO_ID' => 'ID',
			'EXDO_RUTA' => 'URL',
			'EXDO_FECHAINGRESO' => 'FECHA INGRESO',
			'EXDO_FECHAVENCIMIENTO' => 'FECHA VENCIMIENTO',
			'CONT_ID' => 'ID CONTRATO',
			'TIDO_ID' => 'TIPO DOCUMENTO',
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

		$criteria->compare('EXDO_ID',$this->EXDO_ID);
		$criteria->compare('EXDO_RUTA',$this->EXDO_RUTA,true);
		$criteria->compare('EXDO_FECHAINGRESO',$this->EXDO_FECHAINGRESO,true);
		$criteria->compare('EXDO_FECHAVENCIMIENTO',$this->EXDO_FECHAVENCIMIENTO,true);
		$criteria->compare('CONT_ID',$this->CONT_ID);
		$criteria->compare('TIDO_ID',$this->TIDO_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getTiposdocumentos($id)
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.TIDO_ID, t.TIDO_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_EXPEDIENTEDOCUMENTOS ec ON ec.TIDO_ID = t.TIDO_ID AND ec.CONT_ID = '.$id; 
	 $criteria->order = 't.TIDO_NOMBRE ASC';
	 return  CHtml::listData(Tiposdocumentos::model()->findAll($criteria),'TIDO_ID','TIDO_NOMBRE'); 
	}	
}