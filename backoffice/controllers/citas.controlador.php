<?php

class CitaControlador
{


    public function CancelarCitaMedica()
    {

        if (isset($_POST["idcitamedica"])) {

            $tablaDB = "cita_medica";

            $idcitamedica = $_POST["idcitamedica"];

            $resultado = CitaModelo::CancelarCitaM($tablaDB, $idcitamedica);

            $ruta = ControladorRuta::ctrRuta();

            if ($resultado == true) {

?>
                <script LANGUAGE="javascript">
                    $(document).ready(function() {

                        swal({
                            titltype: "success",
                            title: "¡SENTIMOS TU DECICIÓN!",
                            text: "HAZ CANCELADO TU CITA MÉDICA CORRECTAMENTE",
                            showConfirmButtom: true,
                            confirmButtomText: "Comenzar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "<?php echo $ruta; ?>cancelar-cita";
                            }
                        })

                    });
                </script>
            <?php

            }
        }
    }

    static public function VerCitaPendientes($columna, $valor)
    {
        $tablaDB = "citas_pendientes";

        $resultado = CitaModelo::VerHistorialM($tablaDB, $columna, $valor);

        return $resultado;
    }

    static public function VerHistorial($columna, $valor)
    {
        $tablaDB = "historial_citas_medicas";

        $resultado = CitaModelo::VerHistorialM($tablaDB, $columna, $valor);

        return $resultado;
    }


    static public function ConsultarRegistroC($tablaDB, $columna, $valor)
    {

        $resultado = CitaModelo::ConsultarRegistroM($tablaDB, $columna, $valor);

        return $resultado;
        
    }

    static public function ConsultarRegistrosC($tablaDB, $columna, $valor)
    {

        $resultado = CitaModelo::ConsultarRegistrosM($tablaDB, $columna, $valor);

        return $resultado;
    }

    static public function ConsultaReporteC($tablaDB)
    {

        $resultado = CitaModelo::ConsultaReporteM($tablaDB);

        return $resultado;
    }

    static public function ConsultarRegistrosCompletos($tablaDB, $columna, $valor, $fecha)
    {

        $resultado = CitaModelo::ConsultarRegistrosCompletosM($tablaDB, $columna, $valor, $fecha);

        return $resultado;
    }


    static public function ConsultarHoraValida($tablaDB, $columna, $valor, $fecha, $hora)
    {

        $resultado = CitaModelo::ConsultarHoraValidaM($tablaDB, $columna, $valor, $fecha, $hora);

        return $resultado;
    }


    //CONSULTAR EXPEDIENTE DEL USUARIO
    static public function ExpedienteExistente($idcliente)
    {

        $ruta = ControladorRuta::ctrRuta();


        $columna1 = "ID_CLIENTE";
        $valor1 = $idcliente;
        $tabla1 = "expediente";

        $resultado1 = CitaControlador::ConsultarRegistroC($tabla1, $columna1, $valor1);

        $respuesta = empty($resultado1);

        if ($respuesta == true) {
            ?>
            <script LANGUAGE="javascript">
                $(document).ready(function() {

                    swal({
                        titltype: "error",
                        title: "¡ERROR!",
                        text: "NO CUENTAS CON UN EXPEDIENTE, ESTE SE TE CREARÁ EN TU PRIMERA CONSULTA MÉDICA",
                        showConfirmButtom: true,
                        confirmButtomText: "Cerrar"
                    }).then((result) => {
                        if (result.value) {
                            window.location = "<?php echo $ruta; ?>crear-expediente";
                        }
                    })

                });
            </script>
        <?php
        } else {
        ?>
            <script LANGUAGE="javascript">
                $(document).ready(function() {

                    swal({
                        titltype: "error",
                        title: "¡ERROR!",
                        text: "NO CUENTAS CON UN EXPEDIENTE, ESTE SE TE CREARÁ EN TU PRIMERA CONSULTA MÉDICA",
                        showConfirmButtom: true,
                        confirmButtomText: "Cerrar"
                    }).then((result) => {
                        if (result.value) {
                            window.location = "<?php echo $ruta; ?>crear-expediente";
                        }
                    })

                });
            </script>
            <?php
        }
    }


    //CONSULTAR SI SE DEBE DE CREAR UN EXPEDIENTE DEL PACIENTE
    static public function ExpedienteExistenteP()
    {

        $ruta = ControladorRuta::ctrRuta();

        if (isset($_POST["idcliente"])) {

            $idcliente = $_POST["idcliente"];
            $idcitamedica = $_POST["idcitamedica"];

            $columna1 = "ID_CLIENTE";
            $valor1 = $idcliente;
            $tabla1 = "expediente";

            $resultado1 = CitaControlador::ConsultarRegistroC($tabla1, $columna1, $valor1);

            $respuesta = empty($resultado1);

            if ($respuesta == true) {

            ?>
                <script LANGUAGE="javascript">
                    $(document).ready(function() {

                        swal({
                            titltype: "error",
                            title: "¡ERROR!",
                            text: "NO EXISTE EXPEDIENTE, SE DEBE DE CREAR ANTES DE LA CONSULTA",
                            showConfirmButtom: true,
                            confirmButtomText: "Crear Expediente"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "<?php echo $ruta; ?>crear-expediente/" + <?php echo $idcitamedica; ?>;
                            }
                        })

                    });
                </script>
            <?php
            } else {
            ?>
                <script LANGUAGE="javascript">
                    $(document).ready(function() {

                        swal({
                            titltype: "success",
                            title: "¡CONTINUAR!",
                            text: "EL PACIENTE YA CUENTA CON UN EXPEDIENTE, COMENZAR DIAGNOSTICO",
                            showConfirmButtom: true,
                            confirmButtomText: "Comenzar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "<?php echo $ruta; ?>diagnostico/" + <?php echo $idcitamedica; ?>;
                            }
                        })

                    });
                </script>
            <?php
            }
        }
    }

    public function AgendarCitaC()
    {
        if (isset($_POST["FechaCita"])) {

            $tablaDB = "cita_medica";

            $datosC = array(
                "idcliente" => $_POST["idcliente"],
                "idmedico" => $_POST["cbx_doctor"],
                "idespecialidad" => $_POST["cbx_especialidad"],
                "fecha_cita" => $_POST["FechaCita"],
                "hora_Inicio" => $_POST["hora_cita"],
                "estado_cita" => "1"
            );


            $resultado = reservaModelo::AgendaCitaM($tablaDB, $datosC);

            $ruta = ControladorRuta::ctrRuta();

            if ($resultado == true) {

            ?>
                <script LANGUAGE="javascript">
                    $(document).ready(function() {

                        swal({
                            titltype: "success",
                            title: "¡CORRECTO!",
                            text: "SE HA AGENDADO TU CITA SATISFACTORIAMENTE",
                            showConfirmButtom: true,
                            confirmButtomText: "Aceptar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "<?php echo $ruta; ?>reservar";
                            }
                        })

                    });
                </script>

            <?php

            } else {

            ?>
                <script LANGUAGE="javascript">
                    $(document).ready(function() {

                        swal({
                            titltype: "error",
                            title: "¡ERROR!",
                            text: "NO SE HA AGENDADO TU CITA SATISFACTORIAMENTE",
                            showConfirmButtom: true,
                            confirmButtomText: "Cerrar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "<?php echo $ruta; ?>reservar";
                            }
                        })

                    });
                </script>

                <?php

            }
        }
    }

    static public function ConsultarPorFechasC()
    {

        $fecha_actual = date("Y-m-d");

        $tablaDB = "fecha_citas";
        $fechaInicio = date("Y-m-d", strtotime($fecha_actual . "- 7 days"));

        $fechaFinal = $fecha_actual;

        $resultado = CitaModelo::ConsultarPorFechaM($tablaDB, $fechaInicio, $fechaFinal);

        return $resultado;
    }


    static public function NuevosUsuariosC($tabla, $fechaInicio, $fechaFinal)
    {

        $resultado = CitaModelo::NuevosUsuariosM($tabla, $fechaInicio, $fechaFinal);

        return $resultado;

    }

}







