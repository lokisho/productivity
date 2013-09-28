<?php
/* @var $this OperacionController */
/* @var $model Operacion */

$this->breadcrumbs=array(
	'Registrar',
);

$this->menu=array(
	array('label'=>'List Operacion', 'url'=>array('index')),
	array('label'=>'Manage Operacion', 'url'=>array('admin')),
);
?>

<!-- <h1>Create Operacion</h1> -->

<div class="form-container">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>

<div class="list-container">
<?php echo $this->renderPartial('_list', array('operaciones'=>Operacion::getOperaciones(array('estados'=>array($model::EST_ACTIVO,$model::EST_PAUSADO)))));?>
</div>
