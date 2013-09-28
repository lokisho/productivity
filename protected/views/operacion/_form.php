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
			<?php echo $form->dropDownList($model,'id_proyecto',Proyecto::getProyectos(array('dropdown'=>'1')),
			array(
				'empty'=>'Proyecto',
				'class'=>'span-12 last',
				'ajax'=> array(
						'type'=>'POST',
						'url'=>'getSecciones',
						'update'=>'#Operacion_id_seccion',
						'data'=>array('id_proyecto'=>'js:this.value'),
					),
				
				
				)); ?>
		</div>
		<div class="clear"></div>
		
		<div class="row span-12">
			<?php echo $form->dropDownList($model,'id_seccion',array(),
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
		
	</div><!-- subcontainer-1 -->
	<div class="span-5 subcontainer-2">	
		<div class="row span-3">
			<?php echo $form->labelEx($model,'tiempoPlaneado'); ?>
			<?php echo $form->textField($model,'tiempoPlaneado',array('class'=>'span-3 last')); ?>
		</div>	
		
	</div><!-- subcontainer-2 -->
	<div class="clear"></div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar'); ?>
	</div>
	
<?php $this->endWidget(); ?>
</fieldset>
</div><!-- form -->