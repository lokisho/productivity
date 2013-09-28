function pauseOperation(ID)
{
	
		jQuery.ajax({
			'beforeSend':function(){$(".wait-container .8").show().addClass("wait-1")},
			'complete':function(){$(".wait-container .8").hide().removeClass("wait-1")},
			'success':function(html){$(".wait-container .8").hide().removeClass("wait-1");
			window.location= "create";},
			'url':'pausar?id=8',
			'cache':false});
	
	return false;
	
}

function update(id)
{
	jQuery.ajax({
		'beforeSend':function(){
			$('.inf-operaciones .wait-container').html('<div>Cargando los datos </div><div class="wait-3">&nbsp;</div>').addClass('flash-success').removeClass('flash-error').show();
		},
		'success':function(html){
			$('.inf-operaciones .wait-container').html("").removeClass('flash-success flash-error').hide();
			$('.inf-operaciones .edit-form-container').html(html).hide().fadeIn(500);
			$('.inf-operaciones .edit-form-container .timepicker').addClass('span-3');
		},
		'error':function(){
			$('.inf-operaciones .wait-container').html('Ocurrió un error al cargar los datos').addClass('flash-error').removeClass('flash-success').show();
		},
		'url':'../operacion/update?id='+id,
		'cache':false,
	});
	return false;

}

function updateOperacion(id)
{
	jQuery.ajax({
			'beforeSend':function(){
				$('.inf-operaciones .wait-container').html('<div>Guardando Información </div><div class="wait-3">&nbsp;</div>').addClass('flash-success').removeClass('flash-error').show();
			},
			'success':function(){
				$('.inf-operaciones .edit-form-container').html("").fadeOut(500);
				$('.inf-operaciones .wait-container').html("").removeClass('flash-success flash-error').hide();
				$('#informeOperaciones').trigger('click');
			},
			'error':function(){
				$('.inf-operaciones .wait-container').html('Ocurrió un error al cargar los datos').addClass('flash-error').removeClass('flash-success').show();
			},
			'data':$('#operacion-form').serialize(),
			'type':'POST',
			'url':'../operacion/update?id='+id,
			'cache':false,
	});

	return false;
}