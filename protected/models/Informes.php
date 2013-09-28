<?php
class Informes 
{

	
	/**
	 * @return array validation rules for model attributes.
	
	public function rules()
	{
		return array(
			array('id_calend_inf', 'safe'),
		);
	}
	 */
	
	public static function getOperaciones ($params=array(),$activo=1)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = "activo = :activo";
		$criteria->params[':activo']=1;
		
		if(array_key_exists('fechaDesde', $params))
		{
			$criteria->addCondition('fechaInicio >= :fechaDesde');
			$criteria->params[':fechaDesde']=date('Y-m-d', strtotime($params['fechaDesde']));
		}
		
		if(array_key_exists('fechaHasta', $params))
		{
			$criteria->addCondition('fechaInicio <= :fechaHasta');
			$criteria->params[':fechaHasta']=date('Y-m-d', strtotime($params['fechaHasta']));
		}
		
		
		if(array_key_exists('id_proyecto', $params)&&! is_null($params['id_proyecto'])&&$params['id_proyecto']!="")
		{
			$criteria->addCondition('id_proyecto = :idProyecto');
			$criteria->params[':idProyecto']=$params['id_proyecto'];
		}
		
		
		if(array_key_exists('id_usuario', $params)&&! is_null($params['id_usuario'])&&$params['id_usuario']!="")
		{
			$criteria->addCondition('id_usuario = :idUsuario');
			$criteria->params[':idUsuario']=$params['id_usuario'];
		}
		
		
		
		if(array_key_exists('id_estado', $params)&&! is_null($params['id_estado'])&&$params['id_estado']!="")
		{
			$criteria->addCondition('id_estado = :idEstado');
			$criteria->params[':idEstado']=$params['id_estado'];
		}
		
