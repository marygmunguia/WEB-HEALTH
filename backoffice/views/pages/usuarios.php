<?php

$ruta = ControladorRuta::ctrRuta();

?>
<section class="content">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Usuarios del Sistema</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="principal-admin">Principal</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Usuarios Registrados en el sistema</h3>
                        </div>
                        <div class="card-body">
                            <table id="ME" class="table table-bordered table-hover US">
                                <thead>
                                    <tr>

                                        <th style="width: 10%">
                                            <center>ID</center>
                                        </th>
                                        <th style="width: 20%">
                                            <center>USUARIO</center>
                                        </th>
                                        <th style="width: 10%">
                                            <center>ESTADO</center>
                                        </th>
                                        <th style="width: 15%">
                                            <center>ROL</center>
                                        </th>
                                        <th style="width: 10%">
                                            <center>FOTO DE PERFIL</center>
                                        </th>
                                        <th style="width: 10%">
                                            <center>FECHA DE REGITRO</center>
                                        </th>
                                        <th style="width: 20%">
                                            <center>RESTABLECER CONTRASEÑA</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $columna = null;
                                    $valor = null;

                                    $resultado = PersonaC::ConsultarUsuariosC($columna, $valor);

                                    foreach ($resultado as $key => $value) {

                                    ?>

                                        <tr>
                                            <td style="width: 10%;">
                                                <center><?php echo $value["ID_USUARIO"];  ?></center>
                                            </td>
                                            <td style="width: 20%;">
                                                <center><?php echo $value["NOMBRE_USUARIO"];  ?></center>
                                            </td>
                                            <?php

                                            if ($value["ESTADO"] == 1) {
                                            ?>
                                                <td style="width: 10%; color: #28a745;">
                                                    <center>ACTIVO</center>
                                                </td>
                                            <?php
                                            } else if ($value["ESTADO"] == 0) {
                                            ?>
                                                <td style="width: 10%; color: red;">
                                                    <center>INACTIVO</center>
                                                </td>
                                            <?php
                                            }
                                            ?>
                                            <?php

                                            if ($value["ID_ROL"] == 1) {
                                            ?>
                                                <td style="width: 15%; color: #007bff;">
                                                    <center>ADMINISTRADOR</center>
                                                </td>
                                            <?php
                                            } else if ($value["ID_ROL"] == 2) {
                                            ?>
                                                <td style="width: 15%; color: #28a745;">
                                                    <center>MÉDICO</center>
                                                </td>
                                            <?php
                                            } else {
                                            ?>
                                                <td style="width: 15%; color: #17a2b8;">
                                                    <center>PACIENTE</center>
                                                </td>
                                            <?php
                                            }
                                            ?>
                                            <td style=" width: 10%;">
                                                <center><img src="<?php echo $ruta, $value["IMG_PERFIL"];  ?>" class="brand-image img-circle" width="50px" height="50px" alt=""></center>
                                            </td>
                                            <td style="width: 15%;">
                                                <center><?php echo $value["FECHA_REGISTRO"]; ?></center>
                                            </td>
                                            <td style="width: 20%;">
                                                <center>
                                                    <button class="btn btn-block btn-warning RestablecerContraseña" email="<?php echo $value["NOMBRE_USUARIO"]; ?>" data-toggle="modal" data-target="#Rpassword">Restablecer Contraseña</button>
                                                </center>

                                            </td>
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
        </div>
    </section>
</section>



<div class="modal fade" rol="dialog" id="Rpassword">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" role="form">

                <div class="modal-body">

                    <div class="box-body">

                        <h5>RESTABLECER CONTRASEÑA!</h5>
                        <p>¿Deseas restablecer la contraseña de este usuario?</p>
                        <br/>

                        <input name="correoRestablecer" id="correoRestablecer" placeholder="" class="form-control" type="text">

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="submit" class="btn btn-danger"><i class="fas fa-check-circle"></i> Aceptar</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancelar</button>

                </div>

                <?php

                $restablecer = new UsuarioControlador();
                $restablecer->RestablecerPassword();

                ?>

            </form>

        </div>

    </div>

</div>