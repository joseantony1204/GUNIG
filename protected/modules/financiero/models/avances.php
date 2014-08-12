<?php

/**
 * This is the model class for table "TBL_AVANCES".
 *
 * The followings are the available columns in table 'TBL_AVANCES':
 * @property integer $AVAN_ID
 * @property integer $AVAN_NUMERO
 * @property string $AVAN_REALIZA
 * @property string $AVAN_RESOLUCION
 * @property string $AVAN_FECHA
 * @property string $AVAN_RESPONSABLE
 * @property string $AVAN_PENDIENTES_DOC
 * @property string $AVAN_CONCEPTO
 * @property string $AVAN_FECHA_LEGAL
 */
class avances extends CActiveRecord
{  /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return avances the static model class
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
		return 'TBL_AVANCES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('AVAN_NUMERO, AVAN_REALIZA, AVAN_RESOLUCION, AVAN_FECHA, AVAN_RESPONSABLE, AVAN_CONCEPTO', 'required'),
			array('AVAN_NUMERO', 'numerical', 'integerOnly'=>true),
			array('AVAN_REALIZA, AVAN_RESOLUCION, AVAN_FECHA, AVAN_RESPONSABLE, AVAN_PENDIENTES_DOC, AVAN_CONCEPTO, AVAN_FECHA_LEGAL', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			//array('AVAN_ID, AVAN_NUMERO, AVAN_REALIZA, AVAN_RESOLUCION, AVAN_FECHA, AVAN_RESPONSABLE, AVAN_PENDIENTES_DOC, AVAN_CONCEPTO, AVAN_FECHA_LEGAL', 'safe', 'on'=>'search'),
			array('AVAN_ID, AVAN_CONCEPTO, AVAN_FECHA', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'AVAN_ID' => 'ID',
			'AVAN_NUMERO' => 'Numero',
			'AVAN_REALIZA' => 'Realiza',
			'AVAN_RESOLUCION' => 'Resolucion',
			'AVAN_FECHA' => 'Fecha',
			'AVAN_RESPONSABLE' => 'Responsable',
			'AVAN_PENDIENTES_DOC' => 'Pendientes Doc',
			'AVAN_CONCEPTO' => 'Concepto',
			'AVAN_FECHA_LEGAL' => 'Legalizacion',
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

		$criteria->compare('AVAN_ID',$this->AVAN_ID);
		$criteria->compare('AVAN_NUMERO',$this->AVAN_NUMERO);
		$criteria->compare('AVAN_REALIZA',$this->AVAN_REALIZA,true);
		$criteria->compare('AVAN_RESOLUCION',$this->AVAN_RESOLUCION,true);
		$criteria->compare('AVAN_FECHA',$this->AVAN_FECHA,true);
		$criteria->compare('AVAN_RESPONSABLE',$this->AVAN_RESPONSABLE,true);
		$criteria->compare('AVAN_PENDIENTES_DOC',$this->AVAN_PENDIENTES_DOC,true);
		$criteria->compare('AVAN_CONCEPTO',$this->AVAN_CONCEPTO,true);
		$criteria->compare('AVAN_FECHA_LEGAL',$this->AVAN_FECHA_LEGAL,true);
	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	

	
/*	public function getEstadoArc($ruta)
	{
		if($ruta==null){
			return "Pendiente";
		}
		return "Cargado";
	}
	
	
	public function getLinkValue($data){
		$link=null;
		if($data->AVAN_RUTA==null) $link=array("tesoreria/avances/update", "id"=>$data["AVAN_ID"]);
		else $link=Yii::app()->baseUrl.$data->AVAN_RUTA; 
		return $link;
	}	*/
}