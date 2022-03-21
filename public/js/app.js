$(document).ready(function(){

	$('.precio_separador').each(function(){
		let nro = $(this).html();
		$(this).html(new Intl.NumberFormat('es-MX').format(nro));
	});

	function fecha_humano(date){
		let d = new Date(date);
		d.setDate(d.getDate() + 1);
		let meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		let diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
		let resp = diasSemana[d.getDay()] + ", " + d.getDate() + " de " + meses[d.getMonth()] + " de " + d.getFullYear();
		return resp;
	}

	$('.fecha_facil').each(function(){
		let fecha = $(this).html();
		$(this).html(fecha_humano(fecha));
	});

	function animationClick(element, animation){
	    element = $(element);
	    element.click(
	    function() {
	        element.addClass('animated ' + animation);
	        //wait for animation to finish before removing classes
	        window.setTimeout( function(){
	            element.removeClass('animated ' + animation);
	        }, 2000);
	    }
	  );
	}; 

	animationClick('#favorito_button','pulse');  

	$('body').keyup(function(e) {
        if(e.keyCode == 13) {
            let modal = $("#accesoModal").hasClass('show');
            if(!modal){
                $('#busqueda-form').submit();
            } else {
                if($('#register-title').hasClass('active')){
                    $('#registro_form').submit();
                } else if ($('#login-title').hasClass('active')) {
                    $('#login_form').submit();
                }
            }
        }
    });  

});

		