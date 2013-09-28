<div>


<?php
	foreach($operaciones as $key => $operacion):
	if($key%2==0)
		$class="even";
	else
		$class = "odd";
	
?>
<div class="<?php echo $operacion->id.' '.$class;?>">	
	
	<div class="span-9">
		<?php 
		if(isset($operacion->idProyecto->nombre))
			echo $operacion->idProyecto->nombre;
		else
			echo "&nbsp;";
		?>
	</div>
	
	<div class="span-2">
		<?php
		echo $operacion->tiempoPlaneado; 
		?>
	</div>
	
	<div class="span-4">
		<span>Finaliza a:</span>
		<?php 
		echo $operacion->getHoraFin($operacion->horaInicio);
		//echo "Error en hora final";
		?>
	</div>	
	<div class="clear"></div>
	
	<div class="span-9">
	<?php
	if(isset($operacion->idSeccion->nombre))
				echo $operacion->idSeccion->nombre;
			else
				echo "&nbsp;";
	
	?>
	</div>
	<div class="span-2">
		<?php 
			if($operacion->id_estado==$operacion::EST_PAUSADO)
			{
				echo number_format($operacion->tiempoReal,2);
			}elseif($operacion->id_estado==$operacion::EST_ACTIVO)
			{
				$operacion->calculateTiempoReal();
				echo number_format($operacion->tiempoReal,2); 
			}else
			{
				echo number_format($operacion->tiempoReal,2); 
			}

		?>
	</div>
	<div class="span-2">
		<?php
		if ($operacion->id_estado==$operacion::EST_PAUSADO)
			echo "PAUSADA";
		?>
	</div>
	<div class="span-1 wait-container"></div>
	<div class="clear"></div>
	<div class="span-9">
		<?php 
			if(isset($operacion->descripcion)&&$operacion->descripcion != "")
				echo $operacion->descripcion;
			else
				echo "&nbsp;";
		?>
	</div>
	<div class="span-2">
		<?php
		if($operacion->id_estado==$operacion::EST_ACTIVO)
		{ 
			$beforeSend='js:function(){$(".wait-container .'.$operacion->id.'").show().addClass("wait-1")}';
			$complete = 'js:function(){$(".wait-container .'.$operacion->id.'").hide().removeClass("wait-1")}';
			$success= 'js:function(html){$(".wait-container .'.$operacion->id.'").hide().removeClass("wait-1");
			window.location= "create";}'; 
			
			echo CHtml::ajaxButton('Pausar', 'pausar?id='.$operacion->id, array(
			'beforeSend'=>$beforeSend,
			'complete'=>$complete,
			'success'=>$success,
			 ),array ( )); 
		 
		 }elseif($operacion->id_estado==$operacion::EST_PAUSADO)
		 {
	
			$beforeSend='js:function(){$(".wait-container .'.$operacion->id.'").show().addClass("wait-1")}';
			$complete = 'js:function(){$(".wait-container .'.$operacion->id.'").hide().removeClass("wait-1")}';
			$success= 'js:function(html){$(".wait-container .'.$operacion->id.'").hide().removeClass("wait-1");
			window.location= "create";}'; 
			
			echo CHtml::ajaxButton('Reiniciar', 'reiniciar?id='.$operacion->id, array(
			'beforeSend'=>$beforeSend,
			'complete'=>$complete,
			'success'=>$success,
			 ),array ()); 	 
		 
		 }
		 ?>
	</div>
	<div class="span-2">
	<?php	
		//$(".list-container").hide().html(html).fadeIn(500);
		$beforeSend='js:function(){$(".wait-container .'.$operacion->id.'").show().addClass("wait-1")}';
		$complete = 'js:function(){$(".wait-container .'.$operacion->id.'").hide().removeClass("wait-1")}';
		$success= 'js:function(html){$(".wait-container .'.$operacion->id.'").hide().removeClass("wait-1");
		window.location= "create";}'; 
		
		echo CHtml::ajaxButton('Terminar', 'terminar?id='.$operacion->id, array(
		'beforeSend'=>$beforeSend,
		'complete'=>$complete,
		'success'=>$success,
		 ),array ('confirm'=>'Esta seguro que quiere terminar esta operación?')); 
	?>
	</div>
	<div class="clear"></div>
	
</div><!-- class="operacion" -->
<?php
	endforeach;
?>