<?php
/* @var $this InformeController */


$this->breadcrumbs=array(
	'Informe Operaciones',
	
);

/*$this->menu=array(
	array('label'=>'List Estado', 'url'=>array('index')),
	array('label'=>'Create Estado', 'url'=>array('create')),
	array('label'=>'Manage Estado', 'url'=>array('admin')),
); */
?>

<div class="form-header">
<!-- <h1>Informe de Operaciones</h1> -->
</div>

<?php Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/productivity.js'); ?>

<div class="inf-operaciones">
	<?php 
	$array = array('informe'=>$informe);
			if(isset($params))
				$array['params']=$params; 
	
	?>
	
	<div class="criterios">
		<?php $this->renderPartial('_sub_0_informeOperaciones',array()); ?>
	</div>
	
	<div class="wait-container" style="display:none;">	
	</div>
	
	<div class="edit-form-container"></div>
	
	<div class="informe-container">
		<?php 
		if(array_key_exists('params', $array))
			$this->renderPartial('_sub_1_informeOperaciones',$array); 
		?>
	</div>
	

</div>