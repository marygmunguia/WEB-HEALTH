<?php

require_once "../controllers/especialidades.controlador.php";
require_once "../models/especialidades.modelo.php";

class AjaxClientes{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $idCliente;

	public function ajaxEditarCliente(){

		$item = "ID_ESPECIALIDAD";
		$valor = $this->idCliente;

		$respuesta = EspecialidadC::VerEspecialidadC($item, $valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["idCliente"])){

	$cliente = new AjaxClientes();
	$cliente -> idCliente = $_POST["idCliente"];
	$cliente -> ajaxEditarCliente();

}else{
    echo 'error';
}