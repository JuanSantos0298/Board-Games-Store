<?php

require 'config/database.php';
require 'config/config.php';

$db = new Database();
$con = $db->conectar();
$productos = isset($_SESSION['carrito']['juegos']) ? $_SESSION['carrito']['juegos'] : null;

$lista_carrito = array();

/*Carrito*/
if ($productos != null) {
    foreach ($productos as $clave => $cantidad) {

        //Pasteles
        $sql = $con->prepare("SELECT id_juego, nombre, costo, descuento, $cantidad AS cantidad FROM juegos WHERE id_juego=? AND activo=1");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    }
} else {
    header("Location:home.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BakeryApp</title>

    <!--Importaciones de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Implementacion del CSS -->
    <link href="css/styles.css" rel="stylesheet">

</head>

<body>

    <header>
        <div class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a href="home.php" class="navbar-brand">
                    <strong>PlayApp</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarHeader">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="catalogo.php" class="nav-link active">Catalogo</a>
                        </li>
                        <li class="nav-item">
                            <a href="sucursales.php" class="nav-link">Nuestras sucursales</a>
                        </li>
                    </ul>

                    <a href="#" class="btn btn-primary">Carrito de compra<span id="num_cart" class="bagde bg-secondary"><?php echo $num_cart ?></span></a>

                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="container">

            <div class="row">
                <div class="col-6">
                    <h4>Detalles de pago </h4>
                    <div id="paypal-button-container"></div>
                </div>

                <div class="col-6">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($lista_carrito == null) {
                                    echo '<tr><td colspan ="5" class = "text-center"><b>Lista Vacia</b></td></tr>';
                                } else {
                                    $total = 0;
                                    foreach ($lista_carrito as $item) {
                                        $_id = $item['id_juego'];
                                        $nombre = $item['nombre'];
                                        $precio = $item['costo'];
                                        $cantidad = $item['cantidad'];
                                        $descuento = $item['descuento'];
                                        $precio_descuento = $precio - (($precio * $descuento) / 100);
                                        $subtotal = $cantidad * $precio_descuento;
                                        $total += $subtotal;
                                ?>

                                        <tr>
                                            <td><?php echo $nombre; ?></td>
                                            <td>
                                                <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]">$<?php echo number_format($subtotal, 2, '.', ','); ?></div>
                                            </td>

                                        <?php } ?>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                <p class="h3 text-end" id="total">$<?php echo number_format($total, 2, '.', ',') ?></p>
                                            </td>
                                        </tr>
                            </tbody>
                        <?php } ?>
                        </table>
                    </div>

                </div>
            </div>
            <br><br>
            <div class="text-center">
                <a class="btn btn-primary" href="php/factura.php">Obten tu factura</a>
            </div>

        </div>
    </main>


    <!--Implemetación del Bundle para -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!--Implementación del SDK de JavaScript para usar la API de Paypal-->
    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>&currency=<?php echo CURRENCY; ?>"></script>

    <!--Script de JS para el uso de los botones -->
    <script>
        let url = 'php/captura.php'
        paypal.Buttons({
            style: {
                color: 'blue',
                shape: 'pill',
                label: 'pay'
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: <?php echo $total ?>
                        }
                    }]
                });
            },

            onApprove: function(data, actions) {
                actions.order.capture().then(function(detalles) {
                    console.log(detalles)
                    return fetch(url, {
                        method: 'post',
                        headers: {
                            'content-type': 'application/json'
                        },
                        body: JSON.stringify({
                            detalles: detalles
                        })
                    })
                });
            },

            onCancel: function(data) {
                alert("Se ha cancelado el pago. ")
                console.log(data)
            }


        }).render('#paypal-button-container')
    </script>


</body>

</html>