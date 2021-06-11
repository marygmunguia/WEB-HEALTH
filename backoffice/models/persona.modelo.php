<?php

require_once 'conexionDB.php';

class PersonaM extends ConexionDB
{

    //CONSULTA GENERALES SEXO, TIPO DE DOCUMENTO, ETC.
    static public function Consultar($tablaDB)
    {

        $pdo = ConexionDB::cDB()->prepare("SELECT * FROM $tablaDB");

        $pdo->execute();

        return $pdo->fetchAll();

        $pdo . close();
        $pdo = null;
    }

    // CONSULTA DE USUARIOS
    static public function ConsultarUsuariosM($tablaDB, $columna, $valor)
    {
        if ($columna == null) {

            $pdo = ConexionDB::cDB()->prepare("SELECT * FROM $tablaDB");

            $pdo->execute();

            return $pdo->fetchAll();

            $pdo . close();
            $pdo = null;
        } else {
            $pdo = ConexionDB::cDB()->prepare("SELECT * FROM $tablaDB WHERE $columna =:$columna");

            $pdo->bindParam(":" . $columna, $valor, pdo::PARAM_STR);

            $pdo->execute();

            return $pdo->fetch();

            $pdo . close();
            $pdo = null;
        }
    }

    //REGISTRAR DATOS PERSONALES
    static public function CrearPersonaM($tablaDB1, $datosC)
    {

        $pdo = ConexionDB::cDB()->prepare("INSERT INTO $tablaDB1(NOMBRE, APELLIDO, TIPO_DOCUMENTO, NO_DOCUMENTO, PAIS, 
        FECHA_NACIMIENTO, SEXO, DOMICILIO, TELEFONO, CELULAR, EMAIL, TIPO_SANGRE) 
        VALUES (:nombre, :apellido, :tipo_documento, :no_documento, :pais,
        :fecha_nacimiento, :sexo, :domicilio, :telefono, :celular, :email, :tipo_sangre)");

        $pdo->bindParam(":nombre", $datosC["nombre"], PDO::PARAM_STR);
        $pdo->bindParam(":apellido", $datosC["apellido"], PDO::PARAM_STR);
        $pdo->bindParam(":tipo_documento", $datosC["tipo_identificacion"], PDO::PARAM_STR);
        $pdo->bindParam(":no_documento", $datosC["no_identificacion"], PDO::PARAM_STR);
        $pdo->bindParam(":pais", $datosC["pais"], PDO::PARAM_STR);
        $pdo->bindParam(":fecha_nacimiento", $datosC["fecha-nacimiento"], PDO::PARAM_STR);
        $pdo->bindParam(":sexo", $datosC["sexo"], PDO::PARAM_STR);
        $pdo->bindParam(":domicilio", $datosC["domicilio"], PDO::PARAM_STR);
        $pdo->bindParam(":telefono", $datosC["telefono"], PDO::PARAM_STR);
        $pdo->bindParam(":celular", $datosC["celular"], PDO::PARAM_STR);
        $pdo->bindParam(":email", $datosC["email"], PDO::PARAM_STR);
        $pdo->bindParam(":tipo_sangre", $datosC["tipo-sangre"], PDO::PARAM_STR);


        if ($pdo->execute()) {

            return true;
        }

        $pdo . close();
        $pdo = null;
    }

    // CONSULTA DE PERFIL DEL USUARIO
    static public function VerPerfilM($tablaDB, $columna, $valor, $columnaU, $valorU)
    {

        $pdo = ConexionDB::cDB()->prepare("SELECT * FROM $tablaDB WHERE $columna =:$columna and $columnaU =:$columnaU");

        $pdo->bindParam(":" . $columna, $valor, pdo::PARAM_STR);
        $pdo->bindParam(":" . $columnaU, $valorU, pdo::PARAM_STR);


        $pdo->execute();

        return $pdo->fetchAll();

        $pdo . close();
        $pdo = null;
    }

