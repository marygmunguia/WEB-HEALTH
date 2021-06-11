  //CARGAR SALA
  $(document).ready(function() {
    $("#cbx_doctor").change(function() {
      var id_medico = $(this).val();

      var datos = new FormData();
      datos.append("id_medico", id_medico);

      $.ajax({

        url: "ajax/medico.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",

        success: function(respuesta) {

          $("#idsala").val(resultado["ID_SALA_MEDICA"]);
          $("#numerosala").val(resultado["NUMERO"]);
          $("#edificiosala").val(resultado["EDIFICIO"]);
          $("#detallesala").val(resultado["DETALLE_UBICACION"]);

        }
      });
    });
  });

/*=============================================
SUBIENDO LA FOTO DEL USUARIO
=============================================*/
$("#imagenNueva").change(function () {

    var imagen = this.files[0];

    /*=============================================
      VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
      =============================================*/

    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

        $(".imagenNueva").val("");

        swal({
            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });

    } else if (imagen["size"] > 2000000) {

        $(".imagenNueva").val("");

        swal({
            title: "Error al subir la imagen",
            text: "¡La imagen no debe pesar más de 2MB!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });

    } else {

        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function (event) {

            var rutaImagen = event.target.result;

            $(".previsualizar").attr("src", rutaImagen);

        })

    }
})

//Consultar expediente
$(".EXP").on("click", ".ComenzarC", function () {

    var Did = $(this).attr("Did");

    $("#idcliente").val(Did);

})


//RESTABLECER CONTRASEÑA 
$(".US").on("click", ".RestablecerContraseña", function () {

    var email = $(this).attr("email");

    $("#correoRestablecer").val(email);

})

//Consultar expediente
$(".EXP").on("click", ".ComenzarC", function () {

    var Cid = $(this).attr("Cid");

    $("#idcitamedica").val(Cid);

})


//Eliminar Salas Médicas
$(".SM").on("click", ".EliminarSalas", function () {

    var Did = $(this).attr("Did");

    $("#Did1").val(Did);

})


//Eliminar Citas Médicas
$(".EM").on("click", ".CancelarCita", function () {

    var Did = $(this).attr("idcitamedica");

    $("#idcitamedica").val(Did);

})


//Editar Salas Médicas
$(".SM").on("click", ".EditarSalas", function () {

    var Did = $(this).attr("Did");
    var datos = new FormData();

    datos.append("Did", Did);

    $.ajax({

        url: "ajax/SalasA.php",
        method: "POST",
        data: datos,
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,

        success: function (resultado) {

            $("#Did").val(resultado["ID_SALA_MEDICA"]);
            $("#numeroE").val(resultado["NUMERO"]);
            $("#edificioE").val(resultado["EDIFICIO"]);
            $("#ubicacionE").val(resultado["DETALLE_UBICACION"]);

        }

    })

})



//Eliminar Enfermedad Base
$(".EB").on("click", ".EliminarEB", function () {

    var Did = $(this).attr("Did");

    $("#Did1").val(Did);

})

//Editar Enfermedad Base
$(".EB").on("click", ".EditarEB", function () {

    var Did = $(this).attr("Did");
    var datos = new FormData();

    datos.append("Did", Did);

    $.ajax({

        url: "ajax/EnfermedadBase.php",
        method: "POST",
        data: datos,
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,

        success: function (resultado) {

            $("#Did").val(resultado["CODIGO_ENFERMEDAD_BASE"]);
            $("#nomE").val(resultado["NOMBRE_ENFERMEDAD_BASE"]);
            $("#obsE").val(resultado["OBS"]);

        }

    })
})


//Eliminar Sintoma Comun
$(".SC").on("click", ".EliminarSintoma", function () {

    var Did = $(this).attr("Did");

    $("#Did1").val(Did);

})

//Editar Sintoma Común
$(".SC").on("click", ".EditarSintoma", function () {

    var Did = $(this).attr("Did");
    var datos = new FormData();

    datos.append("Did", Did);

    $.ajax({

        url: "ajax/sintomasComunes.php",
        method: "POST",
        data: datos,
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,

        success: function (resultado) {

            $("#Did").val(resultado["CODIGO_SINTOMA_COMUN"]);
            $("#nombreE").val(resultado["NOMBRE_SINTOMA_COMUN"]);
            $("#obsE").val(resultado["OBS"]);

        }

    })
})





// Activar y Traducir el dataTable
$("#ME").DataTable({

    "language": {
        "sSearch": "Buscar:",
        "sEmptyTable": "No hay datos disponibles",
        "sZeroRecords": "No se han encontrado resultados",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total _TOTAL_",
        "SInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrando de un total de _MAX_ registrados)",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },

        "sLoadingRecords": "Cargando...",
        "sLengthMenu": "Mostrar _MENU_ registros"
    }
});





$("#emailValidar").change(function(){

	var usuario = $(this).val();

	var datos = new FormData();

	datos.append("validarUsuario", usuario);

	 $.ajax({
	    url:"ajax/usuarios.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		swal({
                    titltype: "error",
                    title: "¡ERROR!",
                    text: "ERROR: EL EMAIL YA EXISTE EN EL SISTEMA",
                    showConfirmButtom: true,
                    confirmButtomText: "Aceptar"
                }).then((result) => {
                    if (result.value) {
                        $("#emailValidar").val("");
                    }
                })

	    	}

	    }

	})
})