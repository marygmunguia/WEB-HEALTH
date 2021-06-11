<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Gestión de Especialidades Médicas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="principal-admin">Principal</a></li>
                    <li class="breadcrumb-item active">Especialidades Médicas</li>
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

                        <button class="btn btn-1 btn-brock" data-toggle="modal" data-target="#CrearEspecialidad"><i class="fas fa-plus-circle"></i> Crear Nueva</button>
                        <button class="btn btn-success btn-brock ImprimirEspecialidades" ><i class="fas fa-print"></i> Imprimir</button>

                    </div>


                    <div class="box-body">
                        <br />

                        <table id="ME" class="table table-bordered table-hover EM">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Duración</th>
                                    <th>Precio</th>
                                    <th>Editar</th>
                                    <th>Borrar</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $columna = null;
                                $valor = null;

                                $resultado = EspecialidadC::VerEspecialidadC($columna, $valor);

                                foreach ($resultado as $key => $value) {

                                ?>

                                    <tr>
                                        <td style="width: 10%;"><?php echo $value["ID_ESPECIALIDAD"];  ?></td>
                                        <td style="width: 10%;"><?php echo $value["NOMBRE_ESPECIALIDAD"];  ?></td>
                                        <td style="width: 40%;"><?php echo $value["DESCRIPCION"];  ?></td>
                                        <td style="width: 10%;"><?php echo $value["DURACION_CITA"];  ?> </td>
                                        <td style="width: 10%;"><?php echo $value["PRECIO_CITA"];  ?> </td>
                                        <td>
                                            <button class="btn btn-block btn-warning EditarEspecialidad" Did="<?php echo $value["ID_ESPECIALIDAD"]; ?>" data-toggle="modal" data-target="#EditarEspecialidad">Editar</button>
                                        </td>
                                        <td>
                                            <button class="btn btn-block btn-danger EliminarEspecialidad" Did="<?php echo $value["ID_ESPECIALIDAD"]; ?>" data-toggle="modal" data-target="#EliminarEspecialidad">Eliminar</button>
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


<!-- FORMULARIO DE CREAR ESPECIALIDAD -->
<div class="modal fade" rol="dialog" id="CrearEspecialidad">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" role="form">

                <div class="modal-body">

                    <div class="box-body">

                        <h5>Agregar una nueva especialidad médica</h5><br />
                        <div class="form-group">
                            <label><span style="color: red;"> * </span>Nombre:</label>
                            <input name="nombre" placeholder="" id="nombre" class="form-control" type="text" required> <br />
                        </div>
                        <div class="form-group">
                            <label>Descripción:</label>
                            <textarea name="descripcion" placeholder="" id="descripcion" class="form-control" type="text" rows="5"> </textarea><br />
                        </div>
                        <div class="form-group">
                            <label><span style="color: red;"> * </span>Duración en Minutos:</label>
                            <input name="duracion" placeholder="" id="duracion" required class="form-control" type="number" min="15"> <br />
                        </div>
                        <div class="form-group">
                            <label><span style="color: red;"> * </span>Precio en Lempiras:</label>
                            <input name="precio" placeholder="" id="precio" required class="form-control" type="number" min="100"> <br />
                        </div>
                    </div>

                </div>


                <div class="modal-footer">

                    <button type="submit" class="btn btn-1"><i class="fas fa-plus-circle"></i> Agregar</button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancelar</button>

                </div>

                <?php

                $crearEspecialidad = new EspecialidadC();
                $crearEspecialidad->CrearEspecialidadC();

                ?>

            </form>

        </div>

    </div>

</div>


<!-- FORMULARIO DE EDITAR ESPECIALIDAD -->
<div class="modal fade" rol="dialog" id="EditarEspecialidad">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" role="form">

                <div class="modal-body">

                    <div class="box-body">

                        <h5>Actualizar especialidad médica</h5><br />
                        <div class="form-group">
                            <input type="hidden" name="Did" id="Did">
                            <label><span style="color: red;"> * </span>Nombre:</label>
                            <input name="nombreE" placeholder="" id="nombreE" class="form-control" type="text" required> <br />
                        </div>
                        <div class="form-group">
                            <label>Descripción:</label>
                            <textarea name="descripcionE" placeholder="" id="descripcionE" class="form-control" type="text" rows="5"> </textarea><br />
                        </div>
                        <div class="form-group">
                            <label><span style="color: red;"> * </span>Duración en Minutos:</label>
                            <input name="duracionE" placeholder="" id="duracionE" required class="form-control" type="number" min="15"> <br />
                        </div>
                        <div class="form-group">
                            <label><span style="color: red;"> * </span>Precio en Lempiras:</label>
                            <input name="precioE" placeholder="" id="precioE" required class="form-control" type="number" min="100"> <br />
                        </div>
                    </div>

                </div>


                <div class="modal-footer">

                    <button type="submit" class="btn btn-1"><i class="fas fa-check-circle"></i> Actualizar</button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancelar</button>

                </div>

                <?php

                $editarEspecialidad = new EspecialidadC();
                $editarEspecialidad->ActualizarEspecialidadesC();

                ?>

            </form>

        </div>

    </div>

</div>


<!-- FORMULARIO DE ELIMINAR ESPECIALIDAD -->
<div class="modal fade" rol="dialog" id="EliminarEspecialidad">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" role="form">

                <div class="modal-body">

                    <div class="box-body">
                        <h5>Eliminar especialidad médica</h5><br />
                        <p>¿Deseas eliminar la especialidad médica definitivamente?</p>
                        <div class="form-group">
                            <input type="hidden" name="Did1" id="Did1">
                        </div>

                    </div>


                    <div class="modal-footer">

                        <button type="submit" class="btn btn-1"><i class="fas fa-check-circle"></i> Aceptar</button>

                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancelar</button>

                    </div>

                    <?php

                    $borrarEspecialidad = new EspecialidadC();
                    $borrarEspecialidad->BorrarEspecialidadC();

                    ?>

            </form>

        </div>

    </div>

</div>