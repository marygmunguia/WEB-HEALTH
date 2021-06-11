<?php

include '../models/conexionDB.php';

$id = $_POST["id_especialidad"];

$queryMedico = "SELECT * FROM horario_medico WHERE ID_ESPECIALIDAD='$id'";

$resultadoMedico = $mysqli->query($queryMedico);

$cadena = "<option value='0'>SELECCIONE UN MÉDICO</option>";

while ($ver=mysqli_fetch_row($resultadoMedico)) {
$cadena=$cadena.'<option value='.$ver[4].'>Médico '.utf8_encode($ver[5]).' '.utf8_encode($ver[6]).'</option>';
}

echo  $cadena; 
