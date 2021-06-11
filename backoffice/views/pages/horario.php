<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Registrar Horarios Médicos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="principal-admin">Home</a></li>
                    <li class="breadcrumb-item active">Horario</li>
                </ol>
            </div>
        </div>
    </div>
</section>


<div class="container">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Horarios Médicos</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <button class="btn btn-1 btn-brock" data-toggle="modal" data-target="#crearHorario"><i class="fas fa-plus-circle"></i> Registrar Horario</button>
            </div>
        </div>
        <div class="card-footer">
           
        </div>
    </div>
</div>


<div class="modal fade" rol="dialog" id="crearHorario">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" role="form">

                <div class="modal-body">

                    <div class="box-body">
                        <label><span style="color: red;"> * </span>Seleccione el doctor:</label>
                        <select name="idmedico" id="idmedico" class="form-control">

                            <option value="0">SELECCIONA EL MEDICO AL CUAL ASIGNAR UN HORARIO</option>

                            <?php
                            $columna = NULL;
                            $valor = NULL;
                            $cMedico = DoctorC::VerMedicoRegistrado($columna, $valor);

                            foreach ($cMedico as $key => $value) {

                                echo '<option value="' . $value["ID_MEDICO"] . '"> ' . $value["NOMBRE"] . " " . $value["APELLIDO"] . '</option>';
                            }
                            ?>
                        </select><br />

                        <label><span style="color: red;"> * </span>Seleccione minimo un día de la semana para registrar:</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" onchange="javascript:showContentLunes()" id="Lunes" name="Lunes">
                            <label class="form-check-label">LUNES</label>

                            <div id="LunesH" style="display: none;">
                                <div class="form-group">
                                    Hora de Entrada: <input type="time" name="horaLunesE" id=""><br />
                                </div>
                                <div class="form-group">
                                    Hora de Salida: <input type="time" name="horaLunesS" id=""><br />
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" onchange="javascript:showContentMartes()" id="Martes" name="Martes">
                            <label class="form-check-label">MARTES</label>

                            <div id="MartesH" style="display: none;">
                                <div class="form-group">
                                    Hora de Entrada: <input type="time" name="horaMartesE" id=""><br />
                                </div>
                                <div class="form-group">
                                    Hora de Salida: <input type="time" name="horaMartesS" id=""><br />
                                </div>
                            </div>

                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" onchange="javascript:showContentMiercoles()" id="Miercoles" name="Miercoles">
                            <label class="form-check-label">MIÉRCOLES</label>

                            <div id="MiercolesH" style="display: none;">
                                <div class="form-group">
                                    Hora de Entrada: <input type="time" name="horaMiercolesE" id=""><br />
                                </div>
                                <div class="form-group">
                                    Hora de Salida: <input type="time" name="horaMiercolesS" id=""><br />
                                </div>
                            </div>

                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" onchange="javascript:showContentJueves()" id="Jueves" name="Jueves">
                            <label class="form-check-label">JUEVES</label>

                            <div id="JuevesH" style="display: none;">
                                <div class="form-group">
                                    Hora de Entrada: <input type="time" name="horaJuevesE" id=""><br />
                                </div>
                                <div class="form-group">
                                    Hora de Salida: <input type="time" name="horaJuevesS" id=""><br />
                                </div>
                            </div>

                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" onchange="javascript:showContentViernes()" id="Viernes" name="Viernes">
                            <label class="form-check-label">VIERNES</label>

                            <div id="ViernesH" style="display: none;">
                                <div class="form-group">
                                    Hora de Entrada: <input type="time" name="horaViernesE" id=""><br />
                                </div>
                                <div class="form-group">
                                    Hora de Salida: <input type="time" name="horaViernesS" id=""><br />
                                </div>
                            </div>

                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" onchange="javascript:showContentSabado()" id="Sabado" name="Sabado">
                            <label class="form-check-label">SÁBADO</label>

                            <div id="SabadoH" style="display: none;">
                                <div class="form-group">
                                    Hora de Entrada: <input type="time" name="horaSabadoE" id=""><br />
                                </div>
                                <div class="form-group">
                                    Hora de Salida: <input type="time" name="horaSabadoS" id=""><br />
                                </div>
                            </div>

                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" onchange="javascript:showContentDomingo()" id="Domingo" name="Domingo">
                            <label class="form-check-label">DOMINGO</label>

                            <div id="DomingoH" style="display: none;">
                                <div class="form-group">
                                    Hora de Entrada: <input type="time" name="horaDomingoE" id=""><br />
                                </div>
                                <div class="form-group">
                                    Hora de Salida: <input type="time" name="horaDomingoS" id=""><br />
                                </div>
                            </div>

                        </div>

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="submit" class="btn btn-1"><i class="fas fa-plus-circle"></i> Agregar</button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancelar</button>

                </div>

                <?php

                $registrar = new DoctorC();
                $registrar->HorarioMedico();

                ?>

            </form>

        </div>

    </div>

</div>