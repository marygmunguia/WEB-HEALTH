<?php
$tablaDB = "horario_medico";
$columna = "ID_MEDICO";
$valor = $_POST["cbx_doctor"];

$resultado = CitaControlador::ConsultarRegistroC($tablaDB, $columna, $valor);


$tablaDB1 = "cliente";
$columna1 = "CODIGO_PERSONA";
$valor1 = $_SESSION["id_persona"];

$resultado1 = CitaControlador::ConsultarRegistroC($tablaDB1, $columna1, $valor1);


?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Reservar Citas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="principal-paciente">Home</a></li>
                    <li class="breadcrumb-item active">Reservar</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body p-0">
                    <div class="card-header">
                        <h3 class="card-title">Selecciona el día y hora en que deseas tu cita:</h3>
                    </div>
                    <div id="calendario">
                    </div>
                </div>
            </div>
        </div>
</section>

<div class="modal fade" rol="dialog" id="AgregarCita">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="POST" action="agendarcita">

                <div class="modal-body">

                    <div class="box-body">
                        <div class="form-group">
                            <input type="hidden" name="idcliente" value="<?php echo $resultado["ID_CLIENTE"]; ?>">
                            <label>Nombre del Paciente:</label>
                            <input type="text" id="nombre" class="form-control input-sm" name="nombre" value="<?php echo $_SESSION["nombre"] . " " . $_SESSION["apellido"]; ?>" disabled>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Especialidad:</label>
                                    <input type="hidden" name="idespecialidad" value="<?php echo $resultado["ID_ESPECIALIDAD"]; ?>">
                                    <input type="text" id="especialidad" class="form-control input-sm" name="especialidad" value="<?php echo $resultado["NOMBRE_ESPECIALIDAD"]; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="hidden" name="idmedico" value="<?php echo $resultado["ID_MEDICO"]; ?>">
                                    <label>Médico:</label>
                                    <input type="text" id="medico" class="form-control input-sm" name="medico" value="<?php echo $resultado["NOMBRE"] . " " . $resultado["APELLIDO"]; ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Monto a Pagar:</label>
                                    <input type="hidden" name="precio" value="<?php echo $resultado["PRECIO_CITA"]; ?>">
                                    <input type="text" id="monto_pagar" class="form-control" name="monto_pagar" value="<?php echo $resultado["PRECIO_CITA"]; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Duración de la cita en Minutos:</label>
                                    <input type="text" id="duracion" class="form-control" name="duracion" value="<?php echo $resultado["DURACION_CITA"];?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="hidden" name="idsala" value="<?php echo $resultado["ID_SALA_MEDICA"]; ?>">
                                    <label>Consultorío:</label>
                                    <textarea name="sala" disabled id="sala" class="form-control" rows="4"><?php echo "EDIFICIO:" . $resultado["EDIFICIO"] . ", NÚMERO:" . $resultado["NUMERO"] . ", UBICACIÓN DETALLADA:" . $resultado["DETALLE_UBICACION"];  ?>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label>Fecha de la Cita Médica:</label>
                        <input type="hidden" name="fechacitam" id="fechacitam">
                            <input type="date" id="FechaCita" class="form-control" name="txt_fecha" disabled>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Seleccione la hora de la cita:</label>
                                    <select class="form-control" name="cbx_hInicio" id="cbx_hInicio">
                                        <?php

                                        //HORA ENTRADA
                                        $horaE = $resultado["hora_entrada"];
                                        $horaEArray = explode(":", $horaE);
                                        $i = $horaEArray[0] . ":" . $horaEArray[1] . ":" . $horaEArray[1];

                                        //DURACIÓN CITA
                                        $duracion = $resultado["DURACION_CITA"];

                                        //HORA SALIDA
                                        $horaS = $resultado["hora_salida"];
                                        $horaSArray = explode(":", $horaS);

                                        $horaFinal = DeterminarUltimaHora($duracion, $horaS, $horaSArray);

                                        //$horasProgramadas = array('00:00:00', '00:00:00');

                                        //$numero = 0;

                                        /* for ($elemento0 = 0; $elemento0 < count($horasProgramadas); $elemento0++) {

                                            if ($horasProgramadas[$elemento0] === $i) {

                                                $numero = $numero - 1;
                                            } else {

                                                $numero = $numero + 1;
                                            }
                                        }
 */
                                        //if ($numero == count($horasProgramadas)) {

                                        echo "<option value='$i'>$i</option>";

                                        //}


                                        // MOSTRAR LAS HORAS QUE CUMPLAN CON EL HORARIO
                                        do {

                                            $horas = calcularSumarhora($i, $duracion);

                                            /* $numero = 0;

                                            foreach ($horasProgramadas as $valor => $hP) {

                                                if ($horasProgramadas[$elemento] === $horas) {

                                                    $numero = $numero - 1;
                                                } else {

                                                    $numero = $numero + 1;
                                                }
                                            }
                                            for ($elemento = 0; $elemento < count($horasProgramadas); $elemento++) {

                                                if ($horasProgramadas[$elemento] === $horas) {

                                                    $numero = $numero - 1;
                                                } else {

                                                    $numero = $numero + 1;
                                                }
                                            } */

                                            //if ($numero == count($horasProgramadas)) {

                                            echo "<option value='$horas'>$horas</option>";

                                            // }

                                            $i = calcularSumarhora($i, $duracion);
                                        } while ($i < $horaFinal);

                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-1 btn-block">Agendar Cita</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- FUNCIONES IMPORTANTES -->
<?php

// DETERMINAR SI MOSTRAR LA ULTIMA HORA SI NO SOBRE PASA EL HORARIO
function DeterminarUltimaHora($duracion, $horaS, $horaSArray)
{
    if ($duracion < 30) {

        $horaFinal = calcularRestahora($horaS, $duracion);
    } elseif ($duracion == 30 and $horaSArray[1] == "30") {

        $horaFinal = calcularRestahora($horaS, $duracion);
    } elseif ($duracion == 30 and $horaSArray[1] == "00") {

        $horaFinal = calcularRestahora($horaS, $duracion);
    } else {

        $horaFinal = calcularRestahora($horaS, 60);
    }

    return $horaFinal;
}


//FUNCION PARA SUMAR MINUTOS A UNA HORA
function calcularSumarhora($horaInicial, $minutoAnadir)
{

    $segundos_horaInicial = strtotime($horaInicial);

    $segundos_minutoAnadir = $minutoAnadir * 60;

    $nuevaHora = date("H:i", $segundos_horaInicial + $segundos_minutoAnadir);

    return $nuevaHora . ":00";
}
//FUNCION PARA RESTAR MINUTOS A UNA HORA
function calcularRestahora($horaInicial, $minutoAnadir)
{

    $segundos_horaInicial = strtotime($horaInicial);

    $segundos_minutoAnadir = $minutoAnadir * 60;

    $nuevaHora = date("H:i", $segundos_horaInicial - $segundos_minutoAnadir);

    return $nuevaHora . ":00";
}

?>