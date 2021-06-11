<?php

require_once "../controllers/persona.controlador.php";
require_once "../models/persona.modelo.php";

class AjaxUsuarios
{
    public $validarUsuario;

    public function ajaxValidarUsuario()
    {

        $item = "NOMBRE_USUARIO";
        $valor = $this->validarUsuario;

        $respuesta = PersonaC::ConsultarUsuariosC($item, $valor);

        echo json_encode($respuesta);
    }
}

/*=============================================
VALIDAR NO REPETIR USUARIO
=============================================*/

if (isset($_POST["validarUsuario"])) {

    $valUsuario = new AjaxUsuarios();
    $valUsuario->validarUsuario = $_POST["validarUsuario"];
    $valUsuario->ajaxValidarUsuario();
}
