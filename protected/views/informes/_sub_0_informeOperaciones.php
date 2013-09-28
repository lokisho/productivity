<div class="form">
<fieldset>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'inf-operaciones-form',
	'enableAjaxValidation'=>false,
)); ?>

<div class="row">
	<div class="span-3 first">
		<?php echo CHtml::label('Fecha Desde','Inf_Operaciones_fechaDesde',array('class'=>'input-1')); ?>
	</div>
	<div class="span-6">
	<?php 
	$this->widget('zii.widgets.jui.CJuiDatePicker',array(
		    'name'=>'Inf_Operaciones[fechaDesde]',
		    //'attribute'=>'fechaARealizar',
		    //'model'=>$calendario,
		    // additional javascript options for the date picker plugin
		    //'value'=>date('d-M-y',mktime(0, 0, 0, date("m")-1, date("d"),   date("Y"))),
		    'value'=>date('d-M-y',mktime(0, 0, 0, date("m"), date("d"),   date("Y"))),
		    'options'=>array(
		        'showAnim'=>'fold',
		        'dateFormat'=>'d-M-y',
		  ),
		  	//'htmlOptions'=>array('disabled'=>'disabled'),
		  ));   
	?>
	</div>	

	<div class="span-3">
		<?php echo CHtml::label('Fecha Hasta','Inf_Operaciones_fechaHasta',array('class'=>'input-1')); ?>
	</div>
	<div class="span-6 last">
	<?php 
	$this->widget('zii.widgets.jui.CJuiDatePicker',array(
		    'name'=>'Inf_Operaciones[fechaHasta]',
		    'value'=>date('d-M-y'),
		    //'attribute'=>'fechaARealizar',
		    //'model'=>$calendario,
		    // additional javascript options for the date picker plugin
		    'options'=>array(
		        'showAnim'=>'fold',
		        'dateFormat'=>'d-M-yy',
		  ),
		  	//'htmlOptions'=>array('disabled'=>'disabled'),
		  )); 
		  
	?>
	</div>	
</div>
<div class="clear"></div>

<div class="row">
	
	<div class="span-3 first">
		<?php echo CHtml::label('Proyecto','Inf_Operaciones_id_proyecto',array('class'=>'input-1')); ?>
	</div>
	<div class="span-6">
		<?php /*echo CHtml::dropDownList('Inf_Operaciones[id_proyecto]','empty',Proyecto::getProyectos(array('dropdown'=>'1')),array('empty'=>'Seleccione Uno','class'=>'span-6 last')); */
			
			echo CHtml::dropDownList('Inf_Operaciones[id_proyecto]','empty',Proyecto::getProyectos(array('dropdown'=>'1')),
			array(
				'empty'=>'Proyecto',
				'class'=>'span-6 last',
				'ajax'=> array(
						'type'=>'POST',
						'url'=>'/productivity/index.php/operacion/getSecciones',
						'update'=>'#Inf_Operaciones_id_seccion',
						'data'=>array('id_proyecto'=>'js:this.value'),
					),
				
				
				));
			
			
			
		?>
	</div>
	<div class="span-3">
		<?php echo CHtml::label('Usuario','Inf_Operaciones_id_usuario',array('class'=>'input-1')) ?>
	</div>
	<div class="span-6 last">
		<?php echo CHtml::dropDownList('Inf_Operaciones[id_usuario]','empty',User::getUsers(),array('empty'=>'Seleccione Uno','class'=>'span-6 last'));?>
	</div>

</div>
<div class="clear"></div>
<div class="row">
	<div class="span-3 fist">
		<?php echo CHtml::label('Estado','Inf_Operaciones_id_estado',array('class'=>'input-1')) ?>
	</div>
	<div class="span-6">
		<?php echo CHtml::dropDownList('Inf_Operaciones[id_estado]','empty',Estado::getEstados(),array('empty'=>'Seleccione Uno','class'=>'span-6 last'));?>
	</div>
		<div class="span-3">
		<?php echo CHtml::label('Seccion','Inf_Operaciones_id_seccion',array('class'=>'input-1')) ?>
	</div>
	<div class="span-6 last">
		<?php //echo CHtml::dropDownList('Inf_Operaciones[id_seccion]','empty',Seccion::getSecciones(array('dropdown'=>'1')),array('empty'=>'Seleccione Una','class'=>'span-6 last'));
		
		echo CHtml::dropDownList('Inf_Operaciones[id_seccion]','',array(),
				array('empty'=>'Seccion','class'=>'span-6 last'));
		
		?>
		
	</div>
</div>
<div class="clear"></div>


<div class="row buttons">
		<?php //echo CHtml::button('Ver Informe',array('onclick'=>'submitInformeMantenimientos()')); ?>
		<?php echo CHtml::ajaxButton('Mostrar Informe','informeOperaciones_1',
		array(
			'beforesend'=>'js:function(){
				$(".wait-container").addClass("flash-success").fadeIn(500).html("Se están generando el informe, por favor espere <div class=\'wait-3\'></div>");
			}',
			'type'=>'POST',
			'data'=>'js:$(\'#inf-operaciones-form\').serialize()',
			'success'=>'js:function(html){
				$(\'.inf-operaciones .informe-container\').html(html).fadeIn(500);
				$(".wait-container").removeClass("flash-error flash-success").fadeOut(500).html("");
			}',
			'error'=>'js:function(){
				$(".wait-container").addClass("flash-error").fadeIn(500).html("Ocurrió un error al generar el informe, por favor contacte al administrador");
			}',
		),array('id'=>'informeOperaciones','class'=>'submit-special-short')); ?>
		<?php echo CHtml::ajaxButton('Limpiar Filtros','informeOperaciones_0',
		array(
			'success'=>'js:function(html){
				$(\'.inf-operaciones .criterios\').html(html);
				$(\'.inf-operaciones .informe-container\').fadeOut(500).html("");

			}',
		
		),array('id'=>'clearInf_Mantenimientos','class'=>'submit-special-short')); ?>
	</div>

<?php $this->endWidget(); ?>
</fieldset>
</div>