class Diagnostico
{

    public function registrarExpDiagnostico()
    {

        $ruta = ControladorRuta::ctrRuta();

        if (isset($_POST["diagnostico"])) {

            $idcitamedica = substr($_GET["pagina"], 17);

            $table = "cita_medica";
            $column = "ID_CITA_MEDICA";
            $values = $idcitamedica;

            $respuesta = CitaControlador::ConsultarRegistroC($table, $column, $values);

            $idcliente = $respuesta["ID_CLIENTE"];
            $tabla1 = "expediente";

            $resultado1 = DiagnosticoM::CrearExpediente($tabla1, $idcliente);

            if ($resultado1 == true) {

                $table1 = "expediente";
                $column1 = "ID_CLIENTE";
                $values1 = $idcliente;

                $respuesta1 = CitaControlador::ConsultarRegistroC($table1, $column1, $values1);

                $num_expediente = $respuesta1["NUM_EXPEDIENTE"];
                $tabla2 = "expediente";

                $checkbox = $_POST['checkbox_one'];
                $tabla3 = "enfermedad_paciente";

                foreach ($checkbox as $llave => $valor) {
                    $insertar_enfermedad = DiagnosticoM::InsertarEnfermedad($tabla3, $num_expediente, $valor);
                }

                $datosC = array(
                    "sintomasespecificos" => $_POST["sintomas"],
                    "altura" => $_POST["altura"],
                    "peso" => $_POST["peso"],
                    "temperatura" => $_POST["temperatura"],
                    "diagnostico" => $_POST["diagnostico"],
                    "receta" => $_POST["receta"]
                );

                $checkbox1 = $_POST['checkbox'];
                $tabla4 = "sintomas_pacientes";

                foreach ($checkbox1 as $llave1 => $valor1) {
                    $insertar_sintoma = DiagnosticoM::InsertarSintoma($tabla4, $idcitamedica, $valor1);
                }

                $tabla5 = "detalle_consulta";
                $insertar_diagnostico = DiagnosticoM::InsertarDiagnostico($tabla5, $idcitamedica, $datosC);

                $tabla6 = "cita_medica";
                $estado = "2";

                $actualizarcita =  DiagnosticoM::ActualizarCita($tabla6, $idcitamedica, $estado);

                if ($insertar_diagnostico == true) {

                ?>
                    <script LANGUAGE="javascript">
                        $(document).ready(function() {

                            swal({
                                titltype: "success",
                                title: "¡CORRECTO!",
                                text: "SE HA REGISTRADO CORRECTAMENTE EL DIAGNOSTICO",
                                showConfirmButtom: true,
                                confirmButtomText: "Aceptar"
                            }).then((result) => {
                                if (result.value) {
                                    window.location = "<?php echo $ruta; ?>consultas-dia";
                                }
                            })

                        });
                    </script>

                <?php

                } else {

                ?>
                    <script LANGUAGE="javascript">
                        $(document).ready(function() {

                            swal({
                                titltype: "error",
                                title: "¡ERROR!",
                                text: "SE HA REGISTRADO CORRECTAMENTE EL DIAGNOSTICO",
                                showConfirmButtom: true,
                                confirmButtomText: "Cerrar"
                            }).then((result) => {
                                if (result.value) {
                                    window.location = "<?php echo $ruta; ?>consultas-dia";
                                }
                            })

                        });
                    </script>

                <?php

                }
            }
        }
    }


