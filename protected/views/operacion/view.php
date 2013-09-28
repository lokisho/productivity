<?php
/* @var $this OperacionController */
/* @var $model Operacion */

$this->breadcrumbs=array(
	'Operacions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Operacion', 'url'=>array('index')),
	array('label'=>'Create Operacion', 'url'=>array('create')),
	array('label'=>'Update Operacion', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Operacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Operacion', 'url'=>array('admin')),
);
?>

<h1>View Operacion #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_orden',
		'id_estado',
		'id_trabajador',
		'descripcion',
		'tiempoPlaneado',
		'tiempoReal',
		'fechaInicio',
		'horaInicio',
		'fechaFin',
		'horaFin',
		'fechaPausa',
		'horaPausa',
		'numPausa',
		'activo',
	),
)); ?>
