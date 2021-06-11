<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Registro de Administradores</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Principal</a></li>
                    <li class="breadcrumb-item active">Registrar Administradores</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="card card-primary card-1">
                    <div class="card-body">
                        <p class="card-text">
                        <div class="row">
                            <div class="col-sm-6">
                                <h5 class="card-title">DATOS PERSONALES</h5>
                                <p class="card-text">
                                <p><span style="color: red;"> * Campos obrigatorios </span></p>
                                <br />
                                <label>Código:</label>
                                <input name="codigo" placeholder="" id="codigo" class="form-control" type="text" disabled> <br />
                                <label><span style="color: red;"> * </span>Nombre:</label>
                                <input name="nombre" placeholder="" id="nombre" class="form-control" type="text" required> <br />
                                <label><span style="color: red;"> * </span>Apellido:</label>
                                <input name="apellido" placeholder="" id="apellido" class="form-control" type="text" required> <br />
                                <label>Tipo de documento:</label>
                                <select name="tipoi" id="tipoi" class="form-control">
                                    <?php

                                    $tdocumento = PersonaC::ConsultarDocumentosC();

                                    echo '<option value="">Seleccione el tipo de documento</option>';

                                    foreach ($tdocumento as $key => $value) {

                                        echo '<option value="' . $value["ID_TIPO_DOCUMENTO"] . '"> ' . $value["NOMBRE"] . '</option>';
                                    }
                                    ?>
                                </select><br />
                                <label>Numero de Identificación:</label>
                                <input name="numeroi" placeholder="" id="numeroi" class="form-control" type="text" pattern="[0-9]{1,20}"> <br />
                                <label><span style="color: red;"> * </span>País:</label>
                                <select name="pais" id="pais" class="form-control" required>
                                    <?php

                                    $cPaises = PersonaC::ConsultarPaisesC();

                                    echo '<option value="">Seleccione el país</option>';

                                    foreach ($cPaises as $key => $value) {

                                        echo '<option value="' . $value["CODIGO_PAIS"] . '"> ' . $value["NOMBRE_OFICIAL"] . '</option>';
                                    }
                                    ?>
                                </select><br />
                                <label>Fecha de Nacimiento:</label>
                                <input name="fecha-nacimiento" placeholder="" id="" class="form-control" id="fecha" type='date' min="1900-01-01" max="<?php echo date("Y-m-d") ?>"> <br />
                                <label>Sexo:</label>
                                <select name="sexo" id="sexo" class="form-control">
                                    <?php

                                    $Ssexo = PersonaC::ConsultarSexoC();

                                    echo '<option value="">Seleccione el sexo</option>';

                                    foreach ($Ssexo as $key => $value) {

                                        echo '<option value="' . $value["CODIGO"] . '"> ' . $value["NOMBRE"] . '</option>';
                                    }
                                    ?>
                                </select><br />
                            </div>
                            <div class="col-sm-6">
                                <label>Domicilio:</label>
                                <textarea class="form-control" name="domicilio" id="domicilio" cols="30" rows="3"></textarea><br />
                                <label>Teléfono:</label>
                                <input name="telefono" placeholder="" id="telefono" class="form-control" type="text" pattern="[0-9]{1,15}"> <br />
                                <label>Celular:</label>
                                <input name="celular" placeholder="" id="celular" class="form-control" type="text" pattern="[0-9]{1,15}"> <br />
                                <label> <span style="color: red;"> * </span>Correo Eletrónico:</label>
                                <input name="email" placeholder="" id="emailValidar" class="form-control" type="email" required> <br />
                                <label>Tipo de sangre:</label>
                                <select name="tipo-sangre" id="tipo-sangre" class="form-control">
                                    <?php

                                    $TSangre = PersonaC::ConsultarTSangreC();

                                    echo '<option value=""> Seleccione el tipo de Sangre </option>';

                                    foreach ($TSangre as $key => $value) {

                                        echo '<option value="' . $value["ID_TIPO_SANGRE"] . '"> (' . $value["NOMBBRE_TIPO_SANGRE"] . ') ' . $value["OBS"] . '</option>';
                                    }
                                    ?>
                                </select><br />
                                <h5 class="card-title">DATOS DE ACCESO</h5><br /><br />
                                <label><span style="color: red;"> * </span>Clave de Acceso:</label>
                                <input name="clave" placeholder="" id="clave" class="form-control" type="password" required> <br />
                                <label><span style="color: red;"> * </span>Estado:</label>
                                <select name="estado" id="estado" class="form-control">
                                    <option value="1">ACTIVO</option>
                                    <option value="0">INACTIVO</option>
                                </select><br />
                                <label>Fecha de Registro:</label>
                                <input name="registro" id="registro" class="form-control" type='text' disabled value="<?php echo date("Y-m-d") ?>"> <br />
                            </div>
                        </div>
                        </p>
                    </div>
                </div>
                <button name="btnEnviar" placeholder="" class="btn btn-1 btn-block" type="submit"><i class="fa fa-check"></i> Ingresar</button>
                <?php
                $crearAdmin = new AdministradorC();
                $crearAdmin->CrearAdmin();
                ?>
            </form>
        </div>
    </div>
</section>