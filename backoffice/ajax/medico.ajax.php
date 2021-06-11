<?php

require_once "../controllers/citas.controlador.php";
require_once "../models/citas.modelos.php";

class AjaxMedico{

	/*=============================================
	EDITAR MEDICO
	=============================================*/	

	public $id_medico;

	public function ajaxSalaMedica(){

		$tabla = 'horario_medico';
		$item = 'ID_MEDICO';
		$valor = $this->id_medico;

		$respuesta = CitaControlador::ConsultarRegistroC($tabla, $item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR MEDICO
=============================================*/	
if(isset($_POST["id_medico"])){

	$medico = new AjaxMedico();
	$medico -> id_medico = $_POST["id_medico"];
	$medico -> ajaxSalaMedica();
}
