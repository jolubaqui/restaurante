<?php

$servidor =   "localhost"; //nombre del servidor de   la base de datos
$usuario = "root";        //usuario que se va a utilizar para el inicio de sesion en mysql
$contrasena = "";         //contr aseña del usuario anterior
$bd = "restaurante";       //nombre de la base de datos  

//Creación de la conexión ala BD

try {

    $conexion = new PDO("mysql:host=$servidor;dbname=$bd", $usuario, $contrasena);

    //Catch de errores si o
} catch (
    Exception $error
) {
    echo $error->getMessage();
}
