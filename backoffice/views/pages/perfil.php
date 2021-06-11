<script>
    function ConfirmaCerrarSesion() {

        var respuesta = confirm("Deseas cerrar sesión definitivamente?", "CERRAR SESIÓN!");

        if (respuesta == true) {
            return true;
        } else {
            return false;
        }
    }

    function ValidarPassword() {

        pass1 = document.getElementById('password');
        pass2 = document.getElementById('password1');

        // Verificamos si las constraseñas no coinciden
        if (pass1.value != pass2.value) {

            // Si las constraseñas no coinciden mostramos un mensaje
            swal({
                titltype: "error",
                title: "¡ERROR!",
                text: "LAS CLAVES NO COINCIDEN",
                showConfirmButtom: true,
                confirmButtomText: "Cerrar"
            }).then((result) => {
                if (result.value) {
                    window.location = "<?php echo $ruta; ?>perfil";
                }
            });

            return false;

        } else {

            return true;
        }

    }
</script>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2>Mi Perfil</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="principal-admin">Principal</a></li>
                    <li class="breadcrumb-item active">Mi perfil</li>
                </ol>
            </div>
        </div>
    </div>
</section>


<section class="content">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <div class="card card-widget widget-user-2">
                        <div class="widget-user-header bg-1">
                            <div class="widget-user-image">
                                <img class="img-circle elevation-2" src="<?php echo $ruta, $_SESSION["foto_perfil"]; ?>">
                            </div>
                            <h5 class="widget-user-username"><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido'] ?></h5>
                            <h5 class="widget-user-desc"><?php echo $_SESSION["rol"]; ?></h5>
                        </div>
                        <div class="card-footer p-0">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <center>
                                        <br />
                                        <button class="btn btn-secondary" style="color: #fff;" data-toggle="modal" data-target="#CambiarFoto">Cambiar fotografía</button>
                                        <br /><br />
                                    </center>
                                </li>
                                <li class="nav-item">
                                    <center>
                                        <br />
                                        <button class="btn btn-warning" style="color: #000;" data-toggle="modal" data-target="#CambiarClaveAcceso">
                                            Cambiar contraseña</button>
                                        <br /><br />
                                    </center>
                                </li>
                                <li class="nav-item">
                                    <center>
                                        <br />
                                        <a href="salir" onclick="return ConfirmaCerrarSesion();" class="btn btn-success" style="color: #fff;">Cerrar Sesión</a>
                                        <br /><br />
                                    </center>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="card">
                        <div class="card-header card-principal-1">
                            <h3 class="card-title">INFORMACIÓN DE PERFIL</h3>
                        </div>

                        <?php

                        $columna = "EMAIL";
                        $valor = $_SESSION["email"];

                        $columnaU = "NOMBRE_USUARIO";
                        $valorU = $_SESSION["email"];

                        $resultado = PersonaC::VerPerfilC($columna, $valor, $columnaU, $valorU);

                        foreach ($resultado as $key => $value) {

                        ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input type="text" value="<?php echo $value["NOMBRE"];  ?>" class="form-control" id="" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Apellido</label>
                                            <input type="text" value="<?php echo $value["APELLIDO"];  ?>" class="form-control" id="" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Tipo de Documento</label>
                                            <?php

                                            $columna1 = "ID_TIPO_DOCUMENTO";
                                            $valor1 = $value["TIPO_DOCUMENTO"];
                                            $tabla1 = "tipo_documento";

                                            $resultado1 = CitaControlador::ConsultarRegistroC($tabla1, $columna1, $valor1);

                                            ?>

                                            <input type="text" value="<?php echo $resultado1["NOMBRE"];  ?>" class="form-control" id="" disabled>

                                        </div>
                                        <div class="form-group">
                                            <label>Número de Documento</label>
                                            <input type="text" value="<?php echo $value["NO_DOCUMENTO"];  ?>" class="form-control" id="" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>País</label>
                                            <?php

                                            $columna2 = "CODIGO_PAIS";
                                            $valor2 = $value["PAIS"];
                                            $tabla2 = "paises";

                                            $resultado2 = CitaControlador::ConsultarRegistroC($tabla2, $columna2, $valor2);

                                            ?>
                                            <input type="text" value="<?php echo $resultado2["NOMBRE_OFICIAL"]; ?>" class="form-control" id="" disabled>

                                        </div>
                                        <div class="form-group">
                                            <label>Fecha de Nacimiento</label>
                                            <input type="text" value="<?php echo $value["FECHA_NACIMIENTO"];  ?>" class="form-control" id="" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Sexo</label>
                                            <?php

                                            $columna3 = "CODIGO";
                                            $valor3 = $value["SEXO"];
                                            $tabla3 = "sexo";

                                            $resultado3 = CitaControlador::ConsultarRegistroC($tabla3, $columna3, $valor3);

                                            ?>
                                            <input type="text" value="<?php echo $resultado3["NOMBRE"]; ?>" class="form-control" id="" disabled>

                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Domicilio</label>
                                            <textarea class="form-control" rows="4" disabled><?php echo $value["DOMICILIO"];  ?>
                                                </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Teléfono</label>
                                            <input type="text" value="<?php echo $value["TELEFONO"];  ?>" class="form-control" id="" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Celular</label>
                                            <input type="text" value="<?php echo $value["CELULAR"];  ?>" class="form-control" id="" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" value="<?php echo $value["EMAIL"];  ?>" class="form-control" id="" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Tipo de Sangre</label>
                                            <?php

                                            $columna4 = "ID_TIPO_SANGRE";
                                            $valor4 = $value["TIPO_SANGRE"];
                                            $tabla4 = "tipo_sangre";

                                            $resultado4 = CitaControlador::ConsultarRegistroC($tabla4, $columna4, $valor4);
                                            ?>
                                            <input type="text" value="<?php echo $resultado4["OBS"]; ?>" class="form-control" id="" disabled>
                                            <?php

                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Estado</label>
                                            <input type="text" value="ACTIVO" class="form-control" id="" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-1 btn-block CambiarInformacion" Did="<?php $_SESSION["id_usuario"]; ?>" data-toggle="modal" data-target="#CambiarInformacion">Editar Perfil</button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#EliminarCuenta">Eliminar Cuenta</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- CAMBIAR CLAVE DE ACCESO -->
<div class="modal fade" rol="dialog" id="CambiarClaveAcceso">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" role="form">

                <div class="modal-header">
                    <h3>Cambiar contreseña</h3>
                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">
                            <label for="exampleInputPassword1">Contraseña Actual:</label>
                            <input type="password" class="form-control" id="claveActual" name="claveActual" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Contraseña Nueva:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Repetir Contraseña Nueva:</label>
                            <input type="password" class="form-control" name="password1" id="password1" placeholder="">
                        </div>

                    </div>
                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-1" onclick="return ValidarPassword();"> Guardar cambios</button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancelar</button>
                </div>
                <?php
                $cambiarPassword = new PersonaC();
                $cambiarPassword->CambiarPassword();
                ?>
            </form>
        </div>
    </div>
</div>

<!-- CAMBIAR FOTOGRAFÍA DE PERFIL -->
<div class="modal fade" rol="dialog" id="CambiarFoto">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" enctype="multipart/form-data">

                <div class="modal-header">
                    <h3>Cambiar Imagen de Perfil</h3>
                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">
                            <label for="exampleInputPassword1">Seleccione la imagen en <span style="color: red;">formato .jpg o .png</span></label>
                            <div class="form-group">
                                <input type="hidden" name="idUsuarioFoto" value="<?php echo $_SESSION["id_usuario"]; ?>" />
                                <input type="file" class="form-control-file border" name="imagenNueva" id="imagenNueva" required>
                                <input type="hidden" name="fotoActual" value="<?php echo $_SESSION["foto_perfil"]; ?>" />
                                <br /><br />
                                <img src="<?php echo $_SESSION["foto_perfil"]; ?>" alt="" class="previsualizar" width="150px" height="150px">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-1"> Guardar cambios</button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancelar</button>
                </div>
                <?php

                $cambiarImagen = new PersonaC();
                $cambiarImagen->ctrCambiarFotoPerfil();

                ?>

            </form>
        </div>
    </div>
</div>




























<!-- ACTUALIZAR INFORMACIÓN DE PERFIL -->
<div class="modal fade" rol="dialog" id="CambiarInformacion">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <h3>Actualizar Información de Perfil</h3>
            </div>

            <div class="modal-body">

                <div class="box-body">

                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                <?php

                                $columna3 = "ID_USUARIO";
                                $valor3 = $_SESSION["id_usuario"];
                                $tabla3 = "consulta_perfil";

                                $respuesta = CitaControlador::ConsultarRegistroC($tabla3, $columna3, $valor3);

                                ?>

                                <input type="hidden" name="idpersonaE" id="idpersonaE" value="<?php echo $respuesta["CODIGO_PERSONA"]; ?>">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" value="<?php echo $respuesta["NOMBRE"]; ?>" class="form-control" id="nombreE" name="nombreE">
                                </div>
                                <div class="form-group">
                                    <label>Apellido</label>
                                    <input type="text" class="form-control" value="<?php echo $respuesta["APELLIDO"]; ?>" id="apellidoE" name="apellidoE">
                                </div>
                                <div class="form-group">
                                    <label>Tipo de Documento</label>
                                    <select name="tipoDocumentoE" id="tipoDocumentoE" class="form-control">
                                        <?php

                                        $columna2 = "ID_TIPO_DOCUMENTO";
                                        $valor2 = $respuesta["TIPO_DOCUMENTO"];
                                        $tabla2 = "tipo_documento";

                                        $resultado2 = CitaControlador::ConsultarRegistroC($tabla2, $columna2, $valor2);

                                        echo '<option value="' . $resultado2["ID_TIPO_DOCUMENTO"] . '">' . $resultado2["NOMBRE"] . '</option>';

                                        ?>
                                        <?php

                                        $tdocumento = PersonaC::ConsultarDocumentosC();

                                        echo '<option value="">Seleccione el tipo de documento</option>';

                                        foreach ($tdocumento as $key => $value) {

                                            echo '<option value="' . $value["ID_TIPO_DOCUMENTO"] . '"> ' . $value["NOMBRE"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Número de Documento</label>
                                    <input type="text" value="<?php echo $respuesta["NO_DOCUMENTO"]; ?>" class="form-control" id="numeroDocumentoE" name="numeroDocumentoE">
                                </div>
                                <div class="form-group">
                                    <label>País:</label>
                                    <select name="paisE" id="paisE" class="form-control" required>
                                        <?php

                                        $columna2 = "CODIGO_PAIS";
                                        $valor2 = $respuesta["PAIS"];
                                        $tabla2 = "paises";

                                        $resultado2 = CitaControlador::ConsultarRegistroC($tabla2, $columna2, $valor2);

                                        echo '<option value="' . $resultado2["CODIGO_PAIS"] . '">' . $resultado2["NOMBRE_OFICIAL"] . '</option>';

                                        ?>
                                        <?php

                                        $cPaises = PersonaC::ConsultarPaisesC();

                                        echo '<option value="">Seleccione el país</option>';

                                        foreach ($cPaises as $key => $value) {

                                            echo '<option value="' . $value["CODIGO_PAIS"] . '"> ' . $value["NOMBRE_OFICIAL"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Fecha de Nacimiento</label>
                                    <input type="date" value="<?php echo $respuesta["FECHA_NACIMIENTO"]; ?>" class="form-control" id="fechaNacimientoE" name="fechaNacimientoE">
                                </div>
                            </div>
                            <div class="col-6">
                                <label>Sexo:</label>
                                <select name="sexoE" id="sexoE" class="form-control">
                                    <?php

                                    $columna4 = "CODIGO";
                                    $valor4 = $respuesta["SEXO"];
                                    $tabla4 = "sexo";

                                    $resultado4 = CitaControlador::ConsultarRegistroC($tabla4, $columna4, $valor4);

                                    echo '<option value="' . $resultado4["CODIGO"] . '">' . $resultado4["NOMBRE"] . '</option>';


                                    ?>

                                    <?php

                                    $Ssexo = PersonaC::ConsultarSexoC();

                                    echo '<option value="">Seleccione el sexo</option>';

                                    foreach ($Ssexo as $key => $value) {

                                        echo '<option value="' . $value["CODIGO"] . '"> ' . $value["NOMBRE"] . '</option>';
                                    }
                                    ?>
                                </select><br />
                                <div class="form-group">
                                    <label>Domicilio</label>
                                    <textarea class="form-control" name="domicilioE" id="domicilioE" rows="4"><?php echo $respuesta["DOMICILIO"]; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <input type="text" name="telefonoE" class="form-control" value="<?php echo $respuesta["TELEFONO"]; ?>" id="telefonoE">
                                </div>
                                <div class="form-group">
                                    <label>Celular</label>
                                    <input type="text" class="form-control" id="celularE" name="celularE" value="<?php echo $respuesta["CELULAR"]; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Tipo de Sangre</label>
                                    <select name="tipoSangreE" id="tipoSangreE" class="form-control">
                                        <?php

                                        $columna2 = "ID_TIPO_SANGRE";
                                        $valor2 = $respuesta["TIPO_SANGRE"];
                                        $tabla2 = "tipo_sangre";

                                        $resultado2 = CitaControlador::ConsultarRegistroC($tabla2, $columna2, $valor2);

                                        echo '<option value="' . $resultado2["ID_TIPO_SANGRE"] . '">' . $resultado2["OBS"] . '</option>';

                                        ?>
                                        <?php

                                        $TSangre = PersonaC::ConsultarTSangreC();

                                        echo '<option value=""> Seleccione el tipo de Sangre </option>';

                                        foreach ($TSangre as $key => $value) {

                                            echo '<option value="' . $value["ID_TIPO_SANGRE"] . '"> (' . $value["NOMBBRE_TIPO_SANGRE"] . ') ' . $value["OBS"] . '</option>';
                                        }
                                        ?>
                                    </select><br />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-1"><i class="fas fa-check"></i> Guardar cambios</button>

                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancelar</button>

                        </div>
                        <?php

                        $actualizarP = new PersonaC();
                        $actualizarP->ActualizarPerfilC();

                        ?>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>