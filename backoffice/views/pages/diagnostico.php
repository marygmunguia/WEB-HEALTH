<?php

$idcitamedica = substr($_GET["pagina"], 12);

$table = "cita_medica";
$column = "ID_CITA_MEDICA";
$values = $idcitamedica;

$respuesta = CitaControlador::ConsultarRegistroC($table, $column, $values);

$idcliente = $respuesta["ID_CLIENTE"];

$table1 = "expediente";
$column1 = "ID_CLIENTE";
$values1 = $idcliente;

$respuesta1 = CitaControlador::ConsultarRegistroC($table1, $column1, $values1);

$num_expediente = $respuesta1["NUM_EXPEDIENTE"];


?>


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Diagnistico del Paciente</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="btn btn-danger btn-block"><a style="color: #fff;" href="<?php echo $ruta; ?>consultas-dia">Cancelar</a></li>
                </ol>
            </div>
        </div>


        <form method="POST">
            <div class="container">
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Información del Expediente</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">ID Cita Médica</label>
                                <input type="text" class="form-control" id="idcitamedica" name="idcitamedica" value="<?php echo $idcitamedica; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Número del Expediente</label>
                                <input type="text" class="form-control" id="id_cliente" name="id_cliente" value="<?php echo $num_expediente; ?>" disabled>
                            </div>
                            <div class="form-group">
                            </div>
                            <label>Enfermedad(es) qué padece el paciente:</label>
                            <div class="form-check">
                                <?php

                                $tabla = "consultar_enfermedad";
                                $columna = "NUM_EXPEDIENTE";
                                $valor = $num_expediente;

                                $resultado = CitaControlador::ConsultarRegistrosC($tabla, $columna, $valor);

                                foreach ($resultado as $key => $value) {

                                ?>
                                    <label class="form-check-label" for="exampleCheck1"><?php echo $value["NOMBRE_ENFERMEDAD_BASE"]; ?></label>
                                    <br />
                                <?php

                                }

                                ?>

                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Introducir Diagnostico Médico</h3>
                        </div>
                        <div class="card-body">
                            <label>Seleccione el o los sintomas que padece el paciente:</label>
                            <div class="form-check">
                                <?php

                                $tabla1 = "sintomas_comunes";
                                $columna1 = null;
                                $valor1 = null;

                                $resultado1 = CitaControlador::ConsultarRegistroC($tabla1, $columna1, $valor1);

                                foreach ($resultado1 as $key1 => $value1) {

                                ?>
                                    <input type="checkbox" class="form-check-input" id="checkbox" name="checkbox[]" value="<?php echo $value1["CODIGO_SINTOMA_COMUN"]; ?>">
                                    <label class="form-check-label" for="exampleCheck1"><?php echo $value1["NOMBRE_SINTOMA_COMUN"]; ?></label>
                                    <br />
                                <?php

                                }

                                ?>

                            </div><br />
                            <div class="row">
                                <div class="form-group col-4">
                                    <label>Temperatura:</label>
                                    <input type="text" class="form-control" name="temperatura" placeholder="Grados">
                                </div>
                                <div class="form-group col-4">
                                    <label>Peso:</label>
                                    <input type="text" class="form-control" name="peso" placeholder="Kilogramos">
                                </div>
                                <div class="form-group col-4">
                                    <label>Altura:</label>
                                    <input type="text" class="form-control" name="altura" placeholder="Metros">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Sintomas Especificos</label>
                                <textarea class="form-control" rows="3" name="sintomas" placeholder="Enter ..."></textarea>
                            </div>
                            <div class="form-group">
                                <label>Diagnostico Médico</label>
                                <textarea class="form-control" rows="3" name="diagnostico" placeholder="Enter ..." required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Receta Médica</label>
                                <textarea class="form-control" rows="3" name="receta" placeholder="Enter ..."></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Terminar</button>

            <?php

            $registrar = new Diagnostico;
            $registrar->registrarDiagnostico();

            ?>

        </form>
    </div>
</section>