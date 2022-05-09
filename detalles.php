<?php

require 'config/database.php';
require 'config/config.php';

$db = new Database();
$con = $db->conectar();

$id = isset($_GET['id_juego']) ? $_GET['id_juego'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($id == '' || $token == '') {
    echo "Error. No se ha procesado la petición";
    exit;
} else {
    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

    if ($token == $token_tmp) {
        $sql = $con->prepare("SELECT count(id_juego) FROM juegos WHERE id_juego=? AND activo=1");
        $sql->execute([$id]);

        if ($sql->fetchColumn() > 0) {
            $sql = $con->prepare("SELECT id_juego, nombre, descripcion, costo, categoria, num_jugadores, tiempo_juego, edad_recomendada, ranking , ruta , descuento FROM juegos WHERE id_juego=? AND activo=1 LIMIT 1");
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);

            $nombre = $row['nombre'];
            $descripcion = $row['descripcion'];
            $precio = $row['costo'];

            $descuento = $row['descuento'];
            $precio_desc = ($precio - (($precio * $descuento) / 100));

            $imagen = $row['ruta'];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de producto</title>

    <!--Importaciones de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Implementacion del CSS -->
    <link href="css/styles.css" rel="stylesheet">

    <!--Implementación del SDK de JavaScript para usar la API de Paypal-->
    <script src="https://www.paypal.com/sdk/js?client-id=AUi2ss7xR07wl21rey1Or02m3AU3mRBZczfeMeT_CBCEUtH1HOjI5S_T71ASbIixVJYBmdwvXbj06on5&currency=MXN"></script>

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

                    <a href="checkout.php" class="btn btn-primary">Carrito de compra</a>

                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-6 order-md-1">
                    <img src="<?php echo $imagen ?>" alt="">
                </div>
                <div class="col-md-6 order-md-2">
                    <h2><?php echo $nombre ?></h2>

                    <?php if ($descuento > 0) { ?>
                        <p><del>$<?php echo number_format($precio, 2, '.', ','); ?> </del></p>
                        <h2>$<?php echo number_format($precio_desc, 2, '.', ',') ?>
                            <small class="text-success"><?php echo $descuento; ?> % de descuento</small>
                        </h2>

                    <?php } else { ?>

                        <h2>$<?php echo number_format($precio, 2, '.', ',') ?></h2>

                    <?php } ?>

                    <p class="lead">
                        <?php echo $descripcion; ?>
                    </p>

                    <div class="d-grid gap-3 col-10 mx-auto">
                        <button class="btn btn-primary" type="button">Comprar ahora</button>
                        <button class="btn btn-outline-primary" type="button" onclick="agregarProducto(<?php echo $id; ?>,'<?php echo $token; ?>')">Agregar al carrito</button>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!--Implemetación del Bundle para -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
        function agregarProducto(id, token) {
            let url = 'php/carrito.php'
            let formData = new FormData()

            formData.append('id', id)
            formData.append('token', token)

            fetch(url, {
                    method: 'POST',
                    body: formData,
                    mode: 'cors'
                }).then(response => response.json())
                .then(data => {
                    if (data.ok) {
                        let elemento = document.getElementById("num_cart")
                        elemento.innerHTML = data.numero;
                    }
                })
        }
    </script>

</body>

</html>