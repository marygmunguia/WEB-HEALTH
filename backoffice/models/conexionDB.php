<?php

class ConexionDB{

	static public function cDB(){

		$link = new PDO("mysql:host=localhost;dbname=proyectocitasmedicas",
						"root",
						"");

		$link->exec("set names utf8");

		return $link;

	}

}

//CONEXION PARA MOSTRAR MEDICOS CON SELECT

$mysqli = new mysqli("localhost","root","","proyectocitasmedicas");

if(mysqli_connect_errno()){
    echo 'CONEXION FALLIDA: ', mysqli_connect_error();
    exit();
}

