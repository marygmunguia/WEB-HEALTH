<?php

require_once 'conexionDB.php';

class UsuarioModelo extends ConexionDB
{


    static public function RestablecerPasswordM($tablaDB, $email, $password)
    {

        $pdo = ConexionDB::cDB()->prepare("UPDATE $tablaDB SET CLAVE_ACCESO = :Rpassword WHERE NOMBRE_USUARIO = :Remail");

        $pdo->bindParam(":Rpassword", $password, PDO::PARAM_STR);
        $pdo->bindParam(":Remail", $email, PDO::PARAM_STR);

        if ($pdo->execute()) {

            return true;

        } else {
            
            return false;
        }

        $pdo . close();
        $pdo = null;
    }

    static public function IngresoUsuarioM($view, $item, $value)
    {

        if ($item != null && $value != null) {

            $stmt = ConexionDB::cDB()->prepare("SELECT * FROM $view WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

            $stmt . close();
            $stmt = null;
        } else {

            $stmt = ConexionDB::cDB()->prepare("SELECT * FROM $view");

            $stmt->execute();

            return $stmt->fetchAll();

            $stmt . close();
            $stmt = null;
        }
    }


    //CONSULTAR CODIGO DE PERSONA Y CODIGO DE USUARIO DE ADMINISTRADORES
    static public function consultarPersonaUsuarioM($view, $datosC)
    {

        $stmt = ConexionDB::cDB()->prepare("SELECT * FROM $view WHERE EMAIL = :email");
        $stmt->bindParam(":email", $datosC["email"], PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt . close();
        $stmt = null;
    }


    // INSERTAR ADMINISTRADORES
    static public function InsertarAdminM($tablaDB3, $persona, $usuario)
    {

        $pdo = ConexionDB::cDB()->prepare("INSERT INTO $tablaDB3(CODIGO_PERSONA, ID_USUARIO) VALUES (:persona, :usuario)");

        $pdo->bindParam(":persona", $persona, PDO::PARAM_STR);
        $pdo->bindParam(":usuario", $usuario, PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        }

        $pdo . close();
        $pdo = null;
    }


    // CREAR USUARIOS
    static public function CrearUsuarioM($tablaDB2, $datosC)
    {

        $pdo = ConexionDB::cDB()->prepare("INSERT INTO $tablaDB2(NOMBRE_USUARIO, CLAVE_ACCESO, ESTADO, ID_ROL, FECHA_REGISTRO, IMG_PERFIL) 
        VALUES (:usuario, :clave, :estado, :rol, :registro, :img)");

        $pdo->bindParam(":usuario", $datosC["usuario"], PDO::PARAM_STR);
        $pdo->bindParam(":clave", $datosC["clave"], PDO::PARAM_STR);
        $pdo->bindParam(":estado", $datosC["estado"], PDO::PARAM_STR);
        $pdo->bindParam(":rol", $datosC["rol"], PDO::PARAM_STR);
        $pdo->bindParam(":registro", $datosC["registro"], PDO::PARAM_STR);
        $pdo->bindParam(":img", $datosC["img"], PDO::PARAM_STR);


        if ($pdo->execute()) {
            return true;
        }

        $pdo . close();
        $pdo = null;
    }
}
