<?php

require_once "conexionDB.php";

class EspecialidadM extends ConexionDB
{


    //Consultar la base de datos
    static public function VerEspecialidadM($tablaDB, $columna, $valor)
    {
        if ($columna == null) {

            $pdo = ConexionDB::cDB()->prepare("SELECT * FROM $tablaDB");

            $pdo->execute();

            return $pdo->fetchAll();
        } else {
            $pdo = ConexionDB::cDB()->prepare("SELECT * FROM $tablaDB WHERE $columna =:$columna");

            $pdo->bindParam(":" . $columna, $valor, pdo::PARAM_STR);

            $pdo->execute();

            return $pdo->fetchAll();
        }
    }

    
}
