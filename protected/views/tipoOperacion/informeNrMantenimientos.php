<?php
/* @var $this InformeController */


$this->breadcrumbs=array(
	'Informe Mantenimientos NO realizados',
	
);

/*$this->menu=array(
	array('label'=>'List Estado', 'url'=>array('index')),
	array('label'=>'Create Estado', 'url'=>array('create')),
	array('label'=>'Manage Estado', 'url'=>array('admin')),
); */
?>

<div class="form-header">
<h1>Informe de Mantenimientos no realizados</h1>
</div>

<?php Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/informes.js'); ?>

<div class="inf-mantenimientos">
	<?php 
	$array = array('informe'=>$informe);
			if(isset($params))
				$array['params']=$params; 
	
	?>
	
	<div class="criterios">
		<?php $this->renderPartial('_sub_0_informeNrMantenimientos',array()); ?>
	</div>
	<div class="wait-container" style="display:none;">
	
	</div>
	
	
	<div class="levels-button form">
		<fieldset>
				<div class="span-1">
					<?php echo CHtml::button('1',array('onclick'=>'collapse(\'level-1\',\'none\',\'none\',1)')) ?>
				</div>
				<div class="span-1">
					<?php echo CHtml::button('2',array('onclick'=>'collapse(\'level-2\',\'.none\',\'.none\',2)')) ?>
				</div>
				<div class="span-1">
					<?php echo CHtml::button('3',array('onclick'=>'collapse(\'level-3\',\'.none\',\'.none\',3)')) ?>
				</div>
		</fieldset>

				
			<div>
						<?php
						$tipo_Calendario = array(Calendario::TYPE_PREV=>'Preventivo',Calendario::TYPE_CORR=>'Correctivo');
					?>
				<div class="span-1 first spacer-3 spacer-4">
					<img src ="<?php echo Yii::app()->request->baseUrl; ?>/images/<?php echo Calendario::TYPE_PREV; ?>.png" class="input-1" />
				</div>
				<div class="span-2">
					<?php echo CHtml::label($tipo_Calendario[Calendario::TYPE_PREV],''); ?>
				</div>
				<div class="clear"></div>
				<div class="span-1 first spacer-3 spacer-4">
					<img src ="<?php echo Yii::app()->request->baseUrl; ?>/images/<?php echo Calendario::TYPE_CORR; ?>.png" />
				</div>
				<div class="span-2">
					<?php echo CHtml::label($tipo_Calendario[Calendario::TYPE_CORR],''); ?>
				</div>

			</div>
			<div class="clear">&nbsp;</div>
		
	</div>
	
	<div class="informe-container">
		<?php $this->renderPartial('_sub_1_informeNrMantenimientos',$array); ?>
	</div>
	

</div>