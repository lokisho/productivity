<?php
/* @var $this TipoOperacionController */
/* @var $model TipoOperacion */

$this->breadcrumbs=array(
	'Tipo Operacions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TipoOperacion', 'url'=>array('index')),
	array('label'=>'Create TipoOperacion', 'url'=>array('create')),
	array('label'=>'View TipoOperacion', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TipoOperacion', 'url'=>array('admin')),
);
?>

<h1>Update TipoOperacion <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>