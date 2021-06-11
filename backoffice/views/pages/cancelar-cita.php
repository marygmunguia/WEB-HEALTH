<!-- TABLA DE DATOS -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Cancelar de Cita Médica</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="principal-paciente">Principal</a></li>
                    <li class="breadcrumb-item active">Cancelar Citas</li>
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
                                        <th>Médico</th>
                                        <th>Monto a Pagar</th>
                                        <th>Cancelar</th>

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

                                    $resultado = CitaControlador::VerCitaPendientes($columna, $valor);


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
                                            <td style="width: 10%;">
                                                <button class="btn btn-block btn-danger CancelarCita" idcitamedica="<?php echo $value["ID_CITA_MEDICA"]; ?>" data-toggle="modal" data-target="#CancelarCita">Cancelar Cita</button>
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


<div class="modal fade" rol="dialog" id="CancelarCita">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" role="form">

                <div class="modal-body">

                    <div class="box-body">

                        <h5>CANCELAR CITA!</h5>
                        <p>¿Estas seguro de querer cancelar tu cita médica?</p>
                        <br />

                        <input name="idcitamedica" id="idcitamedica" placeholder="" class="form-control" type="hidden">

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="submit" class="btn btn-danger"><i class="fas fa-check-circle"></i> Aceptar</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancelar</button>

                </div>

                <?php

                $cancelar = new CitaControlador();
                $cancelar -> CancelarCitaMedica();


                ?>

            </form>

        </div>

    </div>

</div>