    // CONSULTA DE PERFIL DEL USUARIO DOCUMENTO, ESTADO, SEXO, ETC.
    static public function ConsultaPerfil($tablaDB, $columna, $valor)
    {

        $pdo = ConexionDB::cDB()->prepare("SELECT * FROM $tablaDB WHERE $columna =:$columna");

        $pdo->bindParam(":" . $columna, $valor, pdo::PARAM_STR);

        $pdo->execute();

        return $pdo->fetchAll();

        $pdo . close();
        $pdo = null;
    }


    static public function ConsultaEditarPerfil($tablaDB, $columna, $valor)
    {

        $pdo = ConexionDB::cDB()->prepare("SELECT * FROM $tablaDB WHERE $columna =:$columna");

        $pdo->bindParam(":" . $columna, $valor, pdo::PARAM_STR);

        $pdo->execute();

        return $pdo->fetch();

        $pdo . close();
        $pdo = null;
    }


    // CAMBIAR CLAVE DE ACCESO
    static public function CambiarPasswordM($tablaDB, $datosC)
    {
        $pdo = ConexionDB::cDB()->prepare("UPDATE $tablaDB SET CLAVE_ACCESO = :clave WHERE ID_USUARIO = :id");

        $pdo->bindParam(":id", $datosC["id"], PDO::PARAM_INT);
        $pdo->bindParam(":clave", $datosC["password"], PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        } else {
            return false;
        }
    }


    /*=============================================
	Actualizar usuario
	=============================================*/

    static public function mdlActualizarUsuario($tabla, $id, $item, $valor)
    {

        $stmt = ConexionDB::cDB()->prepare("UPDATE $tabla SET $item = :$item WHERE ID_USUARIO = :id_usuario");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(ConexionDB::cDB()->errorInfo());
        }

        $stmt->close();

        $stmt = null;
    }


    //ACTUALIZAR DATOS PERSONALES
    static public function ActualizarPerfilM($tablaDB1, $datosC)
    {

        $pdo = ConexionDB::cDB()->prepare("UPDATE $tablaDB1 SET NOMBRE = :nombre, APELLIDO = :apellido, 
            TIPO_DOCUMENTO = :tipo_documento, NO_DOCUMENTO = :no_documento, PAIS = :pais, FECHA_NACIMIENTO = :fecha_nacimiento,
            SEXO = :sexo, DOMICILIO =  :domicilio, TELEFONO = :telefono, CELULAR = :celular, 
            TIPO_SANGRE = :tipo_sangre WHERE CODIGO_PERSONA = :codigo_persona");

        $pdo->bindParam(":codigo_persona", $datosC["codigo_persona"], PDO::PARAM_STR);
        $pdo->bindParam(":nombre", $datosC["nombre"], PDO::PARAM_STR);
        $pdo->bindParam(":apellido", $datosC["apellido"], PDO::PARAM_STR);
        $pdo->bindParam(":tipo_documento", $datosC["tipo_documento"], PDO::PARAM_STR);
        $pdo->bindParam(":no_documento", $datosC["no_documento"], PDO::PARAM_STR);
        $pdo->bindParam(":pais", $datosC["pais"], PDO::PARAM_STR);
        $pdo->bindParam(":fecha_nacimiento", $datosC["fecha_nacimiento"], PDO::PARAM_STR);
        $pdo->bindParam(":sexo", $datosC["sexo"], PDO::PARAM_STR);
        $pdo->bindParam(":domicilio", $datosC["domicilio"], PDO::PARAM_STR);
        $pdo->bindParam(":telefono", $datosC["telefono"], PDO::PARAM_STR);
        $pdo->bindParam(":celular", $datosC["celular"], PDO::PARAM_STR);
        $pdo->bindParam(":tipo_sangre", $datosC["tipo_sangre"], PDO::PARAM_STR);


        if ($pdo->execute()) {

            return true;
        }

        $pdo . close();
        $pdo = null;
    }
}
