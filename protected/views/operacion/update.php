<?php
/* @var $this OperacionController */
/* @var $model Operacion */

$this->breadcrumbs=array(
	'Operacions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Operacion', 'url'=>array('index')),
	array('label'=>'Create Operacion', 'url'=>array('create')),
	array('label'=>'View Operacion', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Operacion', 'url'=>array('admin')),
);
?>

<h1>Update Operacion <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>