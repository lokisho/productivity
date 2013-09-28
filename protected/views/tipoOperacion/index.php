<?php
/* @var $this TipoOperacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipo Operacions',
);

$this->menu=array(
	array('label'=>'Create TipoOperacion', 'url'=>array('create')),
	array('label'=>'Manage TipoOperacion', 'url'=>array('admin')),
);
?>

<h1>Tipo Operacions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
