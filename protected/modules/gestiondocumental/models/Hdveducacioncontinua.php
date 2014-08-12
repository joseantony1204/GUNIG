<?php

/**
 * This is the model class for table "TBL_HDVEDUCACIONCONTINUA".
 *
 * The followings are the available columns in table 'TBL_HDVEDUCACIONCONTINUA':
 * @property integer $HECO_ID
 * @property string $HECO_NOMBRE
 * @property string $HECO_RUTA
 * @property string $HECO_FECHATERMINACION
 * @property integer $PERS_ID
 *
 * The followings are the available model relations:
 * @property TblPersonas $pERS
 */
class Hdveducacioncontinua extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Hdveducacioncontinua the static model class
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
		return 'TBL_HDVEDUCACIONCONTINUA';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('HECO_NOMBRE, HECO_LUGAR, HECO_FECHATERMINACION, ARCHIVO, PERS_ID', 'required'),
			array('PERS_ID', 'numerical', 'integerOnly'=>true),
			array('HECO_RUTA, HECO_LUGAR', 'safe'),
			array('ARCHIVO', 'file', 'types'=>'pdf'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('HECO_ID, HECO_NOMBRE, HECO_LUGAR, HECO_RUTA, HECO_FECHATERMINACION, PERS_ID', 'safe', 'on'=>'search'),
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
			'pERS' => array(self::BELONGS_TO, 'TblPersonas', 'PERS_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'HECO_ID' => 'ID',
			'HECO_NOMBRE' => 'DESCRIPCION O NOMBRE DE ESTUDIO',
			'HECO_RUTA' => 'DOCUMENTO',
			'HECO_FECHATERMINACION' => 'FECHA CULMINACION',
			'PERS_ID' => 'PERSONA',
			'HECO_LUGAR'=>'LUGAR DE ESTUDIO',
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

		$criteria->compare('HECO_ID',$this->HECO_ID);
		$criteria->compare('HECO_NOMBRE',$this->HECO_NOMBRE,true);
		$criteria->compare('HECO_RUTA',$this->HECO_RUTA,true);
		$criteria->compare('HECO_FECHATERMINACION',$this->HECO_FECHATERMINACION,true);
		$criteria->compare('PERS_ID',$this->PERS_ID);
		$criteria->compare('HECO_LUGAR',$this->HECO_LUGAR, true); 

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function verificarPersona($id)
	{

		$Usuario = Usuarios::model()->findByPk(Yii::app()->user->id);
		$Personasnaturales = Personasnaturales::model()->findByPk($Usuario->PENA_ID);
		$Personas = Personas::model()->findByPk($Personasnaturales->PERS_ID);

		$criteria=new CDbCriteria;		
		$criteria->select='t.PERS_ID';
		$criteria->join = '
	    INNER JOIN TBL_PERSONAS p ON p.PERS_ID = t.PERS_ID ';
        $criteria->condition = 'p.PERS_ID = '.$Personas->PERS_ID. ' AND t.PERS_ID = '.$id;
		$criteria->order = 't.PERS_ID ASC';
		
		$Personas = Personas::model()->find($criteria);
		if($Personas===null)
			throw new CHttpException(404,'La página que ha solicitado no se encuenta disponible :(');
		return $Personas;
	}
}