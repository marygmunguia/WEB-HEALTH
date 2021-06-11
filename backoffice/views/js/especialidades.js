
//Eliminar Salas Médicas
$(".EM").on("click", ".EliminarEspecialidad", function () {

    var Did = $(this).attr("Did");

    $("#Did1").val(Did);

})

//Editar Salas Médicas
$(".EM").on("click", ".EditarEspecialidad", function(){

	var idCliente = $(this).attr("Did");

	var datos = new FormData();
    datos.append("idCliente", idCliente);

    $.ajax({

      url:"ajax/especialidadA.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",

      success:function(respuesta){
      
      	   $("#Did").val(respuesta["ID_ESPECIALIDAD"]);
	       $("#nombreE").val(respuesta["NOMBRE_ESPECIALIDAD"]);
	       $("#descripcionE").val(respuesta["DESCRIPCION"]);
	       $("#duracionE").val(respuesta["DURACION_CITA"]);
	       $("#precioE").val(respuesta["PRECIO_CITA"]);
	  }

  	})

})