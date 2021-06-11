<?php

require_once "../controllers/sintomas.controlador.php";
require_once "../models/sintomas.modelo.php";

class SintomasComunesA{

    public $Did;

    public function ESintomasComunesA(){

        $columna = "CODIGO_SINTOMA_COMUN";
        $valor = $this->Did;

        $resultado = SintomasControlador::VerSintomasC($columna, $valor);

        echo json_encode($resultado);


    }

}

if (isset($_POST["Did"])) {
    $eS = new SintomasComunesA();
    $eS -> Did = $_POST["Did"];
    $eS -> ESintomasComunesA();
}