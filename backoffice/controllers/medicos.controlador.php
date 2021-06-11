<?php


class DoctorC
{

    public function CrearMedicoC()

    {
        $ruta = ControladorRuta::ctrRuta();

        if (isset($_POST["nombre"])) {

            $tablaDB1 = "persona";
            $tablaDB2 = "usuarios";
            $tablaDB3 = "medico";
            $tablaDB4 = "horario";


            $encriptar = crypt($_POST["clave"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

            $fecha_registro = date("Y-m-d");

            $datosC = array(
                "nombre" => $_POST["nombre"],
                "apellido" => $_POST["apellido"],
                "tipo_identificacion" => $_POST["tipo-identificacion"],
                "no_identificacion" => $_POST["no-identificacion"],
                "pais" => $_POST["pais"],
                "fecha-nacimiento" => $_POST["fecha-nacimiento"],
                "sexo" => $_POST["sexo"],
                "domicilio" => $_POST["domicilio"],
                "telefono" => $_POST["telefono"],
                "celular" => $_POST["celular"],
                "email" => $_POST["email"],
                "tipo-sangre" => $_POST["tipo-sangre"],
                "usuario" => $_POST["email"],
                "clave" => $encriptar,
                "estado" => $_POST["estado"],
                "registro" => $fecha_registro,
                "img" => "views/img/avatar5.png",
                "rol" => 2,
                "especialidad" => $_POST["especialidad"],
                "sala" => $_POST["sala"],
                "horaE" => $_POST["horaentrada"],
                "horaS" => $_POST["horasalida"]
            );

            $resultado = PersonaM::CrearPersonaM($tablaDB1, $datosC);

            if ($resultado == true) {

                $resultado2 = UsuarioModelo::CrearUsuarioM($tablaDB2, $datosC);

                if ($resultado2 == true) {

                    $view = "persona_usuario";

                    $resultado3 = MedicoModelo::consultarPersonaUsuarioM($view, $datosC);

                    $persona = $resultado3["CODIGO_PERSONA"];
                    $usuario = $resultado3["ID_USUARIO"];

                    $resultado4 = MedicoModelo::InsertarDoctorM($tablaDB3, $persona, $usuario, $datosC);


                    if ($resultado4 == true) {

                        $tabla = "medico";
                        $columna = "ID_PERSONA";
                        $valor = $persona;

                        $resultado5 = MedicoModelo::MedicosRegistradosM($tabla, $columna, $valor);

                        $idmedico = $resultado5["ID_MEDICO"];

                        $resultado6 = MedicoModelo::RegistrarHorario($tablaDB4, $idmedico, $datosC);

                        if ($resultado6 == true) {

?>
                            <script LANGUAGE="javascript">
                                $(document).ready(function() {

                                    swal({
                                        titltype: "success",
                                        title: "¡CORRECTO!",
                                        text: "SE HA REGITRADO SATISFACTORIAMENTE",
                                        showConfirmButtom: true,
                                        confirmButtomText: "Cerrar"
                                    }).then((result) => {
                                        if (result.value) {
                                            window.location = "<?php echo $ruta; ?>medico-registro";
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
                                        text: "NO SE HA REGITRADO SATISFACTORIAMENTE",
                                        showConfirmButtom: true,
                                        confirmButtomText: "Cerrar"
                                    }).then((result) => {
                                        if (result.value) {
                                            window.location = "<?php echo $ruta; ?>medico-registro";
                                        }
                                    })

                                });
                            </script>
                <?php
                        }
                    }
                }
            }
        }
    }

    static public function VerMedicoRegistrado($columna, $valor)
    {

        $tablaDB = "medico_registrado";

        $resultado = MedicoModelo::MedicosRegistradosM($tablaDB, $columna, $valor);

        return $resultado;
    }

    static public function HorarioMedico()
    {

        $tablaDB = "horarios";

        //$idmedico = $_POST["idmedico"];

        $idmedico = (isset($_POST['idmedico'])) ? $_POST['idmedico'] : '';

        if (isset($_POST["idmedico"])) {

            $ruta = ControladorRuta::ctrRuta();

            if ($idmedico <> 0) {

                if (isset($_POST["Lunes"])) {

                    $datosC = array(
                        "dia" => "LUNES",
                        "horaE" => $_POST["horaLunesE"],
                        "horaS" => $_POST["horaLunesS"]
                    );

                    $resultado = MedicoModelo::RegistrarHorario($tablaDB, $idmedico, $datosC);

                    if ($resultado = true) {
                    } else {
                        echo 'ERROR AL INGRESAR EL REGISTRO DEL DÍA LUNES';
                    }
                }

                if (isset($_POST["Martes"])) {

                    $datosC1 = array(
                        "dia" => "MARTES",
                        "horaE" => $_POST["horaMartesE"],
                        "horaS" => $_POST["horaMartesS"]
                    );

                    $resultado = MedicoModelo::RegistrarHorario($tablaDB, $idmedico, $datosC1);

                    if ($resultado = true) {
                    } else {
                        echo 'ERROR AL INGRESAR EL REGISTRO DEL DÍA MARTES';
                    }
                }
                if (isset($_POST["Miercoles"])) {
                    $datosC2 = array(
                        "dia" => "MIERCOLES",
                        "horaE" => $_POST["horaMiercolesE"],
                        "horaS" => $_POST["horaMiercolesS"]
                    );

                    $resultado = MedicoModelo::RegistrarHorario($tablaDB, $idmedico, $datosC2);

                    if ($resultado = true) {
                    } else {
                        echo 'ERROR AL INGRESAR EL REGISTRO DEL DÍA MARTES';
                    }
                }

                if (isset($_POST["Jueves"])) {
                    $datosC = array(
                        "dia" => "JUEVES",
                        "horaE" => $_POST["horaJuevesE"],
                        "horaS" => $_POST["horaJuevesS"]
                    );

                    $resultado = MedicoModelo::RegistrarHorario($tablaDB, $idmedico, $datosC);

                    if ($resultado = true) {
                    } else {
                        echo 'ERROR AL INGRESAR EL REGISTRO DEL DÍA MARTES';
                    }
                }
                if (isset($_POST["Viernes"])) {
                    $datosC = array(
                        "dia" => "VIERNES",
                        "horaE" => $_POST["horaViernesE"],
                        "horaS" => $_POST["horaViernesS"]
                    );

                    $resultado = MedicoModelo::RegistrarHorario($tablaDB, $idmedico, $datosC);

                    if ($resultado = true) {
                    } else {
                        echo 'ERROR AL INGRESAR EL REGISTRO DEL DÍA MARTES';
                    }
                }
                if (isset($_POST["Sabado"])) {
                    $datosC = array(
                        "dia" => "SABADO",
                        "horaE" => $_POST["horaSabadoE"],
                        "horaS" => $_POST["horaSabadoS"]
                    );

                    $resultado = MedicoModelo::RegistrarHorario($tablaDB, $idmedico, $datosC);

                    if ($resultado = true) {
                    } else {
                        echo 'ERROR AL INGRESAR EL REGISTRO DEL DÍA MARTES';
                    }
                }
                if (isset($_POST["Domingo"])) {
                    $datosC = array(
                        "dia" => "DOMINGO",
                        "horaE" => $_POST["horaDomingoE"],
                        "horaS" => $_POST["horaDomingoS"]
                    );

                    $resultado = MedicoModelo::RegistrarHorario($tablaDB, $idmedico, $datosC);

                    if ($resultado = true) {
                    } else {
                        echo 'ERROR AL INGRESAR EL REGISTRO DEL DÍA MARTES';
                    }
                }

                ?>
                <script LANGUAGE="javascript">
                    $(document).ready(function() {

                        swal({
                            titltype: "success",
                            title: "¡CORRECTO!",
                            text: "SE HA REGITRADO SATISFACTORIAMENTE",
                            showConfirmButtom: true,
                            confirmButtomText: "Cerrar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "<?php echo $ruta; ?>horario";
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
                            text: "NO HAZ SELECCIONADO UN MEDICO",
                            showConfirmButtom: true,
                            confirmButtomText: "Cerrar"
                        }).then((result) => {
                            if (result.value) {
                                //window.location = "<?php //echo $ruta; 
                                                        ?>horario";
                            }
                        })

                    });
                </script>
<?php

            }
        }
    }


    static public function ConsultasDiaC($columna1, $valor1, $columna2, $valor2)
    {

        $tablaDB = "citas_pendientes";

        $resultado = MedicoModelo::ConsultasDiaM($tablaDB, $columna1, $valor1, $columna2, $valor2);

        return $resultado;
    }

    static public function ConsultasAgendaC($columna1, $valor1, $columna2, $valor2)
    {

        $tablaDB = "citas_pendientes";

        $resultado = MedicoModelo::ConsultasAgendaM($tablaDB, $columna1, $valor1, $columna2, $valor2);

        return $resultado;
    }
}
