<div class="form">
<?php
$id_calend_inf = "";

$estadosCalendario = Calendario::getNrEstados(); //get an array of Estados sin realizar

if(isset($params['Activo'])&&array_key_exists('id_activo', $params['Activo'])&&!is_null($params['Activo']['id_activo'])&&$params['Activo']['id_activo']!="")
	$params['TipoActivos']['id_activo']=$params['Activo']['id_activo'];
?>
<?php isset($params['TipoActivos']) ? $params_tipo_activo = $params['TipoActivos'] : $params_tipo_activo = array(); ?>
<?php if(isset($params['Calendario'])) //Copy the array Calendario to a temp array to determine if some tipo activo or activo are going to be shown.  The reason for this is because the array it's modified later in the code, so, we need to keep it clean.  params_temp if for tipoActivo and params_temp_2 is for activo
	{
	$params_temp_2=$params['Calendario'];
	}
	
	//This code is to only query NR calendarios.  This is repeteded later in the code, for query the calendarios.	
	if(!isset($params_temp_2['estado']) && empty($params_temp_2['estado']))
			foreach ($estadosCalendario as $key => $estado)
					$params_temp_2['estado'][]=$key;
	$params_temp=$params_temp_2;			
 ?>
<?php foreach($informe->getTipoActivos($params_tipo_activo) as $key => $tipoActivo): ?>
<?php 
	$params_temp['id_tipo_activo']=$tipoActivo->id;
	if(count($informe->getCalendarios($params_temp))>0): ?>

