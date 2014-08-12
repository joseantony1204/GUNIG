<?php

/**
 * This is the model class for table "TBL_TUTORIASMODULOSXTUTORIAS".
 *
 * The followings are the available columns in table 'TBL_TUTORIASMODULOSXTUTORIAS':
 * @property integer $TUMT_ID
 * @property integer $TUTO_ID
 * @property integer $TUMO_ID
 * @property string $TUMT_GRUPO
 *
 * The followings are the available model relations:
 * @property TblTutorias $tUTO
 * @property TblTutoriasmodulos $tUMO
 */
class Tutoriasmodulos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tutoriasmodulos the static model class
	 */
	private $LISTADO_MODULOS; 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_TUTORIASMODULOSXTUTORIAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TUTO_ID, TUMO_ID', 'required'),
			array('TUTO_ID, TUMO_ID', 'numerical', 'integerOnly'=>true),
			array('TUMT_GRUPO', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TUMT_ID, TUTO_ID, TUMO_ID, TUMT_GRUPO', 'safe', 'on'=>'search'),
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
			'tUTO' => array(self::BELONGS_TO, 'TblTutorias', 'TUTO_ID'),
			'Modulos' => array(self::BELONGS_TO, 'Modulos', 'TUMO_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'TUMT_ID' => 'ID',
			'TUTO_ID' => 'ID TUTORIA',
			'TUMO_ID' => 'MODULO',
			'TUMT_GRUPO' => 'GRUPO',
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

		$criteria->compare('TUMT_ID',$this->TUMT_ID);
		$criteria->compare('TUTO_ID',$this->TUTO_ID);
		$criteria->compare('TUMO_ID',$this->TUMO_ID);
		$criteria->compare('TUMT_GRUPO',$this->TUMT_GRUPO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public	function modulosTutoria($idTutoria){
	 $connection = Yii::app()->db;
	 $sql = "SELECT * FROM TBL_TUTORIASMODULOSXTUTORIAS T WHERE TUTO_ID = $idTutoria ORDER BY TUMT_ID ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	  foreach($data as $rows){
	   $Modulos = Modulos::model()->findByPk($rows["TUMO_ID"]);
	   $modulos_list .= $Modulos->TUMO_NOMBRE." ".$rows["TUMT_GRUPO"].", ";
	  }
	  $this->LISTADO_MODULOS = $modulos_list;
	 return $this->LISTADO_MODULOS;   
	}	
}