		return Operacion::model()->findAll($criteria);
		
	}
	
	
	/*public static function getActivos($params,$activo=1)
	{
			
		$criteria = new CDbCriteria;
		$criteria->condition = "activo = :activo";
		$criteria->params = array("activo"=>1);
		
		if(array_key_exists('id_tipo_activo', $params)&&!is_null($params['id_tipo_activo'])&&$params['id_tipo_activo']!="")
		{
			$criteria->addCondition("id_tipo_activo = :idTipoActivo");
			$criteria->params[':idTipoActivo']=$params['id_tipo_activo'];
			
		}
		
		if(array_key_exists('id_activo', $params)&&!is_null($params['id_activo'])&&$params['id_activo']!="")
		{
			$criteria->addCondition("id = :idActivo");
			$criteria->params[':idActivo']=$params['id_activo'];
		}
		
		if(array_key_exists('nombre', $params)&&!is_null($params['nombre'])&&$params['nombre']!="")
		{
			$params['nombre'] = addcslashes($params['nombre'], '%_');
			$criteria->addCondition("nombre LIKE :Nombre");
			$criteria->params[':Nombre']='%'.$params["nombre"].'%';
		}
		
		if(array_key_exists('descripcion', $params)&&!is_null($params['descripcion'])&&$params['descripcion']!="")
		{
			$params['descripcion'] = addcslashes($params['descripcion'], '%_');
			$criteria->addCondition("descripcion LIKE :Descripcion");
			$criteria->params[':Descripcion']='%'.$params["descripcion"].'%';
		}
		
		if(array_key_exists('codigo', $params)&&!is_null($params['codigo'])&&$params['codigo']!="")
		{
			$params['codigo'] = addcslashes($params['codigo'], '%_');
			$criteria->addCondition("codigo LIKE :Codigo");
			$criteria->params[':Codigo']='%'.$params["codigo"].'%';
		}
		
		if(array_key_exists('marca', $params)&&!is_null($params['marca'])&&$params['marca']!="")
		{
			$params['marca'] = addcslashes($params['marca'], '%_');
			$criteria->addCondition("marca LIKE :Marca");
			$criteria->params[':Marca']='%'.$params["marca"].'%';
		}
		
		if(array_key_exists('modelo', $params)&&!is_null($params['modelo'])&&$params['modelo']!="")
		{
			$params['modelo'] = addcslashes($params['modelo'], '%_');
			$criteria->addCondition("marca LIKE :Modelo");
			$criteria->params[':Modelo']='%'.$params["modelo"].'%';
		}
		
		if(array_key_exists('id_localizacion', $params)&&!is_null($params['id_localizacion'])&&$params['id_localizacion']!="")
		{
			$criteria->addCondition("id_localizacion = :idLocalizacion");
			$criteria->params[':idLocalizacion']=$params['id_localizacion'];
			
		}
		
		if(array_key_exists('id_estado', $params)&&is_array($params['id_estado'])&&count($params['id_estado'])>0)
		{
			$estados="";
			foreach ($params['id_estado'] as $estado){
					if($estados=="")
						$estados = $estado;
					else
						$estados = $estados.",".$estado;
			}
			
			$params['id_estado']=$estados;
			
			$criteria->addCondition("id_estado IN (".$params['id_estado'].")");
			//$criteria->params[':idEstado']=$params['id_estado']; Not working with bind in multiple selections, probably it takes them as string and not as integer
			
		}
		
		$criteria->order="nombre ASC";
		
		if(array_key_exists('offset',$params)&&! is_null($params['offset'])&&$params['offset'] != "")
			$criteria->offset=$params['offset'];
		
		if(array_key_exists('limit',$params)&&! is_null($params['limit'])&&$params['limit'] != "")
			$criteria->limit=$params['limit'];
		
		return Activo::model()->findAll($criteria);
	
	}
	
	public static function getTipoActivos ($params=array(),$activo=1)
	{
		
		$criteria = new CDbCriteria;
		$criteria->condition = "t.activo = :activo";
		$criteria->params = array("activo"=>1);
		
		if(array_key_exists('id_tipo_activo', $params)&&!is_null($params['id_tipo_activo'])&&$params['id_tipo_activo']!="")
		{
			$criteria->addCondition("t.id = :idTipoActivo");
			$criteria->params[':idTipoActivo']=$params['id_tipo_activo'];
			
		}
		
		if(array_key_exists('id_activo', $params)&&!is_null($params['id_activo'])&&$params['id_activo']!="")
		{
			$criteria->addCondition("cmms_activo.id = :idActivo");
			$criteria->params[':idActivo']=$params['id_activo'];
			$criteria->join="RIGHT JOIN cmms_activo ON t.id = cmms_activo.id_tipo_activo";
			$criteria->distinct = true;
			
		}
		
		$criteria->order="nombre ASC";
			
		return TipoActivo::model()->findAll($criteria);
	}

	public static function getOtActivo($params=array(),$activo=1)
	{
		
		/*
		*
		* Possible params
		* fechaDesde
		* fechaHasta
		* id_activo
		* tipoMantenimiento
		* id_calendario
		* id_tipo_Activo
		
		
		$flag_fecha_desde = false;
		$flag_fecha_hasta = false;
		$flag_id_activo = false;
		$flag_tipoMantenimiento = false;
		$flag_id_calendario = false;
		$flag_id_tipo_activo = false;
		
		
		//print_r($params['tipoMantenimiento']);
		
		$sql="SELECT cmms_calendario.id FROM cmms_calendario ";
		
		if(array_key_exists('id_tipo_activo', $params)&&! is_null($params['id_tipo_activo'])&&$params['id_tipo_activo']!="")
		{
			$sql = $sql." LEFT JOIN cmms_activo ON cmms_calendario.id_activo = cmms_activo.id";
			$flag_id_tipo_activo = true;
		}
		
		$sql=$sql." WHERE cmms_calendario.activo = :activo";

		
		if(array_key_exists('fechaDesde', $params))
		{
		$flag_fecha_desde = true;
		$sql = $sql." AND fechaRealizacion >= :fechaDesde";
		}
		
		if(array_key_exists('fechaHasta', $params))
		{
		$flag_fecha_hasta = true;
		$sql = $sql." AND fechaRealizacion <= :fechaHasta";
		}
		
		if(array_key_exists('id_activo', $params))
		{
		$flag_id_activo = true;
		$sql = $sql." AND id_activo = :idActivo";
		}
		
		if(array_key_exists('id_calendario', $params))
		{
		$flag_id_calendario = true;
		$sql = $sql." AND id = :idCalendario";
		}
		
		if(array_key_exists('tipoMantenimiento', $params))
		{
			$flag_tipoMantenimiento = true;
			$sql=$sql." AND (";
			foreach($params['tipoMantenimiento'] as $key => $tipoMantenimiento)
			{
				if($tipoMantenimiento == end($params['tipoMantenimiento']))
					$sql=$sql."tipoMantenimiento = :tipoMantenimiento_".$key;
				else
					$sql=$sql."tipoMantenimiento = :tipoMantenimiento_".$key." OR ";
			}
			$sql=$sql.")";
		}
		
		if($flag_id_tipo_activo)
			$sql = $sql." AND cmms_activo.id_tipo_activo = ".$params['id_tipo_activo'];
			
		
		$sql_0='SELECT DISTINCT id_ot FROM cmms_calendarioxot WHERE id_calendario IN ('.$sql.') ORDER BY id_ot ASC';
				
		$command = Yii::app()->db->createCommand($sql_0);
		
		$command->bindValue(':activo',$activo,PDO::PARAM_INT);
		
		if($flag_fecha_desde)
		{
			$params['fechaDesde']=date('Y-m-d', strtotime($params['fechaDesde']));
			$command->bindValue(':fechaDesde',$params['fechaDesde'],PDO::PARAM_STR);
		}
		
		if($flag_fecha_hasta)
		{
			$params['fechaHasta']=date('Y-m-d', strtotime($params['fechaHasta']));
			$command->bindValue(':fechaHasta',$params['fechaHasta'],PDO::PARAM_STR);
		}
		
		if($flag_id_activo)
			$command->bindValue(':idActivo',$params['id_activo'],PDO::PARAM_STR);
			
		if($flag_id_calendario)
			$command->bindValue(':idCalendario',$params['id_calendario'],PDO::PARAM_INT);
		
		if($flag_tipoMantenimiento)
		{
			foreach($params['tipoMantenimiento'] as $key => $tipoMantenimiento)
			{
				$command->bindValue(':tipoMantenimiento_'.$key,$tipoMantenimiento,PDO::PARAM_STR);
			}

		}
			
		//if($flag_id_tipo_activo)
		//	$command->bindValue(':idTipoActivo',$params['id_tipo_activo'],PDO::PARAM_INT);
		
			 
		return $command->queryAll();
		
		
	}
	
	public static function getCalendarios($params=array())
	{
		$flag_join_cmms_calendarioxot = false;
		$flag_join_cmms_activo = false;
		
		$criteria = new CDbCriteria;
		$criteria->condition = "t.activo = :activo";
		$criteria->params = array("activo"=>1);
		
		if(array_key_exists('id_ot', $params)&&!is_null($params['id_ot'])&&$params['id_ot']!="")
		{
			$flag_join_cmms_calendarioxot = true;
			$criteria->addCondition("cmms_calendarioxot.id_ot = :idOt");
			$criteria->params[':idOt']=$params['id_ot'];
			
		}
		
		if(array_key_exists('id_activo', $params)&&!is_null($params['id_activo'])&&$params['id_activo']!="")
		{
			$criteria->addCondition("t.id_activo = :idActivo");
			$criteria->params[':idActivo']=$params['id_activo'];
			
		}
		
		if(array_key_exists('estado', $params)&&!empty($params['estado']))
		{
			$condition = "(";
			foreach($params['estado'] as $key => $estado)
			{
				if(end($params['estado'])!= $estado)
				{
					$condition = $condition."realizado = :idEstado_".$key." OR ";
					$criteria->params[':idEstado_'.$key]=$estado;
				}
				else
				{
					
					$condition = $condition."realizado = :idEstado_".$key;
					$criteria->params[':idEstado_'.$key]=$estado;
				}
			}
			
			$condition = $condition.")";
			
			$criteria->addCondition($condition);
			
		}

		if(array_key_exists('id_tipo_activo', $params))
		{
			$criteria->addCondition('cmms_activo.id_tipo_activo=:idTipoActivo');
			$criteria->params[':idTipoActivo']=$params['id_tipo_activo'];
			$flag_join_cmms_activo = true;	
		}
		
		if($flag_join_cmms_calendarioxot)
			$criteria->join = 'LEFT JOIN cmms_calendarioxot ON t.id=cmms_calendarioxot.id_calendario';
		
		if($flag_join_cmms_activo)
			$criteria->join = 'LEFT JOIN cmms_activo ON t.id_activo = cmms_activo.id';

		$criteria->order="t.id ASC";
			
		return Calendario::model()->with('mantenimiento')->findAll($criteria);
		
	}
	
	public static function getSumSuministros($params=array(),$activo=1)
	{
		$flag_id_calendario = false;
		
		$sql = "SELECT SUM(cantidad*precioUnitario) FROM cmms_suministro_x_calendario WHERE activo = :activo";

		
		
		if(array_key_exists('id_calendario', $params))
		{
			$sql = $sql." AND id_calendario = :idCalendario";
			$flag_id_calendario = true;
		}
		
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':activo',$activo,PDO::PARAM_INT);
		
		if($flag_id_calendario)
			$command->bindValue(':idCalendario',$params['id_calendario'],PDO::PARAM_INT);
		
		return $command->queryScalar();
		
	}

	public static function getProblemas($params,$activo=1)
	{
		
		$flag_id_activo=false;
		$flag_id_problema = false;
		
		$sql="SELECT cmms_problema_x_ot.id, cmms_problema.id, cmms_problema.problema, COUNT( cmms_problema.id ) AS incidencias
		FROM cmms_problema_x_ot
		RIGHT JOIN cmms_problema ON cmms_problema_x_ot.id_problema = cmms_problema.id
		WHERE cmms_problema_x_ot.activo = :activo ";
		 
		if(isset($params['id_activo'])&&!is_null($params['id_activo'])&&$params['id_activo']!="")
		{
			$sql=$sql."AND cmms_problema.id_activo=:idActivo ";
			$flag_id_activo = true;
		}
		
		if(isset($params['id_problema'])&&!is_null($params['id_problema'])&&$params['id_problema']!="")
		{
			$sql=$sql."AND cmms_problema.id=:idProblema ";
			$flag_id_problema = true;
		}
		
		$sql=$sql."GROUP BY cmms_problema.id ORDER BY cmms_problema.problema ASC, incidencias DESC";
		
		$command=Yii::app()->db->createCommand($sql);
		if($flag_id_activo)
			$command->bindValue(':idActivo',$params['id_activo'],PDO::PARAM_INT);
			
		if($flag_id_problema)
			$command->bindValue(':idProblema',$params['id_problema'],PDO::PARAM_INT);
			
		$command->bindValue(':activo',$activo,PDO::PARAM_INT);
		
		return $command->queryAll();		
				
		
	}
	
	public static function getCausas($params,$activo=1)
	{
	
		$flag_id_problema = false;
		
		$sql="SELECT cmms_causa.nombre, COUNT(id_causa) as incidencias
		FROM cmms_problema_x_ot
		LEFT JOIN cmms_causa ON cmms_problema_x_ot.id_causa = cmms_causa.id
		WHERE cmms_problema_x_ot.activo = :activo ";
		
		if(isset($params['id_problema'])&&!is_null($params['id_problema'])&&$params['id_problema']!="")
		{
			$sql=$sql."AND cmms_problema_x_ot.id_problema=:idProblema ";
			$flag_id_problema = true;
		}
		
		$sql = $sql. "GROUP BY cmms_problema_x_ot.id_causa ORDER BY incidencias DESC";
		
		$command = Yii::app()->db->createCommand($sql);
		
		$command->bindValue(':activo',$activo,PDO::PARAM_INT);

		
		if($flag_id_problema)
			$command->bindValue(':idProblema',$params['id_problema'],PDO::PARAM_INT);
			

		
		return $command->queryAll();

	}
	
	public static function getSuministros($params=array(),$activo=1)
	{
	
	
		$flag_unidades = false;
		$flag_fecha = false;
		$flag_id_suministro = false;
		$flag_id_activo = false;
		
		$sql="SELECT id_calendario, id_suministro, cantidad
		FROM cmms_suministro_x_calendario
		LEFT JOIN cmms_calendario ON cmms_suministro_x_calendario.id_calendario = cmms_calendario.id
		WHERE ";
		
		if(isset($params['id_suministro'])&&!is_null($params['id_suministro'])&&$params['id_suministro']!="")
		{
			$sql=$sql." id_suministro = :idSuministro ";
			$flag_id_suministro = true;
		}
		 
		
		
		$sql=$sql." AND id_calendario IN (SELECT id
		FROM cmms_calendario
		WHERE cmms_calendario.activo = :activo";
		
		if( array_key_exists('id_activo',$params)&&! is_null($params['id_activo']) && $params['id_activo'] != "" )
		{
			$sql=$sql." AND cmms_calendario.id_activo = :idActivo ";
			$flag_id_activo=true;
		}
		
		if(isset($params['tipoCalendario'])&& in_array(Calendario::TYPE_TIEMPO, $params['tipoCalendario']))
		{
		 	$params['fechaDesde']=date('Y-m-d', strtotime($params['fechaDesde']));
		 	$params['fechaHasta']=date('Y-m-d', strtotime($params['fechaHasta']));


		 	
		 	$sql=$sql." AND ((fechaARealizar >=  '".$params['fechaDesde']."'
		 	AND fechaARealizar <=  '".$params['fechaHasta']."')";
		 	$flag_fecha = true;
		}
		
		
		if(isset($params['tipoCalendario'])&& in_array(Calendario::TYPE_UNIDADES, $params['tipoCalendario']))		
		{
			if($flag_fecha)
				$sql=$sql." OR ";
			else
				$sql=$sql." AND ";
			
			$sql=$sql." (unidadesARealizar IS NOT NULL OR unidadesARealizar != '')";

		}
		
		
		
		if($flag_fecha)
				$sql=$sql.")";
		
		$sql=$sql." AND realizado = 0) 
		AND cmms_suministro_x_calendario.activo = :activo
		ORDER BY cmms_calendario.id_activo ";
		
		
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue('activo',$activo,PDO::PARAM_INT);
		if($flag_id_suministro)
			$command->bindValue('idSuministro',$params['id_suministro'],PDO::PARAM_INT);
			
		if($flag_id_activo)
		{
			$command->bindValue('idActivo',$params['id_activo'],PDO::PARAM_INT);
		}
		
		return $command->queryAll();
		
	}
	
	public function getListaSuministros($params=array(),$activo=1)
	{
				
		$flag_unidades = false;
		$flag_fecha = false;
		$flag_id_suministro = false;
		$flag_id_activo = false;
		
		//echo var_dump($params,true);
		
		$sql_0="SELECT DISTINCT id_suministro
		FROM cmms_suministro_x_calendario
		WHERE id_calendario IN (SELECT id
		FROM cmms_calendario
		WHERE cmms_calendario.activo = :activo";
		
		if(isset($params['tipoCalendario'])&& in_array(Calendario::TYPE_TIEMPO, $params['tipoCalendario']))
		{
		 	$params['fechaDesde']=date('Y-m-d', strtotime($params['fechaDesde']));
		 	$params['fechaHasta']=date('Y-m-d', strtotime($params['fechaHasta']));


		 	
		 	$sql_0=$sql_0." AND ((fechaARealizar >=  '".$params['fechaDesde']."'
		 	AND fechaARealizar <=  '".$params['fechaHasta']."')";
		 	$flag_fecha = true;
		}
		
		
		if(isset($params['tipoCalendario'])&& in_array(Calendario::TYPE_UNIDADES, $params['tipoCalendario']))		
		{
			if($flag_fecha)
				$sql_0=$sql_0." OR ";
			else
				$sql_0=$sql_0." AND ";
			
			$sql_0=$sql_0." (unidadesARealizar IS NOT NULL OR unidadesARealizar != '')";

		}
		
		if($flag_fecha)
				$sql_0=$sql_0.")";
				
		if( array_key_exists('id_activo',$params)&&! is_null($params['id_activo']) && $params['id_activo'] != "" )
		{
			$sql_0=$sql_0." AND cmms_calendario.id_activo = :idActivo ";
			$flag_id_activo=true;
		}
		
		$sql_0=$sql_0." AND realizado = 0) ORDER BY id_suministro ";
		
		
		
		
		$sql="SELECT id, nombre
		FROM cmms_suministro
		WHERE id IN(".$sql_0.") AND cmms_suministro.activo=:activo" ;
		
		if(isset($params['id_suministro'])&&!is_null($params['id_suministro'])&&$params['id_suministro']!="")
		{
			$sql=$sql." AND id = :idSuministro ";
			$flag_id_suministro = true;
		}

		$sql = $sql." ORDER BY nombre";
		
		$command = Yii::app()->db->createCommand($sql);
		
		$command->bindValue('activo',$activo,PDO::PARAM_INT);
		if($flag_id_suministro)
			$command->bindValue('idSuministro',$params['id_suministro'],PDO::PARAM_INT);
		
		if($flag_id_activo)
		{
			$command->bindValue('idActivo',$params['id_activo'],PDO::PARAM_INT);
		}
		
		return $command->queryAll();
		
		
	}
	
	public function getOt($params=array(),$activo=1)
	{
		
		$criteria = new CDbCriteria;
		$criteria->condition = "t.activo = :activo";
		$criteria->params = array("activo"=>1);
		
		
		if(array_key_exists('id_activo', $params)&&!is_null($params['id_activo'])&&$params['id_activo']!="")
		{
			$criteria->addCondition("id_activo = :idActivo");
			$criteria->params[':idActivo']=$params['id_activo'];
		}
		
		if(array_key_exists('id_tipo_activo', $params)&&!is_null($params['id_tipo_activo'])&&$params['id_tipo_activo']!="")
		{
			$criteria->addCondition("id_tipo_activo = :idTipoActivo");
			$criteria->params[':idTipoActivo']=$params['id_tipo_activo'];
			
		}
		
		if(array_key_exists('estado', $params)&&is_array($params['estado'])&&count($params['estado'])>0)
		{
			$estados="";
			foreach ($params['estado'] as $estado){
					if($estados=="")
						$estados = $estado;
					else
						$estados = $estados.",".$estado;
			}
			
			$params['estado']=$estados;
			
			$criteria->addCondition("estado IN (".$params['estado'].")");
			//$criteria->params[':Estado']=$params['estado']; Not working with bind in multiple selections, probably it takes them as string and not as integer
			
		}
		
		if(array_key_exists('id_responsable', $params)&&!is_null($params['id_responsable'])&&$params['id_responsable']!="")
		{
			$criteria->addCondition("responsable = :idResponsable");
			$criteria->params[':idResponsable']=$params['id_responsable'];
			
		}
		
		$criteria->order="t.id ASC";
		
		if(array_key_exists('offset',$params)&&! is_null($params['offset'])&&$params['offset'] != "")
			$criteria->offset=$params['offset'];
		
		if(array_key_exists('limit',$params)&&! is_null($params['limit'])&&$params['limit'] != "")
			$criteria->limit=$params['limit'];
		
		
		return Ot::model()->with('idActivo')->findAll($criteria);
	}
	
	public function dataInfMantenimientosExcel($ids)
	{
		
        $command = Yii::app()->db->createCommand("SELECT t.id as id,cmms_calendarioxot.id_ot as orden,t.tipoMantenimiento as tipoMant, 
        cmms_tipo_activo.nombre as idTipoActivo,cmms_activo.nombre as idActivo,cmms_tarea.nombre as tarea,
			cmms_componente.nombre as componente, cmms_mantenimiento.observaciones as indicaciones, 
			t.fechaARealizar as fechaProg,t.fechaRealizacion as fechaRealiz,t.unidadesARealizar as unidadesProg, 
			t.unidadesRealizacion as unidadesReal, t.observaciones as observaciones, horasParada as hrsParada,
			horasMdeO as hrsMdeO,t.costoHoraMdeO as costoHMdeO,t.costoMdeO as costoMdeO, 
			t.costosSuministros as costoSuministros, costosOutsourcing as costosOutsourcing,t.factura as factura, (SELECT username from tbl_user WHERE tbl_user.id = t.responsable) as responsable
			FROM cmms_calendario AS t
			LEFT JOIN (cmms_mantenimiento,cmms_tarea,cmms_componente,cmms_activo,cmms_tipo_activo,cmms_calendarioxot) ON (t.id_mantenimiento=cmms_mantenimiento.id 
			AND cmms_mantenimiento.id_tarea=cmms_tarea.id 
			AND cmms_mantenimiento.id_componente = cmms_componente.id 
			AND cmms_mantenimiento.id_activo = cmms_activo.id 
			AND cmms_activo.id_tipo_activo = cmms_tipo_activo.id
			AND t.id = cmms_calendarioxot.id_calendario)
			WHERE t.id IN (".$ids.")");
			
		return $command->queryAll();		
	}
	
	public function dataInfProblemasCausasExcel($ids)
	{
		$command = Yii::app()->db->createCommand('SELECT t.fecha as fecha,t.id_ot as ot,cmms_tipo_activo.nombre as idTipoActivo, 
		cmms_activo.nombre as idActivo,  cmms_problema.problema as problema, 
		cmms_causa.nombre as causa 
		FROM cmms_problema_x_ot AS t
		LEFT JOIN (cmms_problema,cmms_tipo_activo,cmms_activo,cmms_causa) ON (t.id_problema =cmms_problema.id 
		AND cmms_problema.id_activo = cmms_activo.id AND 
		cmms_activo.id_tipo_activo = cmms_tipo_activo.id AND 
		t.id_causa = cmms_causa.id)
		WHERE
		t.id IN ('.$ids.')');
		
		return $command->queryAll();
	}
	
	public function dataInfSuministrosExcel($ids){
		$command = Yii::app()->db->createCommand('SELECT cmms_suministro.nombre as suministro, 
		cmms_activo.nombre as activo, cmms_componente.nombre as componente, 
		cmms_calendario.fechaARealizar as progFecha, cmms_calendario.unidadesARealizar as progUnid, 
		t.cantidad as cant    
		FROM
		cmms_suministro_x_calendario as t 
		LEFT JOIN (cmms_suministro, cmms_activo, cmms_calendario,cmms_mantenimiento,cmms_componente) ON 
		(t.id_suministro = cmms_suministro.id AND 
		t.id_calendario = cmms_calendario.id AND 
		cmms_calendario.id_activo = cmms_activo.id AND 
		cmms_calendario.id_mantenimiento = cmms_mantenimiento.id AND
		cmms_mantenimiento.id_componente = cmms_componente.id)
		WHERE 
		t.id_calendario IN ('.$ids.')
		');
		
		return $command->queryAll();
		
	}
	*/
			
}