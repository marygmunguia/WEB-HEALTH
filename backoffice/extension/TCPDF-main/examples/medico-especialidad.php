<?php

require_once '../../../controllers/citas.controlador.php';
require_once '../../../models/citas.modelos.php';

require_once('tcpdf_include.php');


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


if (@file_exists(dirname(__FILE__) . '/lang/spa.php')) {
    require_once(dirname(__FILE__) . '/lang/spa.php');
    $pdf->setLanguageArray($l);
}


$pdf->setFontSubsetting(true);


$pdf->SetFont('times', '', 15);

$pdf->AddPage();


//ENCABEZADO SUPERIOR
$bloque = <<<EOF

	<table>
		
		<tr>
			<td style="width:70px"><img src="images/logo-clinica.png"></td>

			<td style="width:10px"></td>

			<td style="background-color:white; width:400px; text-align:left;"><strong><br>WEB HEALTH</strong><br>
			REPORTE DE MÉDICOS POR ESPECIALIDAD<br></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque, false, false, false, false, '');

//INFORMACION SISTEMA
$bloque1 = <<<EOF

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

$pdf->writeHTML($bloque1, false, false, false, false, '');

//CONTENIDOS PRINCIPAL
$bloque2 = <<<EOF

    <br><br>
	<table style="font-size:10px; padding:5px 10px; background-color: #03a3cc; color:#fff;">
		
		<tr>
        <th style="width:60px; text-align:center; border: 1px solid #000;"><strong>ID</strong></th>
        <th style="width:280px; text-align:center; border: 1px solid #000;"><strong>Nombre Completo</strong></th>
        <th style="width:200px; text-align:center; border: 1px solid #000;"><strong>Especialidad</strong></th>
		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

$tabla = "reporte_medico_especialidad";
$columna = null;
$valor = null;

$resultado = CitaControlador::ConsultarRegistroC($tabla, $columna, $valor);

foreach ($resultado as $key => $value) {

$bloque3 = <<<EOF

<table style="font-size:10px; padding:5px 10px;">
		
<tr>

<td style="width:60px; text-align:center; border: 1px solid #000;">$value[ID_MEDICO]</td>
<td style="width:280px; text-align:left; border: 1px solid #000;"><font style="text-transform: uppercase;">$value[NOMBRE] $value[APELLIDO]</font></td>
<td style="width:200px; text-align:left; border: 1px solid #000;">$value[NOMBRE_ESPECIALIDAD]</td>

</tr>

</table>


EOF;


$pdf->writeHTML($bloque3, false, false, false, false, '');

}

$pdf->Output('reporte_medico_especialidades.pdf', 'I');
