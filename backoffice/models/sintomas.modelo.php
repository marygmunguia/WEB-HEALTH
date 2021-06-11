<?php

require_once 'conexionDB.php';

class SintomasModelo extends ConexionDB
{

    //CONSULTAR
    static public function VerSintomasM($tablaDB, $columna, $valor)
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

    //INSERTAR
    static public function CrearSintomaM($tablaDB, $datosC)
    {

        $pdo = ConexionDB::cDB()->prepare("INSERT INTO $tablaDB(NOMBRE_SINTOMA_COMUN, OBS) VALUES 
        (:nombre, :obs)");

        $pdo->bindParam(":nombre", $datosC["nombre"], PDO::PARAM_STR);
        $pdo->bindParam(":obs", $datosC["obs"], PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        }

        return print_r(ConexionDB::cDB()->errorInfo());
    }

    //ELIMINAR
    static public function BorrarSintomaM($tablaDB, $id)
    {

        $pdo = ConexionDB::cDB()->prepare("DELETE FROM $tablaDB WHERE CODIGO_SINTOMA_COMUN = :id");

        $pdo->bindParam(":id", $id, PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //ACTUALIZAR
    static public function ActualizarSintomaM($tablaDB, $datosC)
    {
        $pdo = ConexionDB::cDB()->prepare("UPDATE $tablaDB SET NOMBRE_SINTOMA_COMUN = :nombre, 
        OBS = :obs WHERE CODIGO_SINTOMA_COMUN = :id");

        $pdo->bindParam(":id", $datosC["id"], PDO::PARAM_INT);
        $pdo->bindParam(":nombre", $datosC["nombre"], PDO::PARAM_STR);
        $pdo->bindParam(":obs", $datosC["obs"], PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        } else {
            return false;
        }
    }
}