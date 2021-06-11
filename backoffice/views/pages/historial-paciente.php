<!-- TABLA DE DATOS -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Historial de Citas Médicas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="principal-admin">Principal</a></li>
                    <li class="breadcrumb-item active">Hitorial Citas</li>
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

                <section class="content">

                    <div class="box">

                        <div class="box-header">


                        </div>


                        <div class="box-body">
                            <br />

                            <table id="ME" class="table table-bordered table-hover EM">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Hora Cita</th>
                                        <th>Especialidad</th>
                                        <th>Doctor</th>
                                        <th>Monto a Pagar</th>
                                        <th>Estado Cita</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php


                                    $columnaC = "ID_USUARIO";
                                    $valorC = $_SESSION["id_usuario"];
                                    $tablaC = "cliente";

                                    $resultadoC = CitaControlador::ConsultarRegistroC($tablaC, $columnaC, $valorC);

                                    $idcliente = $resultadoC["ID_CLIENTE"];

                                    $columna = "ID_CLIENTE";
                                    $valor = $idcliente;

                                    $resultado = CitaControlador::VerHistorial($columna, $valor);


                                    foreach ($resultado as $key => $value) {


                                    ?>

                                        <tr>

                                            <!-- Extracción de los nombres de aquellos campos que cooresponde su ID -->

                                            <?php

                                            //Extracción de nombre de la especialidad

                                            $columnaE = "ID_ESPECIALIDAD";
                                            $valorE = $value["ID_ESPECIALIDAD"];
                                            $tablaE = "especialidad";

                                            $resultadoE = CitaControlador::ConsultarRegistroC($tablaE, $columnaE, $valorE);

                                            //Extracción de nombre del médico

                                            $columnaM = "ID_MEDICO";
                                            $valorM = $value["ID_MEDICO"];
                                            $tablaM = "medico_registrado";

                                            $resultadoM = CitaControlador::ConsultarRegistroC($tablaM, $columnaM, $valorM);

                                            //Extracción del estado cita

                                            ?>
                                            <!-- Se muestran los datos obtenidos de las tablas anteriormente consultadas -->

                                            <td style="width: 10%;"><?php echo $value["FECHA_CITA"];  ?></td>
                                            <td style="width: 10%;"><?php echo $value["HORA_INICIO"];  ?> </td>
                                            <td style="width: 10%;"><?php echo $resultadoE["NOMBRE_ESPECIALIDAD"]; ?></td>
                                            <td style="width: 10%;"><?php echo $resultadoM["NOMBRE"] . " " . $resultadoM["APELLIDO"]; ?></td>
                                            <td style="width: 10%;"><?php echo $resultadoE["PRECIO_CITA"] ?> </td>
                                            <td style="width: 10%;"><?php

                                                                    if ($value["ID_ESTADO_CITA"] == '2') {
                                                                    ?><span style="color: #0000FA;">COMPLETA</span><?php
                                                                                            } else {
                                                                                                ?><span style="color: #FA0000;">CANCELADA</span><?php
                                                                                            }


                                                                                                ?> </td>

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