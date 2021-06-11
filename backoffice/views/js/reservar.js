$(document).ready(function () {
    $("#cbx_especialidad").change(function () {
        $("#cbx_especialidad option:selected").each(function () {
            id_especialidad = $(this).val();
            $.post("<?php echo $ruta; ?>ajax/consulta_select.php", {
                id_especialidad: id_especialidad
            },
                function (data) {
                    $("#cbx_doctor").html(data);
                });
        });
    });
});
$(document).ready(function () {
    $("#cbx_doctor").change(function () {
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

            success: function (respuesta) {

                $("#idsala").val(resultado["ID_SALA_MEDICA"]);
                $("#numerosala").val(resultado["NUMERO"]);
                $("#edificiosala").val(resultado["EDIFICIO"]);
                $("#detallesala").val(resultado["DETALLE_UBICACION"]);

            }
        });
    });
});