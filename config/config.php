<?php

define("KEY_TOKEN", "APR.wqc-354*");
define("CURRENCY", "MXN");
define("CLIENT_ID", "AcFKF1P4ZJMwphxJvTmkm4Jlmksa6w54Wi9-A_B_0Pd7pcsukyKfRgkRI6G-m2jtfREdBJlsfwh0ZsSK");
define("MONEDA", "$");

session_start();

$num_cart = 0;
if (isset($_SESSION['carrito']['juegos'])) {
    $num_cart = count($_SESSION['carrito']['juegos']);
}
