<?php

class reservaModelo
{

    static public function AgendaCitaM($tablaDB, $datosC)
    {
        $pdo = ConexionDB::cDB()->prepare("INSERT INTO $tablaDB (ID_CLIENTE, ID_MEDICO, ID_ESPECIALIDAD, FECHA_CITA, HORA_INICIO, ID_ESTADO_CITA) VALUES 
        (:idcliente, :idmedico, :idespecialidad, :fecha_cita, :hora_Inicio, :estado_cita)");

        $pdo->bindParam(":idcliente", $datosC["idcliente"], PDO::PARAM_STR);
        $pdo->bindParam(":idmedico", $datosC["idmedico"], PDO::PARAM_STR);
        $pdo->bindParam(":idespecialidad", $datosC["idespecialidad"], PDO::PARAM_STR);
        $pdo->bindParam(":fecha_cita", $datosC["fecha_cita"], PDO::PARAM_STR);
        $pdo->bindParam(":hora_Inicio", $datosC["hora_Inicio"], PDO::PARAM_STR);
        $pdo->bindParam(":estado_cita", $datosC["estado_cita"], PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        }else{
            return false;
        }

        return print_r(ConexionDB::cDB()->errorInfo());
    }
}
