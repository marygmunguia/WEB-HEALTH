<?php

require_once "../controllers/citas.controlador.php";
require_once "../models/citas.modelos.php";

class AjaxMedico
{

    public $id_medico;

    public $fecha;

    public function ajaxBuscarMedico()
    {
        date_default_timezone_set('America/Tegucigalpa');

        $tabla = "horario_medico";
        $item = "ID_MEDICO";
        $valor = $this->id_medico;

        $respuesta = CitaControlador::ConsultarRegistroC($tabla, $item, $valor);

        $tabla1 = "cita_medica";
        $fbuscar = $this->fecha;

        $respuesta1 = CitaControlador::ConsultarRegistrosCompletos($tabla1, $item, $valor, $fbuscar);

        //HORA ENTRADA
        $horaE = $respuesta["HORA_ENTRADA"];
        $horaEArray = explode(":", $horaE);
        $i = $horaEArray[0] . ":" . $horaEArray[1] . ":" . $horaEArray[1];

        //DURACIÓN CITA
        $duracion =  $respuesta["DURACION_CITA"];

        //HORA SALIDA
        $horaS =  $respuesta["HORA_SALIDA"];
        $horaSArray = explode(":", $horaS);

        $horaFinal = DeterminarUltimaHora($duracion, $horaS, $horaSArray);

        $horaActual = date("H") . ':' . date("i") . ':' . date("s");
        $FechaActual = date("Y") . '-' . date("m") . '-' . date("d");

        $tablaHoras = "citas_pendientes";

        echo '<option value="0">SELECCIONA LA HORA DE TU CITA</option>';


        if ($fbuscar <> $FechaActual) {
            $validarHora = CitaControlador::ConsultarHoraValida($tablaHoras, $item, $valor, $fbuscar, $i);

            if (empty($validarHora)) {
                echo '<option value="' . $i . '">' . $i . '</option>';
            } else {
            }
        } else if ($fbuscar == $FechaActual) {

            if ($i > $horaActual) {
                $validarHora = CitaControlador::ConsultarHoraValida($tablaHoras, $item, $valor, $fbuscar, $i);

                if (empty($validarHora)) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                } else {
                }
            } else {
            }
        }

        // MOSTRAR LAS HORAS QUE CUMPLAN CON EL HORARIO
        do {

            $horas = calcularSumarhora($i, $duracion);

            if ($fbuscar <> $FechaActual) {

                $validarHora = CitaControlador::ConsultarHoraValida($tablaHoras, $item, $valor, $fbuscar, $horas);

                if (empty($validarHora)) {
                    echo '<option value="' . $horas . '">' . $horas . '</option>';
                } else {
                }
            } else if ($fbuscar == $FechaActual) {

                if ($horas > $horaActual) {
                    $validarHora = CitaControlador::ConsultarHoraValida($tablaHoras, $item, $valor, $fbuscar, $horas);

                    if (empty($validarHora)) {
                        echo '<option value="' . $horas . '">' . $horas . '</option>';
                    } else {
                    }
                } else {
                }
            }

            $i = calcularSumarhora($i, $duracion);
        } while ($i < $horaFinal);
    }
}


if (isset($_POST["id_medico"])) {

    $medico = new AjaxMedico();
    $medico->id_medico = $_POST["id_medico"];
    $medico->fecha = $_POST["fecha"];
    $medico->ajaxBuscarMedico();
}



// FUNCIONES IMPORTANTES 

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
