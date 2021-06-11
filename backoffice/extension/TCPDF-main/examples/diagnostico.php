<?php

require_once "../../../controllers/citas.controlador.php";
require_once "../../../models/citas.modelos.php";


class imprimirFactura
{

public $codigo;

public function traerImpresionFactura()
{

$idcitamedica = $this->codigo;

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


if (@file_exists(dirname(__FILE__).'/lang/spa.php')) {
    require_once(dirname(__FILE__).'/lang/spa.php');
    $pdf->setLanguageArray($l);
}

$pdf->SetFont('times', '', 15);


$pdf->AddPage();

//ENCABEZADO SUPERIOR
$bloque = <<<EOF

	<table>
		
		<tr>
			<td style="width:70px"><img src="images/logo-clinica.png"></td>

			<td style="width:10px"></td>

			<td style="background-color:white; width:400px; text-align:left;"><strong><br>WEB HEALTH<br>
			DIAGNOSTICO MÉDICO<br>
			</strong></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque, false, false, false, false, '');

		//INFORMACION SISTEMA
$bloque2 = <<<EOF

	<table>
		
		<tr>

			<td style="background-color:white; width:270px">
			
			
				<div style="font-size:10px; text-align:left; line-height:15px;">
					<strong>
					<br>
					RTN: </strong> 1807 1995 005432
					<strong>
					<br>
					Dirección:</strong> Col. Los Laureles,<br>calle frende a comerciales Rosa Roja.
				</div>

			</td>

			<td style="background-color:white; width:270px">

				<div style="font-size:10px; text-align:left; line-height:15px;">
					
					<br><strong>
					Télefono: </strong> 2446 - 9823

					<br>
					<strong>
					Móvil:</strong> 504 9435-9032
					
					<br>
					<strong>
					Email: </strong>servicioalcliente@webhealth.com

				</div>
				
			</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

$tablaDB = "cita_diagnostico";
$columna1 = "ID_CITA_MEDICA";
$valor1 = $idcitamedica;

$resultado = CitaControlador::ConsultarRegistroC($tablaDB, $columna1, $valor1);

$numexpediente = $resultado["NUM_EXPEDIENTE"];
$nombrecompleto = $resultado["NOMBRE"] . " " . $resultado["APELLIDO"];
$fecha = $resultado["FECHA_CITA"];

$fechaNueva = date("d/m/Y", strtotime($fecha));

$temperatura = $resultado["TEMPERATURA"];
$peso = $resultado["PESO"];
$altura = $resultado["ALTURA"];

$diagnostico = $resultado["DIAGNOSTICO_MEDICO"];
$receta = $resultado["RECETA_MEDICA"];

//CONTENIDO PRINCIPAL
$bloque1 = <<<EOF

	<table>
		
		<tr>

			<td style="background-color:white; width:540px">
			
			
				<div style="font-size:12px; text-align:left; line-height:15px;">
					<strong><br><br><br>DATOS DEL PACIENTE</strong><br>
					<strong>
					<br>
					Número de Expediente Médico: </strong>$numexpediente
					<strong><br>Nombre Completo:</strong>$nombrecompleto
					<strong><br><br><br><br>DATOS DEL DIAGNOSTICO</strong><br>
					<strong><br>Fecha Cita Médica: </strong>$fechaNueva
					<br>
					<strong><br>Temperatura: </strong>$temperatura Grados
					<strong><br>Peso: </strong>$peso Kilogramos
					<strong><br>Altura: </strong>$altura Metros
					<br>
					<strong><br>Diagnostico Médico: </strong>$diagnostico
					<strong><br>Receta Médica: </strong>$receta
				</div>

			</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

$pdf->Output('DiagnosticoMédico.pdf', 'I');

	}
}


$factura = new imprimirFactura();
$factura -> codigo = $_GET["idcitamedica"];
$factura -> traerImpresionFactura();

