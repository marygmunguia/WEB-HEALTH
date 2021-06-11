<section class="content">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sintemas Comunes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="principal-admin">Principal</a></li>
                        <li class="breadcrumb-item active">Sintomas comunes</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
</section>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Gestión sintomas comunes</h3>
        </div>

        <div class="card-body">
            <div class="container">


                <div class="box">

                    <div class="box-header">

                        <button class="btn btn-1 btn-brock" data-toggle="modal" data-target="#Crear"><i class="fas fa-plus-circle"></i> Crear Nueva</button>

                    </div>


                    <div class="box-body">
                        <br />

                        <table id="ME" class="table table-bordered table-hover SC">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Observaciones</th>
                                    <th>Editar</th>
                                    <th>Borrar</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $columna = null;
                                $valor = null;

                                $resultado = SintomasControlador::VerSintomasC($columna, $valor);

                                foreach ($resultado as $key => $value) {

                                ?>

                                    <tr>
                                        <td style="width: 15%;"><?php echo $value["CODIGO_SINTOMA_COMUN"];  ?></td>
                                        <td style="width: 15%;"><?php echo $value["NOMBRE_SINTOMA_COMUN"];  ?></td>
                                        <td style="width: 50%;"><?php echo $value["OBS"];  ?></td>
                                        <td>
                                            <button class="btn btn-block btn-warning EditarSintoma" Did="<?php echo $value["CODIGO_SINTOMA_COMUN"]; ?>" data-toggle="modal" data-target="#Editar">Editar</button>
                                        </td>
                                        <td>
                                            <button class="btn btn-block btn-danger EliminarSintoma" Did="<?php echo $value["CODIGO_SINTOMA_COMUN"]; ?>" data-toggle="modal" data-target="#Eliminar">Eliminar</button>
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



<div class="modal fade" rol="dialog" id="Crear">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" role="form">

                <div class="modal-body">

                    <div class="box-body">

                        <h5>Agregar Nuevo Sintoma Común</h5><br />
                        <div class="form-group">
                            <label><span style="color: red;"> * </span>Nombre:</label>
                            <input name="nombre" placeholder="" id="nombre" class="form-control" type="text" required> <br />
                        </div>
                        <div class="form-group">
                            <label>Observaciones:</label>
                            <textarea name="obs" placeholder="" id="obs" class="form-control" type="text" rows="5"> </textarea><br />
                        </div>
                    </div>

                </div>


                <div class="modal-footer">

                    <button type="submit" class="btn btn-1"><i class="fas fa-plus-circle"></i> Agregar</button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancelar</button>

                </div>

                <?php

                $crear = new SintomasControlador();
                $crear->CrearSintomaC();

                ?>

            </form>

        </div>

    </div>

</div>


<div class="modal fade" rol="dialog" id="Editar">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" role="form">

                <div class="modal-body">

                    <div class="box-body">

                        <h5>Actualizar Sintoma Común</h5><br />
                        <input name="Did" id="Did" class="form-control" type="hidden">
                        <div class="form-group">
                            <label><span style="color: red;"> * </span>Nombre:</label>
                            <input name="nombreE" placeholder="" id="nombreE" class="form-control" type="text" required> <br />
                        </div>
                        <div class="form-group">
                            <label>Observaciones:</label>
                            <textarea name="obsE" placeholder="" id="obsE" class="form-control" type="text" rows="5"> </textarea><br />
                        </div>

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="submit" class="btn btn-warning"><i class="fas fa-check-circle"></i> Actualizar</button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancelar</button>

                </div>

                <?php

                $actualizar = new SintomasControlador();
                $actualizar->ActualizarSintomaC();

                ?>

            </form>

        </div>

    </div>

</div>


<div class="modal fade" rol="dialog" id="Eliminar">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" role="form">

                <div class="modal-body">

                    <div class="box-body">

                        <h5>ELIMINAR!</h5>
                        <p>¿Deseas eliminar definiticamente el registro?</p>
                        <br />

                        <input name="Did1" id="Did1" class="form-control" type="hidden">

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="submit" class="btn btn-danger"><i class="fas fa-check-circle"></i> Aceptar</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancelar</button>

                </div>

                <?php

                $eliminar = new SintomasControlador();
                $eliminar->BorrarSintomaC();

                ?>

            </form>

        </div>

    </div>

</div>