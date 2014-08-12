<?php

/**
 * This is the model class for table "tbl_resolucionescan".
 *
 * The followings are the available columns in table 'tbl_resolucionescan':
 * @property integer $REES_ID
 * @property string $REES_RUTA
 * @property integer $RESO_ID
 */
class Resolucionescan extends CActiveRecord
{  
	 public $ARCHIVO;
	 
	 public function getEstadoArc($id)
	{
		$condition='RESO_ID=:id';
		$params=array(':id'=>$id);
		$n=Resolucionescan::model()->count($condition,$params);// obtener el número de filas que cumplan la condición especificada
		if($n==0)	return "Pendiente";		
					return "Cargado";				
	}
	
	 public function getLinkValue($id)
	{	
		$link=null;
		$escaneo=null;
		$sql = "SELECT * FROM TBL_RESOLUCIONESCAN WHERE RESO_ID = '$id'";
		//$params=array(':id'=>$id);
		
		$n=Resolucionescan::model()->countBySql($sql);//,$params
		if($n==0){ $link=array("tesoreria/resolucionescan/create", "id"=>$id);
		}
		else{
			$connection = Yii::app()->db;
			$query = $connection->createCommand($sql)->queryColumn();
			$id_escaneo = $query[0];
			$escaneo=Resolucionescan::model()->findByPk($id_escaneo);
			$link=Yii::app()->baseUrl.$escaneo->REES_RUTA;
		}
		return $link;
	}
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return resolucionescan the static model class
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
		return 'TBL_RESOLUCIONESCAN';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('RESO_ID', 'numerical', 'integerOnly'=>true),
			array('REES_RUTA', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('REES_ID, REES_RUTA, RESO_ID', 'safe', 'on'=>'search'),
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
			'REES_ID' => 'Rees',
			'REES_RUTA' => 'Rees Ruta',
			'RESO_ID' => 'Reso',
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

		$criteria->compare('REES_ID',$this->REES_ID);
		$criteria->compare('REES_RUTA',$this->REES_RUTA,true);
		$criteria->compare('RESO_ID',$this->RESO_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}