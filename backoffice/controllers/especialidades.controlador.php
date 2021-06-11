<?php

class EspecialidadC
{


    public function CrearEspecialidadC()
    {

        if (isset($_POST["nombre"])) {

            $tablaDB = "especialidad";

            $datosC = array(
                "nombre" => $_POST["nombre"],
                "descripcion" => $_POST["descripcion"],
                "duracion" => $_POST["duracion"],
                "precio" => $_POST["precio"]
            );

            $resultado = EspecialidadM::CrearEspecialidadM($tablaDB, $datosC);
            $ruta = ControladorRuta::ctrRuta();

            if ($resultado == true) {
?>
                <script LANGUAGE="javascript">
                    $(document).ready(function() {

                        swal({
                            titltype: "success",
                            title: "¡CORRECTO!",
                            text: "SE HA GUARDADO EL REGISTRO SATISFACTORIAMENTE",
                            showConfirmButtom: true,
                            confirmButtomText: "Cerrar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "<?php echo $ruta; ?>especialidades";
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
                            text: "NO SE HA GUARDADO EL REGISTRO SATISFACTORIAMENTE",
                            showConfirmButtom: true,
                            confirmButtomText: "Cerrar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "<?php echo $ruta; ?>especialidades";
                            }
                        })

                    });
                </script>

            <?php
            }
        }
    }

    static public function VerEspecialidadC($columna, $valor)
    {

        $tablaDB = "especialidad";

        $resultado = EspecialidadM::VerEspecialidadM($tablaDB, $columna, $valor);

        return $resultado;
        
    }


    public function ActualizarEspecialidadesC()
    {

        if (isset($_POST["nombreE"])) {

            $tablaDB = "especialidad";

            $datosC = array(
                "id" => $_POST["Did"],
                "nombre" => $_POST["nombreE"],
                "descripcion" => $_POST["descripcionE"],
                "duracion" => $_POST["duracionE"],
                "precio" => $_POST["precioE"]
            );

            $resultado = EspecialidadM::ActualizarEspecialidadesM($tablaDB, $datosC);

            $ruta = ControladorRuta::ctrRuta();

            if ($resultado == true) {

            ?>
                <script LANGUAGE="javascript">
                    $(document).ready(function() {

                        swal({
                            titltype: "success",
                            title: "¡CORRECTO!",
                            text: "SE HA ACTUALIZADO EL REGISTRO SATISFACTORIAMENTE",
                            showConfirmButtom: true,
                            confirmButtomText: "Cerrar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "<?php echo $ruta; ?>especialidades";
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
                            text: "NO SE HA ACTUALIZADO EL REGISTRO SATISFACTORIAMENTE",
                            showConfirmButtom: true,
                            confirmButtomText: "Cerrar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "<?php echo $ruta; ?>especialidades";
                            }
                        })

                    });
                </script>

            <?php

            }
        }
    }


    public function BorrarEspecialidadC()
    {
        if (isset($_POST["Did1"])) {

            $tablaDB = "especialidad";

            $id = $_POST["Did1"];

            $resultado = EspecialidadM::BorrarConsultorioM($tablaDB, $id);


            $ruta = ControladorRuta::ctrRuta();

            if ($resultado == true) {

            ?>
                <script LANGUAGE="javascript">
                    $(document).ready(function() {

                        swal({
                            titltype: "success",
                            title: "¡CORRECTO!",
                            text: "SE HA ELIMINADO EL REGISTRO SATISFACTORIAMENTE",
                            showConfirmButtom: true,
                            confirmButtomText: "Cerrar"
                        }).then((result) => {
                            if (result.value) {

                                window.location = "<?php echo $ruta; ?>especialidades";
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
                            text: "NO SE HA ELIMINADO EL REGISTRO SATISFACTORIAMENTE",
                            showConfirmButtom: true,
                            confirmButtomText: "Cerrar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "<?php echo $ruta; ?>especialidades";
                            }
                        })

                    });
                </script>

<?php

            }
        }
    }


    static public function ConsultarEspecialidadC($tablaDB, $columna, $valor)
    {
        $resultado = EspecialidadM::VerEspecialidadM($tablaDB, $columna, $valor);

        return $resultado;
    }

}
