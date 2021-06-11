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