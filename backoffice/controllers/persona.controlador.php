<?php

class PersonaC
{

  static public function ConsultarPaisesC()
  {

    $tablaDB = "paises";

    $resultado = PersonaM::Consultar($tablaDB);

    return $resultado;
  }

  static public function ConsultarDocumentosC()
  {

    $tablaDB = "tipo_documento";

    $resultado = PersonaM::Consultar($tablaDB);

    return $resultado;
  }

  static public function ConsultarSexoC()
  {

    $tablaDB = "sexo";

    $resultado = PersonaM::Consultar($tablaDB);

    return $resultado;
  }

  static public function ConsultarTSangreC()
  {

    $tablaDB = "tipo_sangre";

    $resultado = PersonaM::Consultar($tablaDB);

    return $resultado;
  }

  static public function ConsultarUsuariosC($columna, $valor)
  {

    $tablaDB = "usuarios";

    $resultado = PersonaM::ConsultarUsuariosM($tablaDB, $columna, $valor);

    return $resultado;
  }

  static public function VerPerfilC($columna, $valor, $columnaU, $valorU)
  {

    $tablaDB = "consulta_perfil";

    $resultado = PersonaM::VerPerfilM($tablaDB, $columna, $valor, $columnaU, $valorU);

    return $resultado;
  }


  static public function ConsultaPerfilC($tablaDB, $columna, $valor)
  {

    $resultado = PersonaM::ConsultaPerfil($tablaDB, $columna, $valor);

    return $resultado;
  }



