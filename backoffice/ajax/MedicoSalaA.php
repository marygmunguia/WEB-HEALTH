<?php

require_once "../controllers/citas.controlador.php";
require_once "../models/citas.modelos.php";

class AjaxSala
{

	public $id_medico;

	public function ajaxVerSala()
	{

		$item = "ID_MEDICO";
		$valor = $this->id_medico;
		$tabla = "horario_medico";

		$respuesta = CitaControlador::ConsultarRegistroC($tabla, $item, $valor);

		echo '
		<label>Sala Médica:</label>
		<div class="row">
			<div class="col-6 form-group">
				<input type="text" class="form-control" disabled value="NÚMERO DE SALA: '. $respuesta["NUMERO"] .'">
			</div>
			<div class="col-6 form-group">
				<input type="text" class="form-control" disabled value="EDIFICIO: '. $respuesta["EDIFICIO"] .'">
			</div><br />
			<div class="col-12 form-group">
				<textarea class="form-control" rows="2" disabled>'. $respuesta["DETALLE_UBICACION"] .'</textarea>
			</div>
		</div>
		</div>

		<label>Precio por Consulta Médica:</label>
			<div class="form-group">
				<input type="text" class="form-control" disabled value="L. '. $respuesta["PRECIO_CITA"] .'">
			</div>
		</div>
		';
?>



<?php


	}
}

/*=============================================
EDITAR CLIENTE
=============================================*/

if (isset($_POST["Did"])) {

	$cliente = new AjaxSala();
	$cliente->id_medico = $_POST["Did"];
	$cliente->ajaxVerSala();

}
