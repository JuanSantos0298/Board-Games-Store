<?php

$hostname = "localhost";
$database = "juegos";
$username = "root";
$password = "";
$charset = "utf8";

$conexion = mysqli_connect($hostname, $username, $password, $database);

$usuario = $_POST['usuario'];
$password = $_POST['contraseña'];

//Creamos sesiones para que guarde el nombre de usuario y password
session_start();

//Guardamos los datos en la sesion
$_SESSION['usuario'] = $usuario;

//Creamos el query para validar 
$sql = "SELECT * FROM usuarios where username='$usuario' and password = '$password'";
$resultado = mysqli_query($conexion, $sql);

$filas = mysqli_num_rows($resultado);

if ($filas) {
    header("location:home.php");
} else {
?>
    <?php
    include("index.php");
    ?>
    <h1>Error de autenticado. El usuario no se encuentra registrado </h1>
<?php
}
mysqli_free_result($resultado);
mysqli_close($conexion);