<div class="info">
	<div class="subtitle-1">
		<div class="span-18 first title-1" style="font-weight:bold;">
			<?php echo $tipoActivo->nombre; ?>
		</div><!-- span-18 first title-1 -->
		<div class="span-5 last">
			<?php echo CHtml::link('ocultar','#ta_'.$tipoActivo->id,array('onclick'=>'collapse(\'#ta_'.$tipoActivo->id.'\',\'#ocultarTA_'.$tipoActivo->id.'\',\'#mostrarTA_'.$tipoActivo->id.'\',0)','class'=>'internal-link ocultarTA','id'=>'ocultarTA_'.$tipoActivo->id)) ?>
			<?php echo CHtml::link('mostrar','#ta_'.$tipoActivo->id,array('onclick'=>'collapse(\'#ta_'.$tipoActivo->id.'\',\'#mostrarTA_'.$tipoActivo->id.'\',\'#ocultarTA_'.$tipoActivo->id.'\',1)','class'=>'internal-link hidden mostrarTA','id'=>'mostrarTA_'.$tipoActivo->id)) ?>
		</div>
		<div class="clear"></div>
	</div><!-- class="subtitle-1" -->
	<div class="clear"></div>
	<div class="container-tipo-activo" id="ta_<?php echo $tipoActivo->id; ?>">

		<?php $params['Activo']['id_tipo_activo'] = $tipoActivo->id; ?>
		<?php foreach ($informe->getActivos($params['Activo']) as $activo): ?>
		<?php
			$params_temp_2['id_activo']=$activo->id;
			//throw new CHttpException('403',print_r($params_temp_2,true));
			if(count($informe->getCalendarios($params_temp_2))>0):
		?>
		<div class="subtitle-1 spacer-7">
			<div class="span-17 first title-1 spacer-7">
				<?php echo $activo->nombre;  ?>
			</div>
			<div class="span-4 prepend-1 last">
			<?php echo CHtml::link('ocultar','#a_'.$activo->id,array('onclick'=>'collapse(\'#a_'.$activo->id.'\',\'#ocultarA_'.$activo->id.'\',\'#mostrarA_'.$activo->id.'\',0)','class'=>'internal-link ocultarA','id'=>'ocultarA_'.$activo->id)) ?>
			<?php echo CHtml::link('mostrar','#a_'.$activo->id,array('onclick'=>'collapse(\'#a_'.$activo->id.'\',\'#mostrarA_'.$activo->id.'\',\'#ocultarA_'.$activo->id.'\',1)','class'=>'internal-link hidden mostrarA','id'=>'mostrarA_'.$activo->id)) ?>
			</div><!-- class="span-4 prepend-1 last" -->
			<div class="clear"></div>
		</div><!-- class="subtitle-1 spacer-7" -->
		<div class="clear"></div>
		<div class="container-activo" id="a_<?php echo $activo->id; ?>">
			<?php 
			$params['Calendario']['id_activo']=$activo->id; 
			if(!isset($params['Calendario']['estado']) && empty($params['Calendario']['estado']))
				foreach ($estadosCalendario as $key => $estado)
						$params['Calendario']['estado'][]=$key;		
			?>
			<?php foreach ($informe->getCalendarios($params['Calendario']) as $keyC => $calendario): ?>
				<div class="<?php $keyC%2==0 ?  $class="odd" : $class="even"; echo $class; ?> spacer-8">
					<div class="row-1">
						<div class="span-1 first spacer-4">
							<img src ="<?php echo Yii::app()->request->baseUrl; ?>/images/<?php echo $calendario->tipoMantenimiento; ?>.png" />
						</div>
						<div class="span-3">
							<?php echo CHtml::label('Orden de Trabajo','',array('class'=>'input-2')); ?>
						</div>	
						<div class="span-2">
							<?php 
							$array_ot = $informe->getOtActivo(array('id_calendario'=>$calendario->id));
							if(!is_null($array_ot)&&count($array_ot)>0)
							{
								foreach($array_ot as $ot)
									echo CHtml::link($ot['id_ot'],'/cmms/index.php/ot/update/'.$ot['id_ot'],array('class'=>'internal-link'));
							}else{
								echo "Sin Asignar";
							};
							?>
						</div>
						<div class="span-2">
							<?php echo CHtml::label('Calendario','',array('class'=>'input-2')); ?>
						</div>
						<div class="span-1">
						<?php echo $calendario->id; 
							if($id_calend_inf=="")
								$id_calend_inf=$calendario->id;
							else
								$id_calend_inf=$calendario->id.",".$id_calend_inf;
						?>
						
						
							<?php //echo CHtml::link($calendario->id,'/cmms/index.php/ot/createMultiple#cal_'.$calendario->id,array('class'=>'internal-link')); ?>
						</div>
						<div class="span-2">
							<?php echo CHtml::label('Estado:','',array('class'=>'input-2')); ?>
						</div>
						<div class="span-2">
							<?php echo $estadosCalendario[$calendario->realizado]; ?>
						</div>
						<div class="span-3">
							<?php echo CHtml::label('Programado para:','',array('class'=>'input-2')) ?>
						</div>
						<?php if (isset($calendario->unidadesARealizar)&&!is_null($calendario->unidadesARealizar)&&$calendario->unidadesARealizar!=""): ?>
							<div class="span-2">
								<?php echo number_format((float) $calendario->unidadesARealizar,2); ?>
							</div>
							<div class="span-2">
								<?php echo $calendario->idActivo->idUnidadProductiva->nombre; ?>
							</div>
						<?php endif; ?>
						<?php if (isset($calendario->fechaARealizar)&&!is_null($calendario->fechaARealizar)&&$calendario->fechaARealizar!=""): ?>
							<div class="span-2">
								<?php echo $calendario->fechaARealizar; ?>
							</div>
						<?php endif; ?>
						<div class="clear"></div>
					</div><!-- class="row-1" -->
					<div class="row-2">
						<div class="span-2 first">
							<?php echo CHtml::label('Tarea','',array('class'=>'input-2')); ?>
						</div>
						<div class="span-4">
							<?php echo $calendario->mantenimiento->tarea->nombre; ?>
						</div>
						<div class="span-2">
							<?php echo CHtml::label('Componente','',array('class'=>'input-2')); ?>
						</div>
						<div class="span-4">
							<?php echo $calendario->mantenimiento->componente->nombre; ?>
						</div>
						<div class="span-2">
							<?php echo CHtml::label('Indicaciones','',array('class'=>'input-2')); ?>
						</div>
						<div class="span-8">
							<?php echo $calendario->mantenimiento->observaciones; ?>
						</div>
						<div class="clear"></div>
					</div><!-- row-2 -->
				</div><!-- class="<?php $keyC%2==0 ?  $class="odd" : $class="even"; echo $class; ?> spacer-8" -->

				<?php endforeach; ?>
		</div><!-- class="container-activo" id="a_<?php echo $activo->id; ?>" -->
		
		<?php endif;  //if(count($informe->getCalendarios($params_temp)>0): activo?>
		<?php endforeach; ?>
	</div><!-- class="container-tipo-activo" id="ta_<?php echo $tipoActivo->id; ?>" -->
	
</div>
<?php endif; //if(count($informe->getCalendarios($params_temp))>0): tipoActivo ?>
<? endforeach; ?>
<div class="form">
<div>
<hr>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'down-inf-mantenimientoNr-form',
	'enableAjaxValidation'=>false,
	'action'=>'/cmms/index.php/informes/downloadInformeMantenimientosNr',
)); ?>

<?php echo CHtml::hiddenField('ids',$id_calend_inf); ?>
<?php echo CHtml::submitButton('Bajar a excel'); ?>

<?php $this->endWidget(); ?>
</div>
</div>


</div><!-- class="form" -->