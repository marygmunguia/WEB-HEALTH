    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestión de Salas Médicas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="principal-admin">Principal</a></li>
                        <li class="breadcrumb-item active">Salas Médicas</li>
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

                            <button class="btn btn-1 btn-brock" data-toggle="modal" data-target="#CrearSala"><i class="fas fa-plus-circle"></i> Crear Nueva</button>

                        </div>


                        <div class="box-body">
                            <br />

                            <table id="ME" class="table table-bordered table-hover SM">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">ID</th>
                                        <th>Número</th>
                                        <th>Edificio</th>
                                        <th>Detalle de Ubicación</th>
                                        <th>Editar</th>
                                        <th>Borrar</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $columna = null;
                                    $valor = null;

                                    $resultado = SalasC::VerSalasC($columna, $valor);

                                    foreach ($resultado as $key => $value) {

                                    ?>

                                        <tr>
                                            <td style="width: 10%;"><?php echo $value["ID_SALA_MEDICA"];  ?></td>
                                            <td style="width: 10%;"><?php echo $value["NUMERO"];  ?></td>
                                            <td style="width: 10%;"><?php echo $value["EDIFICIO"];  ?></td>
                                            <td style="width: 50%;"><?php echo $value["DETALLE_UBICACION"];  ?> </td>
                                            <td>
                                                <button class="btn btn-block btn-warning EditarSalas" Did="<?php echo $value["ID_SALA_MEDICA"]; ?>" data-toggle="modal" data-target="#EditarSala">Editar</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-block btn-danger EliminarSalas" Did="<?php echo $value["ID_SALA_MEDICA"]; ?>" data-toggle="modal" data-target="#EliminarSala">Eliminar</button>
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



<div class="modal fade" rol="dialog" id="CrearSala">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" role="form">

                <div class="modal-body">

                    <div class="box-body">

                        <h5>Agregar una nueva sala médica</h5><br />
                        <div class="form-group">
                            <label><span style="color: red;"> * </span>Número:</label>
                            <input name="numero" placeholder="" id="numero" class="form-control" type="text" required> <br />
                        </div>
                        <div class="form-group">
                            <label>Edificio:</label>
                            <input name="edificio" placeholder="" id="edificio" class="form-control" type="text"> <br />
                        </div>
                        <div class="form-group">
                            <label>Detalles de ubicación:</label>
                            <textarea name="ubicacion" placeholder="" id="ubicacion" class="form-control" type="text" rows="5"> </textarea><br />
                        </div>
                    </div>

                </div>


                <div class="modal-footer">

                    <button type="submit" class="btn btn-1"><i class="fas fa-plus-circle"></i> Agregar</button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancelar</button>

                </div>

                <?php

                $crearSala = new SalasC();
                $crearSala->CrearSalasC();

                ?>

            </form>

        </div>

    </div>

</div>


<div class="modal fade" rol="dialog" id="EditarSala">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" role="form">

                <div class="modal-body">

                    <div class="box-body">

                        <h5>Actualizar la sala médica</h5><br />
                        <input name="Did" id="Did" placeholder="" class="form-control" type="hidden">
                        <div class="form-group">
                            <label><span style="color: red;"> * </span>Número:</label>
                            <input name="numeroE" placeholder="" id="numeroE" class="form-control" type="text" required> <br />
                        </div>
                        <div class="form-group">
                            <label>Edificio:</label>
                            <input name="edificioE" placeholder="" id="edificioE" class="form-control" type="text"> <br />
                        </div>
                        <div class="form-group">
                            <label>Detalles de ubicación:</label>
                            <textarea name="ubicacionE" placeholder="" id="ubicacionE" class="form-control" type="text" rows="5"> </textarea><br />
                        </div>
                    </div>

                </div>


                <div class="modal-footer">

                    <button type="submit" class="btn btn-warning"><i class="fas fa-check-circle"></i> Actualizar</button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancelar</button>

                </div>

                <?php

                $editarSala = new SalasC();
                $editarSala->ActualizarSalasC();

                ?>

            </form>

        </div>

    </div>

</div>


<div class="modal fade" rol="dialog" id="EliminarSala">

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

                $eliminarSala = new SalasC();
                $eliminarSala->BorrarSalaC();

                ?>

            </form>

        </div>

    </div>

</div>