<?php

require_once 'conexionDB.php';

class SalasM extends ConexionDB
{
    static public function VerSalasM($tablaDB, $columna, $valor)
    {
        if ($columna == null) {

            $pdo = ConexionDB::cDB()->prepare("SELECT * FROM $tablaDB");

            $pdo->execute();

            return $pdo->fetchAll();
        } else {

            $pdo = ConexionDB::cDB()->prepare("SELECT * FROM $tablaDB WHERE $columna =:$columna");

            $pdo->bindParam(":" . $columna, $valor, pdo::PARAM_STR);

            $pdo->execute();

            return $pdo->fetch();
        }
    }

    //Editar Salas
    static public function ESalasM($tablaDB, $columna, $valor)
    {
        if ($columna == null) {

            $pdo = ConexionDB::cDB()->prepare("SELECT * FROM $tablaDB");

            $pdo->execute();

            return $pdo->fetch();
        }
    }

    //Crear Sala
    static public function CrearSalasM($tablaDB, $datosC)
    {

        $pdo = ConexionDB::cDB()->prepare("INSERT INTO $tablaDB(NUMERO, EDIFICIO, DETALLE_UBICACION) VALUES 
        (:numero, :edificio, :ubicacion)");

        $pdo->bindParam(":numero", $datosC["numero"], PDO::PARAM_STR);
        $pdo->bindParam(":edificio", $datosC["edificio"], PDO::PARAM_STR);
        $pdo->bindParam(":ubicacion", $datosC["ubicacion"], PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        }

        return print_r(ConexionDB::cDB()->errorInfo());
    }


    //Borrar Salas
    static public function BorrarSalaM($tablaDB, $id)
    {

        $pdo = ConexionDB::cDB()->prepare("DELETE FROM $tablaDB WHERE ID_SALA_MEDICA = :id");

        $pdo->bindParam(":id", $id, PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //Actualizar Salas
    static public function ActualizarSalasM($tablaDB, $datosC)
    {
        $pdo = ConexionDB::cDB()->prepare("UPDATE $tablaDB SET NUMERO = :numero, 
        EDIFICIO = :edificio, DETALLE_UBICACION = :ubicacion WHERE ID_SALA_MEDICA = :id");

        $pdo->bindParam(":id", $datosC["id"], PDO::PARAM_INT);
        $pdo->bindParam(":numero", $datosC["numero"], PDO::PARAM_STR);
        $pdo->bindParam(":edificio", $datosC["edificio"], PDO::PARAM_STR);
        $pdo->bindParam(":ubicacion", $datosC["ubicacion"], PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
