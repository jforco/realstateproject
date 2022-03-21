$(document).ready(function(){

    //CARGAR CIUDADES SEGUN ESTADO
    function cargar_ciudades(){
    	var id_estado = $("#estado_select option:selected").attr("id");
		$( "#ciudad_select" ).empty();
		if(id_estado == 'none'){
			return;
		}
		ciudades.forEach(element => {
			if(element['id_lugar'] == id_estado){
				$( "#ciudad_select" ).append( '<option value="' + element['nombre'] + '" id="' + element['id'] + '">'+ element['nombre'] +'</option>' );
			}
		});
		$( "#ciudad_select" ).append( '<option value="Otra Ciudad" id="Otra">Otra Ciudad</option>' );
    }

    //CARGAR ZONAS SEGUN CIUDAD
    function cargar_zonas(){
    	var id_ciudad = $("#ciudad_select option:selected").attr("id");
		if(id_ciudad == 'none'){
			$( "#zona_select" ).empty();
			return;
		} else if (id_ciudad == 'Otra') {
			$( "#zona_select" ).empty();
			$( "#zona_select" ).append( '<option value="none" id="none">Todas las Zonas</option>' );
			$( "#zona_select" ).append( '<option value="Otra Zona" id="Otra">Otra Zona</option>' );
			return;
		}
		let count = 0;
		zonas.forEach(element => {
			if(element['id_lugar'] == id_ciudad){
				if(count==0){
					$( "#zona_select" ).empty();
				}
				$( "#zona_select" ).append( '<option value="' + element['nombre'] + '" id="' + element['id'] + '">'+ element['nombre'] +'</option>' );
				count++;
			}
		});
		if(count==0){
			$( "#zona_select" ).empty();
			$( "#zona_select" ).append( '<option value="none" id="none">Todas las Zonas</option>' );
		}
		$( "#zona_select" ).append( '<option value="Otra Zona" id="Otra">Otra Zona</option>' );
    }

    //CARGAR MAPA SEGUN ZONA
    function cargar_mapa(inicial = false){
    	var latX, longY;

    	if(latitud && longitud && inicial){
    		latX = latitud;
    		longY = longitud;
    		$('#posx').val(latX);
		  	$('#posy').val(longY);
    	} else {
    		var id_lugar = $("#zona_select option:selected").attr("id");
	    	var lugares = zonas;
			if(id_lugar == 'none' || id_lugar == 'Otra'){
				var id_lugar = $("#ciudad_select option:selected").attr("id");
	    		var lugares = ciudades;
	    		if(id_lugar == 'Otra'){
					var id_lugar = $("#estado_select option:selected").attr("id");
		    		var lugares = estados;
				}
			}
			lugares.forEach(element => {
				if(element['id'] == id_lugar){
					latX = element['posX'];
					longY = element['posY'];
					//$('#posx').val(element['posX']);
					//$('#posy').val(element['posY']);
					return;
				}
			});
			$('#posx').val('');
		  	$('#posy').val('');
    	}
	    	
		map = new GMaps({
			div: '#map',
			zoom: 13,
			height: '300px',
			width: '100%', 
			lat: latX, 
			lng: longY,
			click: function(e) {
				$('#posx').val(e.latLng.lat());
				$('#posy').val(e.latLng.lng());
				map.removeMarkers();
				/*var icon = {
				    url: "img/icons/icon-azul.png", // url
				    scaledSize: new google.maps.Size(50, 70), // scaled size
				};*/
				map.addMarker({
				  	lat: e.latLng.lat(),
				  	lng: e.latLng.lng(),
				  	title: 'ubicacion del inmueble',
				  	//icon: icon,
				  	draggable: true,
				  	dragend: function(e){
				  		$('#posx').val(e.latLng.lat());
						$('#posy').val(e.latLng.lng());
				  	}
				});
			}
		});
		map.addMarker({
			lat: latX, 
		  	lng: longY,
			title: 'ubicacion del inmueble',
			draggable: true,
			dragend: function(e){
				$('#posx').val(e.latLng.lat());
		  		$('#posy').val(e.latLng.lng());
			}
		});
    }

    function carga_inicial(){
    	//RELLENADO DE DATOS PARA EDITAR
		$('option[value="'+tipo+'"]').prop('selected', true);
		if(fecha){
			$('option[value="fecha"]').prop('selected', true);
		}
		$('option[value="'+oferta+'"]').prop('selected', true);
		$('option[value="'+moneda+'"]').prop('selected', true);
		if(marcas.length == 0){
			$('#select-marcas').val('Ninguna')
		} else {
			$('#select-marcas').val(marcas);
		}
		$('option[value="'+estado_inmueble+'"]').prop('selected', true);

		if(estado){
			$('#estado_select').val(estado);
		}
		cargar_ciudades();
		if(ciudad){
			$('#ciudad_select').val(ciudad);
		}
		cargar_zonas();
		if(zona){
			$('#zona_select').val(zona);
		}
		cargar_mapa(true)
		if(dormitorios){
			$('#dormitorios').val(dormitorios);
		}
		if(pisos){
			$('#pisos').val(pisos);
		}
		if(baños){
			$('#baños').val(baños);
		}
		if(parqueos){
			$('#parqueos').val(parqueos);
		}
		if(año){
			$('#año_construccion').val(año);
		}

		if(elevador=='si'){
			$('#elevador-toggle').bootstrapToggle('on')
		}
		if(piscina=='si'){
			$('#piscina-toggle').bootstrapToggle('on')
		}
		if(baulera=='si'){
			$('#baulera-toggle').bootstrapToggle('on')
		}
		if(amoblado=='si'){
			$('#amoblado-toggle').bootstrapToggle('on')
		}
		if(agente!='0'){
			$('input[name="agente"][value="'+agente+'"]').attr("checked",true);
		}
    }

    carga_inicial()

    $( "#estado_select" ).change(function() {
		cargar_ciudades();
		$( "#ciudad_select" ).change();
	});	

	$( "#ciudad_select" ).change(function() {
		cargar_zonas();
		$( "#zona_select" ).change();
		add_ciudad_input($( "#ciudad_select" ).val());
	});	

	$( "#zona_select" ).change(function() {
		cargar_mapa();
		add_zona_input($( "#zona_select" ).val());			
	});	


	//botones mas menos de la interfaz
	$('#d1').click(function(){
		var valor = $("#dormitorios").val();
		var nuevoValor = parseFloat(valor) + 1;
		$("#dormitorios").val(nuevoValor);
	});
	$('#d2').click(function(){
		var valor = $("#dormitorios").val();
		if(parseFloat(valor)>0){
			var nuevoValor = parseFloat(valor) - 1;
			$("#dormitorios").val(nuevoValor);
		}
	});
	$('#g1').click(function(){
		var valor = $("#parqueos").val();
		var nuevoValor = parseFloat(valor) + 1;
		$("#parqueos").val(nuevoValor);
	});
	$('#g2').click(function(){
		var valor = $("#parqueos").val();
		if(parseFloat(valor)>0){
			var nuevoValor = parseFloat(valor) - 1;
			$("#parqueos").val(nuevoValor);
		}
	});
	$('#b1').click(function(){
		var valor = $("#baños").val();
		var nuevoValor = parseFloat(valor) + 1;
		$("#baños").val(nuevoValor);
	});
	$('#b2').click(function(){
		var valor = $("#baños").val();
		if(parseFloat(valor)>0){
			var nuevoValor = parseFloat(valor) - 1;
			$("#baños").val(nuevoValor);
		}
	});
	$('#p1').click(function(){
		var valor = $("#pisos").val();
		var nuevoValor = parseFloat(valor) + 1;
		$("#pisos").val(nuevoValor);
	});
	$('#p2').click(function(){
		var valor = $("#pisos").val();
		if(parseFloat(valor)>0){
			var nuevoValor = parseFloat(valor) - 1;
			$("#pisos").val(nuevoValor);
		}
	});

	//VALIDADOR DE INPUTS
	$(":input").click(function(){
		$(this).removeClass('is-invalid');
	});

	// botones de navegacion entre pills (siguiente's)
	$('#siguiente1').click(function(){
		$('#alerta1').remove();
		//validar que los inputs estan rellenados
		//to access DOM element, get first element from jquery object
		var input1 = $('#direccion')[0];
		var input2 = $('#precio')[0];
		
		if(input1.checkValidity() && input2.checkValidity()){
			$('#link_datos2').removeClass('disabled');
	    	$('#link_datos2').tab('show')
		} else {
			if(!input1.checkValidity()){
				$('#direccion').addClass('is-invalid');
			}
			if(!input2.checkValidity()){
				$('#precio').addClass('is-invalid');
			}
			$("#titulo-tab1").after('<div class="alert alert-danger mx-4" ' + 
				'role="alert" id="alerta1">Por favor, rellena los espacios necesarios' + 
				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">' + 
				'<span aria-hidden="true">&times;</span></button></div>');
		}
	    
	});
	$('#siguiente2').click(function(){
		$('#alerta2').remove();
		//validar que los inputs estan rellenados
		//to access DOM element, get first element from jquery object
		var input1 = $('#ciudad_select')[0];
		var input2 = $('#zona_select')[0];
		var input3 = $('#sup_terreno')[0];
		//validator for map input, move the pointer
		var input4 = $('#posx').val();
		var input5 = $('#posy').val();
		
		if(input1.checkValidity() && input2.checkValidity() && input3.checkValidity() && input4 && input5){
			$('#link_datos3').removeClass('disabled');
	    	$('#link_datos3').tab('show')
		} else {
			if(!input1.checkValidity()){
				$('#ciudad_select').addClass('is-invalid');
			}
			if(!input2.checkValidity()){
				$('#zona_select').addClass('is-invalid');
			}
			if(!input3.checkValidity()){
				$('#sup_terreno').addClass('is-invalid');
			}
			if(!input4 || !input5){
				//lanzar mensaje error
				$('#ModalMensaje').modal('show');
			}
			$("#titulo-tab2").after('<div class="alert alert-danger mx-4" ' + 
				'role="alert" id="alerta2">Por favor, rellena los espacios necesarios' + 
				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">' + 
				'<span aria-hidden="true">&times;</span></button></div>');
		}
	    
	});

	$('#atras1').click(function(){
		$('#link_datos1').tab('show');
	});
	$('#atras2').click(function(){
		$('#link_datos2').tab('show');
	});


	//ANIMACION DEL TELEFONO
	var myVar = setInterval(animacion, 12000);

	function animacion() {
	    var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
		$('#telefono').addClass('animated swing').one(animationEnd, function() {
			$(this).removeClass('animated swing');
		});
	} 	

		

	//CARGAR SEGMENTS
	$(".segment-select").Segment();

	//fecha
	function add_fecha_input(texto){
		if(texto == "Fecha"){
			//$('#fecha_entrega_div').removeClass('invisible');
			var elementoFechaHTML = '<div id="fecha_entrega_div"><label class="mr-2">Fecha de entrega: </label><input type="date" id="fecha_entrega_input" name="fecha_entrega" form="publicacion_form" class="form-control" style="width: 150px !important; display: inline !important;"></div>';
			var segmento = $('#entrega').next();
			if(!segmento.parent().has('#fecha_entrega_div').length){
				segmento.parent().append(elementoFechaHTML);
			}
		} else {
			//$('#fecha_entrega_div').addClass('invisible');
			$('#fecha_entrega_div').remove();
		}
	}

	if(fecha){
		add_fecha_input("Fecha");
		$('#fecha_entrega_input').val(fecha);
	}

	//EVENTO FECHA
	var objetoSegment = $('#entrega').next();
	var spanFecha = objetoSegment.children();
	spanFecha.click(function(){
		add_fecha_input($(this).text());
	});

	//EVENTO SELECCIONAR PORTADA 
	$('.boton_portada').click(function(){
		$(".dz-preview").removeClass('seleccionado');
		$(".foto").removeClass('seleccionado');
		let elemento = $(this).parent();
		elemento.parent().addClass("seleccionado");
		let nombre = elemento.next().text();
		//alert(nombre);
		$("#portada").val(nombre);
	});


	//cargar campos nuevos 
	//nueva ciudad
	function add_ciudad_input(texto){
		if(texto == "Otra Ciudad"){
			var elementoFechaHTML = '<div id="nueva_ciudad_div" class="row no-gutters py-1"><div class="col-auto"><label class="small mb-0 pr-1">Otra Ciudad: </label></div><div class="col"><input type="text" id="nueva_ciudad_input" name="nueva_ciudad" form="publicacion_form" class="form-control form-control-sm" placeholder="Agregue una nueva ciudad"></div></div>';
			var div = $('#ciudad_div');
			if(!div.parent().has('#nueva_ciudad_div').length){
				div.after(elementoFechaHTML);
			}
		} else {
			$('#nueva_ciudad_div').remove();
		}
	}
	//nueva zona
	function add_zona_input(texto){
		//if(texto == "none" || texto == "Otra Zona"){
		if(texto == "Otra Zona"){
			var elementoFechaHTML = '<div id="nueva_zona_div" class="row no-gutters py-1"><div class="col-auto"><label class="small mb-0 pr-1">Otra Zona: </label></div><div class="col"><input type="text" id="nueva_zona_input" name="nueva_zona" form="publicacion_form" class="form-control form-control-sm" placeholder="agregue una nueva zona"></div></div>';
			var div = $('#zona_div');
			if(!div.parent().has('#nueva_zona_div').length){
				div.after(elementoFechaHTML);
			}
		} else {
			$('#nueva_zona_div').remove();
		}
	}
});

	Dropzone.options.imageUpload = {
        maxFilesize  : 3,
        acceptedFiles: ".jpeg,.jpg,.png",
		paramName: "file", 
		maxFiles: object_target_photos,
		//addRemoveLinks: true, 
		//previewTemplate: document.querySelector('#template').innerHTML,
		//mensajes
		dictDefaultMessage: "Arrastre las fotos aqui o haga click para seleccionar",
		dictFallbackMessage: "El navegador no soporta subir fotos arrastrandolas aqui.",
		dictFileTooBig: "La imagen es mas grande que el máximo permitido (3MB)",
		dictInvalidFileType: "Tipo de archivo inválido",
		dictCancelUpload: "Cancelar subida",
		dictUploadCanceled: "Cancelado",
		dictRemoveFile: "Eliminar imagen",
		dictMaxFilesExceeded: "Cantidad máxima excedida",

		init: function () {
			this.on("addedfile", function(file) {
		        // Create the remove button
		        var removeButton = Dropzone.createElement(
		        		'<button type="button" class="btn btn-danger btn-sm py-0 px-1 btn-eliminar"><i class="fa fa-close"></i></button>'
		        	);
		        var selectButton = Dropzone.createElement(
		        		'<div class="text-center"><button type="button" class="btn btn-primary btn-sm py-0 px-1 mr-1">Portada</button></div>'
		        	);
		        // Capture the Dropzone instance as closure.
		        var _this = this;
		        // Listen to the click event
		        removeButton.addEventListener("click", function(e) {
		          	// Make sure the button click doesn't submit the form:
		          	e.preventDefault();
		          	e.stopPropagation();
		          	// Remove the file preview.
		          	_this.removeFile(file);  
		          	//al remover se lanza el evento removedfile que elimina la imagen del servidor
		        });
		        var elm = file.previewElement;
				var elemento = $(elm);
		        selectButton.addEventListener("click", function(e) {
		          	// Make sure the button click doesn't submit the form:
		          	e.preventDefault();
		          	e.stopPropagation();
		          	
					$(".dz-preview").removeClass('seleccionado');
					$(".foto").removeClass('seleccionado');
					elemento.addClass("seleccionado");
					$("#portada").val(file.name);
		        });
		        //seleccionar si es hijo unico

		        //obtener hermanos
		        console.log('hermanos:'+elemento.siblings('.seleccionado').length);
		        if(elemento.siblings('.seleccionado').length == 0){
		        	console.log('entro if')
		        	selectButton.click();
		        }
		        // Add the button to the file preview element.
		        file.previewElement.appendChild(selectButton);
		        file.previewElement.appendChild(removeButton);
		    });
		    this.on("removedfile", function (file) {
		        $.post({
		            url: '/eliminar_imagen',
		            data: {nombre_original: file.name, _token: $('[name="_token"]').val()},
		            dataType: 'json',
		        });
		    });
		    this.on('error', function(file, message, xhr) {
		    	let response = xhr.response;
      			let parse = JSON.parse(response, (key, value)=>{
			        return value;
			    });
      			$('.dz-error-message span').text(parse.message);
			    //$(file.previewElement).find('.dz-error-message').text(response);
			});
	    }
    };

    
		