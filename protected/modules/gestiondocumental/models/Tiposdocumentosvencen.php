<?php

/**
 * This is the model class for table "TBL_TIPOSDOCUMENTOSVENCEN".
 *
 * The followings are the available columns in table 'TBL_TIPOSDOCUMENTOSVENCEN':
 * @property integer $TIDV_ID
 * @property integer $TIDO_ID
 */
class Tiposdocumentosvencen extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return tiposdocumentosvencen the static model class
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
		return 'TBL_TIPOSDOCUMENTOSVENCEN';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TIDO_ID', 'required'),
			array('TIDO_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TIDV_ID, TIDO_ID', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'TIDV_ID' => 'ID',
			'TIDO_ID' => 'TIPO DOCUMENTO QUE VENCE',
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

		$criteria->compare('TIDV_ID',$this->TIDV_ID);
		$criteria->compare('TIDO_ID',$this->TIDO_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}