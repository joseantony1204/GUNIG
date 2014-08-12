<?php

/**
 * This is the model class for table "tbl_escaneados".
 *
 * The followings are the available columns in table 'tbl_escaneados':
 * @property integer $ESCA_ID
 * @property string $ESCA_RUTA
 * @property integer $LIRE_ID
 * @property string $ESCA_ARCHIVO
 */
class Escaneados extends CActiveRecord
{
	public $ARCHIVO;
	
	public function getEstadoArc($id)
	{
		$condition='LIRE_ID=:id';
		$params=array(':id'=>$id);
		$n=Escaneados::model()->count($condition,$params);// obtener el número de filas que cumplan la condición especificada
		if($n==0)	return "Pendiente";		
					return "Cargado";				
	}
	
	public function getLinkValue($id)
	{	
		$link=null;
		$escaneo=null;
		$sql = "SELECT * FROM TBL_ESCANEADOS WHERE LIRE_ID = '$id'";
		//$params=array(':id'=>$id);
		
		$n=Escaneados::model()->countBySql($sql);//,$params
		if($n==0){ $link=array("tesoreria/escaneados/create", "id"=>$id);
		}
		else{
			$connection = Yii::app()->db;
			$query = $connection->createCommand($sql)->queryColumn();
			$id_escaneo = $query[0];
			$escaneo=Escaneados::model()->findByPk($id_escaneo);
			$link=Yii::app()->baseUrl.$escaneo->ESCA_RUTA;
		}
		return $link;
	}
	
	/*public function getLinkValue($id)
	{	
		$condition='LIRE_ID=:id';
		$params=':id='.$id;
		$n=Escaneados::model()->count($condition,$params);// obtener el número de filas que cumplan la condición especificada
		// encontrar todas las filas que cumplan la condición especificada
		$Escaneado=Escaneados::model()->findAll($condition,$params);
		// encontrar todas las filas con la clave primaria especificada
		$Escaneados=Escaneados::model()->findAllByPk($ID,$condition,$params);
		// encontrar todas las filas con los valores de atributos especificados
		$Escaneado=Escaneados::model()->findAllByAttributes($attributes,$condition,$params);
		// encontrar todas las filas usando la sentencia SQL especificada
		$Escaneado=Escaneados::model()->findAllBySql($sql,$params);

		$link=null;
		
		if($n==0){
			$link=array("tesoreria/escaneados/update", "id"=>$data["ESCA_ID"]);		
		}else{
			if($n==1){
				return $link=Yii::app()->baseUrl.$data->AVAN_RUTA;
				}
			return $link=array("tesoreria/escaneados/update", "id"=>$data["ESCA_ID"]);
		}
		return $link;
	} */
	
			
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return escaneados the static model class
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
		return 'TBL_ESCANEADOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('ESCA_RUTA, LIRE_ID, ESCA_ARCHIVO', 'required'),
			array('LIRE_ID', 'numerical', 'integerOnly'=>true),
			array('ESCA_RUTA', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ESCA_ID, ESCA_RUTA, LIRE_ID', 'safe', 'on'=>'search'),
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
			'ESCA_ID' => 'Esca',
			'ESCA_RUTA' => 'Esca Ruta',
			'LIRE_ID' => 'Avan',
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

		$criteria->compare('ESCA_ID',$this->ESCA_ID);
		$criteria->compare('ESCA_RUTA',$this->ESCA_RUTA,true);
		$criteria->compare('LIRE_ID',$this->LIRE_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}