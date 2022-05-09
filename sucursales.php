<?php

$find              = null;
$latitude          = null;
$longitude         = null;
$formatted_address = null;

if (isset($_GET['find'])) {

    // Parametros de Configuracion
    $api_key = "AIzaSyChVyb2nPgMzs1jsi7c-2y_j7pMZw6YU-E"; // API Key Google Maps

    $find = urlencode(trim($_GET['find']));

    // Webservices
    $google_maps_url   = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $find . "&key=" . $api_key;
    $google_maps_json  = file_get_contents($google_maps_url);
    $google_maps_array = json_decode($google_maps_json, true);

    // Get Location
    $latitude          = ($google_maps_array["results"][0]["geometry"]['location']['lat']);
    $longitude         = ($google_maps_array["results"][0]["geometry"]['location']['lng']);
    $formatted_address = ($google_maps_array["results"][0]["formatted_address"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestras sucursales</title>
    <link rel="stylesheet" href="css/flatly.min.css">

    <!--Importaciones de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Implementacion del CSS -->
    <link href="css/styles.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?= $api_key ?>"></script>

    <script src="js/gmaps.min.js"></script>
    <script type="text/javascript">
        var map;
        $(document).ready(function() {
            map = new GMaps({
                div: '#map',
                lat: <?= $latitude ?>,
                lng: <?= $longitude ?>,
                zoom: 16,
                mapTypeId: google.maps.MapTypeId.HYBRID
            });

            map.addMarker({
                lat: <?= $latitude ?>,
                lng: <?= $longitude ?>,
                title: '<?= $formatted_address ?>',
                infoWindow: {
                    content: '<?= $formatted_address ?>'
                }
            });
        });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(function() {
            $(document).on('change', '#mySelect', function() { //detectamos el evento change
                var value = $(this).val(); //sacamos el valor del select
                $('#find').val(value); //le agregamos el valor al input (notese que el input debe tener un ID para que le caiga el valor)
            });
        });
    </script>

    <style>
        #map {
            width: 1200px;
            height: 400px;
            border: #2c3e50 solid;
            border-width: 4px 4px 4px 4px;
        }
    </style>
</head>

<body>

    <header>
        <div class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a href="home.php" class="navbar-brand">
                    <strong class="p-2">PlayApp</strong>
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
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 style="text-align: center;">Nuestra sucursales</h1>
                    <h2 style="text-align: center;">Contamos con algunas sucursales, repartidas por Puebla y México</h2>
                    <form class="form-inline" method="get" style="text-align: center;">
                        <div class="form-group m-4">
                            <select class="custom-select" id="mySelect">
                                <option selected>Seleccione una de nuestras sucursales de entrega</option>
                                <option value="109 Av Independencia Atlixco, Puebla">Colonia Centro, Atlixco</option>
                                <option value="6104 Río Suchiate Puebla de Zaragoza, Puebla">Jardines de San Manuel,Puebla</option>
                                <option value="247 C. San Macario Ciudad de México, Cd. de México">Santa Ursula, Coapa,Mexico</option>
                            </select>
                            <input class="form-control m-4" type="text" hidden name="find" id="find" value="<?= urldecode($find) ?>">
                        </div>
                        <input class="btn btn-primary" type="submit" value="Buscar sucursales">
                    </form>
                    <br>
                </div>
            </div>
            <hr>
            <div class="row">
                <div id="map"></div>
            </div>
        </div>
        <script src="js/bootstrap.min.js"></script>
    </main>

</body>

</html>