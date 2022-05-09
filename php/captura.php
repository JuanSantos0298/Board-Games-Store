<?php

require '../config/database.php';
require '../config/config.php';

$db = new Database();
$con = $db->conectar();

$json = file_get_contents('php://input');
$datos = json_decode($json, true);


echo "<pre>";
print_r($datos);
echo "</pre>";

if (is_array($datos)) {

    $id_transaccion = $datos['detalles']['id'];
    $total = $datos['detalles']['purchase_units'][0]['amount']['value'];
    $status = $datos['detalles']['status'];
    $fecha = $datos['detalles']['update_time'];
    $fecha_nueva = date('Y-m-d H:i:s', strtotime($fecha));
    $email = $datos['detalles']['payer']['email_address'];
    $id_cliente = $datos['detalles']['payer']['payer_id'];

    $sql = $con->prepare("INSERT INTO compra(id_transaccion,fecha,status,email,id_cliente,total) VALUES (?,?,?,?,?,?)");
    $sql->execute([$id_transaccion, $fecha_nueva, $status, $email, $id_cliente, $total]);

    $id = $con->lastInsertId();

    if ($id > 0) {

        $productos = isset($_SESSION['carrito']['juegos']) ? $_SESSION['carrito']['juegos'] : null;

        /*Carrito*/
        if ($productos != null) {
            foreach ($productos as $clave => $cantidad) {

                //Pasteles
                $sql = $con->prepare("SELECT id_juego, nombre, costo, descripcion, categoria,  descuento FROM juegos WHERE id_juego=? AND activo=1");
                $sql->execute([$clave]);
                $row_prod = $sql->fetch(PDO::FETCH_ASSOC);

                $nombre = $row_prod['nombre'];
                $precio = $row_prod['costo'];
                $descripcion = $row_prod['descripcion'];
                $descuento = $row_prod['descuento'];
                $precio_descuento = $precio - (($precio * $descuento) / 100);

                $sql_insert = $con->prepare("INSERT INTO detalle_compra(id_compra,id_producto, nombre ,precio,cantidad) VALUES (?,?,?,?,?)");
                $sql_insert->execute([$id, $clave, $row_prod['nombre'], $precio_descuento, $cantidad]);
            }
        }
    }
}