  public function CambiarPassword()
  {

    if (isset($_POST["claveActual"])) {

      $ruta = ControladorRuta::ctrRuta();

      $encriptarClave = crypt($_POST["claveActual"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

      $nombrecolumna = "ID_USUARIO";
      $valorbuscar = $_SESSION["id_usuario"];
      $nombretabla = "usuarios";

      $respuestaconsulta = CitaControlador::ConsultarRegistroC($nombretabla, $nombrecolumna, $valorbuscar);

      if ($respuestaconsulta["CLAVE_ACCESO"] == $encriptarClave) {
        if (isset($_POST["password"])) {

          $tablaDB = "usuarios";

          $encriptar = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

          $datosC = array(
            "id" => $_SESSION["id_usuario"],
            "password" => $encriptar
          );

          $resultado = PersonaM::CambiarPasswordM($tablaDB, $datosC);

          if ($resultado == true) {
?>
            <script LANGUAGE="javascript">
              $(document).ready(function() {

                swal({
                  titltype: "success",
                  title: "¡CORRECTO!",
                  text: "SE HA ACTULIZADO LA CLAVE DE ACCESO",
                  showConfirmButtom: true,
                  confirmButtomText: "Cerrar"
                }).then((result) => {
                  if (result.value) {
                    window.location = "<?php echo $ruta; ?>perfil";
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
                  text: "NO SE HA LOGRADO ACTULIZAR LA CLAVE DE ACCESO",
                  showConfirmButtom: true,
                  confirmButtomText: "Cerrar"
                }).then((result) => {
                  if (result.value) {
                    window.location = "<?php echo $ruta; ?>perfil";
                  }
                })

              });
            </script>

        <?php
          }
        }
      } else {
        ?>
        <script LANGUAGE="javascript">
          $(document).ready(function() {

            swal({
              titltype: "error",
              title: "¡ERROR!",
              text: "LA CONTRASEÑA ACTUAL NO ES CORRECTA, NO PUEDE CAMBIARSE LA CONTRASEÑA",
              showConfirmButtom: true,
              confirmButtomText: "Cerrar"
            }).then((result) => {
              if (result.value) {
                window.location = "<?php echo $ruta; ?>perfil";
              }
            })

          });
        </script>

      <?php

      }
    }
  }



  /*=============================================
	Cambiar foto perfil
	=============================================*/

  public function ctrCambiarFotoPerfil()
  {

    if (isset($_POST["idUsuarioFoto"])) {

      $id = $_POST["idUsuarioFoto"];

      $rutaImg = $_POST["fotoActual"];

      if (isset($_FILES["imagenNueva"]["tmp_name"]) && !empty($_FILES["imagenNueva"]["tmp_name"])) {

        if (!empty($_POST["fotoActual"])) {

          unlink($_POST["fotoActual"]);
        }


        if ($_FILES["imagenNueva"]["type"] == "image/png") {

          $nombre = mt_rand(100, 999);

          $rutaImg = "views/img/" . $id . "_" . $nombre . ".png";

          $foto = imagecreatefrompng($_FILES["imagenNueva"]["tmp_name"]);

          imagepng($foto, $rutaImg);
        }

        if ($_FILES["imagenNueva"]["type"] == "image/jpeg") {

          $nombre = mt_rand(100, 999);

          $rutaImg = "views/img/" . $id . "_" . $nombre . ".jpg";

          $foto = imagecreatefromjpeg($_FILES["imagenNueva"]["tmp_name"]);

          imagejpeg($foto, $rutaImg);
        }
      }


      $tabla = "usuarios";

      $item = "IMG_PERFIL";

      $valor = $rutaImg;

      $respuesta = PersonaM::mdlActualizarUsuario($tabla, $id, $item, $valor);

      if ($respuesta == "ok") {

        $_SESSION["foto_perfil"] = $rutaImg;

        echo '<script>

					swal({
						type:"success",
					  	title: "¡CORRECTO!",
					  	text: "¡LA FOTO DE PERFIL HA SIDO ACTUALIZADA!",
					  	showConfirmButton: true,
						confirmButtonText: "Cerrar"
					  
					}).then(function(result){

							if(result.value){   
							    history.back();
							  } 
					});

				</script>';
      } else {
        echo '<script>

					swal({
						type:"error",
					  	title: "¡ERROR!",
					  	text: "¡LA FOTO DE PERFIL NO HA SIDO ACTUALIZADA!",
					  	showConfirmButton: true,
						confirmButtonText: "Cerrar"
					  
					}).then(function(result){

							if(result.value){   
							    history.back();
							  } 
					});

				</script>';
      }
    }
  }




  public function ActualizarPerfilC()
  {

    if (isset($_POST["nombreE"])) {
      $ruta = ControladorRuta::ctrRuta();

      $tablaDB = "persona";

      $datosC = array(
        "codigo_persona" => $_POST["idpersonaE"],
        "nombre" => $_POST["nombreE"],
        "apellido" => $_POST["apellidoE"],
        "tipo_documento" => $_POST["tipoDocumentoE"],
        "no_documento" => $_POST["numeroDocumentoE"],
        "pais" => $_POST["paisE"],
        "fecha_nacimiento" => $_POST["fechaNacimientoE"],
        "sexo" => $_POST["sexoE"],
        "domicilio" => $_POST["domicilioE"],
        "telefono" => $_POST["telefonoE"],
        "celular" => $_POST["celularE"],
        "tipo_sangre" => $_POST["tipoSangreE"]
      );

      $respuesta = PersonaM::ActualizarPerfilM($tablaDB, $datosC);

      if ($respuesta == true) {
      ?>
        <script>
          swal({
            type: "success",
            title: "¡CORRECTO!",
            text: "¡SE HA ACTUALIZADO LA INFORMACIÓN DE PERFIL!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"

          }).then(function(result) {

            if (result.value) {
              window.location = "<?php echo $ruta; ?>perfil";
            }
          });
        </script>
      <?php
      } else {
      ?>
        <script>
          swal({
            type: "error",
            title: "¡ERROR!",
            text: "¡NO SE HA ACTUALIZADO LA INFORMACIÓN DE PERFIL!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"

          }).then(function(result) {

            if (result.value) {
              window.location = "<?php echo $ruta; ?>perfil";
            }
          });
        </script>
<?php
      }
    }
  }
}
