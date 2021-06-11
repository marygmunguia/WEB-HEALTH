<?php

$columna = "ID_USUARIO";
$valor = $_SESSION["id_usuario"];
$tabla = "medico";

$resultado = CitaControlador::ConsultarRegistroC($tabla, $columna, $valor);

$idmedico = $resultado["ID_MEDICO"];

?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Agenda General del Citas Médicas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="principal-md">Principal</a></li>
                    <li class="breadcrumb-item active">Citas Médicas</li>
                </ol>
            </div>
        </div>
    </div>
</section>


<section class="container">
    <div class="card">
        <div class="card-header card-principal-1">
        </div>

        <div class="card-body">

            <div class="container">

                <div class="box">

                    <div class="box-header">
                    </div>
                    <div class="box-body">
                        <br />

                        <table id="ME" class="table table-bordered table-hover EXP">
                            <thead>
                                <tr>
                                    <th>No. Cita Médica</th>
                                    <th>ID Cliente</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Fecha de la Cita</th>
                                    <th>Hora de la Cita</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $columna = "ID_MEDICO";
                                $valor = $idmedico;

                                $columna1 = "FECHA_CITA";
                                $valor1 = date("Y-m-d");

                                $resultado = DoctorC::ConsultasAgendaC($columna, $valor, $columna1, $valor1);

                                foreach ($resultado as $key => $value) {

                                ?>
                                    <tr>
                                        <td><center><?php echo $value["ID_CITA_MEDICA"]; ?></center></td>
                                        <td><center><?php echo $value["ID_CLIENTE"];  ?></center></td>
                                        <?php
                                        $columna2 = "ID_CLIENTE";
                                        $valor2 = $value["ID_CLIENTE"];
                                        $tabla2 = "cliente";

                                        $resultado2 = CitaControlador::ConsultarRegistroC($tabla2, $columna2, $valor2);

                                        $usuario = $resultado2["ID_USUARIO"];

                                        $columna2 = "ID_USUARIO";
                                        $valor2 = $usuario;
                                        $tabla2 = "consulta_perfil";

                                        $resultado2 = CitaControlador::ConsultarRegistroC($tabla2, $columna2, $valor2);
                                        ?>
                                        <td><?php echo $resultado2["NOMBRE"];  ?></td>
                                        <td><?php echo $resultado2["APELLIDO"];  ?></td>
                                        <td><?php echo $value["FECHA_CITA"];  ?> </td>
                                        <td><?php echo $value["HORA_INICIO"];  ?> </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
