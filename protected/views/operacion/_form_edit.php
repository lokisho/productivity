<?php
/* @var $this OperacionController */
/* @var $model Operacion */
/* @var $form CActiveForm */
?>

<div class="form">
<fieldset>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'operacion-form',
	'enableAjaxValidation'=>false,
)); ?>

	<!-- <p class="note">Fields with <span class="required">*</span> are required.</p> -->

	<?php echo $form->errorSummary($model,'Por favor corrija los siguientes errores: <br>'); ?>
	<div class="span-14 subcontainer-1">
		<div class="row span-12 first">
			<?php echo $form->dropDownList($model,'id_proyecto',Proyecto::getProyectos(array('dropdown'=>'1')),array('empty'=>'Proyecto','class'=>'span-12 last')); ?>
		</div>
		<div class="clear"></div>
		
		<div class="row span-12">
			<?php echo $form->dropDownList($model,'id_seccion',Seccion::getSecciones(array('dropdown'=>'1')),
				array('empty'=>'Seccion','class'=>'span-12 last'));
			?>
		</div>
		<div class="clear"></div>
		
		<div class="row span-8">
			<?php echo $form->dropDownList($model,'id_usuario',User::getUsers(),array('empty'=>'Usuario','class'=>'span-8')); ?>
		</div>

	
		<div class="clear"></div>
	
		<div class="row">
			<?php // echo $form->labelEx($model,'id_estado'); ?>
			<?php //echo $form->textField($model,'id_estado'); ?>
			<?php //echo $form->error($model,'id_estado'); ?>
		</div>
	
		<div class="row span-14">
			<div>
			<?php echo $form->labelEx($model,'descripcion'); ?>
			</div>
			<div>
			<?php echo $form->textField($model,'descripcion',array('class'=>'span-13')); ?>
			</div>
		</div>
		<div class="clear"></div>
		
		
		<div class="row span-20">
			<div class="span-3">
				<div><?php echo $form->labelEx($model,'fechaPausa'); ?></div>
				<div>
					<?php 
					$this->widget('zii.widgets.jui.CJuiDatePicker',array(
						    //'name'=>'Inf_Operaciones[fechaDesde]',
						    'attribute'=>'fechaPausa',
						    'model'=>$model,
						    // additional javascript options for the date picker plugin
						    //'value'=>date('d-M-y',mktime(0, 0, 0, date("m")-1, date("d"),   date("Y"))),
						    //'value'=>date('d-M-y',mktime(0, 0, 0, date("m"), date("d"),   date("Y"))),
						    'options'=>array(
						        'showAnim'=>'fold',
						        'dateFormat'=>'d-M-y',
						  ),
						  	'htmlOptions'=>array('class'=>'span-3'),
						  ));   
					?>
				</div>
			</div>
			<div class="span-3">
				<div><?php echo $form->labelEx($model,'horaPausa'); ?></div>
				<div>
					<?php 
						$this->widget('application.extensions.timepicker.timepicker', array(
						    'model'=>$model,
						    'name'=>'horaPausa',
						    'options'=>array('class'=>'span-3'),
						));
					?>
					
				</div>
			</div>
			<div class="span-3">
				<div><?php echo CHtml::label('Fecha Inicio','Operacion_fechaInicio'); ?></div>
				<div><?php echo date('d-M-Y', strtotime($model->fechaInicio)); ?></div>
			</div>
			<div class="span-3">
				<div><?php echo CHtml::label('Hora Inicio','Operacion_horaInicio'); ?></div>
				<div><?php echo $model->horaInicio;?></div>
			</div>
			
			<div class="span-3">
				<div><?php echo CHtml::label('Fecha Fin','Operacion_fechaFin'); ?></div>
				<div><?php echo date('d-M-Y', strtotime($model->fechaFin)); ?></div>
			</div>
			
			<div class="span-3">
				<div><?php echo CHtml::label('Hora Fin','Operacion_horaFin'); ?></div>
				<div><?php echo $model->horaFin;?></div>
			</div>
		</div>
		
		
	</div><!-- subcontainer-1 -->
	<div class="span-5 subcontainer-2">
	
		<div class="row span-3">
			<?php echo $form->labelEx($model,'tiempoPlaneado'); ?>
			<?php echo $form->textField($model,'tiempoPlaneado',array('class'=>'span-3 last')); ?>
		</div>	
		<div class="clear"></div>
		
		<div class="row span-3">
			<?php //echo $form->labelEx($model,'tiempoReal'); 
				echo CHtml::label('Acumulado','Operacion_tiempoReal');
			?>
			<?php echo $form->textField($model,'tiempoReal',array('class'=>'span-3 last')); ?>
		</div>
		
		<div class="clear"></div>
		
		<div class="row span-3">
			<?php
				echo CHtml::checkbox('Operacion[reiniciar]',false)." ".CHtml::label('Reiniciar','Operacion_reiniciar');
				
			?>
		</div>
		
		
	</div><!-- subcontainer-2 -->
	<div class="clear"></div>
	<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar'); 
			if(Yii::app()->user->id == 'admin')
			echo CHtml::button('Actualizar',array('onclick'=>'updateOperacion('.$model->id.')'));
		?>
	</div>
	
<?php $this->endWidget(); ?>
</fieldset>
</div><!-- form -->