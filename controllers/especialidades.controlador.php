<?php

class EspecialidadC
{

    static public function VerEspecialidadC($columna, $valor)
    {

        $tablaDB = "inicio_especialidad";

        $resultado = EspecialidadM::VerEspecialidadM($tablaDB, $columna, $valor);

        return $resultado;
    }


    static public function ConsultarEspecialidadC($tablaDB, $columna, $valor)
    {
        $resultado = EspecialidadM::VerEspecialidadM($tablaDB, $columna, $valor);

        return $resultado;
    }

}
