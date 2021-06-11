<?php

require_once "../controllers/enfermedadesbase.controlador.php";
require_once "../models/enfermedadesbase.modelo.php";

class EnfermedadBase{

    public $Did;

    public function EEnfermedadBase(){

        $columna = "CODIGO_ENFERMEDAD_BASE";
        $valor = $this->Did;

        $resultado = Enfermadades_baseC::VerEnfermedadesBaseC($columna, $valor);

        echo json_encode($resultado);


    }

}

if (isset($_POST["Did"])) {
    $eS = new EnfermedadBase();
    $eS -> Did = $_POST["Did"];
    $eS -> EEnfermedadBase();
}