<?php
/* @var $this TipoOperacionController */
/* @var $model TipoOperacion */

$this->breadcrumbs=array(
	'Tipo Operacions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TipoOperacion', 'url'=>array('index')),
	array('label'=>'Manage TipoOperacion', 'url'=>array('admin')),
);
?>

<h1>Create TipoOperacion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>