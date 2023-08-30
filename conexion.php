
<?php 
//-------------------------Conexion con la base de datos---------------------
$server = "localhost";
$username = "root";
$password = "";
$db = "testsisma1";

$conexion = new mysqli($server, $username, $password, $db);

if($conexion->connect_error){
    die("Conexion Fallida " . $conn->connect_error);

}


?>