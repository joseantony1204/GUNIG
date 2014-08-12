<?php

/**
 * This is the model class for table "TBL_TUTORIASVALORHORA".
 *
 * The followings are the available columns in table 'TBL_TUTORIASVALORHORA':
 * @property string $TUVH_ID
 * @property string $TUVH_VALOR
 * @property integer $TUVH_ANIO
 */
class Tutoriasvalorhora extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tutoriasvalorhora the static model class
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
		return 'TBL_TUTORIASVALORHORA';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TUVH_ANIO, TUVH_VALOR', 'required'),
			array('TUVH_ANIO', 'numerical', 'integerOnly'=>true),
			array('TUVH_ID', 'length', 'max'=>10),
			array('TUVH_VALOR', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TUVH_ID, TUVH_VALOR, TUVH_ANIO', 'safe', 'on'=>'search'),
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
			'TUVH_ID' => 'ID',
			'TUVH_VALOR' => 'VALOR DE LA HORA',
			'TUVH_ANIO' => 'AÑO',
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

		$criteria->compare('TUVH_ID',$this->TUVH_ID,true);
		$criteria->compare('TUVH_VALOR',$this->TUVH_VALOR,true);
		$criteria->compare('TUVH_ANIO',$this->TUVH_ANIO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function verificarVrHora($anio){
	 
	 $sql = "SELECT TUVH_ANIO FROM TBL_TUTORIASVALORHORA WHERE TUVH_ANIO = ".$anio." LIMIT 1";
	 $connection = Yii::app()->db;
	 $column = $connection->createCommand($sql)->queryColumn();
	 return $column_valor = $column[0];
	}
}