<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Board Games Store</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/carousel/">

    <link rel="stylesheet" href="css/carousel.css">


    <!--Importaciones de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">


    <!--Implementación del SDK de JavaScript para usar la API de Paypal-->
    <script src="https://www.paypal.com/sdk/js?client-id=AcFKF1P4ZJMwphxJvTmkm4Jlmksa6w54Wi9-A_B_0Pd7pcsukyKfRgkRI6G-m2jtfREdBJlsfwh0ZsSK&currency=MXN"></script>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


</head>

<body>
    <header>
        <div class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
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
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <img src="img/carrusel1.jpg" alt="" width="100%" height="100%">
                    </svg>

                    <div class="container">
                        <div class="carousel-caption text-start">
                            <h1>Mercancía internacional</h1>
                            <p>¡Los juegos más exóticos los encontrarás aquí!</p>
                            <p><a class="btn btn-lg btn-primary" href="catalogo.php">Ver juegos</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <img src="img/open-sign-1309682_1920.jpg" alt="" width="100%" height="100%">
                    </svg>

                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Ubica nuestras sucursales cerca de ti </h1>
                            <p>Contamos con sucursales en distintos puntos de la Republica.</p>
                            <p><a class="btn btn-lg btn-primary" href="sucursales.php">Buscar sucursal</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <img src="img/money-256319_1920.jpg" alt="" width="100%" height="100%">
                    </svg>

                    <div class="container">
                        <div class="carousel-caption text-end">
                            <h1>Facilidad de pago </h1>
                            <p>Contamos con distintos métodos de pago para que no te quedes sin tu juego favorito. </p>
                            <p><a class="btn btn-lg btn-primary" href="catalogo.php">Comprar ahora</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>


        <!-- Marketing messaging and featurettes
  ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->

        <div class="container marketing">

            <!-- Three columns of text below the carousel -->
            <div class="row">
                <div class="col-lg-4">
                    <img class="bd-placeholder-img rounded-circle" src="img/people-2557396_1920.jpg" alt="" height="140" width="140">
                    <h2>Ameniza tus reuniones</h2>
                    <p>Con los mejores juegos de mesa podrás ser el alma de las reuniones con tus amigos</p>
                    <p><a class="btn btn-secondary" href="#">Ver más &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <img class="bd-placeholder-img rounded-circle" src="img/mexico-6569302_640.png" alt="" height="140" width="140">
                    <h2>Mayor alcance nacional</h2>
                    <p>Contamos con ejemplares exclusivos de otros países así como versiones originales de juegos clásicos.</p>
                    <p><a class="btn btn-secondary" href="#">Más información &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <img class="bd-placeholder-img rounded-circle" src="img/load-2060616_640.jpg" alt="" height="140" width="140">
                    <h2>Sucursales fisicas</h2>
                    <p>Contamos con sucursales donde puedes apreciar de mejor manera los productos que manejamos</p>
                    <p><a class="btn btn-secondary" href="sucursales.php">Ver más &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->


            <!-- START THE FEATURETTES -->

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading">Los juegos de mesa. <span class="text-muted">Te vuelan la cabeza</span></h2>
                    <p class="lead">Además de ser muy divertidos y que sean jugados por todo el mundo, te permiten mantener ejercitada la mente.</p>
                </div>
                <div class="col-md-5">
                    <img src="img/casino-1107736_1920.jpg" alt="" height="500" width="100%">
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading">No debes precisamente tenerlo en físico. <span class="text-muted">Hay versiones digitales</span></h2>
                    <p class="lead">Hoy en día contamos además con diversas versiones de juegos tanto nuevos como clásicos gracias a los avances tecnológicos y a la Inteligencia Artificial</p>
                </div>
                <div class="col-md-5 order-md-1">
                    <img src="img/game-3760665_1920.jpg" alt="" height="500" width="100%">

                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading">Todos los juegan. <span class="text-muted">Chicos y grandes.</span></h2>
                    <p class="lead">Existen muchas personas que además de tomarlos como pasatiempos se llevan a cabo torneos y se forman comunidades donde lo más importante es divertirse y ejecitar la mente. </p>
                </div>
                <div class="col-md-5">
                    <img src="img/chess-1582516_1920.jpg" alt="" height="500" width="100%">

                </div>
            </div>

            <hr class="featurette-divider">

            <!-- /END THE FEATURETTES -->

        </div><!-- /.container -->


        <!-- FOOTER -->
        <footer class="container">
            <p class="float-end"><a href="home.php">Back to top</a></p>
            <p>&copy; 2017–2021 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
        </footer>
    </main>

</body>

<!--Implemetación del Bundle para -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>