    public function registrarDiagnostico()
    {

        $ruta = ControladorRuta::ctrRuta();

        if (isset($_POST["diagnostico"])) {

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
            $tabla2 = "expediente";

            $datosC = array(
                "sintomasespecificos" => $_POST["sintomas"],
                "altura" => $_POST["altura"],
                "peso" => $_POST["peso"],
                "temperatura" => $_POST["temperatura"],
                "diagnostico" => $_POST["diagnostico"],
                "receta" => $_POST["receta"]
            );

            $checkbox1 = $_POST['checkbox'];
            $tabla4 = "sintomas_pacientes";

            foreach ($checkbox1 as $llave1 => $valor1) {
                $insertar_sintoma = DiagnosticoM::InsertarSintoma($tabla4, $idcitamedica, $valor1);
            }

            $tabla5 = "detalle_consulta";
            $insertar_diagnostico = DiagnosticoM::InsertarDiagnostico($tabla5, $idcitamedica, $datosC);

            $tabla6 = "cita_medica";
            $estado = "2";

            $actualizarcita =  DiagnosticoM::ActualizarCita($tabla6, $idcitamedica, $estado);

            if ($insertar_diagnostico == true) {

                ?>
                <script LANGUAGE="javascript">
                    $(document).ready(function() {

                        swal({
                            titltype: "success",
                            title: "¡CORRECTO!",
                            text: "SE HA REGISTRADO CORRECTAMENTE EL DIAGNOSTICO",
                            showConfirmButtom: true,
                            confirmButtomText: "Aceptar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "<?php echo $ruta; ?>consultas-dia";
                            }
                        })

                    });
                </script>

            <?php

            } else {

            ?>
                <script LANGUAGE="javascript">
                    $(document).ready(function() {

                        swal({
                            titltype: "error",
                            title: "¡ERROR!",
                            text: "SE HA REGISTRADO CORRECTAMENTE EL DIAGNOSTICO",
                            showConfirmButtom: true,
                            confirmButtomText: "Cerrar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "<?php echo $ruta; ?>consultas-dia";
                            }
                        })

                    });
                </script>

<?php

            }
        }
    }
}
