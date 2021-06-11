<?php

require_once "../controllers/salas.controlador.php";
require_once "../models/salas.modelo.php";

class SalasA{

    public $Did;

    public function ESalasA(){

        $columna = "ID_SALA_MEDICA";
        $valor = $this->Did;

        $resultado = SalasC::VerSalasC($columna, $valor);

        echo json_encode($resultado);


    }

}

if (isset($_POST["Did"])) {
    $eS = new SalasA();
    $eS -> Did = $_POST["Did"];
    $eS -> ESalasA();
}