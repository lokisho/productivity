<?php
/* @var $this OperacionController */
/* @var $data Operacion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_orden')); ?>:</b>
	<?php echo CHtml::encode($data->id_orden); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estado')); ?>:</b>
	<?php echo CHtml::encode($data->id_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_trabajador')); ?>:</b>
	<?php echo CHtml::encode($data->id_trabajador); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tiempoPlaneado')); ?>:</b>
	<?php echo CHtml::encode($data->tiempoPlaneado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tiempoReal')); ?>:</b>
	<?php echo CHtml::encode($data->tiempoReal); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaInicio')); ?>:</b>
	<?php echo CHtml::encode($data->fechaInicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('horaInicio')); ?>:</b>
	<?php echo CHtml::encode($data->horaInicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaFin')); ?>:</b>
	<?php echo CHtml::encode($data->fechaFin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('horaFin')); ?>:</b>
	<?php echo CHtml::encode($data->horaFin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaPausa')); ?>:</b>
	<?php echo CHtml::encode($data->fechaPausa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('horaPausa')); ?>:</b>
	<?php echo CHtml::encode($data->horaPausa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numPausa')); ?>:</b>
	<?php echo CHtml::encode($data->numPausa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />

	*/ ?>

</div>