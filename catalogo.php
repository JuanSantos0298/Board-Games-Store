<?php

require 'config/database.php';
require 'config/config.php';

$db = new Database();

$con = $db->conectar();

$sql = $con->prepare("SELECT id_juego, nombre, costo, categoria, ranking, ruta from juegos");

$sql->execute();

$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo</title>
</head>

<!--Importaciones de Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<!-- Implementacion del CSS -->
<link href="css/styles.css" rel="stylesheet">

<!--Implementación del SDK de JavaScript para usar la API de Paypal-->
<script src="https://www.paypal.com/sdk/js?client-id=AcFKF1P4ZJMwphxJvTmkm4Jlmksa6w54Wi9-A_B_0Pd7pcsukyKfRgkRI6G-m2jtfREdBJlsfwh0ZsSK&currency=MXN"></script>

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

                    <a href="checkout.php" class="btn btn-primary">Carrito de compra<span id="num_cart" class="bagde bg-secondary"><?php echo $num_cart ?></span></a>

                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="container mt-4">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($resultado as $row) { ?>
                    <div class="col">
                        <div class="card shadow-sm " style="width: 18rem; ">
                            <?php

                            $id = $row['ruta'];
                            $imagen = $id;

                            if (!file_exists($imagen)) {
                                $imagen = "img/no-photo.jpg";
                            }

                            ?>

                            <img src="<?php echo $imagen ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['nombre'] ?></h5>
                                <p class="card-text">$<?php echo number_format($row['costo'], 2, '.', ',') ?></p>
                                <p class="card-text"><?php echo $row['categoria'] ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="detalles.php?id_juego=<?php echo $row['id_juego']; ?>&token=<?php echo hash_hmac('sha1', $row['id_juego'], KEY_TOKEN); ?>" class="btn btn-primary">Detalles</a>
                                    </div>
                                    <button class="btn btn-outline-primary" type="button" onclick="agregarProducto(<?php echo $row['id_juego']; ?>,'<?php echo hash_hmac('sha1', $row['id_juego'], KEY_TOKEN); ?>')">Agregar al carrito</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
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