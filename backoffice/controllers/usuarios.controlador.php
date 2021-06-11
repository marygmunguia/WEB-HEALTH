<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class UsuarioControlador
{

    public function IngresoUsuarioC()
    {

        if (isset($_POST["correo"])) {

            $view = "login_usuarios";
            $item = "EMAIL";
            $value = $_POST["correo"];

            $respuesta = UsuarioModelo::IngresoUsuarioM($view, $item, $value);

            $encriptar = crypt($_POST["clave"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

            if ($respuesta["EMAIL"] == $_POST["correo"] && $respuesta["CLAVE_ACCESO"] == $encriptar) {

                if ($respuesta["ESTADO"] == 1) {

                    $_SESSION["Ingresar"] = 'ok';
                    $_SESSION["id_usuario"] = $respuesta["ID_USUARIO"];
                    $_SESSION["id_persona"] = $respuesta["CODIGO_PERSONA"];
                    $_SESSION["nombre"] = $respuesta["NOMBRE"];
                    $_SESSION["apellido"] = $respuesta["APELLIDO"];
                    $_SESSION["foto_perfil"] = $respuesta["IMG_PERFIL"];
                    $_SESSION["email"] = $respuesta["EMAIL"];

                    if ($respuesta["ID_ROL"] == 1) {

                        $_SESSION["rol"] = "Administrador";

                        echo '<script>
                    
                        window.location = "principal-admin";
                        
                        </script>';
                    } elseif ($respuesta["ID_ROL"] == 2) {
                        $_SESSION["rol"] = "Médico";

                        echo '<script>
                    
                        window.location = "principal-md";
                        
                        </script>';
                    } else {
                        $_SESSION["rol"] = "Paciente";

                        echo '<script>
                    
                        window.location = "principal-paciente";
                        
                        </script>';
                    }
                } else {

                    $ruta = ControladorRuta::ctrRuta();

?>
                    <script LANGUAGE="javascript">
                        $(document).ready(function() {

                            swal({
                                titltype: "error",
                                title: "¡Error!",
                                text: "El usuario está inactivo",
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
            } else {

                $ruta = ControladorRuta::ctrRuta();

                ?>
                <script LANGUAGE="javascript">
                    $(document).ready(function() {

                        swal({
                            titltype: "error",
                            title: "¡Error!",
                            text: "Correo Electrónico y/o Clave de Acceso son incorrectos.",
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

    public function RestablecerPassword()
    {
        if (isset($_POST["correoRestablecer"])) {

            $ruta = ControladorRuta::ctrRuta();

            $tablaDB = "usuarios";

            $email = $_POST["correoRestablecer"];

            $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
            $password = "";

            for ($i = 0; $i < 60; $i++) {
                $password = substr($str, rand(25, 62), 25);
            }

            $encriptar = crypt($password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

            $respuesta = UsuarioModelo::RestablecerPasswordM($tablaDB, $email, $encriptar);

            if ($respuesta == true) {

                date_default_timezone_set("America/Tegucigalpa");

                $mail = new PHPMailer;

                $mail->Charset = "UTF-8";

                $mail->isMail();

                $mail->setFrom("info@webhealth.com", "WEB HEALTH");

                $mail->addReplyTo("info@webhealth.com", "WEB HEALTH");

                $mail->Subject  = "RESTABLECER CLAVE DE ACCESO AL SISTEMA";

                $mail->addAddress($_POST["correoRestablecer"]);

                $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
        
    
                            <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
                                
                                <center>

                                    <h3 style="font-weight:100; color:#999">SE HA RESTABLECIDO TU CLAVE DE ACCESO</h3>
    
                                    <hr style="border:1px solid #ccc; width:80%">
    
                                    <h4 style="font-weight:100; color:#999; padding:0 20px">TU CLAVE DE ACCESO TEMPORAR ES: ' . $password . '</h4>
    
                                    <br>
    
                                    <hr style="border:1px solid #ccc; width:80%">
    
                                    <h5 style="font-weight:100; color:#999">Si no te registraste en nuestro sistema, pueden innorar o eliminar este email.</h5>
    
                                </center>	
    
                            </div>
    
                        </div>');

                $envio = $mail->Send();

                if (!$envio) {

                ?>
                    <script LANGUAGE="javascript">
                        $(document).ready(function() {

                            swal({
                                titltype: "error",
                                title: "¡ERROR!",
                                text: "NO SE LOGRAR RESTABLECER LA CONTRASEÑA CON EXITO",
                                showConfirmButtom: true,
                                confirmButtomText: "Cerrar"
                            }).then((result) => {
                                if (result.value) {
                                    window.location = "<?php echo $ruta; ?>usuarios";
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
                                title: "¡CORRECTO!",
                                text: "SE LOGRAR RESTABLECER LA CONTRASEÑA CON EXITO.",
                                showConfirmButtom: true,
                                confirmButtomText: "Cerrar"
                            }).then((result) => {
                                if (result.value) {
                                    window.location = "<?php echo $ruta; ?>usuarios";
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


class AdministradorC
{

    public function CrearAdmin()
    {
        if (isset($_POST["nombre"])) {

            $tablaDB1 = "persona";
            $tablaDB2 = "usuarios";
            $tablaDB3 = "administrador";


            $encriptar = crypt($_POST["clave"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
            $fecha_registro = date("Y-m-d");

            $datosC = array(
                "nombre" => $_POST["nombre"],
                "apellido" => $_POST["apellido"],
                "tipo_identificacion" => $_POST["tipoi"],
                "no_identificacion" => $_POST["numeroi"],
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
                "img" => "views/img/boxed-bg.jpg",
                "rol" => 1
            );

            $resultado = PersonaM::CrearPersonaM($tablaDB1, $datosC);

            if ($resultado == true) {

                $resultado2 = UsuarioModelo::CrearUsuarioM($tablaDB2, $datosC);

                if ($resultado2 == true) {

                    $view = "persona_usuario";

                    $resultado3 = UsuarioModelo::consultarPersonaUsuarioM($view, $datosC);

                    $persona = $resultado3["CODIGO_PERSONA"];
                    $usuario = $resultado3["ID_USUARIO"];

                    $resultado4 = UsuarioModelo::InsertarAdminM($tablaDB3, $persona, $usuario);

                    if ($resultado4 == true) {

                        $ruta = ControladorRuta::ctrRuta();

                    ?>
                        <script LANGUAGE="javascript">
                            $(document).ready(function() {

                                swal({
                                    titltype: "success",
                                    title: "¡CORRECTO!",
                                    text: "SE HA REGISTRADO CORRECTAMENTE EL USUARIO ADMINISTRADOR.",
                                    showConfirmButtom: true,
                                    confirmButtomText: "Cerrar"
                                }).then((result) => {
                                    if (result.value) {
                                        window.location = "<?php echo $ruta; ?>admin-registro";
                                    }
                                })

                            });
                        </script>

                <?php

                    }
                }
            } else {
                $ruta = ControladorRuta::ctrRuta();

                ?>
                <script LANGUAGE="javascript">
                    $(document).ready(function() {

                        swal({
                            titltype: "error",
                            title: "¡ERROR!",
                            text: "NO SE HA REGISTRADO CORRECTAMENTE EL USUARIO ADMINISTRADOR.",
                            showConfirmButtom: true,
                            confirmButtomText: "Cerrar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "<?php echo $ruta; ?>admin-registro";
                            }
                        })

                    });
                </script>

<?php
            }
        }
    }
}
