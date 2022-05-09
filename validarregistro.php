<?php

$hostname = "localhost";
$database = "juegos";
$username = "root";
$password = "";
$charset = "utf8";

$conexion = mysqli_connect($hostname, $username, $password, $database);

if (isset($_POST['register'])) {
    if (strlen($_POST['usuario']) >= 1 && strlen($_POST['contraseña']) >= 1) {
        $usuario = trim($_POST['usuario']);
        $contraseña = trim($_POST['contraseña']);
        $query = "INSERT INTO usuarios(username, password) VALUES ('$usuario','$contraseña')";
        $resultado = mysqli_query($conexion, $query);
        if ($resultado) {
?>
            <?php include("registro.php"); ?>
            <p class="btn btn-success">Se ha registrado al usuario de manera exitosa</p>
        <?php
        } else {
        ?>
            <?php include("registro.php"); ?>
            <p class="text-center btn-btn-danger">No se ha podido registrar al usuario</p>
<?php
        }
    }
}



?>