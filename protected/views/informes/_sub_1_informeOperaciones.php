<div class="form">
<?php
if(! isset($params))
	$params = array();
$operaciones = $informe->getOperaciones($params);

if(count($operaciones)==0)
	echo '<div class="odd">No se encontraron datos para esos criterios</div>';

foreach($operaciones as $key => $operacion):
	if($key%2==0)
		$class="even";
	else
		$class = "odd";

?>
<div class="<?php echo $class; ?>">
	<div class="span-2">
		<?php 
		echo CHtml::link(date('d-M', strtotime($operacion->fechaInicio)),'#',array('onclick'=>'update('.$operacion->id.')'));
		?>
	</div>
	<div class="span-6">
		<?php
		if(isset($operacion->idProyecto->nombre)&&! is_null($operacion->idProyecto->nombre)&&$operacion->idProyecto->nombre!="")
		{
			echo $operacion->idProyecto->nombre;
			if(isset($operacion->idSeccion->nombre))
				echo "- ".$operacion->idSeccion->nombre;
		}else{
			echo "No se indicó proyecto";
				if(isset($operacion->idSeccion->nombre))
					echo "- ".$operacion->idSeccion->nombre;
		}
		?>
	</div>
	<div class="span-6">
		<?php
		if(isset($operacion->descripcion)&&! is_null($operacion->descripcion)&&$operacion->descripcion!="")
			echo $operacion->descripcion;
		else
			echo "No se indicó operación";
		?>
	</div>
	<div class="span-2">
		<?php echo number_format($operacion->tiempoPlaneado,2); ?>
	</div>
	<div class="span-2">
		<?php echo number_format($operacion->tiempoReal,2); ?>
	</div>
	<div class="span-2">
		<?php echo number_format($operacion->tiempoPlaneado-$operacion->tiempoReal,2); ?>
	</div>
	<div class="clear"></div>
</div><!-- class -->

<?php endforeach; //foreach($operaciones as $operacion): ?>
</div><!-- class="form" -->