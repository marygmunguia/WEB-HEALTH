<?php

require_once "conexionDB.php";

class EspecialidadM extends ConexionDB
{

    //Insertar registro en la base de Datos
    static public function CrearEspecialidadM($tablaDB, $datosC)
    {

        $pdo = ConexionDB::cDB()->prepare("INSERT INTO $tablaDB(NOMBRE_ESPECIALIDAD, DESCRIPCION, DURACION_CITA, PRECIO_CITA) VALUES (:nombre, :descripcion, :duracion, :precio)");

        $pdo->bindParam(":nombre", $datosC["nombre"], PDO::PARAM_STR);
        $pdo->bindParam(":descripcion", $datosC["descripcion"], PDO::PARAM_STR);
        $pdo->bindParam(":duracion", $datosC["duracion"], PDO::PARAM_STR);
        $pdo->bindParam(":precio", $datosC["precio"], PDO::PARAM_STR);


        if ($pdo->execute()) {
            return true;
        }

        return print_r(ConexionDB::cDB()->errorInfo());
    }

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

            return $pdo->fetch();
        }
    }

    static public function ActualizarEspecialidadesM($tablaDB, $datosC)
    {
        $pdo = ConexionDB::cDB()->prepare("UPDATE $tablaDB SET NOMBRE_ESPECIALIDAD = :nombre, 
        DESCRIPCION = :descripcion, DURACION_CITA = :duracion, PRECIO_CITA = :precio WHERE ID_ESPECIALIDAD = :id");

        $pdo->bindParam(":id", $datosC["id"], PDO::PARAM_INT);
        $pdo->bindParam(":nombre", $datosC["nombre"], PDO::PARAM_STR);
        $pdo->bindParam(":descripcion", $datosC["descripcion"], PDO::PARAM_STR);
        $pdo->bindParam(":duracion", $datosC["duracion"], PDO::PARAM_STR);
        $pdo->bindParam(":precio", $datosC["precio"], PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        } else {
            return false;
        }
    }


    static public function BorrarConsultorioM($tablaDB, $id)
    {

        $pdo = ConexionDB::cDB()->prepare("DELETE FROM $tablaDB WHERE ID_ESPECIALIDAD = :id");

        $pdo->bindParam(":id", $id, PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
