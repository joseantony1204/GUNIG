<?php

/**
 * This is the model class for table "TBL_TUTORIASSUBPROGRAMAS".
 *
 * The followings are the available columns in table 'TBL_TUTORIASSUBPROGRAMAS':
 * @property integer $TUSP_ID
 * @property string $TUSP_NOMBRE
 * @property integer $TUPR_ID
 *
 * The followings are the available model relations:
 * @property TblTutoriasprogramas $tUPR
 */
class Tutoriassubprogramas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tutoriassubprogramas the static model class
	 */
	public $CONTRATOS;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_TUTORIASSUBPROGRAMAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TUSP_NOMBRE, TUPR_ID', 'required'),
			array('TUPR_ID', 'numerical', 'integerOnly'=>true),
			array('TUSP_NOMBRE', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TUSP_ID, TUSP_NOMBRE, TUPR_ID', 'safe', 'on'=>'search'),
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
			'rel_programas' => array(self::BELONGS_TO, 'Tutoriasprogramas', 'TUPR_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'TUSP_ID' => 'ID',
			'TUSP_NOMBRE' => 'NOMBRE SUB PROGRAMA',
			'TUPR_ID' => 'PROGRAMA',
			'CONTRATOS' => 'CONTRATOS ACTUALES',
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
		
        $criteria->select = "t.TUSP_ID, t.TUSP_NOMBRE, t.TUPR_ID,
		(SELECT COUNT(tt.TUSP_ID) FROM TBL_TUTORIASCONTRATOS tc, TBL_PERIODOSACADEMICOS  pa, TBL_TUTORIAS tt 
		 WHERE tc.TUCO_ID = tt.TUCO_ID AND pa.PEAC_ID = tc.PEAC_ID AND tt.TUSP_ID = t.TUSP_ID AND pa.PEAC_ESTADO = 0) AS CONTRATOS";
		
		$criteria->compare('TUSP_ID',$this->TUSP_ID);
		$criteria->compare('TUSP_NOMBRE',$this->TUSP_NOMBRE,true);
		$criteria->compare('TUPR_ID',$this->TUPR_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getProgramas()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.TUPR_ID, t.TUPR_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_TUTORIASSUBPROGRAMAS  c ON t.TUPR_ID = c.TUPR_ID';	
	 $criteria->order = 't.TUPR_NOMBRE ASC';
	 return  CHtml::listData(Tutoriasprogramas::model()->findAll($criteria),'TUPR_ID','TUPR_NOMBRE'); 
	}	
}