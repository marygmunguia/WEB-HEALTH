<script>
    function ValidarPassword() {

        pass1 = document.getElementById('clavepaciente');
        pass2 = document.getElementById('claverepetida');

        // Verificamos si las constraseñas no coinciden
        if (pass1.value != pass2.value) {

            // Si las constraseñas no coinciden mostramos un mensaje
            swal({
                titltype: "error",
                title: "¡ERROR!",
                text: "LAS CLAVES NO COINCIDEN",
                showConfirmButtom: true,
                confirmButtomText: "Cerrar"
            }).then((result) => {});

            return false;

        } else {

            return true;
        }

    }

    function ValidarEmail() {

        correo1 = document.getElementById('correopaciente');
        correo2 = document.getElementById('correopaciente1');

        // Verificamos si las constraseñas no coinciden
        if (correo1.value != correo2.value) {

            // Si las constraseñas no coinciden mostramos un mensaje
            swal({
                titltype: "error",
                title: "¡ERROR!",
                text: "LAS CLAVES NO COINCIDEN",
                showConfirmButtom: true,
                confirmButtomText: "Cerrar"
            }).then((result) => {});
            if (result.value) {

            }

            return false;

        } else {

            return ValidarPassword();

        }

    }
</script>
<div class="row" style="background-color: #04a4cc;">
    <div class="col-md-8 offset-md-2">
        <div class="content">
            <form method="POST">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header">
                                <div class="login-logo">
                                    <a href="registro">WEB<b> HEALTH</b></a><br />
                                    <img src="views/img/logo-clinica.png" alt="Logo">
                                </div>
                                <p class="login-box-msg">Registrate para reservar tus citas médicas rápido y fácil.</p>
                                <p class="login-box-msg" style="color: red;">Necesitas llenar todos los campos requeridos * para completar el registro</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label><span style="color: red;"> * </span>Nombre:</label>
                                            <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
                                        </div>
                                        <div class="form-group">
                                            <label><span style="color: red;"> * </span>Apellido:</label>
                                            <input type="text" class="form-control" name="apellido" placeholder="Apellido" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tipo de Documento:</label>
                                            <select name="tipo-identificacion" id="tipo-identificacion" class="form-control">
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
                                            <label>Número de Documento:</label>
                                            <input type="text" class="form-control" name="no-identificacion" placeholder="Número de documento">
                                        </div>
                                        <div class="form-group">
                                            <label><span style="color: red;"> * </span>Seleccione el País:</label>
                                            <select name="pais" id="pais" class="form-control" required>
                                                <?php

                                                $cPaises = PersonaC::ConsultarPaisesC();

                                                echo '<option value="">Seleccione el país</option>';

                                                foreach ($cPaises as $key => $value) {

                                                    echo '<option value="' . $value["CODIGO_PAIS"] . '"> ' . $value["NOMBRE_OFICIAL"] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Fecha de Nacimiento:</label>
                                            <input name="fecha-nacimiento" class="form-control" id="fecha" type='date' min="1900-01-01" max="<?php echo date("Y-m-d") ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Sexo:</label>
                                            <select name="sexo" id="sexo" class="form-control">
                                                <?php

                                                $Ssexo = PersonaC::ConsultarSexoC();

                                                echo '<option value="">Seleccione su sexo</option>';

                                                foreach ($Ssexo as $key => $value) {

                                                    echo '<option value="' . $value["CODIGO"] . '"> ' . $value["NOMBRE"] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Domicilio:</label>
                                            <textarea class="form-control" name="domicilio" id="domicilio" cols="30" rows="4"></textarea><br />
                                            <label>Teléfono:</label>
                                            <input name="telefono" placeholder="" id="telefono" class="form-control" type="text" pattern="[0-9]{1,15}"> <br />
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label><span style="color: red;"> * </span>Celular:</label>
                                            <input name="celular" placeholder="" id="celular" class="form-control" type="text" pattern="[0-9]{1,15}" required> 
                                        </div>
                                        <div class="form-group">
                                            <label><span style="color: red;"> * </span>Correo Electrónico:</label>
                                            <input type="email" class="form-control" name="correopaciente" id="emailValidar" placeholder="Correo electrónico" required>
                                        </div>
                                        <div class="form-group">
                                            <label><span style="color: red;"> * </span>Repite Tu Correo Electrónico:</label>
                                            <input type="email" class="form-control" name="correopaciente2" id="correopaciente2" placeholder="Repite tu Correo electrónico" required>
                                        </div>
                                        <div class="form-group">
                                            <label><span style="color: red;"> * </span>Contraseña:</label>
                                            <input type="password" class="form-control" name="clavepaciente" id="clavepaciente" required placeholder="Contraseña">
                                        </div>
                                        <div class="form-group">
                                            <label><span style="color: red;"> * </span>Repite tu Contraseña:</label>
                                            <input type="password" class="form-control" name="claverepetida" id="claverepetida" required placeholder="Repita su contraseña">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-4">
                                        <a href="inicio" class="btn btn-success btn-block">Ingresar</a>
                                    </div>
                                    <div class="col-8">
                                        <button type="submit" onclick="return ValidarPassword();" class="btn btn-1 btn-block">Registrarme</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php

                $crearPaciente = new PacienteControlador();
                $crearPaciente->CrearPacienteC();

                ?>
            </form>
        </div>
    </div>
</div>