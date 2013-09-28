<?php
/* @var $this OperacionController */
/* @var $model Operacion */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_orden'); ?>
		<?php echo $form->textField($model,'id_orden',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_estado'); ?>
		<?php echo $form->textField($model,'id_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_trabajador'); ?>
		<?php echo $form->textField($model,'id_trabajador'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tiempoPlaneado'); ?>
		<?php echo $form->textField($model,'tiempoPlaneado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tiempoReal'); ?>
		<?php echo $form->textField($model,'tiempoReal'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechaInicio'); ?>
		<?php echo $form->textField($model,'fechaInicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'horaInicio'); ?>
		<?php echo $form->textField($model,'horaInicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechaFin'); ?>
		<?php echo $form->textField($model,'fechaFin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'horaFin'); ?>
		<?php echo $form->textField($model,'horaFin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechaPausa'); ?>
		<?php echo $form->textField($model,'fechaPausa'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'horaPausa'); ?>
		<?php echo $form->textField($model,'horaPausa'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'numPausa'); ?>
		<?php echo $form->textField($model,'numPausa'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'activo'); ?>
		<?php echo $form->textField($model,'activo',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->