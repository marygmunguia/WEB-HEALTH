<?php

require_once "conexionDB.php";

class Enfermadades_BaseM extends ConexionDB
{

    //Consultar la base de datos
    static public function VerEnfermadadesBaseM($tablaDB, $columna, $valor)
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


    //INSERTAR REGISTRO EN LA BD

    static public function CrearEnfermedadesBase($tablaDB, $datosC)
    {

        $pdo = ConexionDB::cDB()->prepare("INSERT INTO $tablaDB(NOMBRE_ENFERMEDAD_BASE, OBS) VALUES 
        (:nombre, :observaciones)");

        $pdo->bindParam(":nombre", $datosC["nombre"], PDO::PARAM_STR);
        $pdo->bindParam(":observaciones", $datosC["observaciones"], PDO::PARAM_STR);

        if ($pdo->execute()) {

            return true;
        } else {

            return print_r(ConexionDB::cDB()->errorInfo());
        }
    }

    //BORRAR REGISTRO DE ENFERMEDAD BASE
    static public function BorrarEnfermedadB($tablaDB, $id)
    {

        $pdo = ConexionDB::cDB()->prepare("DELETE FROM $tablaDB WHERE CODIGO_ENFERMEDAD_BASE = :id");

        $pdo->bindParam(":id", $id, PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //ACTUALIZAR REGISTRO DE ENFERMEDAD BASE
    static public function ActualizarEB($tablaDB, $datosC)
    {

        $pdo = ConexionDB::cDB()->prepare("UPDATE $tablaDB SET NOMBRE_ENFERMEDAD_BASE = :nombre, 
        OBS = :obs WHERE CODIGO_ENFERMEDAD_BASE = :id");

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
