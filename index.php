<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Board Games Store</title>

    <!--Importaciones de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">

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

    <!-- Implementacion del CSS -->
    <link href="css/signin.css" rel="stylesheet">

    <!--Implementación del SDK de JavaScript para usar la API de Paypal-->
    <script src="https://www.paypal.com/sdk/js?client-id=AUi2ss7xR07wl21rey1Or02m3AU3mRBZczfeMeT_CBCEUtH1HOjI5S_T71ASbIixVJYBmdwvXbj06on5&currency=MXN"></script>

</head>

<body class="text-center">
    <main class="form-signin">
        <img class="mb-4" src="img/extras/logo.png" alt="" width="72" height="57">
        <h1 class="h2 mb-3 fw-normal">Board Games Store</h1>
        <form action="validarlogin.php" method="post">
            <h1 class="h3 mb-3 fw-normal">Inicie sesion</h1>

            <div class="form-floating">
                <input type="text" class="form-control" name="usuario" placeholder="Ingrese su nombre de usuario">
                <label for="floatingInput">Nombre de usuario</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="contraseña" placeholder="Contraseña">
                <label for="floatingPassword">Contraseña</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Recuerdame
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Iniciar sesión</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
        </form>
    </main>

</body>

</html>