$(document).ready(function(){
	//ACCIONES INICIALES
	hideBusquedaRapida();
	$( window ).resize(function() {
	  	hideBusquedaRapida();
	});

	function hideBusquedaRapida(){
		let width = $( window ).width();
	  	if(width<559){
	  		$('#formulario_collapse').removeClass('show');
	  	} else {
	  		$('#formulario_collapse').addClass('show');
	  	}
	}

	//VARIABLES GLOBALES
	var rango_alquiler = [0, 300, 600, 1000, 1500, 2000, 3000, 4000, 5000, 'Maximo'];
	var rango_venta = [0, 30000, 50000, 100000, 200000, 300000, 500000, 800000, 'Maximo']

	//CARGAS INICIALES
	cargar_datos_iniciales();
	cargar_ciudades()
	cargar_datos_iniciales2();
	cargar_zonas();
	cargar_precios();
	cargar_datos_iniciales3();
	


	//DATOS INICIALES
	function cargar_datos_iniciales(){
		//tipo_inmueble
		$('#inmueble_select option[value="'+tipo_inmueble+'"]').prop('selected', true);
		//tipo_oferta
		$('#oferta_select option[value="'+tipo_oferta+'"]').prop('selected', true);
		
		//seleccionar las opciones de cant de dormitorio
		if(dormitorios){
			dormitorios.forEach(element => {
				switch(element) {
				    case '1':
						$("#check1").prop("checked", true);
				        break;
				    case '2':
						$("#check2").prop("checked", true);
				        break;
				    case '3':
						$("#check3").prop("checked", true);
				        break;
				    case '4':
						$("#check4").prop("checked", true);
				        break;
				    default:
				} 
			});	
		}
		
		//moneda de busqueda
		if(moneda){
			if (moneda == 'dolares'){
				$("#moneda-sus").prop("checked", true);
			} else if(moneda == 'bolivianos') {
				$("#moneda-bs").prop("checked", true);
			} else {
				$("#moneda-sus").prop("checked", true);
				$("#moneda-bs").prop("checked", true);
			}
		} else {
			$("#moneda-sus").prop("checked", true);
			$("#moneda-bs").prop("checked", true);
		}

		//select orden de publicaciones
		if(orden){
			$('#orden_select option[value="'+orden+'"]').prop('selected', true);
		}

		//Estado
		$('#estado_select option[value="'+estado+'"]').prop('selected', true);
	}

	function cargar_datos_iniciales2(){
		//ciudad
		if(ciudad){
			$('#ciudad_select option[value="'+ ciudad +'"]').prop('selected', true);
		}
	}

	function cargar_datos_iniciales3(){
		//zona
		if(zona){
			$('#zona_select option[value="'+ zona +'"]').prop('selected', true);
		}

		//precio_minimo
		if(precio_minimo){
			$('#precio_min_select option[value="'+precio_minimo+'"]').prop('selected', true);
		}
		//precio_maximo
		if(precio_maximo){
			$('#precio_max_select option[value="'+precio_maximo+'"]').prop('selected', true);
		} else {
			$('#precio_max_select option[value="Maximo"]').prop('selected', true);
		}
		
	}

	//FUNCIONES PARA CIUDADES
	function cargar_ciudades(){
    	var id_estado = $("#estado_select option:selected").attr("id");
		$( "#ciudad_select" ).empty();
		if(id_estado == 'none'){
			return;
		}
		$( "#ciudad_select" ).append( '<option value="none" id="none">Todas las ciudades</option>' );
		ciudades.forEach(element => {
			if(element['id_lugar'] == id_estado){
				$( "#ciudad_select" ).append( '<option value="' + element['nombre'] + '" id="' + element['id'] + '">'+ element['nombre'] +'</option>' );
			}
		});
		$( "#ciudad_select" ).append( '<option value="Otra ciudad" id="Otra">Otra ciudad</option>' );

    }

	//FUNCIONES PARA ZONAS
    function cargar_zonas(){
    	var id_ciudad = $("#ciudad_select option:selected").attr("id");
		$( "#zona_select" ).empty();
		$( "#zona_select" ).append( '<option value="none" id="none">Todas las Zonas</option>' );
		if(id_ciudad == 'none'){
			return;
		} 
		let count = 0;
		zonas.forEach(element => {
			if(element['id_lugar'] == id_ciudad){
				$( "#zona_select" ).append( '<option value="' + element['nombre'] + '" id="' + element['id'] + '">'+ element['nombre'] +'</option>' );
				count++;
			}
		});
		if(count>0){
			$( "#zona_select" ).append( '<option value="Otra Zona" id="Otra">Otra zona</option>' );
		} 
    }

    $("#estado_select").change(function() {
		cargar_ciudades();
		cargar_zonas();
	});	
    $("#ciudad_select").change(function() {
		cargar_zonas();
	});	











    //FUNCIONES PARA PRECIOS
    function cargar_precios(){
    	cargar_precio_min();
    	cargar_precio_max();
    }

    function cargar_precio_min(){

    	
    	//let max = $("#precio_max_select option:selected").attr("value");
    	
    	//determinar el rango de numeros
    	let oferta_selected = $("#oferta_select").val();
    	let rango_base = (oferta_selected == 'Alquiler') ? rango_alquiler.slice() : rango_venta.slice();
    	let max = rango_base.slice(rango_base.length - 1);
    	//rellenar el rango a usar, segun el valor maximo que puede tener
    	let rango = [];
    	//if(max == null){
    	//	max = rango_base.slice(rango_base.length - 1);
    	//} 
    	for ( let i = 0; i < rango_base.length; i++ ) {
			if(rango_base[i] == max){
				break;
			}
			rango[i] = rango_base[i];
		}

		//poner el html
		$( "#precio_min_select" ).empty();
		rango.forEach(element => {
			$( "#precio_min_select" ).append( '<option value="' + element + '">'+ element +'</option>' );
		});

    }
    function cargar_precio_max(){
    	let min = 0;
    	//let min = $("#precio_min_select option:selected").attr("value");
    	
    	//determinar el rango de numeros
    	let oferta_selected = $("#oferta_select").val();
    	let rango_base = (oferta_selected == 'Alquiler') ? rango_alquiler.slice() : rango_venta.slice();

    	//rellenar el rango a usar, segun el valor maximo que puede tener
    	let rango = [];
    	//if(min == null){
    	//	min = 0;
    	//} 
    	for ( let i = 0; i < rango_base.length; i++ ) {
			if(rango_base[i] <= min){
				continue;
			}
			rango[rango.length] = rango_base[i];
		}

		//poner el html
		$( "#precio_max_select" ).empty();
		rango.forEach(element => {
			$( "#precio_max_select" ).append( '<option value="' + element + '">'+ element +'</option>' );
		});

    }

    
    $("#oferta_select").change(function(){
    	cargar_precios();
    });

	$("#orden_select").change(function(){
		$('#form_busqueda').submit();
	});

	
});