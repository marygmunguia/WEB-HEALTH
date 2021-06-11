<?php

class Enfermadades_baseC {


    // VER ENFERMEDADES BASE DE LA BASE DE DATOS
    static public function VerEnfermedadesBaseC($columna, $valor)
    {

        $tablaDB = "enfermedades_base";

        $resultado = Enfermadades_BaseM::VerEnfermadadesBaseM($tablaDB, $columna, $valor);

        return $resultado;

    }
    
    //CREAR ENFERMADADES BASE 
    public function crearEnfermedadesBase(){
        if (isset($_POST["nom"])) {
        
            $tablaDB = "enfermedades_base";

            $datosC = array(
                "nombre" => $_POST["nom"],
                "observaciones" => $_POST["obs"]
            );

            $resultado = Enfermadades_BaseM::CrearEnfermedadesBase($tablaDB, $datosC);

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
                                window.location = "<?php echo $ruta; ?>registro-enfermedades";
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
                                window.location = "<?php echo $ruta; ?>registro-enfermedades";
                            }
                        })

                    });
                </script>

            <?php
            }
        }
    }


    //ELIMINAR ENFERMEDAD BASE
    public function BorrarEnfermedadB()
    {
        if (isset($_POST["Did1"])) {

            $tablaDB = "enfermedades_base";

            $id = $_POST["Did1"];

            $resultado = Enfermadades_BaseM::BorrarEnfermedadB($tablaDB, $id);

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
                                window.location = "<?php echo $ruta; ?>registro-enfermedades";
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
                                window.location = "<?php echo $ruta; ?>registro-enfermedades";
                            }
                        })

                    });
                </script>

            <?php

            }
        }
    }



    //ACTUALIZAR ENFERMEDAD BASE

    public function ActualizarEB()
    {

        if (isset($_POST["Did"])) {

            $tablaDB = "enfermedades_base";

            $datosC = array(
                "id" => $_POST["Did"],
                "nombre" => $_POST["nomE"],
                "obs" => $_POST["obsE"]
            );

            $resultado = Enfermadades_BaseM::ActualizarEB($tablaDB, $datosC);

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
                                    window.location = "<?php echo $ruta; ?>registro-enfermedades";
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
                                    window.location = "<?php echo $ruta; ?>registro-enfermedades";
                                }
                            })
    
                        });
                    </script>
    
                <?php
            }
        }
    }



}