<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Gestión de Enfermedades Base</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="principal-admin">Principal</a></li>
                    <li class="breadcrumb-item active">Enfermedades Base</li>
                </ol>
            </div>
        </div>
    </div>
</section>


<section class="content">
    <div class="card">
        <div class="card-body">
            <div class="container">


                <div class="box">

                    <div class="box-header">

                        <button class="btn btn-1 btn-brock" data-toggle="modal" data-target="#CrearEB"><i class="fas fa-plus-circle"></i> Crear Nueva</button>

                    </div>


                    <div class="box-body">
                        <br />

                        <table id="ME" class="table table-bordered table-hover EB">
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

                                $resultado = Enfermadades_baseC::VerEnfermedadesBaseC($columna, $valor);

                                foreach ($resultado as $key => $value) {

                                ?>

                                    <tr>
                                        <td style="width: 10%;"><?php echo $value["CODIGO_ENFERMEDAD_BASE"];  ?></td>
                                        <td style="width: 10%;"><?php echo $value["NOMBRE_ENFERMEDAD_BASE"];  ?></td>
                                        <td style="width: 50%;"><?php echo $value["OBS"];  ?> </td>
                                        <td>
                                            <button class="btn btn-block btn-warning EditarEB" Did="<?php echo $value["CODIGO_ENFERMEDAD_BASE"]; ?>" data-toggle="modal" data-target="#EditarEB">Editar</button>
                                        </td>
                                        <td>
                                            <button class="btn btn-block btn-danger EliminarEB" Did="<?php echo $value["CODIGO_ENFERMEDAD_BASE"]; ?>" data-toggle="modal" data-target="#EliminarEB">Eliminar</button>
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



<div class="modal fade" rol="dialog" id="CrearEB">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" role="form">

                <div class="modal-body">

                    <div class="box-body">

                        <h5>Agregar una nueva Enfermedad Base</h5><br />
                        <div class="form-group">
                            <label><span style="color: red;"> * </span>Nombre:</label>
                            <input name="nom" placeholder="" id="nom" class="form-control" type="text" required> <br />
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

                $crear = new Enfermadades_baseC();
                $crear -> crearEnfermedadesBase();

                ?>

            </form>

        </div>

    </div>

</div>


<div class="modal fade" rol="dialog" id="EditarEB">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" role="form">

                <div class="modal-body">

                    <div class="box-body">

                        <h5>Actualizar Enfermedad Base</h5><br />
                        <input name="Did" id="Did" placeholder="" class="form-control" type="hidden">
                        <div class="form-group">
                            <label><span style="color: red;"> * </span>Nombre:</label>
                            <input name="nomE" placeholder="" id="nomE" class="form-control" type="text" required> <br />
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

                $actualizar = new Enfermadades_baseC();
                $actualizar -> ActualizarEB();

                ?>

            </form>

        </div>

    </div>

</div>


<div class="modal fade" rol="dialog" id="EliminarEB">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" role="form">

                <div class="modal-body">

                    <div class="box-body">

                        <h5>ELIMINAR!</h5>
                        <p>¿Deseas eliminar definiticamente el registro?</p>
                        <br />

                        <input name="Did1" id="Did1" placeholder="" class="form-control" type="hidden">

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="submit" class="btn btn-danger"><i class="fas fa-check-circle"></i> Aceptar</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancelar</button>

                </div>

                <?php

                $eliminarEB = new Enfermadades_baseC();
                $eliminarEB->BorrarEnfermedadB();

                ?>

            </form>
        </div>
    </div>
</div>