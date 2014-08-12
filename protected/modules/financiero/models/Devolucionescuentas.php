<?php

/**
 * This is the model class for table "TBL_DEVOLUCIONESCUENTAS".
 *
 * The followings are the available columns in table 'TBL_DEVOLUCIONESCUENTAS':
 * @property integer $DECU_ID
 * @property string $DECU_MOTIVO
 * @property string $DECU_FECHADEVOLUCION
 * @property integer $TIDO_ID
 * @property integer $SECU_ID
 *
 * The followings are the available model relations:
 * @property TblSeguimientocuentas $sECU
 * @property TblTiposdocumentos $tIDO
 */
class Devolucionescuentas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Devolucionescuentas the static model class
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
		return 'TBL_DEVOLUCIONESCUENTAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DECU_MOTIVO, DECU_FECHADEVOLUCION, TIDO_ID, SECU_ID', 'required'),
			array('TIDO_ID, SECU_ID', 'numerical', 'integerOnly'=>true),
			array('DECU_MOTIVO', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('DECU_ID, DECU_MOTIVO, DECU_FECHADEVOLUCION, TIDO_ID, SECU_ID', 'safe', 'on'=>'search'),
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
			'sECU' => array(self::BELONGS_TO, 'Seguimientocuentas', 'SECU_ID'),
			'rel_tipos_documentos' => array(self::BELONGS_TO, 'Tiposdocumentos', 'TIDO_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'DECU_ID' => 'ID',
			'DECU_MOTIVO' => 'MOTIVO DEVOLUCION',
			'DECU_FECHADEVOLUCION' => 'FECHA DEVOLUCION',
			'TIDO_ID' => 'TIPO DOCUMENTO',
			'SECU_ID' => 'ID SEGUIMIENTO',
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

		$criteria->compare('DECU_ID',$this->DECU_ID);
		$criteria->compare('DECU_MOTIVO',$this->DECU_MOTIVO,true);
		$criteria->compare('DECU_FECHADEVOLUCION',$this->DECU_FECHADEVOLUCION,true);
		$criteria->compare('TIDO_ID',$this->TIDO_ID);
		$criteria->compare('SECU_ID',$this->SECU_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}