<?php

/**
 * This is the model class for table "prod_operacion".
 *
 * The followings are the available columns in table 'prod_operacion':
 * @property integer $id
 * @property string $id_proyecto
 * @property integer $id_estado
 * @property integer $id_usuario
 * @property integer $id_seccion
 * @property string $descripcion
 * @property double $tiempoPlaneado
 * @property double $tiempoReal
 * @property string $fechaInicio
 * @property string $horaInicio
 * @property string $fechaFin
 * @property string $horaFin
 * @property string $fechaPausa
 * @property string $horaPausa
 * @property integer $numPausa
 * @property string $activo
 *
 * The followings are the available model relations:
 * @property Estado $idEstado
 */
class Operacion extends CActiveRecord
{
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Operacion the static model class
	 */
	 
	 const ESTADO_ABIERTO=1;
	 const ESTADO_REABIERTO=4;
	 const ACTIVO=1;
	 
	 const EST_ACTIVO=1;
	 const EST_PAUSADO=2;
	 const EST_TERMINADO=3;
	 
	 public $reiniciar;
	 
	 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'prod_operacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_proyecto, id_estado, id_usuario,tiempoPlaneado,fechaInicio, horaInicio,id_seccion', 'required','message'=>'Por favor indique un(a) {attribute}.'),
			array('id_proyecto, id_estado, id_usuario, id_seccion, numPausa', 'numerical', 'integerOnly'=>true),
			array('tiempoPlaneado, tiempoReal', 'numerical'),
			array('id_proyecto', 'length', 'max'=>20),
			array('descripcion', 'length', 'max'=>250),
			array('fechaFin,horaFin,fechaPausa,horaPausa, numPausa,reiniciar','safe'),
			array('activo', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_proyecto, id_estado, id_trabajador, descripcion, tiempoPlaneado, tiempoReal, fechaInicio, horaInicio, fechaFin, horaFin, fechaPausa, horaPausa, numPausa, activo', 'safe', 'on'=>'search'),
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
			'idEstado' => array(self::BELONGS_TO, 'Estado', 'id_estado'),
			'idProyecto' => array(self::BELONGS_TO, 'Proyecto', 'id_proyecto'),
			'idUser' => array(self::BELONGS_TO, 'User', 'id_usuario'),
			'idSeccion' => array(self::BELONGS_TO, 'Seccion', 'id_seccion'),
			);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_proyecto' => 'Proyecto',
			'id_estado' => 'Estado',
			'id_trabajador' => 'Trabajador',
			'id_Seccion' => 'Seccion',
			'descripcion' => 'Descripcion',
			'tiempoPlaneado' => 'Tiempo',
			'tiempoReal' => 'Tiempo Real',
			'fechaInicio' => 'Fecha Inicio',
			'horaInicio' => 'Hora Inicio',
			'fechaFin' => 'Fecha Fin',
			'horaFin' => 'Hora Fin',
			'fechaPausa' => 'Fecha Reinicio',
			'horaPausa' => 'Hora Reinicio',
			'numPausa' => 'Num Pausa',
			'activo' => 'Activo',
			'id_tipo_operacion' => 'Tipo Operación',
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
		$criteria->compare('id_proyecto',$this->id_proyecto,true);
		$criteria->compare('id_estado',$this->id_estado,true);
		$criteria->compare('id_usuario',$this->id_usuario,true);
		$criteria->compare('id_seccion',$this->id_seccion,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('tiempoPlaneado',$this->tiempoPlaneado);
		$criteria->compare('tiempoReal',$this->tiempoReal);
		$criteria->compare('fechaInicio',$this->fechaInicio,true);
		$criteria->compare('horaInicio',$this->horaInicio,true);
		$criteria->compare('fechaFin',$this->fechaFin,true);
		$criteria->compare('horaFin',$this->horaFin,true);
		$criteria->compare('fechaPausa',$this->fechaPausa,true);
		$criteria->compare('horaPausa',$this->horaPausa,true);
		$criteria->compare('numPausa',$this->numPausa);
		$criteria->compare('activo',$this->activo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getOrden()
	{
		/*$sql='SELECT * FROM torden
		WHERE
		torden.estadoOrden = :estadoAbierto OR 
		torden.estadoOrden = :estadoReabierto 
		ORDER BY idOrden';
		
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':estadoAbierto',self::ESTADO_ABIERTO,PDO::PARAM_INT);
		$command->bindValue(':estadoReabierto',self::ESTADO_REABIERTO,PDO::PARAM_INT);
		
		return CHtml::listData($command->queryAll(),'idOrden','idOrden');*/
		return false;
		
	}
	
	public static function getTrabajador()
	{
		/*$sql='SELECT t.idTrabajador, tentidad.nombreEntidad 
		FROM ttrabajador as t
		LEFT JOIN (tentidad) ON (t.idEntidad = tentidad.idEntidad)
		WHERE
		t.activo = :Activo 
		ORDER BY tentidad.nombreEntidad';
		
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':Activo',self::ACTIVO,PDO::PARAM_INT);
		
		return CHtml::listData($command->queryAll(),'idTrabajador','nombreEntidad');
		*/
		return false;
	}
	
	public function getMaquina($params=array())
	{
		/*$sql='SELECT t.idMaquina, t.nombreMaquina 
		FROM tmaquina as t 
		WHERE 
		t.activo = :Activo';
		if(array_key_exists('id', $params)&&!is_null($params['id'])&&$params['id']!="")
			$sql=$sql.' AND t.idMaquina = :idMaquina';
		
		
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':Activo',self::ACTIVO,PDO::PARAM_INT);
		if(array_key_exists('id', $params)&&!is_null($params['id'])&&$params['id']!="")
			$command->bindValue(':idMaquina',$params['id'],PDO::PARAM_INT);;
		
		
		if(array_key_exists('datos', $params)&&!is_null($params['id'])&&$params['id']!="")
			return $command->queryAll();

		
		return CHtml::listData($command->queryAll(),'idMaquina','nombreMaquina');
		*/
		return false;
	}
	
	public static function getOperaciones($params = array())
	{
		$criteria = new CDbCriteria;
		$criteria->addCondition('activo = :idActivo');
		
		
		if(array_key_exists('estados', $params))
			$criteria->addInCondition('id_estado',$params['estados']); 
		
		$criteria->params[':idActivo']=self::ACTIVO;
		
		return self::model()->findAll($criteria);
	}
	
	public static function getEntidad($params = array())
	{
		$sql='SELECT t.idEntidad, t.nombreEntidad 
		FROM tentidad as t';
		
		if(array_key_exists('id_trabajador', $params))
			$sql=$sql.' LEFT JOIN (ttrabajador) ON (ttrabajador.idEntidad = t.idEntidad)';
		
		if(array_key_exists('id_trabajador', $params))
			$sql=$sql.' WHERE ttrabajador.idTrabajador = :idTrabajador';
	
		$command = Yii::app()->db->createCommand($sql);
		if(array_key_exists('id_trabajador', $params))
			$command->bindValue(':idTrabajador',$params['id_trabajador'],PDO::PARAM_INT);

		return $command->queryAll($sql);
		
	}
	
	public function getHoraFin()
	{
		if($this->numPausa > 0)
		{
			//create starting date
			$strDate1 = $this->fechaPausa.' '.$this->horaPausa;
			$date1= new DateTime($strDate1,new DateTimeZone('America/Costa_Rica'));
			
			//getting how much time is left
			if($this->tiempoPlaneado > $this->tiempoReal)
			{
			$remanente = (integer)($this->tiempoPlaneado - $this->tiempoReal)*60;
			$date1->add(new DateInterval('PT'.($remanente).'M'));
			return $date1->format('H:i');
			}else
			{
				return "Ya debió terminar";
			}
		}else
		{
			//create starting date
			$strDate1 = $this->fechaInicio.' '.$this->horaInicio;
			$date1= new DateTime($strDate1,new DateTimeZone('America/Costa_Rica'));
			
			//getting how much time is left
			$remanente = (integer) $this->tiempoReal*60;
			$date1->add(new DateInterval('PT'.($remanente).'M'));
			return $date1->format('H:i');
		}
		
	}
	
	public function getDiffCurrentTime($date)
	{
		$date1 = new DateTime($date);
		//This seems redundant, but if you don't do it this way, TimeZone isn't applied to 
		//calculations.
		
		$now1 = new DateTime(null,new DateTimeZone('America/Costa_Rica'));
		$now = new DateTime($now1->format('Y-m-d H:i:s'));		
		$interval = $date1->diff($now);
		$minutes = $interval->days * 24 * 60;
		$minutes += $interval->h * 60;
		$minutes += $interval->i;
		
		return $minutes/60;
		
	}
	
	public function calculateTiempoReal()
	{
		if($this->numPausa > 0)
		{
			$date1 = $this->fechaPausa.' '.$this->horaPausa;
			$this->tiempoReal += $this->getDiffCurrentTime($date1);
		}else
		{
			$date1 = $this->fechaInicio.' '.$this->horaInicio;
			$this->tiempoReal = $this->getDiffCurrentTime($date1);
		}
	}
	
}
