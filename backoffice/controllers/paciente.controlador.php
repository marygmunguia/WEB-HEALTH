<?php


class PacienteControlador
{

    public function CrearPacienteC()

    {
        $ruta = ControladorRuta::ctrRuta();

        if (isset($_POST["nombre"])) {

            $tablaDB1 = "persona";
            $tablaDB2 = "usuarios";
            $tablaDB3 = "cliente";


            $encriptar = crypt($_POST["clavepaciente"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

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
                "email" => $_POST["correopaciente"],
                "tipo-sangre" => null,
                "usuario" => $_POST["correopaciente"],
                "clave" => $encriptar,
                "estado" => 1,
                "registro" => $fecha_registro,
                "img" => "views/img/avatar5.png",
                "rol" => 3
            );

            $resultado = PersonaM::CrearPersonaM($tablaDB1, $datosC);

            if ($resultado == true) {

                $resultado2 = UsuarioModelo::CrearUsuarioM($tablaDB2, $datosC);

                if ($resultado2 == true) {

                    $view = "persona_usuario";

                    $resultado3 = PacienteModelo::consultarPersonaUsuarioM($view, $datosC);

                    $persona = $resultado3["CODIGO_PERSONA"];
                    $usuario = $resultado3["ID_USUARIO"];

                    $resultado4 = PacienteModelo::CrearPacienteCliente($tablaDB3, $persona, $usuario);

                    if ($resultado4 == true) {
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
                                        window.location = "<?php echo $ruta; ?>inicio";
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
                                        window.location = "<?php echo $ruta; ?>inicio";
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
