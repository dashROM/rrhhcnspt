// Uso del localStorage para asignar la clase activa al modulo en que se encuentra
if (localStorage.getItem("actual") != null) {

	if (localStorage.getItem("principal") == ".menu#undefined") {
		
		$(localStorage.getItem("inicial")).removeClass("active");
		$(localStorage.getItem("actual")).addClass("active");		

	} else {

		$(localStorage.getItem("inicial")).removeClass("active");
		$(localStorage.getItem("actual")).addClass("active");
		$(localStorage.getItem("principal")).addClass("active");
		$(localStorage.getItem("principal")).parent().addClass("menu-open");

	}	

}

$(document).ready(function() {

	/*=============================================
	//input Mask
	=============================================*/

	$(":input").inputmask();


	/*=============================================
	//Ubicador del menu de usuario
	=============================================*/

	// elementos de la lista
  var menu = $(".menu"); 

  // manejador de click sobre todos los elementos
  menu.click(function() {

  	// eliminamos active de todos los elementos
    menu.removeClass("active");

    // activamos el elemento clicado.
    $(this).addClass("active");

    $(this).parent().parent().siblings().addClass("active");

    var inicial = menu.attr('id');
    var actual = $(this).attr('id');
    var principal = $(this).parent().parent().siblings().attr('id');

    localStorage.setItem("inicial", ".menu#"+inicial);
    localStorage.setItem("actual", ".menu#"+actual);    
    localStorage.setItem("principal", ".menu#"+principal);

  });

});

// Configuración de validator jquery
$(document).ready(function() { 

	/*=============================================
	FUNCIONES PARA CAMBIAR LOS MENSAJES POR DEFECTO DEL PLUGIN DE VALIDACIÓN
	=============================================*/

	$.extend($.validator.messages, {
		required: "Este campo es obligatorio.",
		remote: "Por favor, rellena este campo.",
		email: "Por favor, escribe una dirección de correo válida",
		url: "Por favor, escribe una URL válida.",
		date: "Por favor, escribe una fecha válida.",
		dateISO: "Por favor, escribe una fecha (ISO) válida.",
		number: "Por favor, escribe un número entero válido.",
		digits: "Por favor, escribe sólo dígitos.",
		creditcard: "Por favor, escribe un número de tarjeta válido.",
		equalTo: "Por favor, escribe el mismo valor de nuevo.",
		accept: "Por favor, escribe un valor con una extensión aceptada.",
		maxlength: $.validator.format("Por favor, no escribas más de {0} caracteres."),
		minlength: $.validator.format("Por favor, no escribas menos de {0} caracteres."),
		rangelength: $.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
		range: $.validator.format("Por favor, escribe un valor entre {0} y {1}."),
		max: $.validator.format("Por favor, escribe un valor menor o igual a {0}."),
		min: $.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
	});

	/*=============================================
	FUNCIONES CON LOS DIFERENTES PATRONES CON EXPRESIONES REGULARES PARA LA VALIDACIÓN
	=============================================*/

	$.validator.addMethod("patron_letras", function (value, element) {

	    var pattern = /^[a-zA-Z]+$/;
	    return this.optional(element) || pattern.test(value);

	}, "El campo debe contener letras (azAZ)");

	$.validator.addMethod("patron_numeros", function (value, element) {

	    var pattern = /^[0-9]+$/;
	    return this.optional(element) || pattern.test(value);

	}, "El campo debe tener un valor numérico (0-9)");
    
    $.validator.addMethod("patron_numerosLetras", function (value, element) {

	    var pattern = /^[a-zA-Z0-9-]+$/;
	    return this.optional(element) || pattern.test(value);

	}, "El campo debe tener un valor Alfa Numérico (a-zA-Z0-9)");

	$.validator.addMethod("patron_numerosTexto", function (value, element) {

	    var pattern = /^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ .-]+$/;
	    return this.optional(element) || pattern.test(value);

	}, "Caracteres Especiales No Admitidos");

	$.validator.addMethod("patron_texto", function (value, element) {

	    var pattern = /^[A-Za-zñÑáéíóúÁÉÍÓÚ .]+$/;
	    return this.optional(element) || pattern.test(value);

	}, "Caracteres Especiales No Admitidos");

	$.validator.addMethod("patron_textoEspecial", function (value, element) {

	    var pattern = /^[^"'&%${}]*$/;
	    return this.optional(element) || pattern.test(value);

	}, "Caracteres Especiales No Admitidos");

});

/*======================================
INICIALIZANDO LOS FORMULARIOS SELECT2
========================================*/

$(document).ready(function() {

	var placeholder = "<i class='fas fa-search'></i> Elegir...";
   
  //Initialize Select2 Elements
  $('.select2').select2({

  	language: {

	    noResults: function() {

	      return "No hay resultado";

	    },
	    searching: function() {

	      return "Buscando...";

	    }
		},

		placeholder: placeholder,

    width: null,

    escapeMarkup: function(m) { 

    	return m;

    }
    
	});

 //Initialize Select2 Dinámico Elements
  $('.select2_dinamic').select2({
		tags: true,
		language: "es"
	});

    //Initialize Select2 Elements
  $('.select2bs4').select2({
		theme: 'bootstrap4',
		language: "es"
  });

})

/*======================================
CONVIRTIENDO EN MAYUSCULA LO INGRESADO DINAMICAMENTE
========================================*/
$(document).on("click", ".select2", function() {

	$('.select2-search__field').addClass('mayuscula');

})