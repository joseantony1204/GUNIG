<?php

/**
 * This is the model class for table "TBL_HORASCATEDRAS".
 *
 * The followings are the available columns in table 'TBL_HORASCATEDRAS':
 * @property integer $HOCA_ID
 * @property integer $HOCA_SEMANAL
 * @property integer $TICD_ID
 * @property string $HOCA_ACUERDO
 * @property string $HOCA_INICIO
 * @property string $HOCA_FIN
 * @property string $HOCA_ESTADOS
 *
 * The followings are the available model relations:
 * @property TIPOCONTRATACIONDOCENTES $tICD
 */
class Horascatedras extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Horascatedras the static model class
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
		return 'TBL_HORASCATEDRAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('HOCA_SEMANAL, TICD_ID, HOCA_ACUERDO, HOCA_INICIO, HOCA_FIN, HOCA_ESTADOS', 'required'),
			array('HOCA_SEMANAL, TICD_ID', 'numerical', 'integerOnly'=>true),
			array('HOCA_ACUERDO', 'length', 'max'=>45),
			array('HOCA_ESTADOS', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('HOCA_ID, HOCA_SEMANAL, TICD_ID, HOCA_ACUERDO, HOCA_INICIO, HOCA_FIN, HOCA_ESTADOS', 'safe', 'on'=>'search'),
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
			'rel_tipovinculaciondocente' => array(self::BELONGS_TO, 'TIPOCONTRATACIONDOCENTES', 'TICD_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'HOCA_ID' => 'ID',
			'HOCA_SEMANAL' => 'HORAS CATEDRAS SEMANALES',
			'TICD_ID' => 'TIPO VINCULACION DOCENTE',
			'HOCA_ACUERDO' => 'ACUERDO',
			'HOCA_INICIO' => 'FECHA INICIO',
			'HOCA_FIN' => 'FECHA FIN',
			'HOCA_ESTADOS' => 'ESTADO',
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

		$criteria->compare('HOCA_ID',$this->HOCA_ID);
		$criteria->compare('HOCA_SEMANAL',$this->HOCA_SEMANAL);
		$criteria->compare('TICD_ID',$this->TICD_ID);
		$criteria->compare('HOCA_ACUERDO',$this->HOCA_ACUERDO,true);
		$criteria->compare('HOCA_INICIO',$this->HOCA_INICIO,true);
		$criteria->compare('HOCA_FIN',$this->HOCA_FIN,true);
		$criteria->compare('HOCA_ESTADOS',$this->HOCA_ESTADOS,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getImagenEstado(){
		$imageUrl = '1.png';
	   if($this->HOCA_ESTADOS==='0'){
		$imageUrl = '0.png'; 
	   }
	   return Yii::app()->baseurl.'/images/'.$imageUrl;
	  }	
	  
	public function cambiarEstado($hora_id,$estado){
      
	 $connection = Yii::app()->db;
	 $sql = "SELECT * FROM TBL_HORASCATEDRAS WHERE HOCA_ESTADOS = 0 ORDER BY HOCA_ID DESC";
	 $num_rows = $connection->createCommand($sql)->queryRow();
	 $registro = $connection->createCommand($sql)->queryAll();
	 if($num_rows>0){
	  foreach($registro as $data){
       $string="UPDATE TBL_HORASCATEDRAS  SET HOCA_ESTADOS = 1";
	   $criteria = $connection->createCommand($string)->execute();
	  }
	  $string="UPDATE TBL_HORASCATEDRAS  SET HOCA_ESTADOS = $estado WHERE HOCA_ID = $hora_id";
	  $criteria = $connection->createCommand($string)->execute();
	 }
	}
	
	  public function getTipovinculaciondocenente()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.TICD_ID, t.TICD_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_TIPOCONTRATACIONDOCENTES  c ON t.TICD_ID = c.TICD_ID '; 
	 $criteria->order = 't.TICD_NOMBRE ASC';
	 return  CHtml::listData(Tipocontrataciondocentes::model()->findAll($criteria),'TICD_ID','TICD_NOMBRE'); 
	}
}