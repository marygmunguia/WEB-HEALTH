<?php
$tablaDB1 = "cliente";
$columna1 = "CODIGO_PERSONA";
$valor1 = $_SESSION["id_persona"];

$resultado1 = CitaControlador::ConsultarRegistroC($tablaDB1, $columna1, $valor1);
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Comienza tu reservación ya!</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="principal-paciente">Home</a></li>
          <li class="breadcrumb-item active">Reservaciones</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-body p-0">
            <div class="card-header">
              <h3 class="card-title">Completa todos los campos para reservar tu cita médica:</h3>
            </div>
            <form method="POST" enctype="multipart/form-data">
              <div class class="card-body">
                <div class="container"><br />
                  <div class="form-group">
                    <input type="hidden" name="idcliente" value="<?php echo $resultado1["ID_CLIENTE"]; ?>">
                    <label>Nombre del Paciente:</label>
                    <input type="text" id="nombre" class="form-control input-sm" name="nombre" value="<?php echo $_SESSION["nombre"] . " " . $_SESSION["apellido"]; ?>" disabled>
                  </div>
                  <div class="form-group"><label>Seleccionar Especialidad: </label><select required class="form-control" name="cbx_especialidad" id="cbx_especialidad">
                      <option value="0">SELECCIONE UNA ESPECIALIDAD</option>
                      <?php

                      $tablaDB = "consulta_especialidad_cita";
                      $columna = null;
                      $valor = null;

                      $resultado = CitaControlador::ConsultarRegistroC($tablaDB, $columna, $valor);

                      foreach ($resultado as $key => $value) {

                      ?>

                        <option value="<?php echo $value["ID_ESPECIALIDAD"]; ?>"><?php echo $value["NOMBRE_ESPECIALIDAD"]; ?></option>

                      <?php } ?>
                    </select></div>
                  <div class="form-group"><label>Seleccionar un médico:</label><select class="form-control" name="cbx_doctor" id="cbx_doctor" required>
                    </select></div>
                  <div class="form-group" id="SalaMedica"></div>
                  <div class="form-group"><label>Fecha de la Cita Médica:</label>
                    <input type="date" id="FechaCita" class="form-control" name="FechaCita" min="<?php echo date("Y-m-d"); ?>">
                  </div>
                  <div class="form-group"><label>Hora de la Cita Médica:</label>
                    <select name="hora_cita" id="hora_cita" class="form-control">
                    </select>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-block btn-1">Reservar ahora!</button>
                </div>

                <?php

                $agendar = new CitaControlador();
                $agendar->AgendarCitaC();

                ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<script>
  $(document).ready(function() {
    $("#cbx_especialidad").change(function() {
      $("#cbx_especialidad option:selected").each(function() {
        id_especialidad = $(this).val();
        $.post("<?php echo $ruta; ?>ajax/consulta_select.php", {
            id_especialidad: id_especialidad
          },
          function(data) {
            $("#cbx_doctor").html(data);
          });
      });
    });
  });

  $(document).ready(function() {
    $("#FechaCita").change(function() {
      $("#cbx_doctor option:selected").each(function() {
        id_medico = $(this).val();
        fecha = document.getElementById("FechaCita").value;
        $.post("<?php echo $ruta; ?>ajax/FechaCitaA.php", {
            id_medico: id_medico,
            fecha: fecha
          },
          function(data) {
            $("#hora_cita").html(data);
          });
      });
    });
  });

  $(document).ready(function() {
    $("#cbx_doctor").change(function() {
      $("#cbx_doctor option:selected").each(function() {
        Did = $(this).val();
        $.post("<?php echo $ruta; ?>ajax/MedicoSalaA.php", {
            Did : Did
          },
          function(data) {
            $("#SalaMedica").html(data);
          });
      });
    });
  });

  /*   $(document).ready(function() {
      $("#cbx_doctor").change(function() {

        var id_medico = document.getElementById("cbx_doctor").value;

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
    }); */

  /*   $(document).ready(function() {
      $("#cbx_doctor").change(function() {

        var id_medico = document.getElementById("cbx_doctor").value;
        
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
    }); */
</script>