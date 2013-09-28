<?php
/* @var $this TipoOperacionController */
/* @var $model TipoOperacion */

$this->breadcrumbs=array(
	'Tipo Operacions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TipoOperacion', 'url'=>array('index')),
	array('label'=>'Create TipoOperacion', 'url'=>array('create')),
	array('label'=>'Update TipoOperacion', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TipoOperacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TipoOperacion', 'url'=>array('admin')),
);
?>

<h1>View TipoOperacion #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'activo',
	),
)); ?>
