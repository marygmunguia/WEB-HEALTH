<?php

class SalasC{

    //Mostrar Salas
    static public function VerSalasC($columna, $valor)
    {

        $tablaDB = "salas";

        $resultado = SalasM::VerSalasM($tablaDB, $columna, $valor);

        return $resultado;
    }

    //Editar Salas
    static public function ESalasC($columna, $valor)
    {

        $tablaDB = "salas";

        $resultado = SalasM::ESalasM($tablaDB, $columna, $valor);

        return $resultado;
    }


    //Crear Salas
    public function CrearSalasC()
    {

        if (isset($_POST["numero"])) {

            $tablaDB = "salas";

            $datosC = array(
                "numero" => $_POST["numero"],
                "edificio" => $_POST["edificio"],
                "ubicacion" => $_POST["ubicacion"]
            );

            $resultado = SalasM::CrearSalasM($tablaDB, $datosC);

            $ruta = ControladorRuta::ctrRuta();


            if ($resultado == true) {

                $ruta = ControladorRuta::ctrRuta();

?>
                <script LANGUAGE="javascript">
                    $(document).ready(function() {

                        swal({
                            titltype: "success",
                            title: "¡CORRECTO!",
                            text: "SE HA GUARDADO EL REGISTRO SATISFACTORIAMENTE",
                            showConfirmButtom: true,
                            confirmButtomText: "Aceptar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "<?php echo $ruta; ?>salas";
                            }
                        })

                    });
                </script>

            <?php

            } else {

                $ruta = ControladorRuta::ctrRuta();

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
                                window.location = "<?php echo $ruta; ?>salas";
                            }
                        })

                    });
                </script>

            <?php

            }
        }
    }

    //Eliminar Salas
    public function BorrarSalaC()
    {
        if (isset($_POST["Did1"])) {

            $tablaDB = "salas";

            $datosC = $_POST["Did1"];

            $resultado = SalasM::BorrarSalaM($tablaDB, $datosC);

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
                                window.location = "<?php echo $ruta; ?>salas";
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
                                window.location = "<?php echo $ruta; ?>salas";
                            }
                        })

                    });
                </script>

            <?php

            }
        }
    }


    //Actializar Salas

    public function ActualizarSalasC()
    {

        if (isset($_POST["Did"])) {

            $tablaDB = "salas";

            $datosC = array(
                "id" => $_POST["Did"],
                "numero" => $_POST["numeroE"],
                "edificio" => $_POST["edificioE"],
                "ubicacion" => $_POST["ubicacionE"]
            );

            $resultado = SalasM::ActualizarSalasM($tablaDB, $datosC);

            $ruta = ControladorRuta::ctrRuta();

            if ($resultado == true) {

            ?>

                <script>
                    window.location = "<?php echo $ruta; ?>salas";
                </script>

<?php
            }
        }
    }
}
