<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Historial de Diagnosticos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="principal-md">Principal</a></li>
                    <li class="breadcrumb-item active">Imprimir Diagnostico</li>
                </ol>
            </div>
        </div>
    </div>
</section>


<section class="content">
    <div class="card">
        <div class="card-header card-principal-1">
        </div>
        <div class="card-body">
            <div class="container">
                <div class="box">
                    <div class="box-body">
                        <br />

                        <table id="ME" class="table table-bordered table-hover IMP">
                            <thead>
                                <tr>
                                    <th>No. Cita Médica</th>
                                    <th>Núm. Expediente</th>
                                    <th>Nombre Paciente</th>
                                    <th>Fecha</th>
                                    <th>Imprimir</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $tablaDB = "medico";
                                $columna1 = "ID_USUARIO";
                                $valor1 = $_SESSION["id_usuario"];

                                $resultado1 = CitaControlador::ConsultarRegistroC($tablaDB, $columna1, $valor1);

                                $tabla = "cita_diagnostico";
                                $columna = "ID_MEDICO";
                                $valor = $resultado1["ID_MEDICO"];

                                $resultado = CitaControlador::ConsultarRegistrosC($tabla, $columna, $valor);

                                foreach ($resultado as $key => $value) {

                                ?>

                                    <tr>
                                        <td><?php echo $value["ID_CITA_MEDICA"];  ?></td>
                                        <td><?php echo $value["NUM_EXPEDIENTE"];  ?></td>
                                        <td><?php echo $value["NOMBRE"] . " " . $value["APELLIDO"];  ?></td>
                                        <td><?php echo $value["FECHA_CITA"];  ?> </td>
                                        <td>
                                            <center>
                                                <button class="btn bg-info btnImprimirDiagnostico" idcitamedica="<?php echo $value["ID_CITA_MEDICA"]; ?>" data-toggle="modal" data-target="#EliminarSala"><i class="fas fa-print"></i></button>
                                            </center>
                                        </td>
                                    </tr>

                                <?php

                                }

                                ?>
                            </tbody>
                        </table>
                        <br />
                    </div>

                </div>
            </div>
        </div>
        <div class="card-footer">
        </div>
    </div>
</section>