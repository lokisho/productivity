<?php
/* @var $this OperacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Operacions',
);

$this->menu=array(
	array('label'=>'Create Operacion', 'url'=>array('create')),
	array('label'=>'Manage Operacion', 'url'=>array('admin')),
);
?>

<h1>Operacions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
