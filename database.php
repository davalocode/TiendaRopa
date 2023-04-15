<?php 

    session_start();

    if (array_key_exists("id",$_COOKIE)) {
        $_SESSION['id'] = $_COOKIE['id'];
      }
    if (array_key_exists("id",$_SESSION))
    { 

    $servidor = "sdb-57.hosting.stackcp.net";
    $database = "proyectotienda-35303135db7e";
    $usuario = "dani-8dfc";
    $password = "usuario123";
    
    $enlace = mysqli_connect($servidor, $usuario, $password, $database);

    }
    else {
        echo "<script>window.location.href = 'https://proyectotienda-com.stackstaging.com/iniciosesion.php';</script>";
      }
    ?>