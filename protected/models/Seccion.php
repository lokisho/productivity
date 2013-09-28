<?php

/**
 * This is the model class for table "prod_seccion".
 *
 * The followings are the available columns in table 'prod_seccion':
 * @property integer $id
 * @property integer $id_proyecto
 * @property string $nombre
 * @property string $activo
 *
 * The followings are the available model relations:
 * @property Operacion[] $operacions
 */
class Seccion extends CActiveRecord
{
	const ACTIVO = 1;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Seccion the static model class
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
		return 'prod_seccion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_proyecto, nombre', 'required'),
			array('id_proyecto', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>200),
			array('activo', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_proyecto, nombre, activo', 'safe', 'on'=>'search'),
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
			'operacions' => array(self::HAS_MANY, 'Operacion', 'id_seccion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_proyecto' => 'Id Proyecto',
			'nombre' => 'Nombre',
			'activo' => 'Activo',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('id_proyecto',$this->id_proyecto);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('activo',$this->activo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getSecciones($params=array())
	{
		$criteria = new CDbCriteria;
		$criteria->addCondition('activo = :Activo');
		$criteria->params[':Activo']=self::ACTIVO;
		
		if(array_key_exists('dropdown', $params))
		{
			return CHtml::listData(self::model()->findAll($criteria),'id','nombre');
		}
	}
}